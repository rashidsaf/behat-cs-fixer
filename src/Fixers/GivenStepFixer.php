<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

/**
 * Fixer class for Given keyword.
 */
class GivenStepFixer extends AbstractStepFixer
{
    protected $padding = 4;
    protected $keyword = 'Given';
}
