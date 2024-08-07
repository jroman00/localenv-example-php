#!/usr/bin/env bash

set -e

readonly PARENT_DIR=$(cd $(dirname "${BASH_SOURCE[0]}") && pwd -P)
readonly LOCALENV_DIR=$(cd $(dirname $(dirname $(dirname "$PARENT_DIR"))) && pwd -P)

readonly APP_DIR=$(cd $(dirname "$PARENT_DIR") && pwd -P)

source $LOCALENV_DIR/bin/utils/shell-helpers.sh

# Main function
main() {
  echo_yellow "Starting localenv-example-php repo..."

  (
    # Make sure script is running from the main application directory
    cd $APP_DIR

    # Start docker containers
    docker compose up -d
  )

  echo_green "localenv-example-php repo started successfully!\n"
}

# Execute main functionality
main
