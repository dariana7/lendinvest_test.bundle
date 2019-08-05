<?php

namespace Lendinvest;


use PHPUnit\Framework\TestCase;
use DateTime;

class ReportTest extends TestCase
{

    public function testShowInterestCalculationResult()
    {
        $interest = 28.06;
        $run_date = new DateTime('01-11-2015');

        $tranche = $this->createMock(Tranche::class);

        $investor = new Investor('#1', 1000.0);

        $investment = new Investment($tranche, $investor, new DateTime('03-10-2015'), 1000.0);

        $report = new Report();

        $report->showInterestCalculationResult($investment, $run_date, $interest);

        $this->expectOutputString("Investor #1 in October earned 28.06 Now in his wallet: 1000 pounds \n");

    }
}
