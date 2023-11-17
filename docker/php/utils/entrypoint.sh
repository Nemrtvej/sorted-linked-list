#!/bin/bash
set -e

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"

source "${DIR}/init-user.sh"

echo "Container ready."

exec "$@"
