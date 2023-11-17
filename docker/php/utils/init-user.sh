#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"

PUID="${PUID:-1000}"
PGID="${PGID:-1000}"

echo "Creating user www-data with ${PUID}:${PGID}"
groupadd -g ${PGID} www-data
useradd -m -u ${PUID} -g ${PGID} www-data

chsh -s /bin/bash www-data
