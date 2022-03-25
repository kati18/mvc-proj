<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Guess\Guess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

/**
 * Test class for functional testing of the class GuessMyNumberController/
 * test suite for functional testing of the class GuessMyNumberController.
 */
class ControllerGuessMyNumberTest extends WebTestCase
{
    private $client;

    /**
     * Text fixture - to prepare before a test case
     * Runs before every test method in the class.
     */
    protected function setUp(): void
    {
        /**
         * Below row calls KernelTestCase::bootKernel() and
         * creates a "client" that is acting as the browser:
         */
        $this->client = static::createClient();
        $this->client->followRedirects();
    }


    /**
     * Testcase that asserts that the controller startGame returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - a <h2> HTML element that contains the text 'The guess my number game!''
     * - one <button> HTML element
     */
    public function testControllerStartGuessGameReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/guessmynumber/');

        $this->assertNotSame(
            Response::HTTP_MOVED_PERMANENTLY,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.heading-start-guess-my-number', 'start page of the game Guess my number');
        $this->assertCount(1, $crawler->filter('button'));

        //Below row works if $this->client->followRedirects() is not active in setUp():
        // $this->assertResponseRedirects('/gameonehundred/index', 301);

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller index returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - a <title> HTML element that contains the text My Symfony App!
     * - one <p> HTML element
     */
    public function testControllerIndexReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/guessmynumber/index');

        $this->assertNotSame(
            Response::HTTP_NOT_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('title', 'My Symfony App!');
        $this->assertCount(1, $crawler->filter('p'));

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller init returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - a <h2> HTML element that contains the text 'my number game'
     * - a <h1> HTML element that contains the text 'Katja´s first Symfony app in course mvc at BTH 2021!'
     * - a <p> HTML element that contains the text 'Guess a number from 1 to 100.'
     * - a <button> HTML element that contains the text 'Cheat'
     */
    public function testControllerInitReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/guessmynumber/init');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.guess-header', 'Guess my number');
        $this->assertSelectorTextContains('h1', 'Katja´s first Symfony app in course mvc at BTH 2021!');
        $this->assertSelectorTextContains('p', 'Guess a number from 1 to 100.');
        $this->assertSelectorTextContains('button', 'Cheat');

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller play returns:
     * - a response with correct status code
     * - a successful response
     */
    public function testControllerPlayGetReturnsStatusCodeAndContent()
    {
        /** Test 211101 kl 15:05 and according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        // $sessionObj = $this->client->getContainer()->get('session');
        // $sessionObj->set('game', new Guess());
        // $sessionObj->set('guess', new Guess(number: 5, tries: 10));
        //End test 211101 kl 15:05

        $crawler = $this->client->request('GET', '/guessmynumber/play');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller playPost returns:
     * - a response with correct status code
     * - a successful response
     * - a HTML element with attribute class="guess-header" that contains the text
     *  'Guess my number'
     * - a <form> HTML element
     * - two <input> HTML elements
     * - a HTML element with attribute class="guess-p" that contains the text
     *  'You guessed 5.'
     * - a HTML element with attribute class="result-p" that contains the text
     *  'Guess my numberUnfortunately, your guess is TOO LOW.'
     * - a HTML element with attribute class="tries-p" that contains the text
     *  'You have 4 tries left. Try again!'
     */
    public function testControllerPlayPostReturnsStatusCodeAndContent()
    {
        /** Below according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        $sessionObj = $this->client->getContainer()->get('session');
        $sessionObj->set('number', 8);
        $sessionObj->set('tries', 5);

        // $sessionObj->set('game', new Guess());
        // $sessionObj->set('guess', new Guess(number: 5, tries: 10));

        $crawler = $this->client->request(
            'POST',
            '/guessmynumber/play/post',
            [
                'guess' => '5',
                'doGuess' => 'Make a dummy guess',
            ]
        );

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.guess-header', 'Guess my number');
        $this->assertCount(1, $crawler->filter('form'));
        $this->assertCount(2, $crawler->filter('input'));
        $this->assertSelectorTextContains('.guess-p', 'You guessed 5.');
        $this->assertSelectorTextContains('.result-p', 'Unfortunately, your guess is TOO LOW.');
        $this->assertSelectorTextContains('.tries-p', 'You have 4 tries left. Try again!');
        // $this->assertSelectorTextContains('.start-from-beginning', 'Start from the beginning');

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller doCheat returns:
     * - a response with correct status code
     * - a successful response
     * - a HTML element with attribute class=".guess-game-p" that contains the text
     *  'Guess a number from 1 to 100.'
     * - a HTML element with attribute class="guess-game-tries-p" that contains the text
     *  'You have 6 tries to figure out the secret number.'
     * - a <form> HTML element
     * - two <input> HTML elements
     * - a HTML element with attribute class="guess-game-cheat-p" that contains the text
     *  'The secret number is 3..'
     */
    public function testControllerDoCheatReturnsStatusCodeAndContent()
    {
        /** Below according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        $sessionObj = $this->client->getContainer()->get('session');
        $sessionObj->set('tries', 6);
        $sessionObj->set('number', 3);

        $crawler = $this->client->request('GET', '/guessmynumber/doCheat');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.guess-game-p', 'Guess a number from 1 to 100.');
        $this->assertSelectorTextContains('.guess-game-tries-p', 'You have 6 tries to figure out the secret number.');
        $this->assertCount(1, $crawler->filter('form'));
        $this->assertCount(2, $crawler->filter('input'));
        $this->assertSelectorTextContains('.guess-game-cheat-p', 'The secret number is 3.');

        // unset($client);
    }
}
