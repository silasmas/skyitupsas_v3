#!/usr/bin/env bash
# Régénère les permissions Filament Shield sur Hostinger (PHP 8.3).
set -euo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"

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
cd "$ADMIN"

"$PHP_BIN" artisan config:clear || true
"$PHP_BIN" artisan app:sync-shield-permissions
"$PHP_BIN" artisan optimize || true

echo "Shield sync done"
