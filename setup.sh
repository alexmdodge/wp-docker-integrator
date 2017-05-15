#!/bin/bash
docker-compose rm && \
docker-compose pull && \
docker-compose build --no-cache && \
docker-compose up --force-recreate