<?php declare(strict_types=1);

namespace Medology\GherkinCsFixer\Parsers;

use Generator;
use Medology\GherkinCsFixer\Dto\TableDto;
use Medology\GherkinCsFixer\Dto\TableRowDto;

/**
 * Parse consecutive lines as table and fix the formatting.
 */
class TableParser
{
    /**
     * Parses the whole table and return reformatted new one.
     *
     * @param  Generator $fileReader File streamer
     * @return TableDTO
     */
    public function run(Generator $fileReader): TableDTO
    {
        $table_cells = [];
        while ($table_row = $fileReader->current()) {
            if (empty($rowDto = $this->parseRow($table_row))) {
                // Table ends
                break;
            }
            $table_cells[] = $rowDto;
            $fileReader->next();
        }

        return new TableDto($table_cells, $this->computeColumnWidths($table_cells));
    }

    /**
     * Read table line from file and parse it into cells array.
     *
     * @param  string           $table_row Line of the table.
     * @return TableRowDto|null
     */
    private function parseRow(string $table_row): ?TableRowDto
    {
        // Commented table row
        if (preg_match('/^(\s+)?#(?P<comment>.*)/', $table_row, $matches)) {
            return new TableRowDto([], 'comment', $matches['comment']);
        }
        // Non-table content
        if (!preg_match('/^(\s+)?\|(?P<step>.*)/', $table_row)) {
            return null;
        }
        $cells = preg_split('/\s*\|\s*/', $table_row);
        array_pop($cells);
        array_shift($cells);

        return new TableRowDto($cells);
    }

    /**
     * Find the longest value in the column, and keep the record.
     *
     * @param  TableRowDto[] $table_cells 2D Array of table cells
     * @return int[]         List of the width of the columns
     */
    private function computeColumnWidths(array $table_cells): array
    {
        $columns_width = [];
        foreach ($table_cells as $row => $rowDto) {
            foreach ($rowDto->getCells() as $col => $cell) {
                $columns_width[$col] =
                    isset($columns_width[$col])
                    ? max(strlen($cell), $columns_width[$col])
                    : strlen($cell);
            }
        }

        return $columns_width;
    }
}
