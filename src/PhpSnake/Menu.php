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

    private $menuComponentsArray = array();
    

	public function __construct(Board $board)
    {
        $this->board = $board;

    }


    public function addComponentMenu(MenuComponentInterface $menuComponent)
    {
       $this->menuComponentsArray[]=['name'=> $menuComponent->getName()];
        
    }

    public function drawMenu()
    {
       
        foreach ($this->menuComponentsArray as $oneComponent) 
        {    
            //$this->board->writeStringOnBoard($oneComponent['name']);
            $this->positionMenu($oneComponent);
        }

    }

    public function positionMenu($menuComponent)
    {
        $menuComponentHeight = array_search($menuComponent['name'], array_column($this->menuComponentsArray, 'name'));
        $menuComponentHeight = 7+$menuComponentHeight;
        $this->board->writeStringOnBoard($menuComponent['name'],$menuComponentHeight);
    }


}