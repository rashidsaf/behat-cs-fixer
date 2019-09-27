<?php declare(strict_types=1);

namespace BehatCsFixer;

use BehatCsFixer\Fixers\FixerFactory;
use BehatCsFixer\Fixers\TableFixer;
use BehatCsFixer\Parsers\StepParser;
use BehatCsFixer\Parsers\TableParser;

/**
 * The main operation class.
 */
class Application
{
    /** @var array List of the files. */
    private $files = [];

    /**
     * Application constructor.
     *
     * @param array $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    /**
     * Run the fix function for all given files.
     *
     * @throws Exceptions\InvalidKeywordException
     * @throws Exceptions\FileNotFound
     */
    public function run(): void
    {
        foreach ($this->files as $file) {
            $this->fix($file);
        }
    }

    /**
     * Fe-format file.
     *
     * @param  string                             $file_path Path to the test file.
     * @throws Exceptions\InvalidKeywordException From StepParser
     * @throws Exceptions\FileNotFound            From File
     */
    private function fix(string $file_path): void
    {
        $content = '';
        $fileReader = FileHelper::readFile($file_path);
        $stepParser = new StepParser();
        $tableParser = new TableParser();
        while ($fileReader->current()) {
            $stepDto = $stepParser->run($fileReader->current());
            if ($stepDto->getKeyword() == 'Table') {
                $content .= (new TableFixer($tableParser->run($fileReader)))->run();

                continue;
            }

            $content .= FixerFactory::getStepFixer($stepDto)->run();
            $fileReader->next();
        }

        FileHelper::save($file_path, $content);
    }
}
