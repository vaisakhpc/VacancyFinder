<?php

namespace App\Model;

/**
 * Class Attribute
 * @package App\Model
 */
class Job implements JobInterface
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $jobTitle;

	/**
	 * @var string
	 */
	private $seniority;

	/**
	 * @var string
	 */
	private $requiredSkills;

	/**
	 * @var Salary
	 */
	private $salary;

	/**
	 * @var Company
	 */
	private $company;

	public function __construct(
		int $id,
		string $jobTitle,
		string $seniority,
		string $requiredSkills,
		Salary $salary,
		Company $company
	) {
		$this->id = $id;
		$this->jobTitle = $jobTitle;
		$this->seniority = $seniority;
		$this->requiredSkills = $requiredSkills;
		$this->salary = $salary;
		$this->company = $company;
	}

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJobTitle() : string
    {
        return $this->jobTitle;
    }

    /**
     * @return string
     */
    public function getSeniority() : string
    {
        return $this->seniority;
    }

    /**
     * @return string
     */
    public function getRequiredSkills() : string
    {
        return $this->requiredSkills;
    }

    /**
     * @return Salary
     */
    public function getSalary() : Salary
    {
        return $this->salary;
    }

    /**
     * @return Company
     */
    public function getCompany() : Company
    {
        return $this->company;
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