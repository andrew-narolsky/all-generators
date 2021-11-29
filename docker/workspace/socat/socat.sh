#!/bin/bash

export NVM_DIR="/home/laradock/.nvm" && [ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"
cd /var/www
php artisan down
npm run production
php artisan up
