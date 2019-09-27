<?php declare(strict_types=1);

namespace BehatCsFixer\Parsers;

use BehatCsFixer\Dto\TableDto;
use Generator;

/**
 * Parse consecutive lines as table and fix the formatting.
 *
 * Class TableParser
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
        $max_lengths = [];
        while ($table_row = $fileReader->current()) {
            // Table ends
            if (empty($row_cells = $this->parseRow($table_row))) {
                break;
            }
            // Find largest value for each column
            foreach ($row_cells as $i=>$cell) {
                $max_lengths[$i] = isset($max_lengths[$i]) ? max(strlen($cell), $max_lengths[$i]) : strlen($cell);
            }

            $table_cells[] = $row_cells;
            $fileReader->next();
        }

        return new TableDto($table_cells, $max_lengths);
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
}
