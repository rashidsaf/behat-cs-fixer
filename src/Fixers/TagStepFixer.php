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
}
