<?php


namespace Lendinvest;


interface InvestorInterface
{
    /**
     * @return float
     */
    public function getWallet(): float;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param float $wallet
     */
    public function setWallet(float $wallet): void;

    /**
     * @param float $amount
     */
    public function withdrawFromWallet(float $amount): void;

    /**
     * @param float $amount
     */
    public function chargeAmount(float $amount): void;

}