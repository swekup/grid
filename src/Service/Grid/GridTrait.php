<?php

namespace App\Service\Grid;

use App\Controller\Grid\Factory\ConfigFactory;
use App\Service\Grid\DataProvider\OrmDataProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

trait GridTrait
{
    private GridService            $gridService;
    private EntityManagerInterface $em;
    private Environment            $twig;

    /**
     * @param GridService            $gridService
     * @param EntityManagerInterface $em
     * @param Environment            $twig
     */
    public function __construct(GridService $gridService, EntityManagerInterface $em, Environment $twig)
    {
        $this->em   = $em;
        $this->twig = $twig;

        $this->initGrid($gridService);
    }

    /**
     * @param GridService $gridService
     * @return void
     */
    private function initGrid(GridService $gridService): void
    {
        $this->gridService = $gridService;

        $this->gridService->setConfig(ConfigFactory::create($this->getConfig()));
        $this->gridService->dtoClass     = $this->getDtoClass();
        $this->gridService->dataProvider = new OrmDataProvider($this->getQueryBuilder());
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route(self::ROUTE_INDEX, name: 'grid_cufpa_taxe')]
    public function index(): Response
    {
        return (new Response)->setContent($this->twig->render('cufpa_taxe.html.twig', [
            'config'    => $this->gridService->getConfigSerialize(),
            'routeAjax' => self::ROUTE_AJAX,
        ]));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route(self::ROUTE_AJAX)]
    public function ajax(Request $request): JsonResponse
    {
        $this->gridService->handleRequest($request);

        $this->gridService->execute();

        return new JsonResponse([
                                    'values'     => $this->gridService->getData(),
                                    'totalPages' => $this->gridService->totalPages(),
                                    'count'      => $this->gridService->count(),
                                    'pageToShow' => $this->gridService->currentPage,
                                ]);
    }
}