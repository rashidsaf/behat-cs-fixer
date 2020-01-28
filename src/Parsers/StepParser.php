<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Parsers;

use Medology\GherkinCsFixer\Dto\StepDto;
use Medology\GherkinCsFixer\Exceptions\InvalidKeywordException;

/**
 * Parse the line from file, into step and keywords.
 */
class StepParser
{
    /** @var string Regular exp rule for parsing step line. */
    private $regex;

    /**
     * Compute and keep regex.
     */
    public function __construct()
    {
        $this->regex = '/^(\s+)?(?P<keyword>' .
            implode('|', StepDto::STEP_KEYWORDS) . '|' .
            implode('|\\', array_keys(StepDto::SYMBOL_KEYWORDS)) .
            ')(?P<body>.*)/';
    }

    /**
     * Parses the line from the file and return as StepDTO.
     *
     * @param string  $raw_step     Raw text line from the file
     * @param StepDto $previousStep Previous step information
     *
     * @throws InvalidKeywordException when the keyword mismatched with check
     */
    public function run(string $raw_step, StepDto $previousStep): StepDto
    {
        $dto_data = preg_match($this->regex, $raw_step, $m) ? $m : ['body' => $raw_step];
        $dto_data['line_break'] = $previousStep->getKeyword() != 'Tag';

        return new StepDto($dto_data);
    }
}
