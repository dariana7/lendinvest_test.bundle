<?php
require_once 'vendor/autoload.php';

use Lendinvest\Loan;
use Lendinvest\Investor;
use Lendinvest\Tranche;
use Lendinvest\InterestCalculator;
use Lendinvest\Report;

$run_date = new DateTime('01-11-2015');

// Input data for Loan
$start_date = new DateTime('01-10-2015');
$end_date = new DateTime('15-11-2015');


// Input data for Tranche
$max_amount = 1000.0;
$invested_amount = 0.0;

$percentage1 = 3.0;
$percentage2 = 6.0;

$loan = new Loan($start_date, $end_date);


$trancheA = new Tranche($max_amount, $invested_amount, $percentage1, $loan);
$trancheB = new Tranche($max_amount, $invested_amount, $percentage2, $loan);

$loan->setTranche($trancheA);
$loan->setTranche($trancheB);

$investor1 = new Investor('#1', 1000.0);
$investor2 = new Investor('#2', 1000.0);
$investor3 = new Investor('#3', 1000.0);
$investor4 = new Investor('#4', 1000.0);


$investments = array();
// Input data for Investment
$date1 = new DateTime('03-10-2015');
$date2 = new DateTime('04-10-2015');
$date3 = new DateTime('10-10-2015');
$date4 = new DateTime('25-10-2015');

$incoming_sum1 = 1000.0;
$incoming_sum2 = 1.0;
$incoming_sum3 = 500.0;
$incoming_sum4 = 1100.0;

$trancheA->addInvestment($investor1, $date1, (float)$incoming_sum1);
$trancheA->addInvestment($investor2, $date2, (float)$incoming_sum2);
$trancheB->addInvestment($investor3, $date3, (float)$incoming_sum3);
$trancheB->addInvestment($investor4, $date4, (float)$incoming_sum4);


foreach ($loan->getTranches() as $tranche) {
    foreach ($tranche->getInvestments() as $investment) {
        $interestCalculator = new InterestCalculator();
        $interest = $interestCalculator->calculateInterest($investment, $run_date);

        $report = new Report();
        $report->showInterestCalculationResult($investment, $run_date, $interest);
    }
}
