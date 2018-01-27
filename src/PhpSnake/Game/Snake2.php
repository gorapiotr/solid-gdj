<?php

declare (strict_types = 1);

namespace PhpSnake\Game;

use PhpSnake\Exception\GameException;
use PhpSnake\Game\Board\Point;
use PhpSnake\Terminal\Char;

class Snake2 extends Snake
{
    /**
     * @var Point[]|array
     */
    private $points;

    /**
     * @var string
     */
    private $direction = Direction::RIGHT;

    /**
     * @var int
     */
    private $boardRows;

    /**
     * @var int
     */
    private $boardCols;

    /**
     * @var Point[]|null
     */
    private $lastPoint;

    private $up;

    private $down;

    private $left;

    private $right;

    private $start_row;

    private $start_col;

    /**
     * @param int $boardRows
     * @param int $boardCols
     */
    public function __construct(int $boardRows, int $boardCols, int $start_row=10, int $start_col=10, array $control=['up'=>'w','down'=>'s','left'=>'a','right'=>'d'])
    {
    	// Przypisanie sterowania
    	$this->up = $control['up'];
    	$this->down = $control['down'];
    	$this->left = $control['left'];
    	$this->right = $control['right'];

    	$head = new Point();
    	$head->setParams(['row' => intval($start_row), 'col' => intval($start_col), 'char' => Char::block()]);
    	$this->boardCols = $boardCols;
    	$this->boardRows = $boardRows;

      $this->start_row = $start_row;
      $this->start_col = $start_col;

    	for ($i = 1;$i < 5;++$i) {
    		$body = new Point();
    		$body->setParams(['row' => $head->getRow(), 'col' => $head->getCol() - $i, 'char' => Char::shadeBlock()]);
    		$this->points[] = $body;
    	}
    	array_unshift($this->points, $head);
    }

    public function move(string $input)
    {
        $this->changeDirection($input);

        $row = $this->points[0]->getRow();
        $col = $this->points[0]->getCol();

        switch ($this->direction) {
            case Direction::RIGHT:
                $col++;
                break;
            case Direction::LEFT:
                $col--;
                break;
            case Direction::UP:
                $row--;
                break;
            case Direction::DOWN:
                $row++;
                break;
        }

        if ($col >= $this->boardCols - 1) {
            $col = 1;
        } elseif ($col < 1) {
            $col = $this->boardCols - 2;
        }

        if ($row >= $this->boardRows - 1) {
            $row = 1;
        } elseif ($row < 1) {
            $row = $this->boardRows - 2;
        }

        $this->points[0]->setChar(Char::shadeBlock());
        $new_point = new Point();
        $new_point->setParams(['row'=>$row, 'col'=>$col, 'char'=>Char::block()]);
        $next = $new_point;

        $this->checkCollision($next);

        array_unshift($this->points, $next);
        $this->lastPoint = array_pop($this->points);
    }

    /**
     * @param Point $next
     *
     * @throws GameException
     */
    private function checkCollision(Point $next)
    {
        foreach ($this->points as $point) {
            if ($point->overlaps($next)) {
                throw GameException::snakeCollision();
            }
        }
    }

    public function advance()
    {
        array_push($this->points, $this->lastPoint);
    }

    /**
     * @param string $input
     */
    private function changeDirection(string $input)
    {
    	if ($this->up === $input && $this->direction != Direction::DOWN) {
    		$this->direction = Direction::UP;
    	} elseif ($this->left === $input && $this->direction != Direction::RIGHT) {
    		$this->direction = Direction::LEFT;
    	} elseif ($this->down === $input && $this->direction != Direction::UP) {
    		$this->direction = Direction::DOWN;
    	} elseif ($this->right === $input && $this->direction != Direction::LEFT) {
    		$this->direction = Direction::RIGHT;
    	}
    }

    /**
     * @return array|Point[]
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    public function getUp()
    {
        return $this->up;
    }

    public function getDown()
    {
        return $this->down;
    }

    public function getLeft()
    {
        return $this->left;
    }

    public function getRight()
    {
        return $this->right;
    }

    public function getBoardRows()
    {
        return $this->boardRows;
    }

    public function getBoardCols()
    {
        return $this->boardCols;
    }

    public function getStartRow()
    {
        return $this->start_row;
    }

    public function getStartCol()
    {
        return $this->start_col;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction)
    {
        $this->direction = $direction;
    }
}
