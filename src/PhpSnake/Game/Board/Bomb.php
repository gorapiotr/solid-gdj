<?php

declare (strict_types = 1);

namespace PhpSnake\Game\Board;

class Bomb extends Point
{


    //private $arrayCoin = array("\033[41m\033[37m$\033[0m",
                               //"\033[43m\033[30m+\033[0m",
                              //  "\033[44m\033[30m#\033[0m");



    /**
     * @var string
     */
    private $char = "*";
    
    private $factor = -1;
    
    //private $char =  "\033[?25h\033[?0c";

    public function __construct()
    {
    	parent::__construct();
    	$this->setParams(['char'=>$this->char]);
    }
}
