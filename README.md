Project Setup Guide
Dependencies

PHP: version 8.1 or greater

Composer: version 2.2 or greater

Project Setup

Run the following commands after cloning the project:

composer install
php artisan migrate:fresh

Laravel Collective Form

For a new project, you don’t need to install it separately (it will be installed automatically with composer install).
If you want to install it manually, run:

composer require laravelcollective/html