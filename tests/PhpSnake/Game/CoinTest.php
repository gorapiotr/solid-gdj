<?php

declare (strict_types = 1);

namespace test\PhpSnake\Game;

use PhpSnake\Game\Board\Coin;

//require __DIR__ . '/../../src/PhpSnake/Terminal.php';

class CoinTest extends \PHPUnit_Framework_TestCase
{
    public function testCoinConstruction()
    {
        $coin = new Coin();

        $this->assertEquals("\033[42m\033[37m$\033[0m", $coin->getChar());
    }
}
