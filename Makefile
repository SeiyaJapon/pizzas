#!/bin/bash

DOCKER_BE = php
OS := $(shell uname)

ifeq ($(OS),Darwin)
    UID = $(shell id -u)
else ifeq ($(OS),Linux)
    UID = $(shell id -u)
else
    UID = 1000
endif

## ——   The amazing authentication-service Makefile  ——————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' Makefile | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## ——   Docker  ——————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————

build: create-network up ## First run / installation will call this target

building:
	U_ID=${UID} docker-compose build --no-cache

up: ## Start the docker environment
	U_ID=${UID} docker-compose up -d --remove-orphans

run: ## Start the containers
	docker network create app-network || true
	U_ID=${UID} docker-compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker-compose stop

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) run

rebuild-all: ## Rebuilds all the containers
	U_ID=${UID} docker-compose build

prepare: ## Runs backend commands
	$(MAKE) composer-install

create-network:
	docker network create app-network || true

down: ## composer down
	docker compose down --remove-orphans

destroy: ## destroy
	docker compose down --rmi all --volumes --remove-orphans

## ——   PHP container  ———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————

install-components:
	U_ID=${UID} docker compose exec $(DOCKER_BE) symfony console doctrine:migrations:migrate --no-interaction
	U_ID=${UID} docker compose exec $(DOCKER_BE) symfony console doctrine:fixtures:load --no-interaction

composer-install:
	U_ID=${UID} docker compose exec $(DOCKER_BE) composer install

composer-update:
	U_ID=${UID} docker compose exec $(DOCKER_BE) composer update

symfony-install: ## install symfony
	U_ID=${UID} docker compose exec $(DOCKER_BE) composer create-project symfony/skeleton ./temp

create-project: ## create project
	mkdir -p temp
	@make create-network
	@make symfony-install
	mv temp/* .
	rm -rf temp
	mv docker/.env .env
	U_ID=${UID} docker compose exec $(DOCKER_BE) php bin/console secrets:generate-keys --env=prod #genera las claves de symfony
	U_ID=${UID} docker compose exec $(DOCKER_BE) chmod -R 777 var/cache var/log #da permisos a las carpetas cache y logs
	@make fresh

dumpauto:
	U_ID=${UID} docker compose exec $(DOCKER_BE) composer dumpautoload

fresh: ## php bin/console doctrine:migrations:fresh --seed
	U_ID=${UID} docker compose exec $(DOCKER_BE) symfony console doctrine:migrations:fresh --seed

clear-all:
	U_ID=${UID} docker compose exec $(DOCKER_BE) symfony console cache:clear && php bin/console route:clear

logs: ## Tails the Symfony dev log
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} tail -f var/log/dev.log
# End backend commands

enter: ## ssh's into the be container
	U_ID=$(shell id -u) docker exec -it be bash -l