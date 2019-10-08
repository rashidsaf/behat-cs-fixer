<?php declare(strict_types=1);

namespace BehatCsFixer;

use BehatCsFixer\Exceptions\FileNotFound;
use BehatCsFixer\Exceptions\FileWriteException;
use BehatCsFixer\Exceptions\InvalidKeywordException;
use BehatCsFixer\Fixers\FixerFactory;
use BehatCsFixer\Fixers\TableFixer;
use BehatCsFixer\Parsers\StepParser;
use BehatCsFixer\Parsers\TableParser;
use Generator;

/**
 * The main operation class.
 */
class Application
{
    /** @var string[] List of the files. */
    private $files = [];

    /** @var StepParser Instance of StepParser */
    private $stepParser;

    /** @var TableParser Instance of TableParser */
    private $tableParser;

    /** @var TableFixer Instance of TableFixer */
    private $tableFixer;

    /**
     * Application constructor.
     *
     * @param string[] $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
        $this->stepParser = new StepParser();
        $this->tableParser = new TableParser();
        $this->tableFixer = new TableFixer();
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
            $this->fix($file);
        }
    }

    /**
     * Fixes the formatting of the file.
     *
     * @param  string                  $file_path Path to the test file.
     * @throws InvalidKeywordException From StepParser
     * @throws FileNotFound            From FileHelper
     * @throws FileWriteException      From FileHelper
     */
    private function fix(string $file_path): void
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
     * @param  Generator               $fileReader File streamer
     * @throws InvalidKeywordException From StepParser
     * @return string
     */
    private function fixStep(Generator $fileReader): string
    {
        $stepDto = $this->stepParser->run($fileReader->current());
        if ($stepDto->getKeyword() == 'Table') {
            return $this->tableFixer->run($this->tableParser->run($fileReader));
        }

        $fileReader->next();

        return FixerFactory::getStepFixer($stepDto)->run();
    }
}
