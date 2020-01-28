<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Dto;

/**
 * DTO class to carry table row information.
 */
class TableRowDto
{
    /** @var string[] List of row cells. */
    private $cells;

    /** @var string Type of the row */
    private $type;

    /** @var string Additional content for carry */
    private $raw;

    /**
     * Fill the properties from array.
     *
     * @param string   $type  Type of the row
     * @param string[] $cells List of cells values
     * @param string   $raw   Additional content for carry
     */
    public function __construct(array $cells, string $type = 'row', string $raw = '')
    {
        $this->cells = $cells;
        $this->type = $type;
        $this->raw = $raw;
    }

    /**
     * Gets the cells.
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    /**
     * Gets the additional content.
     */
    public function getRaw(): string
    {
        return $this->raw;
    }

    /**
     * Gets the type or row.
     */
    public function getType(): string
    {
        return $this->type;
    }
}
