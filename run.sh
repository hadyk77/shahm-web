#!/bin/bash

if [ $# -eq 0 ]; then

    docker-compose run --rm artisan_sham remove $1 $2

else

    if [ $1 == "remove" ]; then
        docker-compose run --rm artisan_sham remove log session
    fi

    if [ $1 == "a" ]; then
        docker-compose run --rm artisan_sham $2 $3 $4
    fi

    if [ $1 == "m" ]; then
        docker-compose run --rm artisan_sham make:model $2 $3
    fi

    if [ $1 == "c" ]; then
        docker-compose run --rm artisan_sham make:controller $2 $3
    fi

    if [ $1 == "r" ]; then
        docker-compose run --rm artisan_sham make:request $2
    fi

    if [ $1 == "middleware" ]; then
        docker-compose run --rm artisan_sham make:middleware $2
    fi

    if [ $1 == "storage:link" ]; then
        docker-compose run --rm artisan_sham storage:link
    fi

    if [ $1 == "dts" ]; then
        docker-compose run --rm artisan_sham db:wipe && docker-compose run --rm artisan_sham migrate --seed
    fi

    if [ $1 == "s" ]; then
        docker-compose run --rm artisan_sham make:seed $2
    fi

    if [ $1 == "composer" ]; then
        docker-compose run --rm composer_sham $2 $3
    fi

    if [ $1 == "api:resource" ]; then
        docker-compose run --rm artisan_sham make:resource $2
    fi

fi
