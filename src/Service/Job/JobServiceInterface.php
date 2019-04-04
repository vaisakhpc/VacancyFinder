<?php

namespace App\Service\Job;

interface JobServiceInterface
{
	public function fetchById(int $id);

	public function fetchByLocation(string $location, string $sortItem);

	public function fetchMostInterestingPosition(array $skillSet, string $seniority);
}