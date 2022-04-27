<?php

use PHPUnit\Framework\TestCase;

include_once "utility/Criterion.php";

class CriterionTest extends TestCase
{
    /** @dataProvider validateAgeAndCityDataProvider
     * @param $request
     * @param $expected
     * @param null $cityTier
     */
    public function testValidateAgeAndCity($request, $expected, $cityTier = null)
    {
        $criterionUtil = new Criterion($request);
        $actual = $criterionUtil->validateAgeAndCity();
        $this->assertEquals($expected, $actual);
        if (!is_null($cityTier)) {
            $this->assertIsInt($criterionUtil->getCityTier());
            $this->assertEquals($cityTier, $criterionUtil->getCityTier());
            $this->assertContains($criterionUtil->getCityTier(), [1, 2]);
        }
    }

    public function validateAgeAndCityDataProvider(): array
    {
        $data = [];
        foreach (Criterion::CITIES_TO_TIER as $city => $tier) {
            $data [] = [
                'request' => [
                    'dob' => "1996/03/12",
                    'city' => $city,
                    "score" => 900
                ],
                'expected' => ['error' => ""],
                'cityTire' => $tier
            ];
        }
        $data [] = [
            'request' => [
                'dob' => "1996/03/12",
                'city' => "Udaipur",
                "score" => 900
            ],
            'expected' => ['error' => "Invalid City"]
        ];
        $data [] = [
            'request' => [
                'dob' => "1996/03/12",
                'city' => "",
                "score" => 900
            ],
            'expected' => ['error' => "Invalid City"]
        ];
        $data [] = [
            'request' => [
                'dob' => "1960/03/12",
                'city' => "",
                "score" => 900
            ],
            'expected' => ['error' => "Age greater than 60 years"]
        ];
        $data [] = [
            'request' => [
                'dob' => (new DateTime('yesterday'))->format('Y/m/d'),
                'city' => "Mumbai",
                "score" => 900
            ],
            'expected' => ['error' => "Age less than 18 years"]
        ];
        $data [] = [
            'request' => [
                'dob' => "1996/03/12",
                'city' => "Mumbai",
                "score" => 299
            ],
            'expected' => ['error' => "Score is less for the tier1 city"],
            'cityTier' => 1
        ];
        $data [] = [
            'request' => [
                'dob' => "1996/03/12",
                'city' => "Mysore",
                "score" => 500
            ],
            'expected' => ['error' => "Score is less for the tier2 city"],
            'cityTier' => 2
        ];
        $data [] = [
            'request' => [
                'dob' => "1996/03/12",
                'city' => "Mysore",
                "score" => 300
            ],
            'expected' => ['error' => "Score is less for the tier2 city"],
            'cityTier' => 2
        ];
//        $data [] = [
//            'request' => [
//                'dob' => "12",
//                'city' => "Mysore",
//                "score" => 300
//            ],
//            'expected' => ['error' => "Score is less for the tier2 city"],
//            'cityTier' => 2
//        ];

        return $data;
    }
}