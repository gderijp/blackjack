<?php

require_once 'Card.php';
require_once 'Deck.php';
require_once 'Player.php';

$deck = new Deck();
$player = new Player('Giorgio');

$player->addCard($deck->drawCard());
$player->addCard($deck->drawCard());
$player->addCard($deck->drawCard());

echo $player->showHand() . PHP_EOL;