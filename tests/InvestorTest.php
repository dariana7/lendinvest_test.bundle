<?php

namespace Lendinvest;


use PHPUnit\Framework\TestCase;

class InvestorTest extends TestCase
{

    public function testSetWallet()
    {
        $investor = new Investor('#1', 1000.0);

        $this->assertSame(1000.0, $investor->getWallet());
    }

    public function testGetName()
    {
        $investor = new Investor('#1', 1000.0);

        $this->assertSame('#1', $investor->getName());
    }

    public function testGetWallet()
    {
        $investor = new Investor('#1', 1000.0);

        $this->assertSame(1000.0, $investor->getWallet());
    }
}
