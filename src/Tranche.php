<?php

namespace Lendinvest;

use DateTime;

class Tranche
{

    /**
     * @var $max_amount
     */
    private $max_amount;

    /**
     * @var $invested_amount
     */
    private $invested_amount;

    /**
     * @var $percentage
     */
    private $percentage;

    /**
     * @var Loan
     */
    private $loan;

    /**
     * @var array
     */
    private $investments = [];

    /**
     * Tranche constructor.
     * @param $max_amount
     * @param $invested_amount
     * @param $percentage
     * @param Loan $loan
     */
    public function __construct(float $max_amount, float $invested_amount, float $percentage, Loan $loan)
    {
        $this->max_amount = $max_amount;
        $this->invested_amount = $invested_amount;
        $this->percentage = $percentage;
        $this->loan = $loan;

    }

    /**
     * @return float
     */
    public function getMaxAmount(): float
    {
        return $this->max_amount;
    }

    /**
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * @return Loan
     */
    public function getLoan(): Loan
    {
        return $this->loan;
    }

    /**
     * @return float
     */
    public function getInvestedAmount(): float
    {
        return $this->invested_amount;
    }

    /**
     * @param $invested_amount
     * @return bool
     */
    public function updateInvestedAmount(float $invested_amount): bool
    {
        $new_invested_amount = $this->invested_amount + $invested_amount;

        if ($new_invested_amount > $this->max_amount) {
            return false;
        }

        $this->setInvestedAmount($new_invested_amount);

        return true;

    }

    /**
     * @param mixed $invested_amount
     */
    public function setInvestedAmount($invested_amount): void
    {
        $this->invested_amount = $invested_amount;
    }


    /**
     * @param Investor $investor
     * @param DateTime $incoming_date
     * @param float $incoming_sum
     */
    public function addInvestment(Investor $investor, DateTime $incoming_date, float $incoming_sum): void
    {

        $investmentChecker = new InvestmentChecker();

        if ($investmentChecker->checkInvestmentOpportunity($this, $investor, $incoming_date, $incoming_sum)) {

            $this->investments[] = new Investment($this, $investor, $incoming_date, $incoming_sum);

            $investor->withdrawFromWallet($incoming_sum);
        }
    }

    /**
     * @return Investment[]
     */
    public function getInvestments(): array
    {
        return $this->investments;
    }

}