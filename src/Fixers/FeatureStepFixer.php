<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

/**
 * Fixer class for Feature keyword.
 */
class FeatureStepFixer extends AbstractStepFixer
{
    protected $padding = 0;
    protected $keyword = 'Feature';
}
