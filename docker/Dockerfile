FROM chekote/php:7.3.9.a-composer

COPY . /project

RUN chmod a+x /project/bin/gherkin-fixer; \
    rm -rf /project/docker

ENTRYPOINT ["/project/bin/gherkin-fixer"]
