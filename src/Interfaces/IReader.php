<?php

namespace ZW\HomeWork\Interfaces;

use Generator;

interface IReader
{
    /**
     * @return Generator
     */
    function getData(): Generator;

    /**
     * @param Generator $rows
     * @return array
     */
    function extract(Generator $rows): array;

    /**
     * @param array $output
     * @return void
     */
    function printOutput(array $output): void;

    /**
     * @return void
     */
    function run(): void;
}
