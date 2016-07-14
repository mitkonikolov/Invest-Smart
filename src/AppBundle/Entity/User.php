<?php
/**
 * Created by PhpStorm.
 * User: Mitko
 * Date: 7/06/16
 * Time: 8:18 PM
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Portfolio is a collection of Stocks the user is tracking.
     *
     * @ORM\ManyToMany(targetEntity="Stock", indexBy="symbol")
     * @ORM\JoinTable(name="portfolio")
     */
    private $portfolio;

    public function __construct()
    {
        $this->portfolio = new ArrayCollection();
        parent::__construct();
    }

    /**
     * Add a {@code Stock} to portfolio.
     *
     * @param Stock $stock
     *
     * @return User
     */
    public function addToPortfolio(Stock $stock)
    {
        $this->portfolio[] = $stock;

        return $this;
    }

    /**
     * Remove a {@code Stock} from portfolio.
     *
     * @param Stock $stock
     */
    public function removeFromPortfolio(Stock $stock)
    {
        $this->portfolio->removeElement($stock);
    }

    /**
     * Get portfolio.
     *
     * @return Collection
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }

    /**
     * Add portfolio.
     *
     * @param \AppBundle\Entity\Stock $portfolio
     *
     * @return User
     */
    public function addPortfolio(\AppBundle\Entity\Stock $portfolio)
    {
        $this->portfolio[] = $portfolio;

        return $this;
    }

    /**
     * Remove portfolio.
     *
     * @param \AppBundle\Entity\Stock $portfolio
     */
    public function removePortfolio(\AppBundle\Entity\Stock $portfolio)
    {
        $this->portfolio->removeElement($portfolio);
    }
}
