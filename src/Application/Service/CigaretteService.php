<?php
namespace Application\Service;

class CigaretteService implements OrderInterface
{
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $totalPrice;

    /**
     * @var float
     */
    protected $exchange;

    const COST = 4.99;

    public function __construct($amount, $price)
    {
        $this->amount = $amount;
        $this->price = $price;
    }

    public function buyCigarettes()
    {
        $this->calculateTotalPrice();
        $this->calculateExchange();
        $result = $this->processOrder();
        return $result;

    }

    public function calculateTotalPrice()
    {
        $total = $this->totalPrice = $this->getAmount() * self::COST;
        if ($total > $this->getPrice()) {
            $additionalCharge = round($total - $this->getPrice(), 2);
            $error = "Required amount for {$this->getAmount()} pack(s) is $total. Please, charge additionally ${additionalCharge}€.";
            throw new \Exception($error);
        }
    }

    public function calculateExchange()
    {
        $this->exchange = round($this->price - $this->totalPrice, 2);
    }

    public function processOrder()
    {
        $packageCost = self::COST;
        $result = "You bought {$this->getAmount()} packs of cigarettes for {$this->getTotalPrice()}€, each for ${packageCost}€";
        if ($this->getExchange() > 0) {
            $result .= "\n\nYour exchange:\n\n";
            $result .= "+-------+-------+\n";
            $result .= "| Euro  | Coins |\n";
            $result .= "+-------+-------+\n";
            $result .= sprintf(" %s\t  %s\n", (int) $this->getExchange(), round(fmod($this->getExchange(), 1), 2));
            $result .= "+-------+-------+";

        }
        return $result;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @return float
     */
    public function getExchange()
    {
        return $this->exchange;
    }
}
