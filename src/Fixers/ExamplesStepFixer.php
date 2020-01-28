<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for Examples keyword.
 */
class ExamplesStepFixer extends StepFixer
{
    protected $padding = 4;

    protected $keyword = 'Examples';

    /**
     * {@inheritdoc}
     */
    public function run(): string
    {
        return PHP_EOL . parent::run();
    }
}
