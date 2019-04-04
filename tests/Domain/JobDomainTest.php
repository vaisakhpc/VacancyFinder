<?php

namespace Tests\App\Model;

use App\Domain\JobDomain;
use PHPUnit\Framework\TestCase;
use App\Service\Input\CsvService;
use App\Service\Job\JobService;
use App\Service\Map\MapService;
use App\Model\JobInterface;
use App\Model\JobCollectionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class JobDomainTest
 */
class JobDomainTest extends TestCase
{
	private function getObject()
    {
        return new JobDomain(
        	new JobService(
	            new CsvService(),
	            new MapService()
        	)
        );
    }

    public function testFetchById()
    {
    	$obj = $this->getObject();
        $result = $obj->fetchById(1);
        $this->assertInstanceOf(JobInterface::class, $result);
    }

    public function testNotFoundValueFromFetchById()
    {
        $obj = $this->getObject();
        $this->expectException(NotFoundHttpException::class);
        $result = $obj->fetchById(100);
    }

    public function testFetchByLocation()
    {
        $obj = $this->getObject();
        $result = $obj->fetchByLocation("IE", "Seniority level");
        $this->assertInstanceOf(JobCollectionInterface::class, $result);
    }

    public function testFetchByLocationWithCity()
    {
        $obj = $this->getObject();
        $result = $obj->fetchByLocation("Berlin", "Seniority level");
        $this->assertInstanceOf(JobCollectionInterface::class, $result);
    }

    public function testUnprocessableEntityHttpExceptionFromFetchByLocation()
    {
        $obj = $this->getObject();
        $this->expectException(UnprocessableEntityHttpException::class);
        $result = $obj->fetchByLocation("IE", "Not Existing Field");
    }

    public function testFetchMostInterestingPosition()
    {
    	$obj = $this->getObject();
    	$result = $obj->fetchMostInterestingPosition("php, symfony", "Middle");
    	$this->assertInstanceOf(JobInterface::class, $result);
    }

    public function testEmptyValueFromFetchMostInterestingPosition()
    {
    	$obj = $this->getObject();
    	$result = $obj->fetchMostInterestingPosition("empty, null", "Middle");
    	$this->assertEmpty($result);
    }
}