<?php

/**
 * One-shot ops: symlink storage, sync code from _patch, migrate + seed testimonials.
 *
 * GET /ops-patch.php?s=v3hr7-ops-patch&step=all
 * Delete this file after use.
 */
declare(strict_types=1);

const OPS_SECRET = 'v3hr7-ops-patch';

if (! hash_equals(OPS_SECRET, (string) ($_GET['s'] ?? ''))) {
  http_response_code(403);
  header('Content-Type: text/plain; charset=utf-8');
  exit('Forbidden');
}

header('Content-Type: text/plain; charset=utf-8');

// Live in public/, or under public/_*/public/ after a Hostinger git deploy clone.
$fromNestedDeploy = (bool) preg_match(
  '#'.preg_quote(DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR, '#').'_[^'.preg_quote(DIRECTORY_SEPARATOR, '#').']+'.preg_quote(DIRECTORY_SEPARATOR.'public', '#').'$#',
  __DIR__
);
$admin = $fromNestedDeploy ? dirname(__DIR__, 3) : dirname(__DIR__);
$patchRoot = $fromNestedDeploy ? dirname(__DIR__) : $admin.'/_patch';
$step = (string) ($_GET['step'] ?? 'all');
$lines = [];

/**
 * Append a status line to the response buffer.
 *
 * @param  string  $message  Human-readable status.
 * @return void
 */
function opsLog(string $message): void
{
  global $lines;
  $lines[] = $message;
}

/**
 * Create or refresh the public/storage symlink to storage/app/public.
 *
 * @param  string  $admin  Absolute Laravel root path.
 * @return void
 */
function opsStorageLink(string $admin): void
{
  $link = $admin.'/public/storage';
  $target = $admin.'/storage/app/public';

  if (is_link($link)) {
    unlink($link);
    opsLog('removed old symlink');
  } elseif (is_dir($link)) {
    opsLog('public/storage already a directory — skipping symlink');
    return;
  } elseif (file_exists($link)) {
    unlink($link);
    opsLog('removed stray public/storage file');
  }

  if (! is_dir($target)) {
    opsLog('FAIL: storage/app/public missing');
    return;
  }

  $ok = @symlink($target, $link);
  if ($ok) {
    opsLog('symlink OK');
    opsLog('readlink='.readlink($link));
    return;
  }

  opsLog('symlink FAIL: '.json_encode(error_get_last()));
  opsCopyTree($target, $link);
  opsLog('copied storage/app/public -> public/storage');
}

/**
 * Copy app/database/routes from _patch into the live admin tree.
 *
 * @param  string  $admin  Absolute Laravel root path.
 * @return void
 */
/**
 * Copy app/database/routes from the patch root into the live admin tree.
 *
 * @param  string  $admin  Absolute Laravel root path.
 * @param  string  $patch  Absolute path of the cloned patch sources.
 * @return void
 */
function opsSyncPatch(string $admin, string $patch): void
{
  if (! is_dir($patch.'/app')) {
    opsLog('FAIL: patch app/ missing at '.$patch);
    return;
  }

  foreach (['app', 'database', 'routes'] as $dir) {
    $src = $patch.'/'.$dir;
    $dst = $admin.'/'.$dir;
    if (! is_dir($src)) {
      opsLog("skip missing $dir");
      continue;
    }
    opsCopyTree($src, $dst);
    opsLog("synced $dir");
  }
}

/**
 * Recursively copy directory contents from $src into $dst.
 *
 * @param  string  $src  Source directory.
 * @param  string  $dst  Destination directory.
 * @return void
 */
function opsCopyTree(string $src, string $dst): void
{
  if (! is_dir($dst)) {
    mkdir($dst, 0755, true);
  }
  $iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($src, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
  );
  foreach ($iterator as $item) {
    $target = $dst.DIRECTORY_SEPARATOR.$iterator->getSubPathName();
    if ($item->isDir()) {
      if (! is_dir($target)) {
        mkdir($target, 0755, true);
      }
    } else {
      copy($item->getPathname(), $target);
    }
  }
}

/**
 * Run artisan migrate, seed testimonials, clear config, generate shield.
 *
 * @param  string  $admin  Absolute Laravel root path.
 * @return void
 */
function opsArtisan(string $admin): void
{
  require $admin.'/vendor/autoload.php';
  $app = require $admin.'/bootstrap/app.php';
  $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

  $filamentPanelCache = $admin.'/bootstrap/cache/filament/panels/admin.php';
  if (is_file($filamentPanelCache)) {
    @unlink($filamentPanelCache);
    opsLog('removed filament panel cache');
  }

  $calls = [
    ['migrate', ['--force' => true]],
    ['db:seed', ['--class' => \Database\Seeders\TestimonialSeeder::class, '--force' => true]],
    ['app:sync-shield-permissions', []],
    ['optimize:clear', []],
    ['filament:optimize-clear', []],
    ['permission:cache-reset', []],
  ];

  foreach ($calls as [$command, $params]) {
    try {
      $exit = $kernel->call($command, $params);
      opsLog("artisan $command => exit $exit");
      $output = trim((string) $kernel->output());
      if ($output !== '') {
        opsLog($output);
      }
    } catch (Throwable $e) {
      opsLog("artisan $command FAIL: ".$e->getMessage());
    }
  }
}

opsLog('admin='.$admin);
opsLog('patchRoot='.$patchRoot);

if ($step === 'storage' || $step === 'all') {
  opsStorageLink($admin);
}
if ($step === 'sync' || $step === 'all') {
  opsSyncPatch($admin, $patchRoot);
}
if ($step === 'artisan' || $step === 'all') {
  opsArtisan($admin);
}

opsLog('DONE step='.$step);
echo implode("\n", $lines)."\n";
