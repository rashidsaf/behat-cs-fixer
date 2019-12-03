<?php declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

use Medology\GherkinCsFixer\Dto\PyStringsDto;

/**
 * Fixes the multiple line text formatting.
 */
class PyStringsFixer
{
    /** @var int Padding value from left */
    public const PADDING = 10;

    /**
     * Reformat the text.
     *
     * @param  PyStringsDto $dto Text content dto.
     * @return string
     */
    public function run(PyStringsDto $dto): string
    {
        $start_padding = $dto->getHeaderPadding();
        $text = '';
        foreach ($dto->getContent() as $row) {
            $text .= trim($row['text'])
                ? $this->getPaddedText($row['text'], $start_padding, $row['padding'])
                : PHP_EOL;
        }
        $block_tag = $this->getBlockTag();

        return  $block_tag . $text . $block_tag;
    }

    /**
     * Get the text with the expected padding.
     *
     * @param  string $text         The text string
     * @param  int    $startPadding The original start padding
     * @param  int    $textPadding  The original text padding
     * @return string
     */
    private function getPaddedText(string $text, int $startPadding, int $textPadding): string
    {
        return str_repeat(' ', $this->getLeftPadding($startPadding, $textPadding)) . $text . PHP_EOL;
    }

    /**
     * Get the number of padding spaces.
     *
     * @param  int $startPadding The original start padding
     * @param  int $textPadding  The original text padding
     * @return int
     */
    private function getLeftPadding(int $startPadding, int $textPadding): int
    {
        return self::PADDING + max($textPadding - $startPadding, 0);
    }

    /**
     * Get the block tag with the padding.
     *
     * @return string
     */
    private function getBlockTag(): string
    {
        return str_pad(
            PyStringsDto::KEYWORD,
            strlen(PyStringsDto::KEYWORD) + self::PADDING,
            ' ',
            STR_PAD_LEFT
        ) . PHP_EOL;
    }
}
