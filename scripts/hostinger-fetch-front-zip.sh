#!/usr/bin/env bash
# Télécharge l'archive frontend v9 depuis le dépôt public Laravel.
set -euo pipefail
PUB=/home/u514199474/domains/skyitupsas.org/public_html
ZIP=skyitupsas-front-deploy-v9.zip
URL=https://raw.githubusercontent.com/silasmas/skyitupsas_v3/main/public/deploy/$ZIP
curl -fsSL -o "$PUB/$ZIP" "$URL"
ls -lh "$PUB/$ZIP"
