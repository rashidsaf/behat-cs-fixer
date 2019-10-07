<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

/**
 * Fixer class for Examples keyword.
 */
class ExamplesStepFixer extends StepFixer
{
    protected $padding = 4;
    protected $keyword = 'Examples';

    /**
     * {@inheritDoc}
     */
    public function run(): string
    {
        return PHP_EOL.parent::run();
    }
}
