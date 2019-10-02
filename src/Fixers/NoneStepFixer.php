<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

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
        return $this->step_body;
    }
}
