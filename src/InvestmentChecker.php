<?php


namespace Lendinvest;

use DateTime;

class InvestmentChecker
{

    /**
     * @param Tranche $tranche
     * @param Investor $investor
     * @param DateTime $incoming_date
     * @param float $incoming_sum
     * @return bool
     */
    public function checkInvestmentOpportunity(Tranche $tranche, Investor $investor, \DateTime $incoming_date, float $incoming_sum): bool
    {
        $name = $investor->getName();
        $wallet = $investor->getWallet();
        $updated_invested_amount = $tranche->updateInvestedAmount($incoming_sum);

        try {
            return $this->checkIncomingSum($name, $wallet, $updated_invested_amount, $incoming_sum) && $this->checkIncomingDate($incoming_date, $tranche);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * @param string $name
     * @param float $wallet
     * @param bool $updated_invested_amount
     * @param $incoming_sum
     * @return bool
     * @throws \Exception
     */
    private function checkIncomingSum(string $name, float $wallet, bool $updated_invested_amount, $incoming_sum): bool
    {
        if ($wallet < $incoming_sum) {
            throw new \Exception("Investor " . $name . " - incoming sum can`t be higher than you have in your virtual wallet. You are trying to invest " . $incoming_sum . " pounds. \n");
        } elseif (!$updated_invested_amount) {
            throw new \Exception("Investor " . $name . " - the maximum available amount for this tranche is reached. \n");
        }

        return true;
    }

    /**
     * @param DateTime $incoming_date
     * @param Tranche $tranche
     * @return bool
     * @throws \Exception
     */
    private function checkIncomingDate(DateTime $incoming_date, Tranche $tranche): bool
    {
        $loan = $tranche->getLoan();
        $loan_start_date = $loan->getStartDate();
        $loan_end_date = $loan->getEndDate();

        if ($incoming_date < $loan_start_date || $incoming_date > $loan_end_date) {
            throw new \Exception("You can`t make investment in closed loan tranche \n");
        }

        return true;
    }

}