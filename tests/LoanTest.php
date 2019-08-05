<?php

namespace Lendinvest;

use DateTime;
use PHPUnit\Framework\TestCase;

class LoanTest extends TestCase
{
    public function testGettingEndDate()
    {
        $end_date = new DateTime('15-11-2015');

        $loan = new Loan(new DateTime('01-10-2015'), $end_date);

        $this->assertSame($end_date, $loan->getEndDate());
    }

    public function testGettingStartDate()
    {
        $start_date = new DateTime('01-10-2015');

        $loan = new Loan($start_date, new DateTime('15-11-2015'));

        $this->assertSame($start_date, $loan->getStartDate());
    }

    public function testSetTrance()
    {
        $loan = new Loan(new DateTime('01-10-2015'), new DateTime('15-11-2015'));

        $tranche = $this->createMock(Tranche::class);

        $loan->setTranche($tranche);

        $this->assertSame($tranche, $loan->getTranches()[0]);
    }

    public function testGetTranches()
    {
        $loan = new Loan(new DateTime('01-10-2015'), new DateTime('15-11-2015'));

        $this->assertIsArray($loan->getTranches());
    }
}