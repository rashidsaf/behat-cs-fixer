<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for Feature keyword.
 */
class FeatureStepFixer extends StepFixer
{
    protected $padding = 0;

    protected $keyword = 'Feature';
}
