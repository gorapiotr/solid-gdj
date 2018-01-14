<?php

declare (strict_types = 1);

namespace test\PhpSnake\Game;

use PhpSnake\Game\Board;

//require __DIR__ . '/../../src/PhpSnake/Terminal.php';

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function testBoardConstruction()
    {
        $board = new Board($width = 10, $height = 10);

        $this->assertEquals($width, $board->getWidth());
        $this->assertEquals($height, $board->getHeight());
    }
}
