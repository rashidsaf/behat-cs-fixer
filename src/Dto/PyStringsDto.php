<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Dto;

/**
 * DTO class to carry multiple line text information.
 */
class PyStringsDto
{
    /** @var string Text block starting and ending */
    public const KEYWORD = '"""';

    /** @var string[] List of text rows. */
    private $rows;

    /** @var int Initial padding of the starting tag from left */
    private $padding = 0;

    /**
     * Fill the properties from array.
     *
     * @param array[] $rows    List of text lines and padding from left
     * @param int     $padding Initial padding of the starting tag from left
     */
    public function __construct(array $rows, int $padding = 0)
    {
        $this->rows = $rows;
        $this->padding = $padding;
    }

    /**
     * Gets the text rows.
     *
     * @return string[]
     */
    public function getContent(): array
    {
        return $this->rows;
    }

    /**
     * left starting tag padding value.
     */
    public function getHeaderPadding(): int
    {
        return $this->padding;
    }
}
