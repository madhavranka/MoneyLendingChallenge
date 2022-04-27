<?php

class RateOfInterest
{
    /**
     * Tenure in months
     */
    const TENURE = 12;
    private int $amount;
    private int $rateOfInterest;

    public function __construct($amount, $cityTier, $score){
        $this->amount = $amount;
        $this->calculateInterestRate($cityTier, $score);
    }

    /** Calculates interest rate on the basis of city and creditScore
     * @param $cityTier
     * @param $creditScore
     */
    private function calculateInterestRate($cityTier, $creditScore){
        switch ($cityTier) {
            case 1:
                $this->rateOfInterest = $this->calculateInterestRateForTierOneCity($creditScore);
                break;
            case 2:
                $this->rateOfInterest = $this->calculateInterestRateForTierTwoCity($creditScore);
                break;
            default:
                $this->rateOfInterest = 100;
        }
    }

    private function calculateInterestRateForTierOneCity($creditScore): int
    {
        if($creditScore >= 300) {
            if($creditScore < 501){
                return 14;
            }
            else if ($creditScore < 801) {
                return 12;
            } else {
                return 10;
            }
        }
        return 100;
    }

    private function calculateInterestRateForTierTwoCity($creditScore): int
    {
        if ($creditScore > 500) {
            if ($creditScore < 801) {
                return 13;
            } else {
                return 11;
            }
        }
        return 100;
    }

    /** Creates Repayment Schedule for the tenure
     * @return array
     */
    public function createRepaymentSchedule(): array
    {
        $schedule = [];
        $date = new DateTime('first day of this month');
        $principal = $this->calculatePrincipal();
        $interestAmount = $this->calculateInterestAmount();
        for($month = 0; $month < self::TENURE; $month++){
            $schedule []= [
                'Principal' => $principal,
                'Interest' => $interestAmount,
                'EMI Date' => ($date->modify('+1 month'))->format('d/m/Y')
            ];
        }
        return $schedule;
    }

    /** Returns part of principal amount to be paid every month
     * @return int
     */
    private function calculatePrincipal(): int
    {
        return ceil($this->amount/self::TENURE);
    }

    /** Returns interest amount to be paid every month
     * @return float|int
     */
    private function calculateInterestAmount(){
        if($this->rateOfInterest !== 100) {
            return intval(($this->rateOfInterest * $this->amount) / (self::TENURE*100));
        }return 0;
    }

    public function getRateOfInterest(): int
    {
        return $this->rateOfInterest;
    }
}