<?php

namespace App\Model;

interface SalaryInterface
{
	public function getAmount() : float;

	public function getCurrency() : string;

	public function jsonSerialize() : array;
}