<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

/**
 * Fixer class for Examples keyword.
 */
class ExamplesStepFixer extends AbstractStepFixer
{
    protected $padding = 4;
    protected $keyword = 'Examples';
}
