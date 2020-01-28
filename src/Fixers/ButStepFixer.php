<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for And keyword.
 */
class ButStepFixer extends StepFixer
{
    protected $padding = 6;

    protected $keyword = 'But';
}
