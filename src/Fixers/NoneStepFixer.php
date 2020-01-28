<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for unmatched keywords.
 */
class NoneStepFixer extends StepFixer
{
    protected $padding = 0;

    protected $keyword = '';

    /**
     * {@inheritdoc}
     */
    public function run(): string
    {
        return preg_match('/^([\s\n\r]+)$/m', $this->step_body) ? '' : $this->step_body;
    }
}
