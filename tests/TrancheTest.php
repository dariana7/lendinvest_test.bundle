<?php


namespace Lendinvest;

use DateTime;
use PHPUnit\Framework\TestCase;

class TrancheTest extends TestCase
{
    public function testGettingMaxAmount()
    {
        $loan = $this->createMock(Loan::class);

        $tranche = new Tranche(1000.0, 500, 3, $loan);

        $this->assertSame(1000.0, $tranche->getMaxAmount());
    }

    public function testGettingPercentage()
    {
        $loan = $this->createMock(Loan::class);

        $tranche = new Tranche(1000.0, 500.0, 3.0, $loan);

        $this->assertSame(3.0, $tranche->getPercentage());
    }

    public function testGettingLoan()
    {
        $loan = $this->createMock(Loan::class);

        $tranche = new Tranche(1000.0, 500.0, 3.0, $loan);

        $this->assertInstanceOf(Loan::class, $tranche->getLoan());
    }

    public function testGettingInvestedAmount()
    {
        $loan = $this->createMock(Loan::class);

        $tranche = new Tranche(1000.0, 500.0, 3.0, $loan);

        $this->assertSame(500.0, $tranche->getInvestedAmount());
    }

    public function testUpdateInvestedAmount()
    {
        $loan = $this->createMock(Loan::class);

        $tranche = new Tranche(1000.0, 500.0, 3.0, $loan);

        $tranche->updateInvestedAmount(300.0);

        $this->assertSame(800.0, $tranche->getInvestedAmount());

    }

    public function testSettingInvestedAmount()
    {
        $loan = $this->createMock(Loan::class);

        $tranche = new Tranche(1000.0, 500.0, 3.0, $loan);

        $tranche->setInvestedAmount(300.0);

        $this->assertSame(300.0, $tranche->getInvestedAmount());
    }

    public function testAddInvestment()
    {
        $loan = new Loan(new DateTime('01-10-2015'), new DateTime('15-11-2015'));

        $investor = new Investor('#1', 1000);

        $tranche = new Tranche(1000.0, 500.0, 3.0, $loan);

        $tranche->addInvestment($investor, new DateTime('04-10-2015'), 300.0);

        $this->assertCount(1, $tranche->getInvestments());

    }

    public function testGetInvestments()
    {
        $loan = $this->createMock(Loan::class);

        $tranche = new Tranche(1000.0, 500.0, 3.0, $loan);

        $this->assertIsArray($tranche->getInvestments());
    }


}