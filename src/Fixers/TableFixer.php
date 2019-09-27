<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

use BehatCsFixer\Dto\TableDto;

/**
 * Fix the table formatting.
 *
 * Class TableParser
 */
class TableFixer
{
    /** @var TableDto File reader generator */
    private $dto;
    /** @var int Padding value from left */
    private const PADDING = 8;

    /**
     * Assign tableDto to local property.
     *
     * @param TableDto $dto Table content dto.
     */
    public function __construct(TableDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Reformat the table.
     *
     * @return string
     */
    public function run(): string
    {
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
        array_walk($row, function (&$cell, $column) {
            $cell = str_pad($cell, $this->dto->getColumnLength($column), ' ', STR_PAD_RIGHT);
        });

        return $row;
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
