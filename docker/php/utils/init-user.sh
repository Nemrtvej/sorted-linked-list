#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"

PUID="${PUID:-1000}"
PGID="${PGID:-1000}"

echo "Creating user www-data with ${PUID}:${PGID}"
addgroup -g ${PGID} www-data
adduser -h /app -D -s /bin/bash -u ${PUID} -G www-data www-data
