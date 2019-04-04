<?php

namespace App\Model;

interface JobCollectionInterface
{
	public function count() : int;

	public function add(JobInterface $job) : array;

	public function jsonSerialize() : array;
}