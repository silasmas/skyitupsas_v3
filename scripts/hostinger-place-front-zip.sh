#!/usr/bin/env bash
set -euo pipefail
ADMIN=/home/u514199474/domains/skyitupsas.org/public_html/admin
PUB=/home/u514199474/domains/skyitupsas.org/public_html
ZIP=skyitupsas-front-deploy-v12.zip
URL=https://raw.githubusercontent.com/silasmas/skyitupsas_v3/adea6ee5f5e21f4f081020f8b5e7bbc5c9b62e11/public/deploy/$ZIP
mkdir -p "$ADMIN/public/deploy"
curl -fsSL -o "$ADMIN/public/deploy/$ZIP" "$URL"
cp -f "$ADMIN/public/deploy/$ZIP" "$PUB/$ZIP"
ls -lh "$PUB/$ZIP"


