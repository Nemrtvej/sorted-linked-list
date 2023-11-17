
rebuild-containers:
	docker compose rm -v --stop --force
	docker compose up -d --build --remove-orphans


composer-install:
	docker compose exec php composer install


reset: rebuild-containers composer-install


stan:
	docker compose exec php vendor/bin/phpstan analyse --ansi

cs:
	docker compose exec php vendor/bin/ecs check --ansi

fix:
	docker compose exec php vendor/bin/ecs check --fix


-include Makefile.local
