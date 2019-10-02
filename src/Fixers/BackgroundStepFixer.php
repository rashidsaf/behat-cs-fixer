<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

/**
 * Fixer class for Background keyword.
 */
class BackgroundStepFixer extends StepFixer
{
    protected $padding = 2;
    protected $keyword = 'Background';
}
