<?php

namespace Tests\App\Model;

use App\Model\Job;
use App\Model\Salary;
use App\Model\Company;
use PHPUnit\Framework\TestCase;


/**
 * Class JobTest
 */
class JobTest extends TestCase
{
	private function getObject()
    {
        return new Job(
        	'1',
        	'Title',
        	'Senior',
        	'PHP',
        	new Salary(165740, "SVU"),
        	new Company('10-50', 'Telecom', 'DE', 'Berlin')
        );
    }

    public function testGetId()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getId(), "1");
    }

    public function testGetJobTitle()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getJobTitle(), "Title");
    }

    public function testGetSeniority()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getSeniority(), "Senior");
    }

    public function testGetRequiredSkills()
    {
        $obj = $this->getObject();
        $this->assertEquals($obj->getRequiredSkills(), "PHP");
    }

    public function testGetSalary()
    {
        $obj = $this->getObject();
        $this->assertInstanceOf(Salary::class, $obj->getSalary());
    }

    public function testGetCompany()
    {
        $obj = $this->getObject();
        $this->assertInstanceOf(Company::class, $obj->getCompany());
    }

    public function testJsonSerialize()
    {
    	$obj = $this->getObject();
    	$result = $obj->jsonSerialize();
    	$this->assertEquals($result['id'], "1");
    	$this->assertEquals($result['jobTitle'], "Title");
    	$this->assertEquals($result['seniority'], "Senior");
    	$this->assertEquals($result['requiredSkills'], "PHP");
        $this->assertInstanceOf(Company::class, $result['company']);
        $this->assertInstanceOf(Salary::class, $result['salary']);
    }
}