FROM php:8.2-alpine3.18 AS extensions

# Xdebug
# The PHPIZE_DEPS needs to be globbed and word splitted, hence the SC2086 ignore.
# Sadly the PHPIZE_DEPS do not contain package versions so hadolint is unhappy but there is not much I can do about this. => DL3018 ignore.
# hadolint ignore=SC2086,DL3018
RUN apk add --no-cache $PHPIZE_DEPS linux-headers=6.3-r0 \
    && pecl channel-update pecl.php.net \
    && pecl -q install xdebug \
    && docker-php-ext-enable xdebug


FROM php:8.2-alpine3.18

RUN apk add --no-cache \
    	bash=5.2.15-r5 \
		dumb-init=1.2.5-r2 \
    	git=2.40.1-r0 \
    	unzip=6.0-r14 \
    && rm -fr /var/cache/apt/*

SHELL ["/bin/bash", "-o", "pipefail", "-c"]

RUN set -x && deluser www-data

COPY --from=extensions /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=extensions /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY /docker/php/utils/* /docker/

RUN chmod +x /docker/entrypoint.sh /docker/init-user.sh \
    && mkdir /app  \
    && mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY /docker/php/cfg/php.ini /usr/local/etc/php/conf.d/01-php-dev.ini

WORKDIR /app

ARG PUID
ARG PGID

RUN /docker/init-user.sh

ENTRYPOINT ["/usr/bin/dumb-init", "--", "/docker/entrypoint.sh"]
CMD ["tail", "-f", "/dev/null"]
