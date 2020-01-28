<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for When keyword.
 */
class WhenStepFixer extends StepFixer
{
    protected $padding = 5;

    protected $keyword = 'When';
}
