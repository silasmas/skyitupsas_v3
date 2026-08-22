#!/usr/bin/env bash
# Installe les dépendances PHP Laravel sur Hostinger (une seule commande cron).
set -uo pipefail

ADMIN="/home/u514199474/domains/skyitupsas.org/public_html/admin"
LOG="/home/u514199474/domains/skyitupsas.org/composer-install.log"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
}

composerBin() {
  if command -v composer >/dev/null 2>&1; then
    echo "composer"
  else
    echo "/usr/local/bin/composer"
  fi
}

phpBin() {
  for candidate in \
    /opt/alt/php83/usr/bin/php \
    /opt/alt/php84/usr/bin/php \
    /usr/bin/php83 \
    /usr/local/bin/php83 \
    php; do
    if [[ -x "$candidate" ]]; then
      echo "$candidate"
      return
    fi
  done
  echo "php"
}

if [[ ! -f "$ADMIN/composer.json" ]]; then
  log "ERREUR: composer.json introuvable dans $ADMIN"
  exit 1
fi

if [[ -f "$ADMIN/vendor/autoload.php" ]]; then
  log "vendor/autoload.php déjà présent — rien à faire."
  exit 0
fi

REPO_RAW="https://raw.githubusercontent.com/silasmas/skyitupsas_v3/main"

cd "$ADMIN" || exit 1

log "Mise à jour composer.json / composer.lock depuis GitHub..."
curl -fsSL -o composer.json "$REPO_RAW/composer.json"
curl -fsSL -o composer.lock "$REPO_RAW/composer.lock"

if [[ -d vendor ]] && [[ ! -f vendor/autoload.php ]]; then
  log "vendor incomplet détecté — nettoyage..."
  rm -rf vendor
fi

log "PHP CLI: $(phpBin) ($("$(phpBin)" -v | head -1))"
log "Démarrage: $(phpBin) $(composerBin) install --no-dev"
COMPOSER_MEMORY_LIMIT=-1 COMPOSER_DISABLE_XDEBUG=1 "$(phpBin)" "$(composerBin)" install \
  --no-dev \
  --optimize-autoloader \
  --no-interaction \
  --prefer-dist \
  --no-progress \
  --no-scripts >> "$LOG" 2>&1
status=$?

if [[ $status -ne 0 ]]; then
  log "Sortie composer (dernières lignes):"
  tail -n 20 "$LOG" | tee -a "$LOG"
fi

if [[ -f vendor/autoload.php ]]; then
  log "SUCCÈS — vendor/autoload.php créé."
  chmod -R ug+rwx storage bootstrap/cache 2>/dev/null || true
  exit 0
fi

log "ÉCHEC (code $status) — relancer si vendor absent."
exit 1
