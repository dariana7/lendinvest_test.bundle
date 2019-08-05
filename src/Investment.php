<?php

namespace Lendinvest;

use DateTime;

class Investment implements InvestmentInterface
{
    /**
     * @var Tranche
     */
    private $tranche;
    /**
     * @var Investor
     */
    private $investor;
    /**
     * @var float
     */
    private $incoming_sum;
    /**
     * @var DateTime
     */
    private $incoming_date;


    /**
     * Investment constructor.
     * @param Tranche $tranche
     * @param Investor $investor
     * @param DateTime $incoming_date
     * @param float $incoming_sum
     */
    public function __construct(Tranche $tranche, Investor $investor, DateTime $incoming_date, float $incoming_sum)
    {
        $this->tranche = $tranche;
        $this->investor = $investor;
        $this->incoming_sum = $incoming_sum;
        $this->incoming_date = $incoming_date;
    }

    /**
     * @return Investor
     */
    public function getInvestor(): Investor
    {
        return $this->investor;
    }

    /**
     * @return DateTime
     */
    public function getIncomingDate(): DateTime
    {
        return $this->incoming_date;
    }

    /**
     * @return float $incoming_sum
     */
    public function getIncomingSum(): float
    {
        return $this->incoming_sum;
    }

    /**
     * @return Tranche
     */
    public function getTranche(): Tranche
    {
        return $this->tranche;
    }

}