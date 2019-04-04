<?php

namespace App\Service\Map;

use App\Model\Company;
use App\Model\Job;
use App\Model\JobCollection;
use App\Model\Salary;

/**
 * Class MapService
 */
class MapService implements MapperInterface
{
    /**
     * map To Response
     * @param array $result
     * @return Job
     */
    public function mapToResponse(array $result) : Job
    {
        return $this->mapJobFromResult($result);
    }

    /**
     * map To Response Collection
     * @param array $result
     * @return JobCollection
     */
    public function mapToResponseCollection(array $result) : JobCollection
    {
        $collection = new JobCollection();
        foreach ($result as $entry) {
            $collection->add($this->mapToResponse($entry));
        }
        return $collection;
    }

    /**
     * map Job From Result
     * @param type $result
     * @return Job
     */
    private function mapJobFromResult($result) : Job
    {
        return new Job(
            $result['ID'],
            $result['Job title'],
            $result['Seniority level'],
            $result['Required skills'],
            $this->mapSalaryFromResult($result),
            $this->mapCompanyFromResult($result)
        );
    }

    /**
     * map Salary From Result
     * @param array $result
     * @return Salary
     */
    private function mapSalaryFromResult(array $result) : Salary
    {
        return new Salary(
            $result['Salary'],
            $result['Currency']
        );
    }

    /**
     * map Company From Result
     * @param array $result
     * @return Company
     */
    private function mapCompanyFromResult(array $result) : Company
    {
        return new Company(
            $result['Company size'],
            $result['Company domain'],
            $result['Country'],
            $result['City']
        );
    }
}
