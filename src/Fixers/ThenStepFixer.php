<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for Then keyword.
 */
class ThenStepFixer extends StepFixer
{
    protected $padding = 5;

    protected $keyword = 'Then';
}
