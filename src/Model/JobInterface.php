<?php

namespace App\Model;

interface JobInterface
{
	public function getId();

	public function getJobTitle();

	public function getSeniority();

	public function getCompany();

	public function getSalary();

	public function getRequiredSkills();

	public function jsonSerialize() : array;
}
