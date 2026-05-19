<?php

/**
 * Exporte la base MySQL dans un fichier SQL ordonné (parents avant enfants).
 *
 * Usage : php database/scripts/export-ordered-sql.php
 *
 * @return int Code de sortie (0 = succès)
 */

declare(strict_types=1);

use Illuminate\Support\Facades\DB;

require __DIR__ . '/../../vendor/autoload.php';

$app = require __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

/** Ordre d'exécution : tables sans FK métier, puis tables liées. */
$tableOrder = [
  'users',
  'permissions',
  'roles',
  'cache',
  'cache_locks',
  'jobs',
  'job_batches',
  'failed_jobs',
  'password_reset_tokens',
  'sessions',
  'migrations',
  'role_has_permissions',
  'abouts',
  'blogs',
  'contacts',
  'services',
  'realisations',
  'team_members',
  'partners',
  'job_offers',
  'media',
  'newsletter_subscribers',
  'contact_messages',
  'job_applications',
  'model_has_permissions',
  'model_has_roles',
];

$outputPath = __DIR__ . '/../dumps/skyitupsas_ordered.sql';
$dir = dirname($outputPath);

if (! is_dir($dir)) {
  mkdir($dir, 0755, true);
}

$database = DB::connection()->getDatabaseName();
$existingTables = collect(DB::select('SHOW TABLES'))
  ->map(fn ($row) => array_values((array) $row)[0])
  ->all();

$lines = [
  '-- Export ordonné — ' . $database,
  '-- Généré le ' . date('Y-m-d H:i:s'),
  '-- Ordre : parents avant tables avec clés étrangères',
  '',
  'SET NAMES utf8mb4;',
  'SET FOREIGN_KEY_CHECKS = 0;',
  'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";',
  'SET time_zone = "+00:00";',
  '',
];

foreach ($tableOrder as $table) {
  if (! in_array($table, $existingTables, true)) {
    $lines[] = "-- Table absente (ignorée) : {$table}";
    $lines[] = '';

    continue;
  }

  $lines[] = "-- --------------------------------------------------------";
  $lines[] = "-- Structure et données : {$table}";
  $lines[] = '-- --------------------------------------------------------';
  $lines[] = '';

  $createRow = DB::selectOne('SHOW CREATE TABLE `' . str_replace('`', '``', $table) . '`');
  $createKey = 'Create Table';
  $createSql = $createRow->{$createKey} ?? $createRow->{'Create View'} ?? '';
  $lines[] = 'DROP TABLE IF EXISTS `' . $table . '`;';
  $lines[] = $createSql . ';';
  $lines[] = '';

  $rows = DB::table($table)->get();

  if ($rows->isEmpty()) {
    $lines[] = "-- Aucune donnée pour `{$table}`";
    $lines[] = '';

    continue;
  }

  $columns = array_keys((array) $rows->first());
  $columnList = implode('`, `', $columns);
  $lines[] = 'INSERT INTO `' . $table . '` (`' . $columnList . '`) VALUES';

  $valueLines = [];

  foreach ($rows as $row) {
    $values = [];

    foreach ($columns as $column) {
      $values[] = formatSqlValue($row->{$column});
    }

    $valueLines[] = "\t(" . implode(', ', $values) . ')';
  }

  $lines[] = implode(",\n", $valueLines) . ';';
  $lines[] = '';
}

$lines[] = 'SET FOREIGN_KEY_CHECKS = 1;';
$lines[] = '';

file_put_contents($outputPath, implode("\n", $lines));

echo "Fichier créé : {$outputPath}\n";
echo 'Tables exportées : ' . count(array_intersect($tableOrder, $existingTables)) . "\n";

/**
 * Formate une valeur PHP pour un littéral SQL.
 *
 * @param mixed $value Valeur de colonne
 * @return string Littéral SQL
 */
function formatSqlValue(mixed $value): string
{
  if ($value === null) {
    return 'NULL';
  }

  if (is_bool($value)) {
    return $value ? '1' : '0';
  }

  if (is_int($value) || is_float($value)) {
    return (string) $value;
  }

  if ($value instanceof DateTimeInterface) {
    return "'" . $value->format('Y-m-d H:i:s') . "'";
  }

  $string = (string) $value;

  return "'" . str_replace(["\\", "'"], ["\\\\", "''"], $string) . "'";
}

return 0;
