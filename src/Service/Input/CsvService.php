<?php

namespace App\Service\Input;

/**
 * Class CsvService
 */
class CsvService implements FileServiceInterface
{

    /**
     * @var array
     */
    private $elementsArray;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->elementsArray = [];
    }

    /**
     * read CSV contents To An Array
     * @param string $path
     * @return array
     */
    public function readToArray(string $path) : array
    {
        $rowNo = 1;
        $result = [];

        if (($fp = fopen($path, "r")) !== false) {
            while (($row = fgetcsv($fp, 1000, ",")) !== false) {
                $num = count($row);
                for ($c = 0; $c < $num; $c++) {
                    if ($rowNo === 1) {
                        $this->elementsArray[] = $row[$c];
                    } else {
                    	$result[$rowNo - 2][$this->elementsArray[$c]] = $row[$c];
                    }
                }
                $rowNo++;
            }
            fclose($fp);
        }

        return $result;
    }
}
