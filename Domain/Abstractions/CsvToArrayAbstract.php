<?php

namespace Domain\Abstractions;

use Illuminate\Support\Collection;
use LimitIterator;
use SplFileObject;

abstract class CsvToArrayAbstract
{
    public $csvData;

    /**
     * Read CSV File
     *
     * @param string $csvFile
     * @return self
     */
    public function readCSV(string $csvFile): self
    {
        $data = [];
        $csv  = new SplFileObject($csvFile, 'r');
        $csv->setFlags(SplFileObject::READ_CSV);
        foreach (new LimitIterator($csv, 1) as $line) {
            $data[] = $line;
        }
        $this->csvData = collect($data);
        return $this;
    }

    /**
     * @return Collection
     */
    public function execute(): Collection
    {
        if ($this->csvData->isNotEmpty()) {
            return $this->csvData->map(static function ($item, $key) {
                return [
                    'ipAddress'       => $item[0],
                    'responseType'    => $item[1],
                    'responseTime'    => $item[2],
                    'countryOfOrigin' => $item[3],
                    'path'            => $item[4],
                ];
            });
        }
        return collect();
    }
}
