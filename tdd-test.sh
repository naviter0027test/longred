#!/bin/bash

sh migrate-test-db.sh

./vendor/phpunit/phpunit/phpunit

php artisan DropTables
