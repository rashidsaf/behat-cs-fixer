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

    /**
     * Reformat the text.
     *
     * @param  PyStringsDto $dto Text content dto.
     * @return string
     */
    public function run(PyStringsDto $dto): string
    {
        $block_tag = str_pad(
                PyStringsDto::KEYWORD,
                strlen(PyStringsDto::KEYWORD) + self::PADDING,
                ' ',
                STR_PAD_LEFT) . PHP_EOL;
        $text = '';
        foreach ($dto->getContent() as $row_text) {
            $text .= str_pad($row_text, strlen($row_text) + self::PADDING, ' ', STR_PAD_LEFT);
        }

        return  $block_tag . $text . $block_tag;
    }
}
