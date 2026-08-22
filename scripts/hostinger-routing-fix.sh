#!/usr/bin/env bash
# Applique le correctif de routage admin (redirection / → /admin, pages publiques → frontend).
set -uo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${ROUTING_LOG:-/home/u514199474/domains/skyitupsas.org/routing-fix.log}"
REPO_RAW="https://raw.githubusercontent.com/silasmas/skyitupsas_v3/main"

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

if [[ ! -f "$ADMIN/artisan" ]]; then
  log "ERREUR: artisan introuvable dans $ADMIN"
  exit 1
fi

cd "$ADMIN" || exit 1

log "Mise à jour des fichiers de routage depuis GitHub..."
curl -fsSL -o app/Http/Middleware/RedirectPublicSiteToFrontend.php \
  "$REPO_RAW/app/Http/Middleware/RedirectPublicSiteToFrontend.php"
curl -fsSL -o bootstrap/app.php "$REPO_RAW/bootstrap/app.php"
curl -fsSL -o routes/web.php "$REPO_RAW/routes/web.php"

log "Optimisation des caches Laravel..."
"$PHP_BIN" artisan optimize:clear >> "$LOG" 2>&1 || true
"$PHP_BIN" artisan optimize >> "$LOG" 2>&1 || true

log "=== Correctif routage admin appliqué ==="
exit 0
