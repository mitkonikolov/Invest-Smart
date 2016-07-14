<?php
/**
 * Created by PhpStorm.
 * User: Mitko
 * Date: 7/06/16
 * Time: 8:33 PM
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Stock
 * Used to cache data from API and store user portfolio relations.
 *
 * @ORM\Table(name="stocks")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StockRepository")
 */
class Stock
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"attributes"})
     */
    private $id;

    /**
     * Stock symbol.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=5, unique=true)
     * @Groups({"attributes"})
     */
    private $symbol;

    /**
     * Name of the company whose the stocks are.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups({"attributes"})
     */
    private $companyName;

    /**
     * The most up-to-date price of the stock.
     *
     * @var string
     *
     * @ORM\Column(type="float")
     * @Groups({"attributes"})
     */
    private $lastTradePrice;

    /**
     * Most recent change in percent.
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"attributes"})
     */
    private $changeInPercent;

    /**
     * Stock exchange name.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=3)
     * @Groups({"attributes"})
     */
    private $stockExchange;

    /**
     * Last time data was updated from the Yahoo API.
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Groups({"attributes"})
     */
    private $lastUpdate;

    /**
     * @ORM\OneToMany(targetEntity="StockHistory", mappedBy="stock")
     */
    private $history;

    /**
     * Stock constructor.
     */
    public function __construct()
    {
        $this->lastUpdate = new \DateTime();
        $this->history = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get symbol.
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set symbol.
     *
     * @param string $symbol
     *
     * @return Stock
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get companyName.
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyName.
     *
     * @param string $companyName
     *
     * @return Stock
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }


    /**
     * Get lastTradePrice.
     *
     * @return string
     */
    public function getLastTradePrice()
    {
        return $this->lastTradePrice;
    }

    /**
     * Set lastTradePrice.
     *
     * @param string $lastTradePrice
     *
     * @return Stock
     */
    public function setLastTradePrice($lastTradePrice)
    {
        $this->lastTradePrice = $lastTradePrice ?: 'none';
        return $this;
    }

    /**
     * Get changeInPercent.
     *
     * @return string
     */
    public function getChangeInPercent()
    {
        return $this->changeInPercent;
    }

    /**
     * @param string $changeInPercent
     *
     * @return Stock
     */
    public function setChangeInPercent($changeInPercent)
    {
        $this->changeInPercent = $changeInPercent;
        return $this;
    }

    /**
     * Get stockExchange.
     *
     * @return string
     */
    public function getStockExchange()
    {
        return $this->stockExchange;
    }

    /**
     * Set stockExchange.
     *
     * @param string $stockExchange
     *
     * @return Stock
     */
    public function setStockExchange($stockExchange)
    {
        $this->stockExchange = $stockExchange;
        return $this;
    }

    public function __toString()
    {
        return $this->getSymbol();
    }

    /**
     * Get lastUpdate.
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set lastUpdate.
     *
     * @param string $lastUpdate
     *
     * @return Stock
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }


    /**
     * Add history.
     *
     * @param StockHistory $history
     *
     * @return Stock
     */
    public function addHistory(StockHistory $history)
    {
        $this->history[] = $history;

        return $this;
    }

    /**
     * Remove history.
     *
     * @param StockHistory $history
     */
    public function removeHistory(StockHistory $history)
    {
        $this->history->removeElement($history);
    }

    /**
     * Get history.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistory()
    {
        return $this->history;
    }
}
