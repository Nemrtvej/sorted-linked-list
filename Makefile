docker-image = php

rebuild-containers:
	docker compose rm -v --stop --force
	docker compose up -d --build --remove-orphans


composer-install:
	docker compose exec $(docker-image) composer install


reset: rebuild-containers composer-install


stan:
	docker compose exec $(docker-image) vendor/bin/phpstan analyse --ansi

cs:
	docker compose exec $(docker-image) vendor/bin/ecs check --ansi

fix:
	docker compose exec $(docker-image) vendor/bin/ecs check --fix


test:
	docker-compose exec $(docker-image) vendor/bin/phpunit

check: fix stan test

-include Makefile.local
