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
    #
    # Gherkin CS Fixer requirements
    apt-get install -y --no-install-recommends --no-install-suggests php${PHP_VERSION}-mbstring; \
    #
    # Cleanup
    apt-get remove -y; \
    apt-get autoremove -y; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*; \
    #
    # Remove unneeded Docker files
    rm -rf /project/docker;

ENTRYPOINT ["/usr/local/bin/entrypoint-gherkin-fixer.sh"]
