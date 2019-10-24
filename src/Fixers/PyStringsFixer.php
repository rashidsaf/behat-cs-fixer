<?php declare(strict_types=1);

namespace Medology\GherkinCsFixer\Fixers;

use Medology\GherkinCsFixer\Dto\PyStringsDto;

/**
 * Fixes the multiple line text formatting.
 */
class PyStringsFixer
{
    /** @var int Padding value from left */
    private const PADDING = 10;

    /** @var PyStringsDto PyStrings Data Object */
    private $dto;

    /**
     * Reformat the text.
     *
     * @param  PyStringsDto $dto Text content dto.
     * @return string
     */
    public function run(PyStringsDto $dto): string
    {
        $this->dto = $dto;
        $block_tag = str_pad(
                PyStringsDto::KEYWORD,
                strlen(PyStringsDto::KEYWORD) + self::PADDING,
                ' ',
                STR_PAD_LEFT) . PHP_EOL;
        $text = '';
        $leftPadding = $this->calculateLeftPadding();
        foreach ($this->dto->getContent() as $row_text) {
            $text .= str_pad($row_text, strlen($row_text) + $leftPadding, ' ', STR_PAD_LEFT);
        }

        return  $block_tag . $text . $block_tag;
    }

    /**
     * Calculate the minimum left padding from the left side.
     *
     * @return int
     */
    private function calculateLeftPadding(): int
    {
        $padding =  min(array_map(function ($value) {
            return strspn($value, ' ');
        }, $this->dto->getContent()));

        return $padding > self::PADDING ? 0 : self::PADDING - $padding;
    }
}
