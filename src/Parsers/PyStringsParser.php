<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Parsers;

use Generator;
use Medology\GherkinCsFixer\Dto\PyStringsDto;

/**
 * Parse consecutive lines as text and fix the formatting.
 */
class PyStringsParser
{
    /**
     * Parses the text block and return reformatted new one.
     *
     * @param Generator $fileReader File streamer
     */
    public function run(Generator $fileReader): PyStringsDto
    {
        // Skip the starting line of the block
        $header_padding = strspn($fileReader->current(), ' ');
        $fileReader->next();

        $rows = [];
        while (PyStringsDto::KEYWORD != trim($fileReader->current())) {
            $rows[] = [
                'text'    => trim($fileReader->current()),
                'padding' => strspn($fileReader->current(), ' '),
            ];

            $fileReader->next();
        }
        // Skip the closing line of the block
        $fileReader->next();

        return new PyStringsDto($rows, $header_padding);
    }
}
