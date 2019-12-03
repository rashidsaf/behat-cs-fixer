<?php declare(strict_types=1);

use Medology\GherkinCsFixer\Fixers\PyStringsFixer;
use Tests\TestCase;

/**
 * @covers \Medology\GherkinCsFixer\Fixers\PyStringsFixer::getLeftPadding
 */
class GetLeftPaddingTest extends TestCase
{
    /**
     * Test the final amount of padding is correct.
     *
     * @dataProvider paddingExamples
     *
     * @param  int                 $startPadding    The starting amount of padding before the real data.
     * @param  int                 $textPadding     The amount of padding the single line of text is supposed to have.
     * @param  int                 $expectedPadding The expected amount of total padding for the line.
     * @throws ReflectionException When fails to create a reflection class.
     */
    public function testCorrectLengthIsReturned(int $startPadding, int $textPadding, int $expectedPadding): void
    {
        $actualPadding = $this->invokeMethod(
            new PyStringsFixer(),
            'getLeftPadding',
            [$startPadding, $textPadding]
        );

        $this->assertSame($expectedPadding, $actualPadding);
    }

    /**
     * Examples of number of padding spaces and the expected outcome.
     */
    public function paddingExamples(): array
    {
        return [
        //  startPadding  textPadding  expectedPadding
            [10,          10,          10],
            [5,           10,          15],
            [10,          5,           10],
            [10,          20,          20],
        ];
    }
}
