<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\HighScore;
use App\Controller\HighScoreController;
use App\Repository\HighScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test class for unit testing class HighScoreController/
 * test suite for unit testing class HighScoreController.
 * See https://symfony.com/doc/current/testing/database.html
 */
class ControllerHighScoreReturnsResponseTest extends KernelTestCase
{
    private $highScoreControllerObj;
    // private $highScoreRepositoryObj;
    // private $entityManagerObj;

    /**
     * Text fixture - to prepare before a test case
     * Runs before every test method in the class.
     * Below row 38 calls KernelTestCase::bootKernel() and
     * creates a "client" that is acting as the browser:
     */
    protected function setUp(): void
    {
        /**
         * Below row boots the Symfony kernel by
         * executing the static method bootKernel in class KernelTestCase:
         */
        self::bootKernel();

        /** Below(done by executing the static method getContainer in class
         * KernelTestCase (I think)) row to access the special test service
         * container which contains both the public services as well as
         * non-removed private services:
         */
        $container = static::getContainer();

        $this->highScoreControllerObj = $container->get(HighScoreController::class);
        // $this->entityManagerObj = $container->get(EntityManagerInterface::class);
        // $this->highScoreRepositoryObj = $container->get(HighScoreRepository::class);
    }

    /**
     * Testcase to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $this->assertInstanceOf(HighScoreController::class, $this->highScoreControllerObj);
    }

    // /**
    //  * Testcase that asserts that the controller createHighScore returns a response.
    //  */
    // public function testControllerCreateHighScoreReturnsResponse()
    // {
    //     $exp = "\Symfony\Component\HttpFoundation\Response";
    //     //alt. below row:
    //     // $exp = Response::class;
    //
    //     // echo "exp från testControllerfetchAllBooksReturnsResponse:\n";
    //     // echo $exp;
    //
    //     $res = $this->highScoreControllerObj->createHighScore(
    //         score: 108,
    //         winner: "Player",
    //         histogramp: "dummy histogram for player",
    //         histogramc: "dummy histogram for computer",
    //         entityManager: $this->entityManagerObj
    //     );
    //     // echo "res från testControllerCreateHighScoreReturnsResponse:\n";
    //     // echo $res;
    //     // var_dump($res);
    //     $this->assertInstanceOf($exp, $res);
    // }


    /**
     * Testcase that asserts that the controller createHighScore returns a response.
     * Works!
     */
    public function testControllerCreateHighScoreReturnsResponse1()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerfetchAllBooksReturnsResponse:\n";
        // echo $exp;

        $requestObj = new Request();
        $requestObj->attributes->set('winner', 'Ruff');
        $requestObj->attributes->set('score', 111);
        $requestObj->attributes->set('histogramp', 'dummyp');
        $requestObj->attributes->set('histogramc', 'dummyc');

        // $res = $this->highScoreControllerObj->createHighScore(request: $requestObj, entityManager: $this->entityManagerObj);

        $entityManagerObj = $this->createMock(EntityManagerInterface::class);
        $res = $this->highScoreControllerObj->createHighScore(request: $requestObj, entityManager: $entityManagerObj);

        // echo "res från testControllerCreateHighScoreReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
    }

    // /**
    //  * Testcase that asserts that the controller fetchAllHighScores returns a response.
    //  */
    // public function testControllerfetchAllHighScoresReturnsResponse()
    // {
    //     $exp = "\Symfony\Component\HttpFoundation\Response";
    //     //alt. below row:
    //     // $exp = Response::class;
    //
    //     // echo "exp från testControllerfetchAllBooksReturnsResponse:\n";
    //     // echo $exp;
    //
    //     $res = $this->highScoreControllerObj->fetchAllHighScores(highScoreRepository: $this->highScoreRepositoryObj);
    //     // echo "res från testControllerfetchAllBooksReturnsResponse:\n";
    //     // echo $res;
    //     // var_dump($res);
    //     $this->assertInstanceOf($exp, $res);
    // }

    /**
     * Testcase that asserts that the controller fetchAllHighScores returns a response.
     * Test 220206 kl 19:20
     */
    public function testControllerFetchHistogramsReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;
        // echo "exp från testControllerfetchAllBooksReturnsResponse:\n";
        // echo $exp;

        $highScoreObj = new HighScore();
        $highScoreObj->setWinner('Selma');
        $highScoreObj->setScore(132);
        $highScoreObj->setDate(date("Y-m-d H:i:s"));
        $highScoreObj->setHistogramP('dummyp');
        $highScoreObj->setHistogramC('dummyc');

        $highScoreRepositoryObj = $this->createMock(HighScoreRepository::class);
        $highScoreRepositoryObj->expects($this->any())
            ->method('find')
            ->willReturn($highScoreObj);

        // $res = $this->highScoreControllerObj->fetchHistograms($highScore, highScoreRepository: $this->highScoreRepositoryObj);
        $res = $this->highScoreControllerObj->fetchHistograms(histograms: $highScoreObj, highScoreRepository: $highScoreRepositoryObj);

        // echo "res från testControllerfetchAllBooksReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals(132, $highScoreObj->getScore());
    }
}
