<?php declare(strict_types=1);

namespace GherkinCsFixer\Fixers;

/**
 * Fixer class for Scenario keyword.
 */
class ScenarioStepFixer extends StepFixer
{
    protected $padding = 2;
    protected $keyword = 'Scenario';

    /**
     * {@inheritdoc}
     */
    public function run(): string
    {
        return PHP_EOL.parent::run();
    }
}
