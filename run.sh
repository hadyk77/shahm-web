#!/bin/bash

if [ $# -eq 0 ]; then

    docker-compose run --rm artisan_sham remove $1 $2

else

    if [ $1 == "remove" ]; then
        docker-compose run --rm artisan_sham remove log session
    fi

    if [ $1 == "m" ]; then
        docker-compose run --rm artisan_sham make:model $2 $3
    fi

    if [ $1 == "c" ]; then
        docker-compose run --rm artisan_sham make:controller $2 $3
    fi

    if [ $1 == "storage:link" ]; then
        docker-compose run --rm artisan_sham storage:link
    fi

    if [ $1 == "dts" ]; then
        docker-compose run --rm artisan_sham db:wipe && docker-compose run --rm artisan_sham migrate --seed
    fi

fi
