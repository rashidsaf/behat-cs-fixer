<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

/**
 * Fixer class for And keyword.
 */
class AndStepFixer extends StepFixer
{
    protected $padding = 6;
    protected $keyword = 'And';
}
