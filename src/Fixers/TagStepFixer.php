<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for scenario tags.
 */
class TagStepFixer extends StepFixer
{
    protected $padding = 2;

    protected $keyword = '@';

    protected $newline = true;

    /**
     * Fix the step and return reformatted string.
     */
    public function run(): string
    {
        if (!$this->previousStepDto) {
            $this->padding = 0;
            $this->newline = false;
        }

        return parent::run();
    }
}
