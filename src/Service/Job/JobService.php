<?php

namespace App\Service\Job;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use App\Service\Input\FileServiceInterface;
use App\Service\Map\MapperInterface;

/**
 * Class JobService
 */
class JobService implements JobServiceInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var FileServiceInterface
     */
    private $fileService;

    /**
     * @var MapperInterface
     */
    private $mapperService;

    /**
     * Constructor
     */
    public function __construct(FileServiceInterface $fileService, MapperInterface $mapperService)
    {
        $this->path = getenv('CSV_PATH');
        $this->fileService = $fileService;
        $this->mapperService = $mapperService;
    }

    /**
     * fetch By Id
     * @param int $id
     * @return mixed
     */
    public function fetchById(int $id)
    {
        $content = $this->fileService->readToArray($this->path);
        $jobKey = array_search($id, array_column($content, 'ID'));

        if ($jobKey === false) {
            throw new NotFoundHttpException("Given ID not found");
        }

        $result = $content[$jobKey];

        return !empty($result) ? $this->mapperService->mapToResponse($result) : [];
    }

    /**
     * fetch By Location
     * @param string $location
     * @param string $sortItem
     * @return mixed
     */
    public function fetchByLocation(string $location, string $sortItem)
    {
        $countryResults = [];
        $content = $this->fileService->readToArray($this->path);

        $indices = $this->fetchIndicesFromContent($content);
        if (!in_array($sortItem, $indices)) {
            throw new UnprocessableEntityHttpException("This field `" . $sortItem . "` is not available to sort");
        }

        $countryResult = $this->fetchAndSortArrayElements(
            $content,
            'Country',
            $location,
            $sortItem
        );

        if (empty($countryResult)) {
            $countryResult = $this->fetchAndSortArrayElements(
                $content,
                'City',
                $location,
                $sortItem
            );
        }

        return !empty($countryResult) ? $this->mapperService->mapToResponseCollection($countryResult) : [];
    }

    /**
     * fetch Most Interesting Position
     * @param array $skillSet
     * @param string $seniority
     * @return mixed
     */
    public function fetchMostInterestingPosition(array $skillSet, string $seniority)
    {
        $content = $this->fileService->readToArray($this->path);
        $count = count($skillSet);
        $max = 0;
        $mostInteresting = 0;

        foreach ($content as $key => $value) {
            $skills = explode(", ", strtolower($value['Required skills']));
            $match = array_intersect($skillSet, $skills);
            $currentCount = count($match);
            if ($currentCount > $max) {
                $max = $currentCount;
                $mostInteresting = $key;
            } elseif ($currentCount == $max) {
                if (strtolower($value['Seniority level']) === strtolower($seniority)) {
                    $mostInteresting = $key;
                }
            }
        }

        $position = $max > 0 ? $content[$mostInteresting] : [];

        return !empty($position) ? $this->mapperService->mapToResponse($position) : [];
    }

    /**
     * fetch And Sort Array Elements
     * @param array $content
     * @param string $index
     * @param string $location
     * @param string $sortItem
     * @return array
     */
    private function fetchAndSortArrayElements(
        array $content,
        string $index,
        string $location,
        string $sortItem
    ) : array {
        $sortArray = [];
        $fieldValues = array_column($content, $index);
        $fieldResult = array_intersect_key($content, array_flip(array_keys($fieldValues, $location, true)));

        foreach ($fieldResult as $key => $value) {
            $sortArray[$key] = $value[$sortItem];
        }

        array_multisort($sortArray, SORT_ASC, $fieldResult);
        return $fieldResult;
    }

    /**
     * fetch Indices From Content
     * @param array $content
     * @return array
     */
    private function fetchIndicesFromContent(array $content): array
    {
        return array_keys($content[0] ?? []);
    }
}
