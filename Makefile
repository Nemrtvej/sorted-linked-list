docker-image = php

# Throw away current docker containers and rebuild them from scratch.
rebuild-containers:
	docker compose rm -v --stop --force
	docker compose up -d --build --remove-orphans

# Install composer requirements.
composer-install:
	docker compose exec $(docker-image) composer install

# Perform a clean reset of whole project.
reset: rebuild-containers composer-install

# Start docker container in background.
start:
	docker compose up -d $(docker-image)

# Run PHPStan check.
stan:
	docker compose exec $(docker-image) vendor/bin/phpstan analyse --ansi

# Run ECS check in read only mode.
cs:
	docker compose exec $(docker-image) vendor/bin/ecs check --ansi

# Run ECS check and fix what can automatically be fixed.
fix:
	docker compose exec $(docker-image) vendor/bin/ecs check --fix

# Run PHPUnit tests.
test:
	docker compose exec $(docker-image) vendor/bin/phpunit

# Run roave security advisories.
# Note: this check is intentionally not run automatically during make check.
security:
	docker compose exec $(docker-image) composer require --dev roave/security-advisories:dev-latest

# Run Dockerfile check.
# Note: this check is intentionally not run automatically during make check.
hadolint:
	docker run --rm -i hadolint/hadolint:v2.12.0-alpine < docker/php/Dockerfile

# Run the common test suite locally.
check: fix stan test

# If you wish to add your own tricks or override the already provided one, put those in the file `Makefile.local`.
-include Makefile.local
