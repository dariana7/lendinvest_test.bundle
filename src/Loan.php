<?php

namespace Lendinvest;

use DateTime;

class Loan
{

    /**
     * @var DateTime
     */
    private $start_date;

    /**
     * @var DateTime
     */
    private $end_date;

    /**
     * @var array
     */
    private $tranches = [];

    /**
     * Loan constructor.
     * @param DateTime $start_date
     * @param DateTime $end_date
     */
    public function __construct(DateTime $start_date, DateTime $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->start_date;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->end_date;
    }

    /**
     * @param $tranche
     */
    public function setTranche(Tranche $tranche): void
    {
        $this->tranches[] = $tranche;
    }

    /**
     * @return Tranche[]
     */
    public function getTranches(): array
    {
        return $this->tranches;
    }
}
