<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test class for functional testing of class GuessRecordController/
 * test suite for functional testing of class GuessRecordController.
 * See https://symfony.com/doc/current/testing/database.html
 */
class ControllerGuessRecordTest extends WebTestCase
{
    private $client;

    /**
     * Text fixture - to prepare before a test case
     * Runs before every test method in the class.
     * Below row 31 calls KernelTestCase::bootKernel() and
     * creates a "client" that is acting as the browser:
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
      * Testcase that asserts that the controller createGuessRecord returns:
      * - a response with correct status code
      * - a successful response
     * - a <table> HTML element
     */
    public function testControllerCreateGuessRecordReturnsStatusCodeAndContent1()
    {
        $crawler = $this->client->request(
            'POST',
            '/guess-record/create/record',
            [
                'name' => 'Pippi',
                'number' => 88,
                'tries' => 3,
            ]
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();

        $this->assertCount(1, $crawler->filter('table'));
    }


    /**
     * Testcase that asserts that the controller fetchAllGuessRecords returns:
     * - a response with correct status code
     * - a successful response
     * - a HTML element with attribute class="guess-records-table"
     * - a <table> HTML element
     * - two <h1> HTML elements
     * - a HTML element with attribute class="guess-records-header" that contains
     *  the text 'Score records of the game guess my number!'
     */
    public function testControllerFetchAllGuessRecordsReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/guess-record/find/all');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.guess-records-table'));
        $this->assertCount(1, $crawler->filter('table'));
        $this->assertCount(2, $crawler->filter('h1'));
        $this->assertSelectorTextContains('.guess-records-header', 'Score records of the game Guess my number');
    }
}
