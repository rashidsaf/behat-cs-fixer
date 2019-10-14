<?php declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

use Medology\GherkinCsFixer\Dto\TableDto;

/**
 * Fixes the table formatting.
 */
class TableFixer
{
    /** @var TableDto File reader generator */
    private $dto;

    /** @var int Padding value from left */
    private const PADDING = 8;

    /**
     * Reformat the table.
     *
     * @param  TableDto $dto Table content dto.
     * @return string
     */
    public function run(TableDto $dto): string
    {
        $this->dto = $dto;
        $table_content = '';
        foreach ($this->dto->getTable() as $row) {
            $table_content .= $this->formatRow($row);
        }

        return $table_content;
    }

    /**
     * Set padding to make every column same width.
     *
     * @param  string[] $row List row cells.
     * @return string[]
     */
    private function setCellPadding(array $row): array
    {
        return array_map(function ($column, $cell) {
            return str_pad($cell, $this->dto->getColumnLength($column), ' ', STR_PAD_RIGHT);
        }, array_keys($row), $row);
    }

    /**
     * Makes formatted string out of table row cells.
     *
     * @param  string[] $row List row cells.
     * @return string
     */
    private function formatRow(array $row): string
    {
        $row = $this->setCellPadding($row);
        $left_padding = str_repeat(' ', self::PADDING);
        $content = '| '.implode(' | ', $row) . ' |' . PHP_EOL;

        return $left_padding.$content;
    }
}
