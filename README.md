# laravel-static-routes

Generate a static route file

## Run tests

To run the tests locally, run the following commands:

    # install dependencies
    docker run --rm --interactive --tty --volume $PWD:/app composer install
    # run tests
    docker run --rm --interactive --tty --volume $PWD:/app php /app/vendor/bin/phpunit /app/tests