<?php
/**
 * Created by PhpStorm.
 * User: Mitko
 * Date: 7/06/16
 * Time: 8:50 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StockHistory
 *
 * @ORM\Table(name="stocks_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StockHistoryRepository")
 */
class StockHistory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="closePrice", type="float")
     */
    private $closePrice;

    /**
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="history")
     */
    private $stock;


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
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return StockHistory
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get closePrice
     *
     * @return float
     */
    public function getClosePrice()
    {
        return $this->closePrice;
    }

    /**
     * Set closePrice.
     *
     * @param float $closePrice
     *
     * @return StockHistory
     */
    public function setClosePrice($closePrice)
    {
        $this->closePrice = $closePrice;

        return $this;
    }

    /**
     * Get stock.
     *
     * @return Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set stock.
     *
     * @param Stock $stock
     *
     * @return StockHistory
     */
    public function setStock(Stock $stock = null)
    {
        $this->stock = $stock;

        return $this;
    }
}
