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
        exit();

        // TODO: Per speler (foreach) vraag of die speler een nieuwe kaart wil pakken, als speler geen kaart meer wil, door naar de volgende speler
        $gameIsActive = true;
        while ($gameIsActive === true) {
            $playAgain = readline("Nieuwe kaart (n) of stoppen (s)?... ");
            if ($playAgain === 's') {
                // echo $this->getScore() . "! " . $this->showHand() . PHP_EOL;
                $gameIsActive = false;
                exit();
            } elseif ($playAgain === 'n') {
                // $player->addCard($deck->drawCard());
                // echo "Je kreeg een " . $player->getLastCard()->show() . PHP_EOL;

                // // check if the user > 21 OR === 21
                // $score = $player->getScore();
                // if (
                //     str_contains($score, 'Blackjack')
                //     || str_contains($score, 'Busted')
                //     || str_contains($score, 'Twenty-One')
                //     || str_contains($score, 'Five Card Charlie')
                // ) {
                //     echo $score . "! " . $player->showHand() . PHP_EOL;
                //     $gameIsActive = false;
                //     exit();
                // }
            } else {
                echo "Voer 'n' of 's' in" . PHP_EOL;
            }
        }
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

    public function giveCardToPlayer(Player $player)
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
