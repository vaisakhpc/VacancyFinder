<?php

namespace App\Model;

/**
 * Class Attribute
 * @package App\Model
 */
class Salary implements SalaryInterface
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @param string $amount
     * @param string $currency
     */
    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
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
