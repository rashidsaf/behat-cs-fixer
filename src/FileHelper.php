<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer;

use Generator;
use Medology\GherkinCsFixer\Exceptions\FileNotFound;
use Medology\GherkinCsFixer\Exceptions\FileWriteException;

/**
 * Helper for reading and writing files.
 */
class FileHelper
{
    /**
     * File reading generator.
     *
     * @param string $file path to the file
     *
     * @throws FileNotFound when File not found
     *
     * @return Generator|string[]
     */
    public static function readFile(string $file): Generator
    {
        if (!file_exists($file)) {
            throw new FileNotFound('File cannot be found: ' . $file);
        }
        $fp = fopen($file, 'rb');
        while ($line = fgets($fp)) {
            yield $line;
        }
    }

    /**
     * Saves the file.
     *
     * @param string $file    path to the file
     * @param string $content contents to be saved
     *
     * @throws FileWriteException when there is a problem with saving the file
     */
    public static function save(string $file, string $content): void
    {
        if (!file_put_contents($file, $content)) {
            throw new FileWriteException('There was a problem with saving file: ' . $file);
        }
    }
}
