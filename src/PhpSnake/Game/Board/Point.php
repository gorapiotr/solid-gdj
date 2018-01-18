<?php

declare (strict_types = 1);

namespace PhpSnake\Game\Board;

class Point
{
    /**
     * @var int
     */
    private $row;

    /**
     * @var int
     */
    private $col;

    /**
     * @var string
     */
    private $char;
    
    private $factor = 1;

    /**
     * @param int    $row
     * @param int    $col
     * @param string $char
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getCol()
    {
        return $this->col;
    }

    /**
     * @return string
     */
    public function getChar()
    {
        return $this->char;
    }

    /**
     * @param string $char
     */
    public function setChar($char)
    {
        $this->char = $char;
    }
    
    public function setParams(array $params)
    {
    	if (isset($params['row'])) $this->row = $params['row'];
    	if (isset($params['col'])) $this->col = $params['col'];
    	if (isset($params['char'])) $this->char = $params['char'];
    }

    /**
     * @param Point $point
     * 
     * @return bool
     */
    public function overlaps(Point $point)
    {
        return $this->row == $point->getRow() && $this->col == $point->getCol();
    }
}
