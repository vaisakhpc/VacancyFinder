<?php

namespace App\Service\Input;

interface FileServiceInterface
{
	public function readToArray(string $path) : array;
}