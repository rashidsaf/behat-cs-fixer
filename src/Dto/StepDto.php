<?php declare(strict_types=1);

namespace BehatCsFixer\Dto;

use BehatCsFixer\Exceptions\InvalidKeywordException;

/**
 * DTO class to carry step line information.
 */
class StepDto
{
    /** @var array List of available step keywords. */
    public const STEP_KEYWORDS = [
        'Feature'    => true,
        'Background' => true,
        'Scenario'   => true,
        'Examples'   => true,
        'Given'      => true,
        'When'       => true,
        'Then'       => true,
        'And'        => true,
    ];

    /** @var string Step line without keyword prefix. */
    private $body = '';
    /** @var string Step line keyword. */
    private $keyword;

    /**
     * Fill the properties from array.
     *
     * @param  array                   $content Step line parts
     * @throws InvalidKeywordException When the keyword mismatched with check
     */
    public function __construct(array $content = [])
    {
        if (empty($content['keyword'])) {
            $this->keyword = 'None';
            $this->body = $content['body'] ?? '';
        } elseif ($content['keyword'] == '|') {
            $this->keyword = 'Table';
        } elseif (empty(self::STEP_KEYWORDS[$content['keyword']])) {
            throw new InvalidKeywordException('Mismatched parsed keyword: '.$content['keyword']);
        } else {
            $this->keyword = $content['keyword'];
            $this->body = $content['body'];
        }
    }

    /**
     * Returns the step keyword.
     *
     * @return string
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * Returns the step body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}
