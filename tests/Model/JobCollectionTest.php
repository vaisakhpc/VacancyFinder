<?php

namespace Tests\App\Model;

use App\Model\JobCollection;
use App\Model\Job;
use App\Model\Salary;
use App\Model\Company;
use PHPUnit\Framework\TestCase;


/**
 * Class JobCollectionTest
 */
class JobCollectionTest extends TestCase
{
	private function getObject()
    {
        return new JobCollection();
    }

    private function getJobObject()
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

    public function testAddMethod()
    {
    	$job = $this->getJobObject();
    	$obj = $this->getObject();
    	$result = $obj->add($job);
    	$this->assertInstanceOf(Job::class, $result[0]);
    }

    public function testcountMethod()
    {
    	$job = $this->getJobObject();
    	$obj = $this->getObject();
    	$obj->add($job);
    	$result = $obj->count();
    	$this->assertEquals($result, 1);
    }

    public function testJsonSerialize()
    {
    	$job = $this->getJobObject();
    	$obj = $this->getObject();
    	$obj->add($job);
    	$result = $obj->jsonSerialize();
    	$this->assertEquals($result, [$job]);
    }
}