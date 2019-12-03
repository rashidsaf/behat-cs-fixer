ARG PHP_IMAGE
FROM ${PHP_IMAGE}

COPY . /project
COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint-gherkin-fixer.sh
COPY ./docker/gherkin-cs-fixer /usr/local/bin/gherkin-cs-fixer

RUN rm -rf /project/docker

ENTRYPOINT ["/usr/local/bin/entrypoint-gherkin-fixer.sh"]
