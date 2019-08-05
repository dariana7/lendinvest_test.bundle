<?php

namespace Lendinvest;

use PHPUnit\Framework\TestCase;
use DateTime;

class InvestmentTest extends TestCase
{

    public function testGetInvestor()
    {
        $tranche = $this->createMock(Tranche::class);

        $investor = $this->createMock(Investor::class);

        $investment = new Investment($tranche, $investor, new DateTime('21-10-2015'), 300.0);

        $this->assertSame($investor, $investment->getInvestor());
    }

    public function testGetTranche()
    {
        $tranche = $this->createMock(Tranche::class);

        $investor = $this->createMock(Investor::class);

        $investment = new Investment($tranche, $investor, new DateTime('21-10-2015'), 300.0);

        $this->assertSame($tranche, $investment->getTranche());
    }

    public function testGetIncomingDate()
    {
        $tranche = $this->createMock(Tranche::class);

        $investor = $this->createMock(Investor::class);

        $incoming_date = new DateTime('21-10-2015');

        $investment = new Investment($tranche, $investor, $incoming_date, 300.0);

        $this->assertSame($incoming_date, $investment->getIncomingDate());
    }

    public function testGetIncomingSum()
    {
        $tranche = $this->createMock(Tranche::class);

        $investor = $this->createMock(Investor::class);

        $incoming_sum = 300.0;

        $investment = new Investment($tranche, $investor, new DateTime('21-10-2015'), $incoming_sum);

        $this->assertSame($incoming_sum, $investment->getIncomingSum());
    }
}
