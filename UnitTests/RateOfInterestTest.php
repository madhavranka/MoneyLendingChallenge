<?php

use PHPUnit\Framework\TestCase;

include_once "utility/RateOfInterest.php";

class RateOfInterestTest extends TestCase
{
    /**
     * @dataProvider createRepaymentScheduleDataProvider
     */
    public function testCreateRepaymentSchedule($params, $expected)
    {
        $interestUtil = new RateOfInterest($params['amount'], $params['cityTier'], $params['score']);
        $actual = $interestUtil->createRepaymentSchedule();
        $this->assertEquals($expected, $actual);
    }

    public function createRepaymentScheduleDataProvider(): array
    {
        return [
            //changing score - should ideally change interest only
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 1,
                    'score' => 900
                ],
                'expected' => [
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 41667,
                        "Interest" => 4166,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 1,
                    'score' => 300
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 583,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 1,
                    'score' => 501
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 1,
                    'score' => 701
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 500,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 1,
                    'score' => 801
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 416,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],

            //changing city - should ideally change interest only
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 2,
                    'score' => 300
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 2,
                    'score' => 501
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 2,
                    'score' => 701
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 541,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 2,
                    'score' => 801
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 458,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],

            //invalid cityTier
            [
                'params' => [
                    'amount' => 50000,
                    'cityTier' => 3,
                    'score' => 801
                ],
                'expected' => [
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/05/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/06/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/07/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/08/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/09/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/10/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/11/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/12/2022"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/01/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/02/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/03/2023"
                    ],
                    [
                        "Principal" => 4167,
                        "Interest" => 0,
                        "EMI Date" => "01/04/2023"
                    ]
                ]
            ],


        ];
    }

    /**
     * @dataProvider calculateInterestRateDataProvider
     * @param $params
     * @param $expected
     */
    public function testCalculateInterestRate($params, $expected)
    {
        $interestUtil = new RateOfInterest($params['amount'], $params['cityTier'], $params['score']);
        $this->assertEquals($expected, $interestUtil->getRateOfInterest());
        $this->assertIsInt($interestUtil->getRateOfInterest());
    }

    public function calculateInterestRateDataProvider(): array
    {
        return [
            //tier1 city
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 1,
                    'score' => 900
                ], 'expected' => 10
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 1,
                    'score' => 800
                ], 'expected' => 12
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 1,
                    'score' => 700
                ], 'expected' => 12
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 1,
                    'score' => 500
                ], 'expected' => 14
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 1,
                    'score' => 300
                ], 'expected' => 14
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 1,
                    'score' => 299
                ], 'expected' => 100
            ],

            //tier2 city
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 2,
                    'score' => 900
                ], 'expected' => 11
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 2,
                    'score' => 800
                ], 'expected' => 13
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 2,
                    'score' => 700
                ], 'expected' => 13
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 2,
                    'score' => 500
                ], 'expected' => 100
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 2,
                    'score' => 300
                ], 'expected' => 100
            ],
            [
                'params' => [
                    'amount' => 500000,
                    'cityTier' => 2,
                    'score' => 299
                ], 'expected' => 100
            ]

        ];
    }
}