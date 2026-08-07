#!/bin/bash
set -e

echo "=== GYM Deploy Script ==="
echo "Target: alurelab → /home/alurelab/repositories/gym"
echo "Domain: https://gym.alureflow.com"
echo ""

ssh -p 31988 alurelab 'export PATH="/opt/alt/php84/usr/bin:$PATH" && \
cd /home/alurelab/repositories/gym && \
echo "1/5 Git pull..." && \
git fetch origin main && \
git reset --hard origin/main && \
echo "2/5 Update .env production..." && \
sed -i "s/APP_ENV=local/APP_ENV=production/" .env && \
sed -i "s|APP_URL=http://localhost|APP_URL=https://gym.alureflow.com|" .env && \
sed -i "s/APP_DEBUG=true/APP_DEBUG=false/" .env && \
echo "3/5 Composer install..." && \
composer install --no-dev --optimize-autoloader --no-interaction && \
echo "4/5 Artisan optimize..." && \
php artisan optimize:clear && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan event:cache && \
echo "5/5 Migrate..." && \
php artisan migrate --force && \
echo "" && \
echo "=== DEPLOY SUCCESS ===" && \
echo "URL: https://gym.alureflow.com"'

echo ""
echo "=== DONE ==="
