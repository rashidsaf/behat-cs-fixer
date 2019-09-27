<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

/**
 * Fixer class for When keyword.
 */
class WhenStepFixer extends AbstractStepFixer
{
    protected $padding = 5;
    protected $keyword = 'When';
}
