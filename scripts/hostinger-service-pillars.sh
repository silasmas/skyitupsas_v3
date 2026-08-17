#!/usr/bin/env bash
# Déploie les piliers services (code + migration + seed) sur Hostinger.
set -uo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${PILLARS_LOG:-/home/u514199474/domains/skyitupsas.org/pillars-migrate.log}"
TARBALL="https://codeload.github.com/silasmas/skyitupsas_v3/tar.gz/refs/heads/backend"
TMP="/tmp/skyitup-pillars-$$"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
}

phpBin() {
  for candidate in \
    /opt/alt/php83/usr/bin/php \
    /opt/alt/php84/usr/bin/php \
    /usr/bin/php83 \
    php; do
    if [[ -x "$candidate" ]]; then
      echo "$candidate"
      return
    fi
  done
  echo "php"
}

PHP_BIN="$(phpBin)"

cd "$ADMIN" || exit 1

log "Téléchargement branche backend depuis GitHub..."
mkdir -p "$TMP"
curl -fsSL "$TARBALL" | tar -xz -C "$TMP" --strip-components=1

log "Synchronisation app/, database/, routes/..."
cp -r "$TMP/app/Models/ServicePillar.php" app/Models/
cp -r "$TMP/app/Models/ServiceModule.php" app/Models/
cp -r "$TMP/app/Http/Controllers/Api/ServicePillarController.php" app/Http/Controllers/Api/
cp -r "$TMP/app/Http/Controllers/Api/ServiceModuleController.php" app/Http/Controllers/Api/
cp -r "$TMP/app/Http/Resources/ServicePillarResource.php" app/Http/Resources/
cp -r "$TMP/app/Http/Resources/ServiceModuleResource.php" app/Http/Resources/
cp -r "$TMP/app/Policies/ServicePillarPolicy.php" app/Policies/
cp -r "$TMP/app/Policies/ServiceModulePolicy.php" app/Policies/
cp -r "$TMP/app/Services/SiteSearchService.php" app/Services/
cp -r "$TMP/app/Filament/Resources/ServicePillarResource.php" app/Filament/Resources/
cp -r "$TMP/app/Filament/Resources/ServiceModuleResource.php" app/Filament/Resources/
cp -r "$TMP/app/Filament/Resources/ServiceResource.php" app/Filament/Resources/
cp -rf "$TMP/app/Filament/Resources/ServicePillarResource" app/Filament/Resources/
cp -rf "$TMP/app/Filament/Resources/ServiceModuleResource" app/Filament/Resources/
cp -r "$TMP/routes/api.php" routes/
cp -rf "$TMP/database/migrations/2026_08_12_000001_create_service_pillars_and_modules_tables.php" database/migrations/
cp -r "$TMP/database/seeders/ServicePillarSeeder.php" database/seeders/
cp -r "$TMP/database/seeders/DatabaseSeeder.php" database/seeders/
cp -rf "$TMP/database/seeders/data" database/seeders/

rm -rf "$TMP"

log "Migration..."
"$PHP_BIN" artisan migrate --force >> "$LOG" 2>&1 || exit 1

log "Seed piliers..."
"$PHP_BIN" artisan db:seed --class=ServicePillarSeeder --force >> "$LOG" 2>&1 || exit 1

log "Permissions Filament Shield..."
"$PHP_BIN" artisan shield:generate --all --option=permissions --no-interaction >> "$LOG" 2>&1 || true

log "Caches..."
"$PHP_BIN" artisan optimize:clear >> "$LOG" 2>&1 || true
"$PHP_BIN" artisan optimize >> "$LOG" 2>&1 || true

log "=== Piliers services déployés ==="
exit 0
