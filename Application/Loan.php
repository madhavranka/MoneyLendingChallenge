<?php

namespace MoneyLendingChallenge;

include_once "utility/Validator.php";
include_once "utility/RateOfInterest.php";
include_once "utility/Criterion.php";
include_once "utility/Response.php";

use Criterion;
use RateOfInterest;
use Response;
use Validator;

class Loan
{
    /** Request Specifications for Validation
     * @var array
     */
    public static array $validationSpecs = [
        "amount" => ['type' => 'fn', "class" => "Validator", "name" => "validateLoanAmount",
            "min-value" => 50000, "max-value" => 500000],
        "score" => ['type' => 'integer', "min-val" => 0, "max-val" => 900, "name" => "score"],
        "dob" => ["type" => "fn", "class" => "Validator", "name" => "validateDateOfBirth"],
        "name" => ["type" => "string", "min-length" => 1, "regex" => "/^[a-zA-Z\s]+$/", "name" => "name"],
        "city" => ["type" => "string", "min-length" => 1, "name" => "city"]
    ];

    private array $postParams;

    public function __construct()
    {
        $this->postParams = $_REQUEST;
    }

    public function main()
    {
        $validationResult = $this->validateRequest();
        $this->processValidationFailure($validationResult);
        $criterionUtil = new Criterion($this->postParams);
        $validationResult = $criterionUtil->validateAgeAndCity();
        $this->processValidationFailure($validationResult);
        $interestUtil = new RateOfInterest($this->postParams['amount'], $criterionUtil->getCityTier(),
            $this->postParams['score']);
        $repaymentSchedule = $interestUtil->createRepaymentSchedule();
        Response::echoResponse([
            'status' => "Approve",
            "Rate of Interest" => $interestUtil->getRateOfInterest() . "%",
            'schedule' => $repaymentSchedule
        ]);
    }

    /** Validates request params
     * @return array
     */
    private function validateRequest(): array
    {
        $validator = new Validator();
        return $validator->validateSpec(self::$validationSpecs, $this->postParams);
    }

    private function processValidationFailure(array $validationResult)
    {
        if ($validationResult['error'] != "") {
            $validationResult['status'] = "Reject";
            Response::echoResponse($validationResult);
        }
    }
}