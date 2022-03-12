<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\GuessRecord;
use App\Controller\GuessRecordController;
use App\Repository\GuessRecordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test class for unit testing class GuessRecordController/
 * test suite for unit testing class GuessRecordController.
 * See https://symfony.com/doc/current/testing/database.html
 */
class ControllerGuessRecordReturnsResponseTest extends KernelTestCase
{
    private $guessRecordControllerObj;
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

        $this->guessRecordControllerObj = $container->get(GuessRecordController::class);
        // $this->entityManagerObj = $container->get(EntityManagerInterface::class);
        // $this->guessRecordRepositoryObj = $container->get(GuessRecordRepository::class);
    }

    /**
     * Testcase to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $this->assertInstanceOf(GuessRecordController::class, $this->guessRecordControllerObj);
    }

    /**
     * Testcase that asserts that the controller createGuessRecord returns a response.
     * Works!
     */
    public function testControllerCreateGuessRecordReturnsResponse1()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerCreateGuessRecordReturnsResponse1:\n";
        // echo $exp;

        $requestObj = new Request();
        $requestObj->attributes->set('name', 'Totte');
        $requestObj->attributes->set('number', 77);
        $requestObj->attributes->set('tries', 4);

        $entityManagerObj = $this->createMock(EntityManagerInterface::class);
        $res = $this->guessRecordControllerObj->createGuessRecord(request: $requestObj, entityManager: $entityManagerObj);

        // echo "res från testControllerCreateGuessRecordReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
    }


    /**
     * Testcase that asserts that the controller fetchAllGuessRecords returns a response.
     */
    public function testControllerFetchAllGuessRecordsReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;
        // echo "exp från testControllerfetchAllGuessRecordsReturnsResponse:\n";
        // echo $exp;

        $guessRecordObj = new GuessRecord();
        $guessRecordObj->setName('Selma');
        $guessRecordObj->setNumber(55);
        $guessRecordObj->setTries(4);
        $guessRecordObj->setDate(date("Y-m-d H:i:s"));

        $guessRecordRepositoryObj = $this->createMock(GuessRecordRepository::class);
        $guessRecordRepositoryObj->expects($this->any())
            ->method('findAll')
            ->willReturn($guessRecordObj);

        $res = $this->guessRecordControllerObj->fetchAllGuessRecords(guessRecordRepository: $guessRecordRepositoryObj);

        // echo "res från testControllerfetchAllGuessRecordsReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals('Selma', $guessRecordObj->getName());
    }
}
