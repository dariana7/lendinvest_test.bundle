<?php

namespace Lendinvest;


use DateTime;
use PHPUnit\Framework\TestCase;

class InterestCalculatorTest extends TestCase
{

    public function testCalculateInterest()
    {
        $loan = $this->createMock(Loan::class);
        $tranche = new Tranche(1000.0, 0.0, 3.0, $loan);
        $investor = new Investor('#1', 1000.0);

        $investment = new Investment($tranche, $investor, new DateTime('03-10-2015'), 1000.0);

        $interestCalculator = new InterestCalculator();
        $result = $interestCalculator->calculateInterest($investment, new DateTime('01-11-2015'));

        $this->assertSame(28.06, $result);
    }
}
