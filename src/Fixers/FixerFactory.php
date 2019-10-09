<?php declare(strict_types=1);

namespace GherkinCsFixer\Fixers;

use GherkinCsFixer\Dto\StepDto;

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
     * @param  StepDto   $stepDTO Data transfer Object of the step
     * @return StepFixer
     */
    public static function getStepFixer(StepDto $stepDTO): StepFixer
    {
        $fixerClass = '\GherkinCsFixer\Fixers\\'.$stepDTO->getKeyword().'StepFixer';

        return new $fixerClass($stepDTO->getBody());
    }
}
