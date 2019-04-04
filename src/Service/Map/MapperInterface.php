<?php

namespace App\Service\Map;

interface MapperInterface
{
	public function mapToResponse(array $result);

	public function mapToResponseCollection(array $result);
}