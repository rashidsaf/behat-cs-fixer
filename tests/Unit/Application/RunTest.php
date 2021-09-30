<?php

declare(strict_types=1);

namespace Tests\Unit\Application;

use Medology\GherkinCsFixer\Application;
use Medology\GherkinCsFixer\Dto\StepDto;
use Tests\TestCase;

/**
 * Test the run method fixes all the files properly.
 *
 * @covers \Medology\GherkinCsFixer\Application::fix
 */
class RunTest extends TestCase
{
    public function testResetsPreviousStepBeforeEachFile(): void
    {
        // Given the application is run with two arguments for two files
        $app = $this->createPartialMock(Application::class, ['fix']);
        $this->setProperty($app, 'files', ['some/file', 'another/file']);
        // Then the fix method should be called two times
        $app->expects($this->exactly(2))->method('fix')->willReturnCallback(function () use ($app) {
            // And each time the fix method is called the previousStepDto should be null
            self::assertSame(null, $this->getProperty($app, 'previousStepDto'));
            $this->setProperty($app, 'previousStepDto', $this->createMock(StepDto::class));
        });
        // When then the application is run command executes
        $app->run();
    }
}
