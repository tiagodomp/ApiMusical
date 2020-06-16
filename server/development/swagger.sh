#!/bin/bash

mkdir ../public/swagger

php vendor/bin/swagger --bootstrap;
php ./swagger-constants.php --output;
php ../public/swagger ./swagger.php ../app/Http/Controllers
