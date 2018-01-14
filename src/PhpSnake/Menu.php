<?php

declare (strict_types = 1);

namespace PhpSnake;

use PhpSnake\MenuComponent;
use PhpSnake\Exception\GameException;
use PhpSnake\Game\Board;
use PhpSnake\Game\Drawer;



class Menu
{

    private $board;

    private $terminal;

    private $menuComponentsArray = array();

    private $draver;
    

	public function __construct(Board $board, Terminal $terminal)
    {
        $this->board = $board;
        $this->terminal = $terminal;
        $this->drawer = new Drawer(STDOUT);

    }


    public function addComponentMenu(MenuComponentInterface $menuComponent)
    {
       $this->menuComponentsArray[]=['name'=> $menuComponent->getName(), 'key'=>$this->computeKeyComponentMenuValue(), 'functionName' => $menuComponent->getfunctionName()];
        
    }


    public function computeKeyComponentMenuValue()
    {
        $value = count($this->menuComponentsArray);
        $value++;
        return $value;
    }

    public function drawMenu()
    {
       
        foreach ($this->menuComponentsArray as $oneComponent)
        {
            $this->positionMenu($oneComponent);
        }
        

    }

    public function positionMenu($menuComponent)
    {
        $menuComponentHeight = array_search($menuComponent['name'], array_column($this->menuComponentsArray, 'name'));
        $menuComponentHeight = 7+$menuComponentHeight;
        $this->board->writeStringOnBoard($menuComponent['name'],$menuComponentHeight);
    }

    public function interactWithMenu($char)
    {   
        
        foreach ($this->menuComponentsArray as $oneComponent) 
        {
             if($oneComponent['key'] == $char)
             {
                
                call_user_func(array($this, $oneComponent['functionName']), $oneComponent['name']);

             }
        }
    }


  public function newTextSide($text)
    {
                $this->board->removeBoard();
                $this->board->generateMap();
                $this->board->generateOutline();
                $this->board->writeStringOnBoard($text);
                $this->drawer->draw($this->board);
    }


    ///Rozpoczecie,gry
    public function startGame()
    {
        while (true)
            {
                $input = $this->terminal->getChar();

                
                $this->board->moveSnake($input);

                $this->drawer->draw($this->board);
                usleep(60000);
            }
    }
    ///Koniec gry
    public function endGame($value =NULL)
    {

        $this->newTextSide("!!! Do zobaczenia !!!");
        sleep(1);
        system('clear');
        exit();

    }


}
