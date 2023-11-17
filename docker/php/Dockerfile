FROM php:8.2-alpine3.18 AS extensions

# Xdebug
RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl channel-update pecl.php.net \
    && pecl -q install xdebug \
    && docker-php-ext-enable xdebug


FROM php:8.2-alpine3.18

RUN apk add --no-cache \
    	bash \
		dumb-init \
    	git \
    	unzip \
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
