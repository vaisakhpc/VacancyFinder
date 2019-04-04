<?php

namespace Tests\App\Service;

use App\Model\CompanyInterface;
use App\Model\JobCollectionInterface;
use App\Model\JobInterface;
use App\Model\SalaryInterface;
use App\Service\Map\MapService;
use PHPUnit\Framework\TestCase;

/**
 * Class MapServiceTest
 */
class MapServiceTest extends TestCase
{
    private function getObject()
    {
        return new MapService();
    }

    private function getSampleData($arrayFlag = false)
    {
        $array = [
            "ID" => 1,
            "Job title" => "Senior PHP Developer",
            "Seniority level" => "Senior",
            "Country" => "DE",
            "City" => "Berlin",
            "Salary" => 747500,
            "Currency" => "SVU",
            "Required skills" => "PHP, Symfony, REST, Unit-testing, Behat, SOLID, Docker, AWS",
            "Company size" => "100-500",
            "Company domain" => "Automotive",
        ];

        return $arrayFlag ? [$array] : $array;
    }

    public function testMapToResponse()
    {
        $obj = $this->getObject();
        $sample = $this->getSampleData();
        $result = $obj->mapToResponse($sample);
        $this->assertInstanceOf(JobInterface::class, $result);
    }

    public function testmapToResponseCollection()
    {
        $obj = $this->getObject();
        $sample = $this->getSampleData(true);
        $result = $obj->mapToResponseCollection($sample);
        $this->assertInstanceOf(JobCollectionInterface::class, $result);
    }

    public function testmapSalaryFromResult()
    {
        $obj = $this->getObject();
        $sample = $this->getSampleData();
        $result = $obj->mapToResponse($sample);
        $this->assertInstanceOf(SalaryInterface::class, $result->getSalary());
    }

    public function testmapCompanyFromResult()
    {
        $obj = $this->getObject();
        $sample = $this->getSampleData();
        $result = $obj->mapToResponse($sample);
        $this->assertInstanceOf(CompanyInterface::class, $result->getCompany());
    }
}
