<?php

namespace App\Controller;

use App\Entity\HighScore;
use App\Repository\HighScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route('/high-score', name: 'high_score_', methods: 'GET', 'POST')]
#[Route('/high-score', name: 'high_score_')]
class HighScoreController extends AbstractController
{
    // #[Route('/high/score', name: 'high_score')]
    // public function index(): Response
    // {
    //     return $this->render('high_score/index.html.twig', [
    //         'controller_name' => 'HighScoreController',
    //     ]);
    // }

    #[Route('/create/highscore', name: 'create', methods: 'POST')]
    public function createHighScore(Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
        $winner = $request->get('winner');
        $score = $request->get('score');
        $histogramp = $request->get('histogramp');
        $histogramc = $request->get('histogramc');

        // echo "winner: \n";
        // echo $winner;
        // echo "\n";
        // echo "score: \n";
        // echo $score;
        // echo "histogramp: \n";
        // echo $histogramp;
        // echo "\n";
        // echo "histogramc: \n";
        // echo $histogramc;

        $highScore = new HighScore();
        $highScore->setWinner($winner);
        $highScore->setScore($score);
        $highScore->setDate(date("Y-m-d H:i:s"));
        $highScore->setHistogramP($histogramp);
        $highScore->setHistogramC($histogramc);

        $entityManager->persist($highScore);
        $entityManager->flush();

        // $highScoreListUrl = $this->generateUrl('high_score_find_all');
        // return new Response('The total score of the winner is saved into the' . "<a href='$highScoreListUrl'>highscore list</a>");

        return $this->redirectToRoute('high_score_find_all', [], 301);
    }


    // // Outcommented 22-02-06 kl 19:49:
    // #[Route('/find/histograms/{id}', name: 'find_histograms', methods: 'GET')]
    // public function fetchHistograms(int $id, HighScoreRepository $highScoreRepository): Response
    // {
    //     $histograms = $highScoreRepository->find($id);
    //
    //     // if (empty($highScores)) {
    //     //     return new Response(
    //     //         "No data found",
    //     //         Response::HTTP_NOT_FOUND,
    //     //         ['content-type' => 'text/plain']
    //     //     );
    //     // }
    //
    //     return $this->render('high_score/histograms.html.twig', [
    //         'controller_name' => 'HighScoreController',
    //         'route_name_of_controller' => 'high_score_find_histograms',
    //         'histograms' => $histograms,
    //     ]);
    // }
    // // End outcommented 22-02-06 kl 19:49:


    // Test 220206 kl 19:49. Seems to work 220206 kl 20:24:
    #[Route('/find/histograms/{id}', name: 'find_histograms', methods: 'GET')]
    public function fetchHistograms(HighScore $histograms, /** @scrutinizer ignore-unused */ HighScoreRepository $highScoreRepository): Response
    {
        // $histograms = $highScoreRepository->find($histograms);

        // if (empty($highScores)) {
        //     return new Response(
        //         "No data found",
        //         Response::HTTP_NOT_FOUND,
        //         ['content-type' => 'text/plain']
        //     );
        // }

        return $this->render('high_score/histograms.html.twig', [
            'controller_name' => 'HighScoreController',
            'route_name_of_controller' => 'high_score_find_histograms',
            'histograms' => $histograms,
        ]);
    }
    // End test 220206 kl 19:49:

    #[Route('/find/all', name: 'find_all', methods: 'GET')]
    public function fetchAllHighScores(HighScoreRepository $highScoreRepository): Response
    {
        $highScores = $highScoreRepository->findAll();
        // echo "highScores\n";
        // var_dump($highScores);

        // if (empty($highScores)) {
        //     return new Response(
        //         "No data found",
        //         Response::HTTP_NOT_FOUND,
        //         ['content-type' => 'text/plain']
        //     );
        // }

        // $histogramsUrl = 'localhost:8080/mvc/me/proj/public/high-score/find/histograms/';
        // $histogramsUrl = '/high-score/find/histograms/';

        // $histogramsUrl = $this->generateUrl('high_score_find_histograms', [
        //     'id' => 150,
        // ]);
        // echo "histogramsUrl\n";
        // dump($histogramsUrl);

        return $this->render('high_score/index.html.twig', [
            'controller_name' => 'HighScoreController',
            'route_name_of_controller' => 'high_score_find_all',
            'high_scores' => $highScores,
            // 'histograms_url' => $histogramsUrl,
        ]);

        // return new Response('Highscores från fetchAllHighScores');
    }
}
