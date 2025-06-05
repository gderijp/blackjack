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

    public function playGame()
    {
        $this->dealCardToAllPlayers();
        $this->dealCardToAllPlayers();

        // Check of iemand blackjack heeft aan het begin
        foreach ($this->players as $player) {
            $result = $this->checkIfPlayerHasBlackjack($player, $this->getScore($player));
            if ($result) {
                echo $result;
                foreach ($this->players as $player) {
                    echo $player->showHand() . "-> " . $this->getScore($player) . PHP_EOL;
                }
                exit();
            }
        }

        $dealer = $this->players[0];
        echo $dealer->showHand() . PHP_EOL;

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
                        if ($this->getScore($player) < 18) {
                            $this->giveCardToPlayer($player);
                            echo $player->name() . " pakt een " . $player->getLastCard()->show() . PHP_EOL;
                        } else {
                            $finishedPlayers[$player->name()] = $this->getScore($player);
                        }
                        $playAgain = false;
                        break;
                    }

                    $answer = readline($player->name() . "'s beurt. " . $player->showHand() . "'draw' or 'stop'?... ");
                    if ($answer == 'stop' || $answer == 's') {
                        $playAgain = false;
                        $finishedPlayers[$player->name()] = $this->getScore($player);
                    } elseif ($answer == 'draw' || $answer == 'd') {
                        $this->giveCardToPlayer($player);
                        echo $player->name() . " pakt een " . $player->getLastCard()->show() . PHP_EOL;

                        $score = $this->getScore($player);
                        if (str_contains($score, 'Busted') || str_contains($score, 'Twenty-One')) {
                            $playAgain = false;
                            $finishedPlayers[$player->name()] = $this->getScore($player);
                        } elseif (str_contains($score, 'Five Card Charlie')) {
                            echo $score . "! " . $player->showHand() . PHP_EOL;
                            $playAgain = false;
                            $finishedPlayers[$player->name()] = $this->getScore($player);
                            $gameIsActive = false;
                        }
                        $playAgain = false;
                    } else {
                        echo "Voer 'draw / d' of 'stop / s' in" . PHP_EOL;
                    }
                }
            }
            if (count($finishedPlayers) === (count($this->players))) {
                $gameIsActive = false;
            }
        }

        $winners = [];
        $dealerScore = $this->getScore($dealer);

        foreach ($this->players as $player) {
            $score = $this->getScore($player);
            if ($player->name() == 'Dealer') {
                if (str_contains($dealerScore, 'Busted')) {
                    echo $player->name() . " is " . $dealerScore . ': ' . $player->showHand() . PHP_EOL;
                }
                continue;
            }

            // Check of de speler gewonnen heeft
            if ($score === 'Busted') {
                continue;
            }
            if (null !== ($this->playerWon($player, $score, $dealerScore))) {
                $winners[] = $this->playerWon($player, $score, $dealerScore);
            }
        }

        // Check of dealer gewonnen heeft
        if (empty($winners)) {
            echo $dealer->name() . " wint! " . $dealer->showHand() . '-> ' . $dealerScore . PHP_EOL;
        } else {
            foreach ($winners as $winner) {
                echo $winner . " wint!" . PHP_EOL;
            }
        }

        // Geef de spelers' score weer
        foreach ($this->players as $player) {
            if ($player->name() == 'Dealer') {
                continue;
            }
            echo $player->showHand() . "-> " . $this->getScore($player) . PHP_EOL;
        }
    }

    private function getScore(Player $player): string
    {
        return $this->blackjack->scoreHand($player->hand());
    }

    private function playerWon(Player $player, string $playerScore, string $dealerScore)
    {
        if ($dealerScore === 'Busted') {
            return $player->name();
        } elseif (is_int($playerScore) && is_int($dealerScore) && $playerScore > $dealerScore) {
            return $player->name();
        } elseif ($playerScore === 'Twenty-One' && is_int($dealerScore)) {
            return $player->name();
        } elseif ($playerScore === 'Five Card Charlie') {
            return $player->name();
        } else {
            return;
        }
    }

    private function checkIfPlayerHasBlackjack($player, $score): string
    {
        if (str_contains($score, 'Blackjack')) {
            return $player->name() . " wint! " . $score . "!" . PHP_EOL;
        } else {
            return '';
        }
    }

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
}
