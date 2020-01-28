<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for Given keyword.
 */
class GivenStepFixer extends StepFixer
{
    protected $padding = 4;

    protected $keyword = 'Given';
}
