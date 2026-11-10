<?php

/**
 * One-shot: download skyitupsas-front, zip into site roots, trigger Node builds.
 *
 * GET .../ops-front-deploy.php?s=v3hr7-ops-patch&domain=both|com|org
 */
declare(strict_types=1);

const OPS_SECRET = 'v3hr7-ops-patch';

if (! hash_equals(OPS_SECRET, (string) ($_GET['s'] ?? ''))) {
  http_response_code(403);
  header('Content-Type: text/plain; charset=utf-8');
  exit('Forbidden');
}

header('Content-Type: text/plain; charset=utf-8');
set_time_limit(300);

$fromNested = (bool) preg_match('#/public/_[^/]+/public$#', str_replace('\\', '/', __DIR__));
$admin = $fromNested ? dirname(__DIR__, 3) : dirname(__DIR__);
$domainArg = (string) ($_GET['domain'] ?? 'both');
$zipName = 'skyitupsas-front-deploy-v16.zip';
$frontTarApi = 'https://api.github.com/repos/silasmas/skyitupsas-front/tarball/main';
$tokenFile = '/home/u514199474/domains/skyitupsas.org/.deploy/hostinger_api_token';
$githubToken = trim((string) ($_SERVER['HTTP_X_GITHUB_TOKEN'] ?? ''));

$targets = [];
if ($domainArg === 'com' || $domainArg === 'both') {
  $targets['skyitupsas.com'] = '/home/u514199474/domains/skyitupsas.com/public_html';
}
if ($domainArg === 'org' || $domainArg === 'both') {
  $targets['skyitupsas.org'] = '/home/u514199474/domains/skyitupsas.org/public_html';
}

/**
 * Print a flushed status line.
 *
 * @param  string  $message  Status text.
 * @return void
 */
function out(string $message): void
{
  echo $message."\n";
  @ob_flush();
  @flush();
}

/**
 * Run a shell command and return trimmed output.
 *
 * @param  string  $command  Shell command.
 * @return string
 */
function sh(string $command): string
{
  $output = [];
  $code = 0;
  exec($command.' 2>&1', $output, $code);
  out('$ '.$command);
  out('exit='.$code.' '.implode(' | ', array_slice($output, 0, 8)));

  return trim(implode("\n", $output));
}

$token = trim((string) ($_SERVER['HTTP_X_OPS_TOKEN'] ?? ''));
if ($token === '') {
  foreach ([$tokenFile, $admin.'/.deploy/hostinger_api_token'] as $path) {
    if (is_file($path)) {
      $token = trim((string) file_get_contents($path));
      if ($token !== '') {
        break;
      }
    }
  }
}
if ($token === '') {
  out('FAIL: Hostinger API token missing (header X-Ops-Token or token file)');
  exit;
}

$tmp = '/tmp/sky-front-'.getmypid();
sh('rm -rf '.escapeshellarg($tmp));
sh('mkdir -p '.escapeshellarg($tmp.'/src'));
out('download...');
if ($githubToken === '') {
  out('FAIL: missing X-Github-Token for private front repo');
  exit;
}
$authHeader = 'Authorization: Bearer '.$githubToken;
sh('curl -fsSL -H '.escapeshellarg($authHeader).' -H '.escapeshellarg('Accept: application/vnd.github+json').' -H '.escapeshellarg('User-Agent: skyitup-ops').' '.escapeshellarg($frontTarApi).' -o '.escapeshellarg($tmp.'/front.tgz'));
sh('tar -xzf '.escapeshellarg($tmp.'/front.tgz').' -C '.escapeshellarg($tmp.'/src').' --strip-components=1');
$extracted = $tmp.'/src';
if (! is_file($extracted.'/package.json')) {
  out('FAIL: package.json missing after extract');
  exit;
}

$envBody = "NODE_ENV=production\nAPI_BASE_URL=https://admin.skyitupsas.org/api/v1\nNEXT_PUBLIC_API_BASE_URL=https://admin.skyitupsas.org/api/v1\nNEXT_PUBLIC_SITE_URL=https://skyitupsas.com\n";
file_put_contents($extracted.'/.env.production', $envBody);

foreach ($targets as $domain => $root) {
  if (! is_dir($root)) {
    out("skip missing root $domain");
    continue;
  }
  $zipPath = $root.'/'.$zipName;
  @unlink($zipPath);
  out("zip $domain...");
  sh('cd '.escapeshellarg($extracted).' && zip -rq '.escapeshellarg($zipPath).' . -x "node_modules/*" ".git/*" ".next/*"');
  if (! is_file($zipPath)) {
    out("FAIL zip $domain");
    continue;
  }
  out('zip bytes='.filesize($zipPath));

  $payload = json_encode([
    'node_version' => 22,
    'app_type' => 'next',
    'output_directory' => '.next',
    'build_script' => 'build',
    'source_type' => 'archive',
    'source_options' => ['archive_path' => $zipName],
  ], JSON_THROW_ON_ERROR);
  $url = 'https://developers.hostinger.com/api/hosting/v1/accounts/u514199474/websites/'.$domain.'/nodejs/builds';
  out("build $domain...");
  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
      'Authorization: Bearer '.$token,
      'Content-Type: application/json',
      'Accept: application/json',
    ],
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 60,
  ]);
  $body = (string) curl_exec($ch);
  $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $err = curl_error($ch);
  curl_close($ch);
  out("HTTP $code ".$body.($err !== '' ? " err=$err" : ''));
}

sh('rm -rf '.escapeshellarg($tmp));
out('DONE');
