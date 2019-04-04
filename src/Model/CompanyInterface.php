<?php

namespace App\Model;

interface CompanyInterface
{
	public function getSize() : string;

	public function getDomain() : string;

	public function getCountry() : string;

	public function getCity() : string;

	public function jsonSerialize() : array;
}