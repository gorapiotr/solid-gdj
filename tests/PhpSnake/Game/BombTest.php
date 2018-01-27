<?php

declare (strict_types = 1);

namespace test\PhpSnake\Game;

use PhpSnake\Game\Board\Bomb;

//require __DIR__ . '/../../src/PhpSnake/Terminal.php';

class BombTest extends \PHPUnit_Framework_TestCase
{
    public function testBombConstruction()
    {
        $bomb = new Bomb();

        $this->assertEquals("*", $bomb->getChar());
    }
}
