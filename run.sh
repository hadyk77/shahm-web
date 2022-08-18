#!/bin/bash

if [ $# -eq 0 ]; then

    docker-compose run --rm artisan_sham remove

else

    if [ $1 == "m" ]; then
        docker-compose run --rm artisan_sham make:model $2 $3
    fi

    if [ $1 == "c" ]; then
        docker-compose run --rm artisan_sham make:controller $2 $3
    fi

fi
