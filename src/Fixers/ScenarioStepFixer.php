<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

/**
 * Fixer class for Scenario keyword.
 */
class ScenarioStepFixer extends StepFixer
{
    protected $padding = 2;

    protected $keyword = 'Scenario';

    protected $newline = true;
}
