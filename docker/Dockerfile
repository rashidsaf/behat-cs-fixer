# medology/gherkin-cs-fixer::$(date '+%Y-%m-%d')
ARG PHP_IMAGE
FROM ${PHP_IMAGE}

COPY . /project
COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint-gherkin-fixer.sh
COPY ./docker/gherkin-cs-fixer /usr/local/bin/gherkin-cs-fixer

RUN set -eu; \
    #
    #
    apt-get update; \
    apt-get install -y --no-install-recommends --no-install-suggests \
    #
    # Multibyte string extension
    php${PHP_VERSION}-mbstring; \
    #
    # Cleanup
    apt-get remove -y; \
    apt-get autoremove -y; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*; \
    rm -rf /project/docker;

ENTRYPOINT ["/usr/local/bin/entrypoint-gherkin-fixer.sh"]
