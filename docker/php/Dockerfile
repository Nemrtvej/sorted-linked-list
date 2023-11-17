FROM php:8.2-fpm-bullseye

SHELL ["/bin/bash", "-o", "pipefail", "-c"]

RUN set -x && (userdel -r www-data || true)


RUN apt-get update \
    && apt-get install --no-install-recommends -y \
        dumb-init \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY /docker/php/utils/* /docker/

RUN chmod +x /docker/entrypoint.sh && mkdir /app

WORKDIR /app

ENTRYPOINT ["/usr/bin/dumb-init", "--", "/docker/entrypoint.sh"]
CMD ["tail", "-f", "/dev/null"]
