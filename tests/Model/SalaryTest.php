<?php

namespace Tests\App\Model;

use App\Model\Salary;
use PHPUnit\Framework\TestCase;


/**
 * Class SalaryTest
 */
class SalaryTest extends TestCase
{
	private function getObject()
    {
        return new Salary(722500, 'SVU');
    }

    public function testGetAmount()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getAmount(), 722500);
    }

    public function testGetCurrency()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getCurrency(), 'SVU');
    }

    public function testJsonSerialize()
    {
    	$obj = $this->getObject();
    	$result = $obj->jsonSerialize();
    	$this->assertEquals($result['amount'], 722500);
    	$this->assertEquals($result['currency'], "SVU");
    }
}