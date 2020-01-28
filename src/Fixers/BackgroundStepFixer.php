<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for Background keyword.
 */
class BackgroundStepFixer extends StepFixer
{
    protected $padding = 2;

    protected $keyword = 'Background';

    protected $newline = true;
}
