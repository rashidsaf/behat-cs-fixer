<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Dto;

use Medology\GherkinCsFixer\Exceptions\InvalidKeywordException;

/**
 * DTO class to carry step line information.
 */
class StepDto
{
    /** @var array List of available step keywords. */
    public const STEP_KEYWORDS = [
        'Feature',
        'Background',
        'Scenario',
        'Examples',
        'Given',
        'When',
        'Then',
        'And',
        'But',
    ];

    /** @var array List of special characters that are not actually step keywords. */
    public const SYMBOL_KEYWORDS = [
        '@'                   => 'Tag',    // Scenario tags
        '#'                   => 'Comment', // Comment lines
        '|'                   => 'Table',   // Table pipe
        PyStringsDto::KEYWORD => PyStringsDto::KEYWORD, // PyStrings
    ];

    /** @var string Step line without keyword prefix. */
    private $body = '';

    /** @var string Step line keyword. */
    private $keyword;

    /** @var bool New line before the step or not. */
    private $line_break;

    /**
     * Fill the properties from array.
     *
     * @param array $content Step line parts
     *
     * @throws InvalidKeywordException When the keyword mismatched with check
     */
    public function __construct(array $content = [])
    {
        if (empty($content['keyword'])) {
            $this->keyword = 'None';
        } elseif (isset(self::SYMBOL_KEYWORDS[$content['keyword']])) {
            $this->keyword = self::SYMBOL_KEYWORDS[$content['keyword']];
        } elseif (in_array($content['keyword'], self::STEP_KEYWORDS)) {
            $this->keyword = $content['keyword'];
        } else {
            throw new InvalidKeywordException('Mismatched parsed keyword: ' . $content['keyword']);
        }

        $this->body = $content['body'] ?? '';
        $this->line_break = $content['line_break'] ?? false;
    }

    /**
     * Returns the step keyword.
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * Returns the step body.
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Insert new line before ?
     */
    public function hasLineBreak(): bool
    {
        return $this->line_break;
    }
}
