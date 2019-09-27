<?php declare(strict_types=1);

namespace BehatCsFixer\Dto;

/**
 * DTO class to carry table information.
 */
class TableDto
{
    /** @var array Multilevel associative array of table cells. */
    private $cells;
    /** @var array Width of every column in the table. */
    private $column_lengths;

    /**
     * Fill the properties from array.
     *
     * @param array[] $cells          Associative array of table cell values
     * @param int[]   $column_lengths List of columns sizes
     */
    public function __construct(array $cells, array $column_lengths)
    {
        $this->cells = $cells;
        $this->column_lengths = $column_lengths;
    }

    /**
     * Gets the cells.
     *
     * @return array
     */
    public function getTable(): array
    {
        return $this->cells;
    }

    /**
     * Return size of the column.
     *
     * @param  int $column Index of the column
     * @return int
     */
    public function getColumnLength(int $column): int
    {
        return $this->column_lengths[$column];
    }
}
