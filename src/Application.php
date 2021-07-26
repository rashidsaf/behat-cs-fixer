<?php

declare(strict_types=1);

namespace Medology\GherkinCsFixer;

use Generator;
use Medology\GherkinCsFixer\Dto\PyStringsDto;
use Medology\GherkinCsFixer\Dto\StepDto;
use Medology\GherkinCsFixer\Exceptions\FileNotFound;
use Medology\GherkinCsFixer\Exceptions\FileWriteException;
use Medology\GherkinCsFixer\Exceptions\InvalidKeywordException;
use Medology\GherkinCsFixer\Fixers\FixerFactory;
use Medology\GherkinCsFixer\Fixers\PyStringsFixer;
use Medology\GherkinCsFixer\Fixers\TableFixer;
use Medology\GherkinCsFixer\Parsers\PyStringsParser;
use Medology\GherkinCsFixer\Parsers\StepParser;
use Medology\GherkinCsFixer\Parsers\TableParser;

/**
 * The main operation class.
 */
class Application
{
    /** @var string[] List of the files. */
    protected $files = [];

    /** @var StepParser Instance of StepParser */
    private $stepParser;

    /** @var TableParser Instance of TableParser */
    private $tableParser;

    /** @var PyStringsParser Instance of MultilineParser */
    private $pyStringsParser;

    /** @var TableFixer Instance of TableFixer */
    private $tableFixer;

    /** @var PyStringsFixer Instance of MultilineFixer */
    private $pyStringsFixer;

    /** @var StepDto Storing previous step information */
    protected $previousStepDto;

    /**
     * Application constructor.
     *
     * @param string[] $files list of the files to be fixed
     *
     * @throws InvalidKeywordException When StepDto keyword mismatch
     */
    public function __construct(array $files)
    {
        $this->files = $files;
        $this->stepParser = new StepParser();
        $this->tableParser = new TableParser();
        $this->tableFixer = new TableFixer();
        $this->pyStringsFixer = new PyStringsFixer();
        $this->pyStringsParser = new PyStringsParser();
        $this->previousStepDto = null;
    }

    /**
     * Run the fix function for all given files.
     *
     * @throws InvalidKeywordException From StepParser
     * @throws FileNotFound            From FileHelper
     * @throws FileWriteException      From FileHelper
     */
    public function run(): void
    {
        foreach ($this->files as $file) {
            $this->previousStepDto = null;
            $this->fix($file);
        }
    }

    /**
     * Fixes the formatting of the file.
     *
     * @param string $file_path path to the test file
     *
     * @throws InvalidKeywordException From StepParser
     * @throws FileNotFound            From FileHelper
     * @throws FileWriteException      From FileHelper
     */
    protected function fix(string $file_path): void
    {
        $content = '';
        $fileReader = FileHelper::readFile($file_path);
        while ($fileReader->current()) {
            $content .= $this->fixStep($fileReader);
        }

        FileHelper::save($file_path, $content);
    }

    /**
     * Parses the line or table, fix the formatting and return.
     *
     * @param Generator $fileReader File streamer
     *
     * @throws InvalidKeywordException From StepParser
     */
    private function fixStep(Generator $fileReader): string
    {
        $stepDto = $this->stepParser->run($fileReader->current(), $this->previousStepDto);
        if ($stepDto->getKeyword() == 'Table') {
            return $this->tableFixer->run($this->tableParser->run($fileReader));
        }
        if ($stepDto->getKeyword() == PyStringsDto::KEYWORD) {
            return $this->pyStringsFixer->run($this->pyStringsParser->run($fileReader));
        }

        $fileReader->next();

        try {
            return FixerFactory::getStepFixer($stepDto, $this->previousStepDto)->run();
        } finally {
            $this->previousStepDto = ($stepDto && $stepDto->getKeyword() != 'None') ? $stepDto : $this->previousStepDto;
        }
    }
}
