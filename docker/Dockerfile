FROM chekote/php:7.3.9.a-composer

WORKDIR /project

COPY . /project

RUN chmod a+x ./bin/gherkin-fixer

ENTRYPOINT ["/project/bin/gherkin-fixer"]
