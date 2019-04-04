<?php

namespace Tests\App\Service;

use App\Service\Input\CsvService;
use PHPUnit\Framework\TestCase;

/**
 * Class CsvServiceTest
 */
class CsvServiceTest extends TestCase
{
    /**
     * Check read to array method
     */
    public function testReadToArray()
    {
        $service = new CsvService();
		$response = $service->readToArray(getenv("CSV_PATH"));
		$this->assertInternalType('array', $response);
    }
}
