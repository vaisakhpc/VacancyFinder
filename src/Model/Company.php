<?php

namespace App\Model;

/**
 * Class Attribute
 * @package App\Model
 */
class Company implements CompanyInterface
{
    /**
     * @var string
     */
    private $size;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $city;

    public function __construct(
        string $size,
        string $domain,
        string $country,
        string $city
    ) {
        $this->size = $size;
        $this->domain = $domain;
        $this->country = $country;
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getSize() : string
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getDomain() : string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCity() : string
    {
        return $this->city;
    }

    /**
     *
     * @return array
     */
    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
