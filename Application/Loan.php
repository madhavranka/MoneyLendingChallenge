<?php
namespace MoneyLendingChallenge;

include "utility/Validator.php";
use Validator;

class Loan
{
    //const MANDATORY_PARAMS = ['name','dob','city','score','amount'];
    public static array $validationSpecs = [
        "amount" => ['type' => 'fn', "class" => "Validator", "name" => "validateLoanAmount" ,
            "min-value" => 50000, "max-value" => 500000],
        "score" => ['type' => 'integer', "min-val" => 0, "max-val" => 900, "name" => "score"],
        "dob" => ["type" => "fn", "class" => "Validator", "name" => "validateDateOfBirth"],
        "name" => ["type" => "string", "min-length" => 1, "regex" => "^[a-zA-Z\s]*$^" ,"name" => "name"],
        "city" => ["type" => "string", "min-length" => 1, "name" => "city"]
    ];
    private array $postParams = [];
    public function __construct()
    {
        $this->postParams = $_REQUEST;
    }

    public function main(){
        print_r($this->validateRequest());
    }

    private function validateRequest(): array
    {
        $validator = new Validator();
        return $validator->validateSpec(self::$validationSpecs,$this->postParams);
    }
}