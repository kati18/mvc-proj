<?php

namespace App\Controller;

use App\Entity\GuessRecord;
use App\Repository\GuessRecordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route('/guess-record', name: 'guess_record_', methods: 'GET', 'POST')]
#[Route('/guess-record', name: 'guess_record_')]
class GuessRecordController extends AbstractController
{
    // #[Route('/high/score', name: 'high_score')]
    // public function index(): Response
    // {
    //     return $this->render('high_score/index.html.twig', [
    //         'controller_name' => 'GuessRecordController',
    //     ]);
    // }

    #[Route('/create/record', name: 'create_record', methods: 'POST')]
    // public function createGuessRecord(): Response
    public function createGuessRecord(Request $request, EntityManagerInterface $entityManager): Response
    {
        $name = $request->get('name');
        $number = $request->get('number');
        $tries = $request->get('tries');

        // echo "name: \n";
        // echo $name;
        // echo "\n";
        // echo "number: \n";
        // echo $number;
        // echo "tries: \n";
        // echo $tries;

        $guessRecord = new GuessRecord();
        $guessRecord->setName($name);
        $guessRecord->setNumber($number);
        $guessRecord->setTries($tries);
        $guessRecord->setDate(date("Y-m-d H:i:s"));

        $entityManager->persist($guessRecord);
        $entityManager->flush();

        // return new Response('The guess record score is saved into the guess record list');
        return $this->redirectToRoute('guess_record_find_all', [], 301);
    }


    #[Route('/find/all', name: 'find_all', methods: 'GET')]
    public function fetchAllGuessRecords(GuessRecordRepository $guessRecordRepository): Response
    {
        $guessRecords = $guessRecordRepository->findAll();
        // echo "guessRecords\n";
        // var_dump($guessRecords);

        // if (empty($guessRecords)) {
        //     return new Response(
        //         "No data found",
        //         Response::HTTP_NOT_FOUND,
        //         ['content-type' => 'text/plain']
        //     );
        // }

        return $this->render('guess_record/index.html.twig', [
            'controller_name' => 'GuessRecordController',
            'route_name_of_controller' => 'guess_my_number_find_all',
            'guess_records' => $guessRecords,
        ]);

        // return new Response('GuessRecords från fetchAllGuessRecords');
    }
}
