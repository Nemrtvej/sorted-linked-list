docker-image = php

rebuild-containers:
	docker compose rm -v --stop --force
	docker compose up -d --build --remove-orphans


composer-install:
	docker compose exec $(docker-image) composer install


reset: rebuild-containers composer-install

start:
	docker compose up -d $(docker-image)

stan:
	docker compose exec $(docker-image) vendor/bin/phpstan analyse --ansi

cs:
	docker compose exec $(docker-image) vendor/bin/ecs check --ansi

fix:
	docker compose exec $(docker-image) vendor/bin/ecs check --fix


test:
	docker-compose exec $(docker-image) vendor/bin/phpunit

security:
	docker-compose exec $(docker-image) composer require --dev roave/security-advisories:dev-latest

check: fix stan test

-include Makefile.local
