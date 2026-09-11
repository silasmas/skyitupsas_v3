#!/usr/bin/env bash
set -euo pipefail
ADMIN=/home/u514199474/domains/skyitupsas.org/public_html/admin
PUB=/home/u514199474/domains/skyitupsas.org/public_html
ZIP=skyitupsas-front-deploy-v13.zip
URL=https://raw.githubusercontent.com/silasmas/skyitupsas_v3/c53d1297c55799c09b0d80cd0e8bfbf695b695ba/public/deploy/$ZIP
mkdir -p "$ADMIN/public/deploy"
curl -fsSL -o "$ADMIN/public/deploy/$ZIP" "$URL"
cp -f "$ADMIN/public/deploy/$ZIP" "$PUB/$ZIP"
ls -lh "$PUB/$ZIP"
