<?php declare(strict_types=1);

namespace GherkinCsFixer\Fixers;

/**
 * Fixer class for Background keyword.
 */
class BackgroundStepFixer extends StepFixer
{
    protected $padding = 2;
    protected $keyword = 'Background';

    /**
     * {@inheritdoc}
     */
    public function run(): string
    {
        return PHP_EOL.parent::run();
    }
}
