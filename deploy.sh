#!/bin/bash
set -e

echo "=== GYM Deploy Script ==="
echo "Target: alurelab → /home/alurelab/repositories/gym"
echo "Domain: https://gym.alureflow.com"
echo ""

ssh -p 31988 alurelab 'export PATH="/opt/alt/php84/usr/bin:$PATH" && \
cd /home/alurelab/repositories/gym && \
echo "1/6 Git pull..." && \
git fetch origin main && \
git reset --hard origin/main && \
echo "2/6 Sync public static files..." && \
for f in /home/alurelab/repositories/gym/public/*; do \
  name=$(basename "$f"); \
  dest="/home/alurelab/gym.alureflow.com/$name"; \
  if [ -h "$dest" ] || [ ! -f "$dest" ] && [ ! -d "$dest" ]; then \
    rm -f "$dest"; \
    cp -r "$f" "$dest" 2>/dev/null && echo "  + $name" || true; \
  fi; \
done && \
echo "3/6 Update .env production..." && \
sed -i "s/APP_ENV=local/APP_ENV=production/" .env && \
sed -i "s|APP_URL=http://localhost|APP_URL=https://gym.alureflow.com|" .env && \
sed -i "s/APP_DEBUG=true/APP_DEBUG=false/" .env && \
echo "4/6 Composer install..." && \
composer install --no-dev --optimize-autoloader --no-interaction && \
echo "5/6 Artisan optimize..." && \
php artisan optimize:clear && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan event:cache && \
echo "6/6 Migrate..." && \
php artisan migrate --force && \
echo "" && \
echo "=== DEPLOY SUCCESS ===" && \
echo "URL: https://gym.alureflow.com"'

echo ""
echo "=== DONE ==="
