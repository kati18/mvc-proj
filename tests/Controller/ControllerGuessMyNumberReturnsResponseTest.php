<?php

declare(strict_types=1);

// namespace App\Controller;

// use PHPUnit\Framework\TestCase;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

namespace App\Tests\Controller;

use App\Controller\GuessMyNumberController;
use App\Guess\Guess;
// use App\Dice\Histogram;
// use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Test class for unit testing class GuessMyNumberController/test suite for
 * unit testing class GuessMyNumberController.
 */
class ControllerGuessMyNumberReturnsResponseTest extends KernelTestCase
{
    private $guessMyNumberControllerObj;
    private $requestObj;
    private $requestStackObj;
    private $sessionObj;

    /**
     * Text fixture - to prepare before a test case
     * Runs before every test method in the class.
     * Below row 47 calls KernelTestCase::bootKernel()
     */
    protected function setUp(): void
    {
        /**
         * Below row boots the Symfony kernel by
         * executing the static method bootKernel in class KernelTestCase:
         */
        self::bootKernel();
        // alt.:
        // 'Symfony\Bundle\FrameworkBundle\Test\KernelTestCase'::bootKernel();

        $this->requestObj = new Request();
        $this->requestObj->setSession(new Session(new MockArraySessionStorage()));
        $this->sessionObj = $this->requestObj->getSession();
        $this->sessionObj->set('guessMyNumber', new Guess());

        $this->requestStackObj = new RequestStack();
        $this->requestStackObj->push($this->requestObj);

        $this->guessMyNumberControllerObj = new GuessMyNumberController(requestStack: $this->requestStackObj);

        /**
         * static::$container below is the
         * static Symfony\Bundle\FrameworkBundle\Test\KernelTestCase::$container:
         */
        $this->guessMyNumberControllerObj->setContainer(static::$container);
    }

    /**
     * Testcase to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $this->assertInstanceOf(GuessMyNumberController::class, $this->guessMyNumberControllerObj);
        // $this->assertObjectHasAttribute('message', $this->gameOneHundredControllerObj);
        // $this->assertClassHasAttribute('message', '\App\Controller\GameOneHundredController');
        $this->assertObjectHasAttribute('requestStackGuess', $this->guessMyNumberControllerObj);
        $this->assertClassHasAttribute('requestStackGuess', '\App\Controller\GuessMyNumberController');

        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller startGame returns a response.
     */
    public function testControllerStartGuessGameReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\RedirectResponse";
        // alt. below row:
        // $exp = RedirectResponse::class;

        // echo "exp från testControllerStartGameReturnsResponse:\n";
        // echo $exp;

        $res = $this->guessMyNumberControllerObj->startGuessGame();
        // echo "res från testControllerStartGameReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller index returns a response.
     */
    public function testControllerIndexReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerIndexReturnsResponse:\n";
        // echo $exp;

        $res = $this->guessMyNumberControllerObj->index();
        // echo "res från testControllerIndexReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller init returns a response.
     */
    public function testControllerInitReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerInitReturnsResponse:\n";
        // echo $exp;
        $res = $this->guessMyNumberControllerObj->init();
        // echo "res från testControllerInitReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller play returns a response.
     */
    public function testControllerPlayGetReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerPlayReturnsResponse:\n";
        // echo $exp;
        $res = $this->guessMyNumberControllerObj->playGet();
        // echo "res från testControllerPlayReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller play returns a response.
     */
    public function testControllerPlayPostReturnsResponse()
    {
        $this->sessionObj->set('number', 33);
        $this->sessionObj->set('tries', 5);

        $requestObj = new Request();
        $requestObj->attributes->set('guess', 22);
        $requestObj->attributes->set('doGuess', 'Dummy guess');

        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerPlayReturnsResponse:\n";
        // echo $exp;
        $res = $this->guessMyNumberControllerObj->playPost(request: $this->requestObj);
        // echo "res från testControllerPlayReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller play returns a response.
     */
    public function testControllerDoCheatReturnsResponse()
    {
        $this->sessionObj->set('number', 44);
        $this->sessionObj->set('tries', 2);

        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerPlayReturnsResponse:\n";
        // echo $exp;
        $res = $this->guessMyNumberControllerObj->doCheat();
        // echo "res från testControllerPlayReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }
}
