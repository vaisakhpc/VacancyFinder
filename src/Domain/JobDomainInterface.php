<?php

namespace App\Domain;

interface JobDomainInterface
{
	public function fetchById(int $id);

	public function fetchByLocation(string $location, string $sortItem);

	public function fetchMostInterestingPosition(string $skillSet, string $seniority);
}