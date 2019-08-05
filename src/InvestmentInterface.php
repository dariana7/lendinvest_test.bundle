<?php


namespace Lendinvest;

use DateTime;

interface InvestmentInterface
{
    /**
     * @return Investor
     */
    public function getInvestor(): Investor;

    /**
     * @return DateTime
     */
    public function getIncomingDate(): DateTime;

    /**
     * @return float
     */
    public function getIncomingSum(): float;

    /**
     * @return Tranche
     */
    public function getTranche(): Tranche;
}