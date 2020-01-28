<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for commented lines.
 */
class CommentStepFixer extends StepFixer
{
    protected $padding = 8;

    protected $keyword = '#';
}
