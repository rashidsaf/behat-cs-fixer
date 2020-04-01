<?php

declare(strict_types=1);

namespace Tests\Parsers\TableParser;

use Medology\GherkinCsFixer\Dto\TableRowDto;
use Medology\GherkinCsFixer\Parsers\TableParser;
use ReflectionException;
use Tests\TestCase;

/**
 * @covers \Medology\GherkinCsFixer\Parsers\TableParser::computeColumnWidths
 */
class ComputeColumnWidthsTest extends TestCase
{
    /**
     * Test the column length should be calculated correctly with multibyte characters.
     * - Without proper multibyte support, the column length is 10
     * - With proper multibyte support, the column length is 8.
     *
     * @throws ReflectionException
     */
    public function testColumnWidthShouldBeCalculatedCorrectForColumnWithMultiBytes()
    {
        $tableRowDtos = [
            new TableRowDto(['keyword']),
            new TableRowDto(['Ègg, Ýup']),
            new TableRowDto(['ègg, ýup']),
            new TableRowDto(['èGG, ýUP']),
        ];

        $columnWidths = $this->invokeMethod(new TableParser(), 'computeColumnWidths', [$tableRowDtos]);

        $this->assertEquals($columnWidths, [8]);
    }
}
