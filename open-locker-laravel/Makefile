export DOCKER_COMPOSE_CMD = ./vendor/bin/sail

.PHONY: help
help: ## shows this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

setup:
	composer install
	$(DOCKER_COMPOSE_CMD) up -d --remove-orphans
	$(DOCKER_COMPOSE_CMD) artisan key:generate
	$(DOCKER_COMPOSE_CMD) npm i
	make seed

.PHONY: start
start: ## start containers
	$(DOCKER_COMPOSE_CMD) up -d --remove-orphans
	$(DOCKER_COMPOSE_CMD) npm run dev

.PHONY: stop
stop: ## stop containers
	$(DOCKER_COMPOSE_CMD) stop

.PHONY: restart
restart: ## restart containers
	make stop && sleep 1 && make start

.PHONY: seed
seed: ## run laravel seeds
	$(DOCKER_COMPOSE_CMD) artisan migrate:fresh --seed
