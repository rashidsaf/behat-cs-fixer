<?php declare(strict_types=1);

namespace Medology\GherkinCsFixer\Dto;

/**
 * DTO class to carry table information.
 */
class TableDto
{
    /** @var TableRowDto[] List of TableRowDto rows. */
    private $rows;

    /** @var array Width of every column in the table. */
    private $columns_width;

    /**
     * Fill the properties from array.
     *
     * @param TableRowDto[] $cells  List of TableRowDto
     * @param int[]         $widths List of columns widths
     */
    public function __construct(array $cells, array $widths)
    {
        $this->rows = $cells;
        $this->columns_width = $widths;
    }

    /**
     * Gets the row cells.
     *
     * @return TableRowDto[]
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * Return size of the column.
     *
     * @param  int $column Index of the column
     * @return int
     */
    public function getColumnLength(int $column): int
    {
        return $this->columns_width[$column];
    }
}
