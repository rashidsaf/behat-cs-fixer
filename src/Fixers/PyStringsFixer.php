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
        $start_padding = $this->dto->getHeaderPadding();
        foreach ($this->dto->getContent() as $row) {
            $leftPadding = self::PADDING + max($row['padding'] - $start_padding,0);
            $text .= str_repeat(' ', $leftPadding) . $row['text'] . PHP_EOL;
        }

        return  $block_tag . $text . $block_tag;
    }
}
