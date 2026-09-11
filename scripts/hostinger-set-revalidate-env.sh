#!/usr/bin/env bash
# Configure FRONTEND_REVALIDATE_* dans le .env Laravel (prod) si absents/à remplacer.
set -euo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
ENV_FILE="$ADMIN/.env"
URL="${FRONTEND_REVALIDATE_URL:-https://skyitupsas.org/api/revalidate}"
SECRET_FILE="${REVALIDATE_SECRET_FILE:-/home/u514199474/domains/skyitupsas.org/.deploy/revalidate_secret}"

if [[ ! -f "$ENV_FILE" ]]; then
  echo "Missing $ENV_FILE"
  exit 1
fi

if [[ -f "$SECRET_FILE" ]]; then
  SECRET="$(tr -d '\r\n' < "$SECRET_FILE")"
else
  echo "Missing secret file $SECRET_FILE"
  exit 1
fi

set_env() {
  local key="$1"
  local value="$2"
  if grep -q "^${key}=" "$ENV_FILE"; then
    perl -pi -e "s|^${key}=.*|${key}=${value}|" "$ENV_FILE"
  else
    printf '\n%s=%s\n' "$key" "$value" >> "$ENV_FILE"
  fi
}

set_env "FRONTEND_REVALIDATE_URL" "$URL"
set_env "FRONTEND_REVALIDATE_SECRET" "$SECRET"

cd "$ADMIN"
php artisan config:clear || true
php artisan optimize || true
echo "FRONTEND_REVALIDATE configured"
