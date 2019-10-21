<?php declare(strict_types=1);

namespace Medology\GherkinCsFixer\Dto;

/**
 * DTO class to carry multiple line text information.
 */
class PyStringsDto
{
    /** @var string[] List of text rows. */
    private $rows;

    /** @var string Text block starting and ending */
    public const KEYWORD = '"""';

    /**
     * Fill the properties from array.
     *
     * @param string[] $rows List of text rows
     */
    public function __construct(array $rows)
    {
        $this->rows = $rows;
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
}
