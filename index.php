<?php

require_once 'Blackjack.php';
require_once 'Card.php';
require_once 'Dealer.php';
require_once 'Deck.php';
require_once 'Player.php';


$dealer = new Dealer(new Blackjack(), new Deck());
$dealer->addPlayer(new Player('Player'));
// Add more players if you want!
$dealer->playGame();