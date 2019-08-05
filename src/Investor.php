<?php

namespace Lendinvest;

class Investor implements InvestorInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var double $wallet
     */
    private $wallet;


    /**
     * Investor constructor.
     * @param string $name
     * @param float $wallet
     */
    public function __construct(string $name, float $wallet)
    {
        $this->name = $name;
        $this->wallet = $wallet;
    }

    /**
     * @return float|float
     */
    public function getWallet(): float
    {
        return $this->wallet;
    }

    /**
     * @return string|string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param float $wallet
     */
    public function setWallet(float $wallet): void
    {
        $this->wallet = $wallet;
    }

    /**
     * @param float $amount
     */
    public function withdrawFromWallet(float $amount): void
    {
        $current_wallet = $this->getWallet();
        $this->setWallet($current_wallet - $amount);
    }

    /**
     * @param float $amount
     */

    public function chargeAmount(float $amount): void
    {
        $current_wallet = $this->getWallet();
        $this->setWallet($current_wallet + $amount);
    }

}
