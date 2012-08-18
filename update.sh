#! /bin/sh

git pull && \
(app/console cache:clear --env=prod || rm -rf `dirname $0`/app/cache/prod) && \
(app/console cache:clear || rm -rf `dirname $0`/app/cache/dev) && \
app/console assets:install && \
app/console assetic:dump --env=prod && \
exit 0

