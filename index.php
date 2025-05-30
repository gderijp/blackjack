<?php

require_once 'Card.php';
require_once 'Deck.php';
require_once 'Player.php';
require_once 'Blackjack.php';

// Vraag de naam van de speler
$blackjack = new Blackjack;
$player = new Player(readline("Wat is je naam?... "), $blackjack);
$deck = new Deck();

// Geef de speler twee kaarten aan het begin en geef ze weer
$player->addCard($deck->drawCard());
$player->addCard($deck->drawCard());
echo $player->showHand() . PHP_EOL;

$firstScore = $player->getScore();
if (in_array($firstScore, ['Blackjack', 'Busted'])) {
    echo $firstScore . "! " . $player->showHand() . PHP_EOL;
    exit();
}

// Start het spel
$gameIsActive = true;
while ($gameIsActive) {
    $playAgain = readline("Nieuwe kaart (n) of stoppen (s)?... ");
    if ($playAgain === 's') {
        echo $player->getScore() . "! " . $player->showHand() . PHP_EOL;
        $gameIsActive = false;
        exit();
    } elseif ($playAgain === 'n') {
        $player->addCard($deck->drawCard());
        echo "Je kreeg een " . $player->getLastCard()->show() . PHP_EOL;

        // check if the user > 21 OR === 21
        $score = $player->getScore();
        if (str_contains($score, 'Blackjack') || str_contains($score, 'Busted') || str_contains($score, 'Twenty-One') || str_contains($score, 'Five Card Charlie')) {
            echo $score . "! " . $player->showHand() . PHP_EOL;
            $gameIsActive = false;
            exit();
        }
    } else {
        echo "Voer 'n' of 's' in" . PHP_EOL;
    }
}