<?php
declare(strict_types=1);

namespace ZW\HomeWork;

use Generator;

class FileReader extends AReader
{
    private const RESOURCE_FILE_NAME = '/example.log';

    /**
     * @return Generator
     */
    public function getData(): Generator
    {
        $f = fopen(__DIR__ . self::RESOURCE_DIR_NAME . self::RESOURCE_FILE_NAME, 'r');
        try {
            while ($line = fgets($f)) {

                yield $line;
            }
        } finally {
            fclose($f);
        }
    }

    /**
     * @param Generator $rows
     * @return array
     */
    public function extract(Generator $rows): array
    {
        return iterator_to_array($rows);
    }
}
