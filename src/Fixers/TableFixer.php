<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

use Medology\GherkinCsFixer\Dto\TableDto;
use Medology\GherkinCsFixer\Dto\TableRowDto;

/**
 * Fixes the table formatting.
 */
class TableFixer
{
    /** @var int Padding value from left */
    private const PADDING = 8;

    /** @var TableDto File reader generator */
    private $dto;

    /**
     * Reformat the table.
     *
     * @param TableDto $dto table content dto
     */
    public function run(TableDto $dto): string
    {
        $this->dto = $dto;
        $table_content = '';
        foreach ($this->dto->getRows() as $rowDto) {
            $table_content .= $this->formatRow($rowDto);
        }

        return $table_content;
    }

    /**
     * Set padding to make every column same width.
     *
     * @param TableRowDto $rowDto list row cells
     *
     * @return string[]
     */
    private function setCellPadding(TableRowDto $rowDto): array
    {
        return array_map(function ($column, $cell) {
            return $cell . str_repeat(' ', $this->dto->getColumnLength($column) - mb_strlen($cell));
        }, array_keys($rowDto->getCells()), $rowDto->getCells());
    }

    /**
     * Makes formatted string out of table row cells.
     *
     * @param TableRowDto $rowDto list row cells
     */
    private function formatRow(TableRowDto $rowDto): string
    {
        $left_padding = str_repeat(' ', self::PADDING);

        if ($rowDto->getType() == 'comment') {
            return $left_padding . '#' . $rowDto->getRaw() . PHP_EOL;
        }
        $row_cells = $this->setCellPadding($rowDto);
        $content = '| ' . implode(' | ', $row_cells) . ' |' . PHP_EOL;

        return $left_padding . $content;
    }
}
