#!/usr/bin/env bash

composer install
cd docker
docker-compose up --build -d
