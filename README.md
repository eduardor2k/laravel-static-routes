# Laravel Static Routes

This laravel package will create an apache 2 .htaccess file in the public folder with all the routes.

Once installed you only need to run the following command:

    php artisan laravel-static-routes:apache-2

## Composer

    composer require eduardor2k/laravel-static-routes

## Testing

    composer test

To run the tests locally, run the following commands:

    # install dependencies
    docker run --rm --interactive --tty --volume $PWD:/app composer install
    # run tests
    docker run --rm --interactive --tty --volume $PWD:/app php /app/vendor/bin/phpunit /app/tests