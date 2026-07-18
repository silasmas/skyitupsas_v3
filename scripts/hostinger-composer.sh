#!/usr/bin/env bash
# Installe les dépendances PHP Laravel sur Hostinger (une seule commande cron).
set -uo pipefail

ADMIN="/home/u514199474/domains/skyitupsas.org/public_html/admin"
LOG="/home/u514199474/domains/skyitupsas.org/composer-install.log"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
}

if [[ ! -f "$ADMIN/composer.json" ]]; then
  log "ERREUR: composer.json introuvable dans $ADMIN"
  exit 1
fi

if [[ -f "$ADMIN/vendor/autoload.php" ]]; then
  log "vendor/autoload.php déjà présent — rien à faire."
  exit 0
fi

cd "$ADMIN" || exit 1

if command -v composer >/dev/null 2>&1; then
  cBin="composer"
else
  cBin="/usr/local/bin/composer"
fi

log "Démarrage: $cBin install --no-dev"
COMPOSER_MEMORY_LIMIT=-1 COMPOSER_DISABLE_XDEBUG=1 "$cBin" install \
  --no-dev \
  --optimize-autoloader \
  --no-interaction \
  --prefer-dist \
  --no-progress >> "$LOG" 2>&1
status=$?

if [[ -f vendor/autoload.php ]]; then
  log "SUCCÈS — vendor/autoload.php créé."
  chmod -R ug+rwx storage bootstrap/cache 2>/dev/null || true
  exit 0
fi

log "ÉCHEC (code $status) — relancer si vendor absent."
exit 1
