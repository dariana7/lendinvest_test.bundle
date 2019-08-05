<?php

namespace Lendinvest;


use PHPUnit\Framework\TestCase;
use DateTime;

class InvestmentCheckerTest extends TestCase
{

    public function testCheckInvestmentOpportunity()
    {
        $loan = new Loan(new DateTime('01-10-2015'), new DateTime('15-11-2015'));
        $tranche = new Tranche(1000.0, 0.0, 3.0, $loan);
        $investor = new Investor('#1', 1000.0);

        $investmentChecker = new InvestmentChecker();

        $result = $investmentChecker->checkInvestmentOpportunity($tranche, $investor, new DateTime('03-10-2015'), 500.0);

        $this->assertSame(true, $result);
    }

    public function testIncomingSumHigherWallet()
    {
        $loan = $this->createMock(Loan::class);
        $tranche = new Tranche(1000.0, 0.0, 3.0, $loan);
        $incoming_sum = 600.0;
        $investor = new Investor('#1', 500.0);

        $investmentChecker = new InvestmentChecker();

        $investmentChecker->checkInvestmentOpportunity($tranche, $investor, new DateTime('03-10-2015'), $incoming_sum);

        $this->expectOutputString("Investor #1 - incoming sum can`t be higher than you have in your virtual wallet. You are trying to invest 600 pounds. \n");
    }

    public function testMaxAmountIsReached()
    {
        $loan = $this->createMock(Loan::class);
        $tranche = new Tranche(1000.0, 1000.0, 3.0, $loan);
        $incoming_sum = 1.0;
        $investor = new Investor('#1', 500.0);

        $investmentChecker = new InvestmentChecker();

        $investmentChecker->checkInvestmentOpportunity($tranche, $investor, new DateTime('03-10-2015'), $incoming_sum);

        $this->expectOutputString("Investor #1 - the maximum available amount for this tranche is reached. \n");
    }

    public function testLoanIsClosed()
    {
        $loan = new Loan(new DateTime('01-10-2015'), new DateTime('15-11-2015'));

        $tranche = new Tranche(1000.0, 100.0, 3.0, $loan);
        $investor = new Investor('#1', 500.0);
        $investmentChecker = new InvestmentChecker();
        $investmentChecker->checkInvestmentOpportunity($tranche, $investor, new DateTime('16-11-2015'), 300.0);

        $this->expectOutputString("You can`t make investment in closed loan tranche \n");
    }
}
