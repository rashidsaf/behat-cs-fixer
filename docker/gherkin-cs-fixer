#!/usr/bin/env php
<?php declare(strict_types=1);

$autoloader = '/project/vendor/autoload.php';

if (!file_exists($autoloader)) {
    fwrite(STDERR,
        'You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL
    );
    exit(1);
}

require_once $autoloader;

use Medology\GherkinCsFixer\Application;

array_shift($argv);

try {
    (new Application($argv))->run();
} catch (Exception $e) {
    echo "Error:".PHP_EOL;
    echo $e->getMessage();
}
