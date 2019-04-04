<?php

namespace App\Model;

class JobCollection implements JobCollectionInterface
{
    private $data = [];

    /**
     * retrieve the count of $data
     *
     * @return int
     */
    public function count() : int
    {
        return count($this->data);
    }

    /**
     * add item to $data
     *
     * @return array
     */
    public function add(JobInterface $job) : array
    {
        $this->data[] = $job;
        return $this->data;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->data;
    }
}