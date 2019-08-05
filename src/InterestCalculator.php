<?php


namespace Lendinvest;

use DateTime;
use Lendinvest\Investment;
use phpDocumentor\Reflection\Types\Float_;

/**
 * Class InterestCalculator
 * @package Lendinvest
 */
class InterestCalculator
{
    /**
     *
     */
    const PRECISION = 2;

    /**
     * @param \Lendinvest\Investment $investment
     * @param DateTime $date
     * @return float
     * @throws \Exception
     */
    public function calculateInterest(Investment $investment, DateTime $date): float
    {
        $incoming_sum = $investment->getIncomingSum();
        $incoming_date = $investment->getIncomingDate();
        $tranche = $investment->getTranche();
        $percentage = $tranche->getPercentage();
        $investor = $investment->getInvestor();

        $days = $this->defineDaysAmount($incoming_date, $date);

        if ($days['investment_days'] !== $days['days_in_period']) {
            $percentage = ($days['investment_days'] * $percentage) / $days['days_in_period'];
        }

        $interest = round($incoming_sum * $percentage / 100, self::PRECISION);

        $investor->chargeAmount($interest);

        return $interest;
    }

    /**
     * @param DateTime $incoming_date
     * @param DateTime $date
     * @return array
     * @throws \Exception
     */
    private function defineDaysAmount(DateTime $incoming_date, DateTime $date): array
    {
        $run_date = $date->format('Y-m-d');
        $start_date = new DateTime($run_date);
        $end_date = new DateTime($run_date);

        $start_date->modify('first day of last month');
        $end_date->modify('-1 day');
        $daydiff = $end_date->diff($incoming_date);
        $days_in_month = $end_date->diff($start_date);

        return [
            'investment_days' => ++$daydiff->days,
            'days_in_period' => ++$days_in_month->days,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

    }

}