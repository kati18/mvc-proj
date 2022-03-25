<?php

declare(strict_types=1);

namespace App\Controller;

use App\Guess\Guess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Below row to make all routes defined in the class start with
 * path/URL '/guessmynumber' and name 'guess_my_number_':
 */
#[Route('/guessmynumber', name: 'guess_my_number_', methods: ['GET', 'POST'])]
class GuessMyNumberController extends AbstractController
{
    /**
     * @var RequestStack $requestStackGuess The requestStack service object needed for getting the session
     */
    // private $message;
    private $requestStackGuess;

    /**
     * Constructor for initiating an object of the class GuessMyNumberController.
     * The constructor is not necessary for being able to create an object of the class.
     * @param RequestStack $requestStack The requestStack service object injected into the class
     * @return void
     */
    public function __construct(RequestStack $requestStack)
    {
        // $this->message = "Unit testing the GuessMyNumberController class is working!";
        $this->requestStackGuess = $requestStack;
    }


    #[Route('/', name: 'start_guess_game')]
    /**
     * @return RedirectResponse
     */
    public function startGuessGame(): RedirectResponse
    {
        return $this->redirectToRoute('guess_my_number_index', [], 301);
    }

    #[Route('/index', name: 'index', methods: 'GET')]
    /**
     * @return Response
     */
    public function index(): Response
    {
        $title = "The game Guess my number!";

        return $this->render('guess_my_number/index.html.twig', [
            'title' => $title,
            'route_name_of_controller' => 'index',
        ]);
    }


    #[Route('/init', name: 'init', methods: 'GET')]
    /**
     * @return RedirectResponse
     */
    public function init(): RedirectResponse
    {
        $session = $this->requestStackGuess->getSession();

        $session->set('number', null);
        $session->set('tries', null);
        $session->set('doCheat', null);

        $game = new Guess();

        $session->set('number', $game->number());
        $session->set('tries', $game->tries());

        return $this->redirectToRoute('guess_my_number_play', [], 301);
    }

    #[Route('/play', name: 'play', methods: 'GET')]
    /**
     * @return Response
     */
    public function playGet(): Response
    {
        $session = $this->requestStackGuess->getSession();

        $tries = $session->get("tries", null);
        $res = $session->get("res", null);
        $guess = $session->get("guess", null);
        // echo $guess;
        $number = $session->get("number", null);
        $numRes = $session->get("numRes", null);
        $doCheat = $session->get("doCheat", null);

        $session->set("res", null);
        $session->set("guess", null);
        $session->set("numRes", null);

        $data = [ //data to send to the view-file
            "guess" => $guess ?? null,
            "res" => $res,
            "tries" => $tries,
            "number" => $number ?? null,
            // "do_guess" => $doGuess ?? null,
            "do_cheat" => $doCheat ?? null,
            "num_res" => $numRes ?? null,
        ];

        return $this->render('guess_my_number/play.html.twig', $data);
    }

    #[Route('/play/post', name: 'play_post', methods: 'POST')]
    /**
     * @return RedirectResponse
     */
    public function playPost(Request $request): RedirectResponse
    {
        $session = $this->requestStackGuess->getSession();

        $guess = $request->get('guess');
        // echo $guess;
        $doGuess = $request->get('doGuess');
        // echo $doGuess;

        // Get current settings from the session:
        $number = $session->get("number", null);
        $tries = $session->get("tries", null);
        // $res = null;

        if ($doGuess) {
            $game = new Guess($number, $tries);
            // $res = $game->makeGuess($guess);
            $res = $game->makeGuess((int)$guess);

            $session->set("tries", $game->tries());
            $session->set("res", $res);
            $session->set("guess", $guess);

            // My addition. 200507 not sure if necessary:
            // $tries = $session->get("tries");
        }
        return $this->redirectToRoute('guess_my_number_play', [], 301);
    }

    #[Route('/doCheat', name: 'do_cheat', methods: 'GET')]
    /**
     * @return RedirectResponse
     */
    public function doCheat(): RedirectResponse
    {
        $session = $this->requestStackGuess->getSession();

        $tries = $session->get("tries", null);
        // $res = $session->get("res", null);
        // $guess = $session->get("guess", null);
        // echo $guess;
        $number = $session->get("number", null);
        // $numRes = $session->get("numRes", null);

        $game = new Guess($number, $tries);
        $numRes = $game->number();

        // $session->set("res", null);
        $session->set("numRes", $numRes);
        $session->set("guess", null);
        // $session->set("doCheat", "Cheater!");
        $session->set("doCheat", "Cheater winking-emoji!");

        return $this->redirectToRoute('guess_my_number_play', [], 301);
    }
}
