<?php declare(strict_types=1);

namespace BehatCsFixer;

use BehatCsFixer\Exceptions\FileNotFound;
use Generator;

/**
 * File helper class.
 *
 * Class FileReader
 */
class FileHelper
{
    /**
     * File reading generator.
     *
     * @param  string       $file Path to the file.
     * @throws FileNotFound When File not found.
     * @return Generator
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
     * Saves file.
     *
     * @param string $file    Path to the file.
     * @param string $content Contents to be saved.
     */
    public static function save(string $file, string $content): void
    {
        file_put_contents($file, $content);
    }
}
