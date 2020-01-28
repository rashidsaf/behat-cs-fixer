<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

use Medology\GherkinCsFixer\Dto\StepDto;

/**
 * Fixer factory class, get fixer class by keyword.
 *
 * Class FixerFactory
 */
class FixerFactory
{
    /**
     * Gets related Fixer class.
     *
     * @param StepDto $stepDTO Data transfer Object of the step
     */
    public static function getStepFixer(StepDto $stepDTO): StepFixer
    {
        $fixerClass = '\Medology\GherkinCsFixer\Fixers\\' . $stepDTO->getKeyword() . 'StepFixer';

        return new $fixerClass($stepDTO);
    }
}
