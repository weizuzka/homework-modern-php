<?php

namespace ZW\HomeWork\Decorators;

use Generator;
use ZW\HomeWork\Interfaces\IReader;

class ExtractLevelDecorator implements IReader
{

    public const LEVEL_REGEX = '/test\.(\w+)/';

    /**
     * @var IReader
     */
    private IReader $iReader;

    /**
     * @param IReader $rowParser
     */
    public function __construct(IReader $rowParser)
    {
        $this->iReader = $rowParser;
    }

    /**
     * @return Generator
     */
    public function getData(): Generator
    {
        return $this->iReader->getData();
    }

    /**
     * @param Generator $rows
     * @param array|null $filters
     * @return array
     */
    public function extract(Generator $rows, array $filters = null): array
    {
        $levels = [];
        foreach ($rows as $row) {
            preg_match(ExtractLevelDecorator::LEVEL_REGEX, $row, $matches);
            $levels[] = strtolower($matches[1]);
        }

        return $levels;
    }

    /**
     * @param array $output
     * @return void
     */
    public function printOutput(array $output): void
    {
         $this->iReader->printOutput($output);
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $data = $this->getData();
        $output = $this->extract($data);
        $this->printOutput($output);
    }
}
