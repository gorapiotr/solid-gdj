<?php

declare (strict_types = 1);

namespace PhpSnake;

use PhpSnake\Exception\GameException;
use PhpSnake\Game\Board;
use PhpSnake\Game\Snake;
use PhpSnake\Game\Drawer;
use PhpSnake\Menu;
use PhpSnake\MenuComponent;


class Game
{
    /**
     * @var Terminal
     */
    private $terminal;

    /**
     * @var Board
     */
    private $board;

    /**
     * @var Drawer
     */
    private $drawer;

    public function __construct()
    {
    	
    	$this->terminal = new Terminal();
    	$board_width = intval($this->terminal->getWidth() * .9);
    	$board_height = 20;
    	
    	$snake[] = new Snake($board_height, $board_width, 10, 10, ['up'=>'w','down'=>'s','left'=>'a','right'=>'d']);
    	$snake[] = new Snake($board_height, $board_width, 30, 30, ['up'=>'i','down'=>'k','left'=>'j','right'=>'l']);
    	
    	$this->board = new Board($board_width, $board_height, $snake);
    	$this->drawer = new Drawer(STDOUT);
    	
    	
    	//POWODUJE POJAWIENIE SIE TABLICY
    	//$this->drawBoard();
    }
    




    public function run()
    {
        try {
                    system('clear');
                    $menu = new Menu($this->board, $this->terminal);


                    $menu ->addComponentMenu(new MenuComponent('Zadanie','startGame'));
                    $menu ->addComponentMenu(new MenuComponent('Opcje','newTextSide'));
                    $menu ->addComponentMenu(new MenuComponent('Zapisz gre','newTextSide'));
                    $menu ->addComponentMenu(new MenuComponent('Wyjscie','endGame'));
                    $menu ->drawMenu();
                    $this->drawBoard();

                while(true)
                    {
                        $input = $this->terminal->getChar();
                    
                        if($input != NULL)
                        {
                            $menu->interactWithMenu($input);
                        }
                        
                    }
            }
         catch (GameException $exception) {
            $this->gameOver();
            $this->board->removeBoard();
        }
    }

    public function gameOver()
    {
        $this->board->writeStringOnBoard('Game Over');
        $this->drawBoard();      
    }

    private function drawBoard()
    {
        $this->drawer->draw($this->board);
    }

}
