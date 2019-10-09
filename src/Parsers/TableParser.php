<?php declare(strict_types=1);

namespace GherkinCsFixer\Parsers;

use GherkinCsFixer\Dto\TableDto;
use Generator;

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
            if (empty($row_cells = $this->parseRow($table_row))) {
                // Table ends
                break;
            }
            $table_cells[] = $row_cells;
            $fileReader->next();
        }

        return new TableDto($table_cells, $this->computeColumnWidths($table_cells));
    }

    /**
     * Read table line from file and parse it into cells array.
     *
     * @param  string     $table_row Line of the table.
     * @return array|null
     */
    private function parseRow(string $table_row): ?array
    {
        // Skip commented lines and other line that has "|" char
        if (!preg_match('/^(\s+)?\|(?P<step>.*)/', $table_row)) {
            return null;
        }
        $cells = preg_split('/\s*\|\s*/', $table_row);
        array_pop($cells);
        array_shift($cells);

        return $cells;
    }

    /**
     * Find the longest value in the column, and keep the record.
     *
     * @param  array[] $table_cells 2D Array of table cells
     * @return int[]   List of the width of the columns
     */
    private function computeColumnWidths(array $table_cells): array
    {
        $columns_width = [];
        foreach ($table_cells as $row => $row_cells) {
            foreach ($row_cells as $col => $cell) {
                $columns_width[$col] =
                    isset($columns_width[$col])
                    ? max(strlen($cell), $columns_width[$col])
                    : strlen($cell);
            }
        }

        return $columns_width;
    }
}
