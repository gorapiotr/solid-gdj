<?php

declare (strict_types = 1);

namespace test\PhpSnake\Game;

use PhpSnake\Game\Snake;

//require __DIR__ . '/../../src/PhpSnake/Terminal.php';

class SnakeTest extends \PHPUnit_Framework_TestCase
{
    public function testSnakeConstruction()
    {
        $snake = new Snake($boardRows=20,$boardCols=20, $start_row=5, $start_col=5, $control=['up'=>'u','down'=>'d','left'=>'l','right'=>'r']);

        $this->assertEquals($control['up'], $snake->getup());
        $this->assertEquals($control['down'], $snake->getdown());
        $this->assertEquals($control['left'], $snake->getleft());
        $this->assertEquals($control['right'], $snake->getright());

        $this->assertEquals($boardRows, $snake->getboardrows());
        $this->assertEquals($boardCols, $snake->getboardcols());

        $this->assertEquals($start_row, $snake->getstartrow());
        $this->assertEquals($start_col, $snake->getstartcol());

    }
}
