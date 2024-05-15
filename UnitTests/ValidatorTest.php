<?php

use MoneyLendingChallenge\Loan;
use PHPUnit\Framework\TestCase;

include_once "utility/Validator.php";
include_once "Application/Loan.php";

class ValidatorTest extends TestCase
{
    /** @dataProvider validateDateOfBirthDataProvider
     * @param $dob
     * @param $expected
     */
    public function testValidateDateOfBirth($dob, $expected)
    {
        $actual = Validator::validateDateOfBirth($dob, []);
        $this->assertEquals($expected, $actual);
    }

    public function validateDateOfBirthDataProvider(): array
    {
        return [
            [
                'dob' => '201',
                'expected' => [
                    'error' => "Invalid date of birth format: DateTime::__construct(): Failed to parse time string (201) at position 0 (2): Unexpected character"
                ]
            ],
            [
                'dob' => '1996-03-12',
                'expected' => ['error' => ""]
            ],
            [
                'dob' => (new DateTime('tomorrow'))->format('d-m-Y'),
                'expected' => ['error' => "Date of Birth cannot be in future"]
            ]
        ];
    }

    /** @dataProvider validateLoanAmountDataProvider
     * @param $amount
     * @param $specs
     * @param $expected
     */
    public function testValidateLoanAmount($amount, $specs, $expected)
    {
        $actual = Validator::validateLoanAmount($amount, $specs);
        $this->assertEquals($expected, $actual);
    }

    public function validateLoanAmountDataProvider(): array
    {
        return [
            [
                'amount' => 50000,
                'specs' => ["min-value" => 50000, "max-value" => 500000],
                'expected' => [
                    'error' => ""
                ]
            ],
            [
                'amount' => 500000,
                'specs' => ["min-value" => 50000, "max-value" => 500000],
                'expected' => [
                    'error' => ""
                ]
            ],
            [
                'amount' => 100000,
                'specs' => ["min-value" => 50000, "max-value" => 500000],
                'expected' => [
                    'error' => ""
                ]
            ],
            [
                'amount' => 49999,
                'specs' => ["min-value" => 50000, "max-value" => 500000],
                'expected' => [
                    'error' => "Amount must be greater than or equal to 50000"
                ]
            ],
            [
                'amount' => 500001,
                'specs' => ["min-value" => 50000, "max-value" => 500000],
                'expected' => [
                    'error' => "Amount must be less than or equal to 500000"
                ]
            ],
            [
                'amount' => 499999,
                'specs' => ["min-value" => 50000, "max-value" => 500000],
                'expected' => [
                    'error' => "Amount must be a multiple of 10000"
                ]
            ],
            [
                'amount' => "H",
                'specs' => ["min-value" => 50000, "max-value" => 500000],
                'expected' => [
                    'error' => "Amount must be greater than or equal to 50000"
                ]
            ],
        ];
    }

    /** @dataProvider validateSpecDataProvider
     * @param $spec
     * @param $params
     * @param $expected
     */
    public function testValidateSpec($spec, $params, $expected)
    {
        $validator = new Validator();
        $actual = $validator->validateSpec($spec, $params);
        $this->assertEquals($expected, $actual);
    }

    public function validateSpecDataProvider(): array
    {
        $spec = Loan::$validationSpecs;
        return [
            [
                'spec' => $spec,
                'params' => [
                    'dob' => "1996/03/12",
                    'city' => "Udaipur",
                    "score" => 900,
                    "amount" => 50000,
                    "name" => "Madhav"
                ],
                'expected' => ['error' => ""]
            ],
            [
                'spec' => $spec,
                'params' => [
                    'dob' => "1996/03/12",
                    'city' => "Udaipur",
                    "score" => 901,
                    "amount" => 50000,
                    "name" => "Madhav"
                ],
                'expected' => ['error' => "score value too large, should be less than or equal to 900"]
            ],
            [
                'spec' => $spec,
                'params' => [
                    'dob' => "1996/03/12",
                    'city' => "Udaipur",
                    "score" => -1,
                    "amount" => 50000,
                    "name" => "Madhav"
                ],
                'expected' => ['error' => "score value too small, should be greater than or equal to 0"]
            ],
            [
                'spec' => $spec,
                'params' => [
                    'dob' => "1996/03-12",
                    'city' => "Udaipur",
                    "score" => 0,
                    "amount" => 50000,
                    "name" => "Madhav"
                ],
                'expected' => ['error' => "Invalid date of birth format: DateTime::__construct(): Failed to parse time string (1996/03-12) at position 4 (/): Unexpected character"]
            ],
            [
                'spec' => $spec,
                'params' => [
                    'dob' => (new DateTime('tomorrow'))->format('d-m-Y'),
                    'city' => "Udaipur",
                    "score" => 0,
                    "amount" => 50000,
                    "name" => "Madhav"
                ],
                'expected' => ['error' => "Date of Birth cannot be in future"]
            ],
            [
                'spec' => $spec,
                'params' => [
                    'dob' => "1996-12-03",
                    'city' => "Udaipur",
                    "score" => 0,
                    "amount" => 50000,
                    "name" => ""
                ],
                'expected' => ['error' => "name value failed regex match"]
            ],
            [
                'spec' => $spec,
                'params' => [
                    'dob' => "1996-12-03",
                    'city' => "",
                    "score" => 0,
                    "amount" => 50000,
                    "name" => "M"
                ],
                'expected' => ['error' => "city value too short"]
            ],
            [
                'spec' => $spec,
                'params' => [
                    'dob' => "1996-12-03",
                    'city' => "U",
                    "score" => 0,
                    "amount" => 5000,
                    "name" => "M"
                ],
                'expected' => ['error' => 'Amount must be greater than or equal to 50000']
            ],

            [
                'spec' => $spec,
                'params' => [
                    'dob' => "1996-12-03",
                    'city' => "U",
                    "score" => 0,
                    "amount" => 500001,
                    "name" => "M"
                ],
                'expected' => ['error' => 'Amount must be less than or equal to 500000']
            ]
        ];
    }
}