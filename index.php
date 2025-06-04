<?php

require_once 'Blackjack.php';
require_once 'Card.php';
require_once 'Dealer.php';
require_once 'Deck.php';
require_once 'Player.php';


$dealer = new Dealer(new Blackjack(), new Deck());
$dealer->addPlayer(new Player('Ischa'));
$dealer->addPlayer(new Player('Merel'));
$dealer->playGame();

// echo var_dump($dealer->showDeck());
// $dealer->giveCardsToPlayer();
// $dealer->giveCardsToPlayer();
// echo var_dump($dealer->showPlayers());

// $firstScore = $dealer->getScore();
// if (in_array($firstScore, ['Blackjack', 'Busted'])) {
//     echo $firstScore . "! " . $player->showHand() . PHP_EOL;
//     exit();
// }

// // Start het spel
// $gameIsActive = true;
// while ($gameIsActive) {
//     $playAgain = readline("Nieuwe kaart (n) of stoppen (s)?... ");
//     if ($playAgain === 's') {
//         echo $player->getScore() . "! " . $player->showHand() . PHP_EOL;
//         $gameIsActive = false;
//         exit();
//     } elseif ($playAgain === 'n') {
//         $player->addCard($deck->drawCard());
//         echo "Je kreeg een " . $player->getLastCard()->show() . PHP_EOL;

//         // check if the user > 21 OR === 21
//         $score = $player->getScore();
//         if (
//             str_contains($score, 'Blackjack')
//             || str_contains($score, 'Busted') 
//             || str_contains($score, 'Twenty-One') 
//             || str_contains($score, 'Five Card Charlie')
//         ) {
//             echo $score . "! " . $player->showHand() . PHP_EOL;
//             $gameIsActive = false;
//             exit();
//         }
//     } else {
//         echo "Voer 'n' of 's' in" . PHP_EOL;
//     }
// }