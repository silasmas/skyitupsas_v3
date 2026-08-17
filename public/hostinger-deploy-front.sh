#!/usr/bin/env bash
# Déploiement frontend Next.js (archive + build Node Hostinger).
# Usage : bash /tmp/deploy-front.sh
set -euo pipefail

PUB="${PUB_DIR:-/home/u514199474/domains/skyitupsas.org/public_html}"
ZIP_NAME="skyitupsas-front-deploy-v8.zip"
ZIP_PATH="$PUB/$ZIP_NAME"
LOG="${DEPLOY_LOG:-/home/u514199474/domains/skyitupsas.org/deploy-front.log}"
TOKEN_FILE="${TOKEN_FILE:-/home/u514199474/domains/skyitupsas.org/.deploy/hostinger_api_token}"
FRONT_TAR="https://codeload.github.com/silasmas/skyitupsas-front/tar.gz/refs/heads/main"
TMP="$(mktemp -d)"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
}

cleanup() {
  rm -rf "$TMP"
}

trap cleanup EXIT

if [[ -f "$TOKEN_FILE" ]]; then
  API_TOKEN="$(tr -d '\r\n' < "$TOKEN_FILE")"
else
  API_TOKEN="${HOSTINGER_API_TOKEN:-}"
fi

if [[ -z "$API_TOKEN" ]]; then
  log "ERROR: token API Hostinger introuvable ($TOKEN_FILE ou HOSTINGER_API_TOKEN)"
  exit 1
fi

log "1/4 Téléchargement sources frontend..."
curl -fsSL "$FRONT_TAR" | tar xz -C "$TMP" --strip-components=1

log "2/4 Écriture .env.production..."
cat > "$TMP/.env.production" <<'EOF'
NODE_ENV=production
API_BASE_URL=https://admin.skyitupsas.org/api/v1
NEXT_PUBLIC_API_BASE_URL=https://admin.skyitupsas.org/api/v1
NEXT_PUBLIC_SITE_URL=https://skyitupsas.org
OPENAI_BASE_URL=https://api.openai.com/v1
OPENAI_MODEL=gpt-4o-mini
EOF

if [[ -n "${OPENAI_API_KEY:-}" ]]; then
  echo "OPENAI_API_KEY=$OPENAI_API_KEY" >> "$TMP/.env.production"
fi

log "3/4 Création archive $ZIP_NAME..."
rm -f "$ZIP_PATH"
(
  cd "$TMP"
  zip -rq "$ZIP_PATH" . -x "node_modules/*" ".git/*"
)

log "4/4 Déclenchement build Node.js..."
RESP="$(curl -fsSL -X POST \
  "https://developers.hostinger.com/api/hosting/v1/accounts/u514199474/websites/skyitupsas.org/nodejs/builds" \
  -H "Authorization: Bearer $API_TOKEN" \
  -H "Content-Type: application/json" \
  -d "{\"node_version\":20,\"app_type\":\"next\",\"output_directory\":\".next\",\"build_script\":\"build\",\"source_type\":\"archive\",\"source_options\":{\"archive_path\":\"$ZIP_NAME\"}}")"

log "Build déclenché : $RESP"
