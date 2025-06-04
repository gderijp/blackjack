<?php

require_once 'Blackjack.php';

class Dealer
{
    private Blackjack $blackjack;
    private Deck $deck;
    private array $players;

    public function __construct(Blackjack $blackjack, Deck $deck)
    {
        $this->addPlayer(new Player('Dealer'));
        $this->blackjack = $blackjack;
        $this->deck = $deck;
    }

    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    private function getScore()
    {
        foreach ($this->players as $player) {
            return $this->blackjack->scoreHand($player->hand());
        }
    }

    private function getScoreSubstitute(Player $player)
    {
        return $this->blackjack->scoreHand($player->hand());
    }

    private function checkIfPlayerHasBlackjack($player, $score)
    {
        if (str_contains($score, 'Blackjack')) {
            return $player->name() . " wint! " . $score . "!" . PHP_EOL;
        }
    }

    public function playGame()
    {
        $this->dealCardToAllPlayers();
        $this->dealCardToAllPlayers();

        // Check of iemand blackjack heeft
        foreach ($this->players as $player) {
            if ($this->checkIfPlayerHasBlackjack($player, $this->getScoreSubstitute($player))) {
                echo $this->checkIfPlayerHasBlackjack($player, $this->getScoreSubstitute($player));
                foreach ($this->players as $player) {
                    echo $player->showHand() . "-> " . $this->getScoreSubstitute($player) . PHP_EOL;
                }
                $gameIsActive = false;
                exit();
            }
        }

        echo $this->players[0]->showHand() . PHP_EOL;
        // echo $this->getScoreSubstitute($this->players[0]) . PHP_EOL;
        // exit();

        // TODO: Per speler (foreach) vraag of die speler een nieuwe kaart wil pakken, als speler geen kaart meer wil, door naar de volgende speler
        $finishedPlayers = [];
        $gameIsActive = true;
        while ($gameIsActive === true) {
            foreach ($this->players as $player) {
                if (isset($finishedPlayers[$player->name()])) {
                    continue;
                }

                $playAgain = true;
                while ($playAgain) {
                    if ($player->name() == 'Dealer') {
                        if ($this->getScoreSubstitute($player) <= 18) {
                            $this->giveCardToPlayer($player);
                            echo $player->name() . " pakt een " . $player->getLastCard()->show() . PHP_EOL;
                        } else {
                            $finishedPlayers[$player->name()] = true;
                        }
                        $playAgain = false;
                        break;
                    }

                    $answer = readline($player->name() . "'s beurt. " . $player->showHand() . "'draw' or 'stop'?... ");
                    if ($answer == 'stop' || $answer == 's') {
                        $playAgain = false;
                        $finishedPlayers[$player->name()] = true;
                    } elseif ($answer == 'draw' || $answer == 'd') {
                        $this->giveCardToPlayer($player);
                        echo $player->name() . " pakt een " . $player->getLastCard()->show() . PHP_EOL;

                        // check if the user > 21 OR === 21
                        $score = $this->getScoreSubstitute($player);
                        if (str_contains($score, 'Busted') || str_contains($score, 'Twenty-One')) {
                            $playAgain = false;
                            $finishedPlayers[$player->name()] = true;
                        } elseif (str_contains($score, 'Five Card Charlie')) {
                            echo $score . "! " . $player->showHand() . PHP_EOL;
                            $playAgain = false;
                            $finishedPlayers[$player->name()] = true;
                            $gameIsActive = false;
                        }
                    } else {
                        echo "Voer 'draw / d' of 'stop / s' in" . PHP_EOL;
                    }
                }
            }
            // echo var_dump($finishedPlayers);
            if (count($finishedPlayers) === (count($this->players))) {
                $gameIsActive = false;
            }
        }

        foreach ($this->players as $player) {
            echo $player->showHand() . "-> " . $this->getScoreSubstitute($player) . PHP_EOL;
            // echo $this->getScoreSubstitute($player) . PHP_EOL;
        }


        // while ($gameIsActive === true) {
        //     $playAgain = readline("Nieuwe kaart (n) of stoppen (s)?... ");
        //     if ($playAgain === 's') {
        //         // echo $this->getScore() . "! " . $this->showHand() . PHP_EOL;
        //         $gameIsActive = false;
        //         exit();
        //     } elseif ($playAgain === 'n') {
        //         // $player->addCard($deck->drawCard());
        //         // echo "Je kreeg een " . $player->getLastCard()->show() . PHP_EOL;

        //         // // check if the user > 21 OR === 21
        //         // $score = $player->getScore();
        //         // if (
        //         //     str_contains($score, 'Blackjack')
        //         //     || str_contains($score, 'Busted')
        //         //     || str_contains($score, 'Twenty-One')
        //         //     || str_contains($score, 'Five Card Charlie')
        //         // ) {
        //         //     echo $score . "! " . $player->showHand() . PHP_EOL;
        //         //     $gameIsActive = false;
        //         //     exit();
        //         // }
        //     } else {
        //         echo "Voer 'n' of 's' in" . PHP_EOL;
        //     }
        // }
    }

    // public function playGame()
    // {
    //     $gameIsActive = true;
    //     while ($gameIsActive) {
    //         $playAgain = readline("Nieuwe kaart (n) of stoppen (s)?... ");
    //         if ($playAgain === 's') {
    //             echo $this->getScore() . "! " . $this->showHand() . PHP_EOL;
    //             $gameIsActive = false;
    //             exit();
    //         } elseif ($playAgain === 'n') {
    //             $player->addCard($deck->drawCard());
    //             echo "Je kreeg een " . $player->getLastCard()->show() . PHP_EOL;

    //             // check if the user > 21 OR === 21
    //             $score = $player->getScore();
    //             if (
    //                 str_contains($score, 'Blackjack')
    //                 || str_contains($score, 'Busted')
    //                 || str_contains($score, 'Twenty-One')
    //                 || str_contains($score, 'Five Card Charlie')
    //             ) {
    //                 echo $score . "! " . $player->showHand() . PHP_EOL;
    //                 $gameIsActive = false;
    //                 exit();
    //             }
    //         } else {
    //             echo "Voer 'n' of 's' in" . PHP_EOL;
    //         }
    //     }
    // }

    private function giveCardToPlayer(Player $player)
    {
        $player->addCard($this->deck->drawCard());
    }

    private function dealCardToAllPlayers()
    {
        foreach ($this->players as $player) {
            $player->addCard($this->deck->drawCard());
        }
    }

    public function showDeck(): Deck
    {
        return $this->deck;
    }

    public function showPlayers(): array
    {
        return $this->players;
    }
}
