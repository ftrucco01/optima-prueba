# Executables (local)
DOCKER_COMP = docker compose

# Docker containers
PHP_CONT = $(DOCKER_COMP) exec php

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
ARTISAN  = $(PHP_CONT) php artisan

# Misc
.DEFAULT_GOAL = help

## —— 🎵 🐳 The Docker Makefile 🐳 🎵 ——————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

up: ## Start the docker containers in detached mode (no logs)
	@$(DOCKER_COMP) up --detach

down: ## Stop the docker containers and remove the orphan containers
	@$(DOCKER_COMP) down --remove-orphans

d: ## alias for "down"
	@$(DOCKER_COMP) down --remove-orphans

sh: ## Connect to the PHP FPM container
	@$(PHP_CONT) sh

## —— Composer 🧙 ——————————————————————————————————————————————————————————————
composer:
	@$(eval c ?=)
	@$(COMPOSER) $(c)

install: ## Install vendors according to the current composer.lock file
install: c=install --prefer-dist --no-progress --no-scripts --no-interaction
install: composer

## —— Artisan 🎵 ———————————————————————————————————————————————————————————————
art: ## List all Artisan commands or pass the parameter "c=" to run a given command, example: make sf c=about
	@$(eval c ?=)
	@$(ARTISAN) $(c)

migrate: c=migrate ## migrate fresh database
migrate: art

## —— Tests ✅ ————————————————————————————————————————————————————————————————
test: ## Run the test suite
	@$(PHP) vendor/bin/phpunit

## —— Code style ✨ ————————————————————————————————————————————————————————————
psr: ## Code style check
	@$(PHP) ./vendor/bin/phpcs
