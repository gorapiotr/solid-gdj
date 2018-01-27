<?php

namespace Game;

use PhpSnake\Game;
use PhpSnake\Game\Snake;
use PhpSnake\Terminal;

include 'vendor/autoload.php';

# Parametry początkowe okna gry
$terminal = new Terminal();
$board_width = intval($terminal->getWidth() * .9);
$board_height = 20;

# Ilość węży
$snakes[] = new Snake($board_height, $board_width, 10, 10, ['up'=>'w','down'=>'s','left'=>'a','right'=>'d']);
$snakes[] = new Snake($board_height, $board_width, 30, 30, ['up'=>'i','down'=>'k','left'=>'j','right'=>'l']);

# Inicjowanie opcji gry
$game = new Game($terminal, $snakes, $board_width, $board_height);

# Uruchamianie gry
$game->run();
