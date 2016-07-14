<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PortfolioController
 */
class PortfolioController extends Controller
{

    /**
     * Makes a call to the service stock_provider and get information about
     * the stock. Then it renders the correct template that's able to display it.
     *
     * @Route(name="portfolio_table", path="/portfolio/table",
     *     methods={"GET"}, options={"expose"=true})
     * @return Response
     */
    public function portfolioTableAction()
    {
        $portfolio = $this->getStocksPortfolio()->toArray();
        $portfolio = $this->get('app.stock_provider')->getStock(array_keys($portfolio));
        return $this->render(
            'Portfolio/table.html.twig', ['quotes' => $portfolio]
        );
    }

    /**
     * Adds new stock to user portfolio by its symbol.
     *
     * @Route(name="stock_add", path="/stock/add",
     *     methods={"POST"}, options={"expose"=true})
     *
     * @return JsonResponse
     */
    public function addStockBySymbolAction(Request $request)
    {
        $symbol = $request->request->get('symbol');
        if (!$symbol || strlen($symbol) > 5) {
           return new JsonResponse(['error' => 'Wrong quote symbol']);
        }

        // get the user's portfolio and the use the stock provider service to get
        // information about the stocks
        $portfolio = $this->getStocksPortfolio();
        $stocks = $this->get('app.stock_provider')->getStock(strtoupper($symbol));

        if (empty($stocks)) {
            return new JsonResponse(['error' => 'Stock not found.']);
        }

        $stock = array_pop($stocks);
        if ($portfolio->contains($stock)) {
            return new JsonResponse(['error' => 'Stock already added to your portfolio.']);
        }
        $portfolio->add($stock);
        $this->getDoctrine()->getManager()->flush();
        $result = $this->get('serializer')->serialize(
            ['result' => $stock], 'json', ['groups' => ['attributes']]
        );

        return new Response($result, 200, ['Content-type'=>'application/json']);
    }

    /**
     * Removes stock from user portfolio.
     *
     * @Route(name="stock_remove", path="/stock/remove",
     *     methods={"POST"}, options={"expose"=true})
     *
     * @return JsonResponse
     */
    public function removeStockByIdAction(Request $request)
    {
        $portfolio = $this->getStocksPortfolio();

        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $stock = $em->find('AppBundle:Stock', $id);
        if (!$stock) {
            return new JsonResponse(['error' => 'Stock not found.']);
        }
        if (!$portfolio->removeElement($stock)) {
            return new JsonResponse(['error' => 'Stock not found in your portfolio.']);
        }
        $em->flush();
        return new JsonResponse(['result' => ['id' => $stock->getId()]]);
    }

    /**
     * Formats the data into a JSON so that the chart representing the
     * 2-year performance of the portfolio can be generated.
     *
     * @Route(name="portfolio_graph_data", path="/portfolio/graph",
     *     methods={"GET"}, options={"expose"=true})
     *
     * @return JsonResponse
     */
    public function portfolioGraphDataAction()
    {
        $portfolio = $this->getStocksPortfolio();

        $stocksHistory = $this->get('app.stock_provider')->getStockHistory($portfolio, 'M Y');

        $chartData = [
            'labels' => array_keys($stocksHistory),
            'datasets' => [['data' => array_values($stocksHistory)]]
        ];

        return new JsonResponse(['result' => $chartData]);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    private function getStocksPortfolio()
    {
        $user = $user = $this->getUser();
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        $portfolio = $user->getPortfolio();
        return $portfolio;
    }
}
