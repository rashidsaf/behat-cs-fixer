<?php declare(strict_types=1);

use Medology\GherkinCsFixer\Fixers\PyStringsFixer;
use Tests\TestCase;

/**
 * @covers \Medology\GherkinCsFixer\Fixers\PyStringsFixer::getBlockTag
 */
class GetBlockTagTest extends TestCase
{
    /**
     * Test the block tag ends with a new line.
     *
     * @throws ReflectionException When fails to create a reflection class.
     */
    public function testTheBlockTagEndsWithANewLine(): void
    {
        $blockTag = $this->invokeMethod(new PyStringsFixer(), 'getBlockTag');

        $this->assertSame(
            PHP_EOL,
            substr($blockTag, -1, 1), //gets the last character of the $blockTag string
            'Expected the block tag to end with a new line but it did not.'
        );
    }

    /**
     * Test the block tag has the correct amount of padding.
     *
     * @throws ReflectionException When fails to create a reflection class.
     */
    public function testTheBlockTagHasTheCorrectAmountOfPadding(): void
    {
        preg_match('/\s+/', $this->invokeMethod(new PyStringsFixer(), 'getBlockTag'), $matches);

        $this->assertSame(
            $expected = PyStringsFixer::PADDING,
            $actual = mb_strlen($matches[0] ?? ''),
            "Expected padding of $expected spaces but found $actual spaces"
        );
    }

    /**
     * Test the block tag has quotes in the correct place.
     *
     * @throws ReflectionException When fails to create a reflection class.
     */
    public function testTheBlockTagHasQuotesInCorrectPlace(): void
    {
        $blockTag = $this->invokeMethod(new PyStringsFixer(), 'getBlockTag');

        $this->assertSame(
            $expected = '"""',
            substr($blockTag, -4, 3), //gets the last character of the $blockTag string
            "Expected the block tag to end with $expected just before the last new line, it did not."
        );
    }
}
