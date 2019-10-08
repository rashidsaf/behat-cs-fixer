<?php declare(strict_types=1);

namespace BehatCsFixer;

use BehatCsFixer\Exceptions\FileNotFound;
use BehatCsFixer\Exceptions\FileWriteException;
use Generator;

/**
 * Helper for reading and writing files.
 */
class FileHelper
{
    /**
     * File reading generator.
     *
     * @param  string             $file Path to the file.
     * @throws FileNotFound       When File not found.
     * @return Generator|string[]
     */
    public static function readFile(string $file): Generator
    {
        if (!file_exists($file)) {
            throw new FileNotFound('File cannot be found: '.$file);
        }
        $fp = fopen($file, 'rb');
        while ($line = fgets($fp)) {
            yield $line;
        }
    }

    /**
     * Saves the file.
     *
     * @param  string             $file    Path to the file.
     * @param  string             $content Contents to be saved.
     * @throws FileWriteException When there is a problem with saving the file.
     */
    public static function save(string $file, string $content): void
    {
        if (!file_put_contents($file, $content)) {
            throw new FileWriteException('There was a problem with saving file: '.$file);
        }
    }
}
