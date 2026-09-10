#!/usr/bin/env bash
# Prépare l'archive frontend Next.js dans public_html (sans appeler l'API Hostinger).
# Ensuite : démarrer le build via MCP / API avec archive_path = ZIP_NAME.
set -euo pipefail

PUB="${PUB_DIR:-/home/u514199474/domains/skyitupsas.org/public_html}"
ZIP_NAME="${ZIP_NAME:-skyitupsas-front-deploy-v9.zip}"
ZIP_PATH="$PUB/$ZIP_NAME"
LOG="${DEPLOY_LOG:-/home/u514199474/domains/skyitupsas.org/deploy-front.log}"
FRONT_TAR="https://codeload.github.com/silasmas/skyitupsas-front/tar.gz/refs/heads/main"
TMP="$(mktemp -d)"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
}

cleanup() {
  rm -rf "$TMP"
}

trap cleanup EXIT

log "1/3 Téléchargement sources frontend (main)..."
curl -fsSL "$FRONT_TAR" | tar xz -C "$TMP" --strip-components=1

log "2/3 Écriture .env.production..."
cat > "$TMP/.env.production" <<'EOF'
NODE_ENV=production
API_BASE_URL=https://admin.skyitupsas.org/api/v1
NEXT_PUBLIC_API_BASE_URL=https://admin.skyitupsas.org/api/v1
NEXT_PUBLIC_SITE_URL=https://skyitupsas.org
OPENAI_BASE_URL=https://api.openai.com/v1
OPENAI_MODEL=gpt-4o-mini
EOF

log "3/3 Création archive $ZIP_NAME..."
rm -f "$ZIP_PATH"
(
  cd "$TMP"
  zip -rq "$ZIP_PATH" . -x "node_modules/*" ".git/*" ".next/*"
)

ls -lh "$ZIP_PATH" | tee -a "$LOG"
log "=== Archive prête : $ZIP_PATH ==="
exit 0
