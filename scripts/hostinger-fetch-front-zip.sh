#!/usr/bin/env bash
# T??l??charge l'archive frontend v10 depuis le d??p??t public Laravel.
set -euo pipefail
PUB=/home/u514199474/domains/skyitupsas.org/public_html
ZIP=skyitupsas-front-deploy-v10.zip
URL=https://raw.githubusercontent.com/silasmas/skyitupsas_v3/main/public/deploy/$ZIP
curl -fsSL -o "$PUB/$ZIP" "$URL"
ls -lh "$PUB/$ZIP"
