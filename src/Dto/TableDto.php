<?php declare(strict_types=1);

namespace BehatCsFixer\Dto;

/**
 * DTO class to carry table information.
 */
class TableDto
{
    /** @var array Multilevel associative array of table cells. */
    private $rows;

    /** @var array Width of every column in the table. */
    private $columns_width;

    /**
     * Fill the properties from array.
     *
     * @param array[] $cells  Associative array of table cell values
     * @param int[]   $widths List of columns widths
     */
    public function __construct(array $cells, array $widths)
    {
        $this->rows = $cells;
        $this->columns_width = $widths;
    }

    /**
     * Gets the cells.
     *
     * @return array
     */
    public function getTable(): array
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
