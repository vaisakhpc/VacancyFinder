<?php

namespace Tests\App\Model;

use App\Model\Error;
use PHPUnit\Framework\TestCase;


/**
 * Class ErrorTest
 */
class ErrorTest extends TestCase
{
	private function getObject()
    {
        return new Error('500', 'Invalid Input!');
    }

    public function testGetCode()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getCode(), "500");
    }

    public function testGetMessage()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getMessage(), "Invalid Input!");
    }

    public function testJsonSerialize()
    {
    	$obj = $this->getObject();
    	$result = $obj->jsonSerialize();
    	$this->assertEquals($result['code'], "500");
    	$this->assertEquals($result['message'], "Invalid Input!");
    }
}