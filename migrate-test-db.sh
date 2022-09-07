#!/bin/bash

php artisan migrate --path=/database/migrations/20191212
php artisan migrate --path=/database/migrations/20191216
php artisan migrate --path=/database/migrations/20191217
php artisan migrate --path=/database/migrations/20191220
php artisan migrate --path=/database/migrations/20191227
php artisan migrate --path=/database/migrations/20200114
php artisan migrate --path=/database/migrations/20200203
php artisan migrate --path=/database/migrations/20200206
php artisan migrate --path=/database/migrations/20200212
php artisan migrate --path=/database/migrations/20200214
php artisan migrate --path=/database/migrations/20200226
php artisan migrate --path=/database/migrations/20200227
php artisan migrate --path=/database/migrations/20200303
php artisan migrate --path=/database/migrations/20200312
php artisan migrate --path=/database/migrations/20200323
php artisan migrate --path=/database/migrations/20200427
php artisan migrate --path=/database/migrations/20200618

echo "migrate finish\n"
echo "prepare start seeder\n"
sleep 2

php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=AccountSeeder
php artisan db:seed --class=RecordSeeder
php artisan db:seed --class=MessageSeeder
php artisan db:seed --class=HasReadSeeder
