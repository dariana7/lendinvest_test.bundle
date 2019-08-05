<?php


namespace Lendinvest;

use DateTime;

class Report
{
    public function showInterestCalculationResult(Investment $investment, DateTime $run_date, $interest): void
    {
        $current_run_date = $run_date->format('Y-m-d');
        $date = new DateTime($current_run_date);
        $date1 = $date->modify('-1 day');
        $month = $date1->format('F');

        $investor = $investment->getInvestor();

        echo "Investor " . $investor->getName() . " in ".$month." earned "
            . $interest . ". Now in his wallet: " . $investor->getWallet() . " pounds \n";
    }
}