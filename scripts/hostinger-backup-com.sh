#!/usr/bin/env bash
# Sauvegarde public_html de skyitupsas.com avant bascule v3.
set -euo pipefail
BASE=/home/u514199474/domains/skyitupsas.com
STAMP=$(date -u +%Y%m%d-%H%M)
mkdir -p "$BASE/backups"
tar -czf "$BASE/backups/pre-v3-$STAMP.tar.gz" -C "$BASE" public_html
ls -lh "$BASE/backups/pre-v3-$STAMP.tar.gz"
echo "BACKUP_OK $STAMP"
