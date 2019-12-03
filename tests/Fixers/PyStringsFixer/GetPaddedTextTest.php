<?php declare(strict_types=1);

use Medology\GherkinCsFixer\Fixers\PyStringsFixer;
use Tests\TestCase;

/**
 * @covers \Medology\GherkinCsFixer\Fixers\PyStringsFixer::getPaddedText
 */
class GetPaddedTextTest extends TestCase
{
    /**
     * Test that the text ends with a new line.
     *
     * @dataProvider paddingExamples
     *
     * @param  int                 $startPadding The original start padding
     * @param  int                 $textPadding  The original text padding
     * @throws ReflectionException When fails to create a reflection class.
     */
    public function testTextEndsWithANewLine(int $startPadding, int $textPadding): void
    {
        $text = $this->invokeMethod(
            new PyStringsFixer(),
            'getPaddedText',
            [$expectedText = 'this is some text', $startPadding, $textPadding]
        );

        $this->assertSame(
            PHP_EOL,
            substr($text, -1, 1), //gets the last character of the $text string
            'Expected text to end with a new line but it did not.'
        );
    }

    /**
     * Test that the text contains the original string.
     *
     * @dataProvider paddingExamples
     *
     * @param  int                 $startPadding The original start padding
     * @param  int                 $textPadding  The original text padding
     * @throws ReflectionException When fails to create a reflection class.
     */
    public function testTextContainsOriginalString(int $startPadding, int $textPadding): void
    {
        $text = $this->invokeMethod(
            new PyStringsFixer(),
            'getPaddedText',
            [$expectedText = 'this is some text', $startPadding, $textPadding]
        );

        $this->assertStringContainsString(
            $expectedText,
            $text,
            "Expected to find text '$expectedText' in '$text'"
        );
    }

    public function paddingExamples(): array
    {
        return [
        //  startPadding  textPadding
            [0,           0],
            [1,           10],
            [15,          10],
            [10,          15],
            [15,          5],
            [5,           5],
        ];
    }
}
