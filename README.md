# README

This web application was created with [Symfony CLI](https://symfony.com/download) version 4.28.1.

[![Build Status](https://app.travis-ci.com/kati18/mvc-proj.svg?branch=master)](https://app.travis-ci.com/kati18/mvc-proj)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kati18/mvc-proj/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kati18/mvc-proj/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/kati18/mvc-proj/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kati18/mvc-proj/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/kati18/mvc-proj/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kati18/mvc-proj/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/kati18/mvc-proj/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

## About

This Symfony web application contains two games - the dice game "Game 100" and the guess game "Guess my number" as well as an database for storing game results and the developer´s favorite books.

### Game 100

In Game 100 you play against the Computer until one of you reaches the total score of 100 or more. The game starts with each player (you and the Computer) rolling a single die in order to decide who gets to start playing i.e. rolling three dice. A die face of 1 sets the game round score to 0 and the turn goes over to the other player. The total winning score can be saved into a high score table.

![Dice image](public/img_books/dice.jpg?raw=true)

### Guess my number

In Guess my number you have six tries to figure out the secret number which is a random number from 1 to 100. After each guess you get a hint on whether your guess is too low or too high. It is possible to cheat during the game and then continue to play. The guess record can, unless you cheated, be saved into a guess records table.

![Numbers image](public/img_books/numbers.jpg?raw=true)

## Software Requirements Specification(SRS):

    - a local web server running php ^8.0
    - composer
    - a web browser

## Installation:

    - download this GitHub repository
    - in terminal run composer install

## Start playing by:

    - starting the local web server
    - in browser navigate to the directory of installation/public

## Development server

Run `symfony serve` or `php -S localhost:8000 -t public/` for a dev server. Navigate to `http://localhost:8000/`.


## Code scaffolding

Run `php bin/console make:controller to generate controller controller-name` to generate a new controller. You can also use `php bin/console make entity|command|form|class|fixture` e t c.
Run `php bin/console` for a list of available commands when using script `bin/console`.  


## Running unit tests and functional tests

Run `./bin/phpunit` or `make test` to execute tests using PHPUnit.


## Further help

To get more help on the Symfony CLI use `symfony help`.
