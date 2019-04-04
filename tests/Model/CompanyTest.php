<?php

namespace Tests\App\Model;

use App\Model\Company;
use PHPUnit\Framework\TestCase;


/**
 * Class CompanyTest
 */
class CompanyTest extends TestCase
{
	private function getObject()
    {
        return new Company('10-50', 'Telecom', 'DE', 'Berlin');
    }

    public function testGetSize()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getSize(), "10-50");
    }

    public function testGetDomain()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getDomain(), "Telecom");
    }

    public function testGetCountry()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getCountry(), "DE");
    }

    public function testGetCity()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getCity(), "Berlin");
    }

    public function testJsonSerialize()
    {
    	$obj = $this->getObject();
    	$result = $obj->jsonSerialize();
    	$this->assertEquals($result['size'], "10-50");
    	$this->assertEquals($result['domain'], "Telecom");
    	$this->assertEquals($result['country'], "DE");
    	$this->assertEquals($result['city'], "Berlin");
    }
}