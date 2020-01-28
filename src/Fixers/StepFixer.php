<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

use Medology\GherkinCsFixer\Dto\StepDto;

/**
 * Abstract Fixer main class.
 *
 * @property int $padding Left padding.
 * @property int $keyword Keyword of the step.
 */
abstract class StepFixer
{
    /** @var string Step body. */
    protected $step_body;

    /** @var bool Has new line before this step. */
    protected $newline = false;

    /**
     * Assign the body variable.
     *
     * @param StepDto $stepDto All the information about this step
     */
    public function __construct(StepDto $stepDto)
    {
        $this->step_body = $stepDto->getBody();
        $this->newline = $stepDto->hasLineBreak() && $this->newline;
    }

    /**
     * Fix the step and return reformatted string.
     */
    public function run(): string
    {
        return ($this->newline ? PHP_EOL : '') .
            str_repeat(' ', $this->padding) .
            $this->keyword .
            $this->step_body .
            PHP_EOL;
    }
}
