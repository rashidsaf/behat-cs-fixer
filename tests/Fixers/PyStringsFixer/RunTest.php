<?php declare(strict_types=1);

namespace Tests\Fixers\PyStringsFixer;

use Medology\GherkinCsFixer\Dto\PyStringsDto;
use Medology\GherkinCsFixer\Fixers\PyStringsFixer;
use Tests\TestCase;

/**
 * @covers \Medology\GherkinCsFixer\Fixers\PyStringsFixer::run
 */
class RunTest extends TestCase
{
    /**
     * Test that blank pyString lines do contain any white space.
     */
    public function testBlankLinesInPyStringsDoNotContainAnyWhiteSpace(): void
    {
        $pyStringsDto = new PyStringsDto([
            ['text' => '          testing_on_line_1', 'padding' => 10],
            ['text' => '                        ', 'padding' => 10],
            ['text' => '          testing_on_line_3', 'padding' => 10],
            ['text' => '   ', 'padding' => 10],
        ], 10);

        $expected = <<<'text'
          """
                    testing_on_line_1

                    testing_on_line_3

          """

text;
        $this->assertSame(
            $expected,
            $actual = (new PyStringsFixer())->run($pyStringsDto),
            'Expected ' . PHP_EOL . " >>>$expected<<< but got " . PHP_EOL . ">>>$actual<<<"
        );
    }
}
