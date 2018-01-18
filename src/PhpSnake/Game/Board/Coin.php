<?php

declare (strict_types = 1);

namespace PhpSnake\Game\Board;

class Coin extends Point
{
    
    
    //private $arrayCoin = array("\033[41m\033[37m$\033[0m", 
                               //"\033[43m\033[30m+\033[0m",
                              //  "\033[44m\033[30m#\033[0m");

    
    
    /**
     * @var string
     */
    private $char = "\033[42m\033[37m$\033[0m";
    //private $char =  "\033[?25h\033[?0c";
   
     /**
     * @param int $row
     * @param int $col
     */
    public function __construct(int $row=1, int $col=1)
    {
       //$test= rand(0,2);
        parent::__construct($row, $col, $this->char);
    }
}
