<?php

namespace App\Domain;

use App\Service\Job\JobServiceInterface;

class JobDomain implements JobDomainInterface
{
	/**
	 * @var JobServiceInterface
	 */
	private $jobService;

	/**
	 * constructor
	 * @param JobServiceInterface $jobService
	 */
	public function __construct(JobServiceInterface $jobService)
	{
		$this->jobService = $jobService;
	}

	/**
	 * fetch By Id
	 * @param int $id
	 * @return mixed
	 */
	public function fetchById(int $id)
	{
		return $this->jobService->fetchById($id);
	}

	/**
	 * fetch By Location
	 * @param string $location
	 * @param string $sortItem
	 * @return mixed
	 */
	public function fetchByLocation(string $location, string $sortItem)
	{
		return $this->jobService->fetchByLocation($location, $sortItem);
	}

	/**
	 * fetch Most Interesting Position
	 * @param string $skillSet
	 * @param string $seniority
	 * @return type
	 */
	public function fetchMostInterestingPosition(string $skillSet, string $seniority)
	{
		$skillSet = explode(",", strtolower($skillSet));
		return $this->jobService->fetchMostInterestingPosition($skillSet, $seniority);
	}
}