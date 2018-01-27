<?php

declare (strict_types = 1);

namespace test\PhpSnake\Game;

use PhpSnake\Game\Board\Point;

//require __DIR__ . '/../../src/PhpSnake/Terminal.php';

class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testPointConstruction()
    {
        $point = new Point();
        $point->setParams(['row'=>2,'col'=>3,'char'=>'#']);
        $this->assertEquals("2", $point->getRow());
        $this->assertEquals("3", $point->getCol());
        $this->assertEquals("#", $point->getChar());
    }
}
