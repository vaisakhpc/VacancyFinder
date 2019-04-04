<?php

namespace App\Controller;

use App\Domain\JobDomainInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JobController
{
    /**
     * @var JobDomainInterface
     */
    private $jobDomain;

    /**
     * SumController constructor.
     * @param Job $jobDomain
     */
    public function __construct(JobDomainInterface $jobDomain)
    {
        $this->jobDomain = $jobDomain;
    }

    /**
     * Fetch By Id
     * @param int $id
     * @return JsonResponse
     */
    public function fetchById(int $id) : JsonResponse
    {
        $result = $this->jobDomain->fetchById($id);
        return new JsonResponse($this->serializeObject($result));
    }

    /**
     * Fetch By Location
     * @param string $location
     * @param string $sortItem
     * @return JsonResponse
     */
    public function fetchByLocation(string $location, string $sortItem) : JsonResponse
    {
        $result = $this->jobDomain->fetchByLocation($location, $sortItem);
        return new JsonResponse($this->serializeObject($result));
    }

    /**
     * Fetch Most Interesting Position
     * @param string $skillSet
     * @return JsonResponse
     */
    public function fetchMostInterestingPosition(string $skillSet, string $seniority) : JsonResponse
    {
        $result = $this->jobDomain->fetchMostInterestingPosition($skillSet, $seniority);
        return new JsonResponse($this->serializeObject($result));
    }

    private function serializeObject($obj) : array
    {
        $arr = [];
        $_arr = is_object($obj) ? $obj->jsonSerialize() : $obj;
        foreach ($_arr as $key => $val) {
            if (is_array($val) || is_object($val)) {
                $val = $this->serializeObject($val);
            }
            $arr[$key] = $val;
        }
        return $arr;
    }
}
