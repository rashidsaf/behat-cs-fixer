<?php

declare(strict_types=1);

namespace Tests\Parsers\TableParser;

use Medology\GherkinCsFixer\Dto\TableDto;
use Medology\GherkinCsFixer\Dto\TableRowDto;
use Medology\GherkinCsFixer\Fixers\TableFixer;
use Medology\GherkinCsFixer\Parsers\TableParser;
use ReflectionException;
use Tests\TestCase;

/**
 * @covers \Medology\GherkinCsFixer\Fixers\TableFixer::setCellPadding
 */
class SetCellPadding extends TestCase
{
    /**
     * Test the cells should be padded correctly with/without multibyte string inside the table node.
     *
     * @param array $tableDtoContents the contents of the TableDto that will be tested
     * @param array $formattedCells   the expected formatted cells
     *
     * @throws ReflectionException
     *
     * @dataProvider tableRowsProvider
     */
    public function testSetCellPaddingParsedCorrectlyForCellWithMultiBytes(array $tableDtoContents, array $formattedCells)
    {
        $tableRowDtos = array_map(function ($tableDtoContent) {
            return new TableRowDto([$tableDtoContent]);
        }, $tableDtoContents);

        $columnWidths = $this->invokeMethod(new TableParser(), 'computeColumnWidths', [$tableRowDtos]);

        $tableDto = new TableDto($tableRowDtos, $columnWidths);

        $tableFixer = new TableFixer();

        $tableFixer->run($tableDto);

        $output = array_map(function ($tableRowDto) use ($tableFixer) {
            return $this->invokeMethod($tableFixer, 'setCellPadding', [$tableRowDto]);
        }, $tableRowDtos);

        $this->assertEquals($formattedCells, $output);
    }

    /**
     * Provide all test cases for the table rows with/without multibyte string.
     *
     * @return array
     */
    public function tableRowsProvider(): array
    {
        return [
            'None multibyte' => [
                [
                    'keyword',
                    'egg, yup',
                ],
                [
                    ['keyword '],
                    ['egg, yup'],
                ],
            ],
            'Only header in multibyte' => [
                [
                    'keywörd',
                    'egg, yup',
                ],
                [
                    ['keywörd '],
                    ['egg, yup'],
                ],
            ],
            'Only header in multibyte with multiple rows' => [
                [
                    'keywörd',
                    'egg, yup',
                    'egg, yup 2',
                ],
                [
                    ['keywörd   '],
                    ['egg, yup  '],
                    ['egg, yup 2'],
                ],
            ],
            'Only content in multibyte' => [
                [
                    'keyword',
                    'egg, yöp',
                ],
                [
                    ['keyword '],
                    ['egg, yöp'],
                ],
            ],
            'Only content in multibyte with multiple rows' => [
                [
                    'keyword',
                    'egg, yöp',
                    'egg, yöp 2',
                ],
                [
                    ['keyword   '],
                    ['egg, yöp  '],
                    ['egg, yöp 2'],
                ],
            ],
            'All multibyte' => [
                [
                    'keywörd',
                    'egg, yöp',
                ],
                [
                    ['keywörd '],
                    ['egg, yöp'],
                ],
            ],
            'All multibyte with multiple rows' => [
                [
                    'keywörd',
                    'egg, yöp',
                    'egg, yöp 2',
                ],
                [
                    ['keywörd   '],
                    ['egg, yöp  '],
                    ['egg, yöp 2'],
                ],
            ],
        ];
    }
}
