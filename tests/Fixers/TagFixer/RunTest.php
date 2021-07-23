<?php

declare(strict_types=1);

namespace Tests\Fixers\TagFixer;

use Medology\GherkinCsFixer\Dto\StepDto;
use Medology\GherkinCsFixer\Fixers\TagStepFixer;
use Tests\TestCase;

class RunTest extends TestCase
{
    public function testNoNewlineAddedWhenTheTagIsTheFirstStep(): void
    {
        // Given the previous step does not exist (the current step is the first step)
        $previousStepDto = null;
        // And the current step is for a tag step.
        $currentStepDto = new StepDto([
            'keyword' => '@',
            'body' => 'test',
            'line_break' => false
        ]);
        // When the current step is fixed
        $actual = (new TagStepFixer($currentStepDto, $previousStepDto))->run();
        // Then the tag step should not be indented
        $expected = <<<'gherkin'
@test

gherkin;
        self::assertEquals($expected, $actual);
    }

    public function testNewlineIsAddedWhenTheTagIsNotTheFirstStep(): void
    {
        // Given the previous step is present (the current step is not the first step)
        $previousStepDto = new StepDto([
            'keyword' => 'Then',
            'body' => 'I assert something',
            'line_break' => true
        ]);
        // And the current step is for a tag step.
        $currentStepDto = new StepDto([
            'keyword' => '@',
            'body' => 'test',
            'line_break' => false
        ]);
        // When the current step is fixed
        $actual = (new TagStepFixer($currentStepDto, $previousStepDto))->run();
        // Then the tag step should be indented
        $expected = <<<'gherkin'
  @test

gherkin;

        self::assertEquals($expected, $actual);
    }
}
