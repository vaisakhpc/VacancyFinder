<?php

namespace Tests\App\Service;

use App\Model\JobCollectionInterface;
use App\Model\JobInterface;
use App\Service\Input\CsvService;
use App\Service\Job\JobService;
use App\Service\Map\MapService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class JobServiceTest
 */
class JobServiceTest extends TestCase
{
    private function getObject()
    {
        putenv("CSV_PATH=/www/tests/Service/Stubs/vacancies.csv");
        return new JobService(
            new CsvService(),
            new MapService()
        );
    }

    public function testFetchById()
    {
        $service = $this->getObject();
        $result = $service->fetchById(1);
        $this->assertInstanceOf(JobInterface::class, $result);
    }

    public function testNotFoundValueFromFetchById()
    {
        $service = $this->getObject();
        $this->expectException(NotFoundHttpException::class);
        $result = $service->fetchById(100);
    }

    public function testFetchByLocation()
    {
        $service = $this->getObject();
        $result = $service->fetchByLocation("IE", "Seniority level");
        $this->assertInstanceOf(JobCollectionInterface::class, $result);
    }

    public function testFetchByLocationWithCity()
    {
        $service = $this->getObject();
        $result = $service->fetchByLocation("Berlin", "Seniority level");
        $this->assertInstanceOf(JobCollectionInterface::class, $result);
    }

    public function testUnprocessableEntityHttpExceptionFromFetchByLocation()
    {
        $service = $this->getObject();
        $this->expectException(UnprocessableEntityHttpException::class);
        $result = $service->fetchByLocation("IE", "Not Existing Field");
    }

    public function testFetchMostInterestingPosition()
    {
    	$service = $this->getObject();
    	$result = $service->fetchMostInterestingPosition(["php", "symfony"], "Middle");
    	$this->assertInstanceOf(JobInterface::class, $result);
    }

    public function testEmptyValueFromFetchMostInterestingPosition()
    {
    	$service = $this->getObject();
    	$result = $service->fetchMostInterestingPosition(["empty", "null"], "Middle");
    	$this->assertEmpty($result);
    }
}
