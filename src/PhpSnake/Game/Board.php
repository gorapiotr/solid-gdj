<?php

declare (strict_types = 1);

namespace PhpSnake\Game;

use PhpSnake\Game\Board\Coin;
use PhpSnake\Game\Board\Point;
use PhpSnake\Terminal\Char;
use PhpSnake\Game\Board\Bomb;

class Board
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var array
     */
    private $map;

    /**
     * @var array
     */
    private $sourceMap;

    /**
     * @var Snake
     */
    private $snake;
  
    /**
     * @var ObjectsOnBoard[]:array
     */
    private $ObjectsOnBoard;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;

        $this->snake[] = new Snake($height, $width);

        // Nowy sposób generowania obiektów na ekranie
        $this->randomObjectsOnBoard(new Coin(),1);
        $this->randomObjectsOnBoard(new Bomb(),1);

        $this->generateMap();
        $this->generateOutline();
        $this->sourceMap = $this->map;

        $this->applyElements();
    }
   
    public function randomObjectsOnBoard(Point $Object, int $count)
    {
    	for ($i = 0; $i < $count; ++$i) {
    		$col = rand(1, $this->width - 2);
    		$row = rand(1, $this->height - 2);
    		// Losowa aktualizacja położenia obiektu na ekranie
    		$Object->setParams(['col'=>$col,'row'=>$row]);
    		$this->ObjectsOnBoard[] = $Object; 
    	}
    }

    public function moveSnake(string $input)
    {
    	foreach ($this->snake as $snake)
    	{
    		$snake->move($input);
    		$this->checkObjects();
    		$this->applyElements();
    	}
    }

    private function checkObjects()
    {
    	foreach ($this->snake as $snake)
    	{
    		$head = $snake->getPoints()[0];
    		
    		if (!empty($this->ObjectsOnBoard)) {
    			foreach ($this->ObjectsOnBoard as $index => $object) {
    				if ($head->overlaps($object)) {
    					$snake->advance();
    					unset($this->ObjectsOnBoard[$index]);
    					// Nowy sposób generowania obiektów na ekranie
    					rand(0,1)==0 ? $this->randomObjectsOnBoard(new Coin(),1):$this->randomObjectsOnBoard(new Bomb(),1);
    				}
    			}
    		}
    	}
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }


    /**Funcion writing a string on board 
    *
    */
    public function writeStringOnBoard($text, $row = NULL , $column = NULL )
    {

        $length = strlen($text);

        if($row == NULL)
        {
            $row = $this->height / 2;
        }

        if($column == NULL)
        {    
        $column = ($this->width / 2) - ($length / 2);
        }


        for ($i = 0; $i < $length; ++$i) {
            $this->map[$row][$column] = $text[$i];
            ++$column;
        }
    }

    /**Function clear console after 2 seconds
    *
    */
    public function removeBoard()
    {
        sleep(2);
        system('clear');
    }

    private function applyElements()
    {
    	$this->map = $this->sourceMap;
    	
    	foreach ($this->snake as $snake)
    	{
    		foreach ($snake->getPoints() as $point) {
    			$this->applyPoint($point);
    		}
    	}
    	
    	if (!empty($this->ObjectsOnBoard)) {
    		foreach ($this->ObjectsOnBoard as $object) {
    			$this->applyPoint($object);
    		}
    	}
    }

    /**
     * @param Point $point
     */
    private function applyPoint(Point $point)
    {
        $this->map[$point->getRow()][$point->getCol()] = $point->getChar();
    }

    public function generateMap()
    {
        for ($i = 0; $i < $this->height; ++$i) {
            $this->map[$i] = array_fill(0, $this->width, ' ');
        }
    }

    public function generateOutline()
    {
        $this->map[0][0] = Char::boxTopLeft();
        $this->map[0][$this->width - 1] = Char::boxTopRight();

        $this->generateHLine(0, 1, $this->width - 2, Char::boxHorizontal());
        $this->generateHLine($this->height - 1, 1, $this->width - 2, Char::boxHorizontal());

        $this->generateVLine(0, 1, $this->height - 2, Char::boxVertical());
        $this->generateVLine($this->width - 1, 1, $this->height - 2, Char::boxVertical());

        $this->map[$this->height - 1][0] = Char::boxBottomLeft();
        $this->map[$this->height - 1][$this->width - 1] = Char::boxBottomRight();
    }

    /**
     * @param int    $row
     * @param int    $start
     * @param int    $cols
     * @param string $char
     */
    private function generateHLine(int $row, int $start, int $cols, string $char)
    {
        for ($i = 0;$i < $cols;++$i) {
            $this->map[$row][$start + $i] = $char;
        }
    }

    /**
     * @param int    $col
     * @param int    $start
     * @param int    $rows
     * @param string $char
     */
    private function generateVLine(int $col, int $start, int $rows, string $char)
    {
        for ($i = 0;$i < $rows;++$i) {
            $this->map[$start + $i][$col] = $char;
        }
    }
}
