<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HistoricalRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;


class HistoricalController extends AbstractController
{
    /**
     * @Route("/graph", name="graph")
     */
    public function index(ChartBuilderInterface $builder, HistoricalRepository $historicalRepository,ChartBuilderInterface $chartBuilder): Response
    {

        $dailyResults = $historicalRepository->findAll();
        $labels = [];
        $data = [];

        foreach ($dailyResults as $dailyResult) {
            $labels[] = $dailyResult->getDate()->format('d/m/Y');
            $data[] = $dailyResult->getBalance();
        }

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([

            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Balance',
                    'borderColor' => '#1fc36c',
                    'data' => $data,

                ],
            ],
        ]);


        //$chart->setOptions([]);

        return $this->render('main/graph.html.twig', [
            'chart' => $chart,
        ]);
    }
}
