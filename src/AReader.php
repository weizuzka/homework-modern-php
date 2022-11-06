<?php

declare(strict_types=1);

namespace ZW\HomeWork;

use ZW\HomeWork\Interfaces\IReader;

abstract class AReader implements IReader
{
    private const SPLIT_PATTERN = '/[.,;:\s]+/';

    public const RESOURCE_DIR_NAME = '/Resources';

    /**
     * @var array|null
     */
    private ?array $filters;

    /**
     * @param array|null $filters
     */
    public function __construct(array $filters = null)
    {
        $this->filters = $filters;
    }

    /**
     * @param array $output
     * @return void
     */
    public function printOutput(array $output): void
    {
        $arrayCountValues = array_count_values($output);

        array_walk(
            $arrayCountValues,
            function (&$value, $key) {
                $value = $key . ': ' . $value . PHP_EOL;
            });

        foreach ($arrayCountValues as $value) {
            if ($this->skipByFilter($value)) {
                continue;
            }

            echo $value;
        }
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

    /**
     * @param string $value
     * @return bool
     */
    protected function skipByFilter(string $value): bool
    {
        return isset($this->filters)
            && 0 < count(array_intersect(array_map('strtolower', preg_split(
                self::SPLIT_PATTERN,
                strtolower($value), -1,
                PREG_SPLIT_NO_EMPTY)), $this->filters));
    }
}
