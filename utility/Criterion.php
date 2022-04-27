<?php

class Criterion
{
    const TIER_ONE_MIN_SCORE = 300;
    const TIER_TWO_MIN_SCORE = 501;
    const SECONDS_IN_A_YEAR = 31536000;

    const CITIES_TO_TIER = [
        "Bengaluru" => 1,
        "Mumbai" => 1,
        "Delhi" => 1,
        "Chennai" => 1,
        "Hyderabad" => 1,
        "Mysore" => 2,
        "Hubli" => 2,
        "Dharwad" => 2,
        "Belgaum" => 2,
        "Shimoga" => 2
    ];
    private DateTime $dateOfBirth;
    /**
     * @var mixed
     */
    private $city;
    /**
     * @var mixed
     */
    private $creditScore;
    private int $cityTier;

    public function __construct($request)
    {
        $this->dateOfBirth = new DateTime($request['dob']);
        $this->city = $request['city'];
        $this->creditScore = $request['score'];
    }

    public function validateAgeAndCity(): array
    {
        $result = $this->isValidAge();
        if($result['error'] != "")return $result;
        $result = $this->isValidCity();
        if($result['error'] != "")return $result;
        return ['error' => ""];
    }

    /** Validates age, should be > 18 and Tenure(12 months)+age < 60
     * @return string[]
     */
    private function isValidAge(): array
    {
        $age = strtotime((new DateTime())->format('Y-m-d H:i:s')) -
            strtotime($this->dateOfBirth->format('Y-m-d H:i:s'));
        if($age < 18*self::SECONDS_IN_A_YEAR){
            return ['error' => "Age less than 18 years"];
        }else if($age > 59*self::SECONDS_IN_A_YEAR){
            return ['error' => "Age greater than 60 years"];
        }
        return ['error' => ""];
    }

    /**
     * Checks if the creditScore is valid for the given category of city or
     * city is not in the valid city's list
     * @return string[]
     */
    private function isValidCity(): array
    {
        if(isset(self::CITIES_TO_TIER[$this->city])){
            $this->cityTier = self::CITIES_TO_TIER[$this->city];
            switch ($this->cityTier) {
                case 1:
                    return $this->creditScore < self::TIER_ONE_MIN_SCORE ?
                        ["error" => "Score is less for the tier".$this->cityTier." city"] : ["error" => ""];
                case 2:
                    return $this->creditScore < self::TIER_TWO_MIN_SCORE ?
                        ["error" => "Score is less for the tier".$this->cityTier." city"] : ["error" => ""];
                default:
                    return ["error" => "No plans for tier".$this->cityTier. " city"];
            }
        }
        return ["error" => "Invalid City"];
    }

    public function getCityTier(): int
    {
        return $this->cityTier;
    }
}