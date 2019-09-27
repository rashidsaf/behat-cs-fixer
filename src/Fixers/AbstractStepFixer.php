<?php declare(strict_types=1);

namespace BehatCsFixer\Fixers;

/**
 * Abstract Fixer main class.
 *
 * @property int $padding       Left padding.
 * @property int $keyword       Keyword of the step.
 */
abstract class AbstractStepFixer
{
    /** @var string Step body. */
    protected $step_body;

    /**
     * Assign the body variable.
     *
     * @param string $step_body
     */
    public function __construct(string $step_body)
    {
        $this->step_body = $step_body;
    }

    /**
     * Fix the step and return reformatted string.
     *
     * @return string
     */
    public function run(): string
    {
        return str_repeat(' ', $this->padding) . $this->keyword . $this->step_body . PHP_EOL;
    }
}
