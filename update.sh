#! /bin/sh

git pull && \
app/console assets:install && \
app/console assetic:dump --env=prod && \
app/console cache:clear --env=prod && app/console cache:clear

exit 0

