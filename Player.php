<?php

require_once 'Blackjack.php';

class Player
{
    private string $name;
    private array $hand = [];
    private Blackjack $blackjack;

    public function __construct(string $name, Blackjack $blackjack)
    {
        $this->name = $name;
        $this->blackjack = $blackjack;
    }

    public function addCard(Card $card)
    {
        $this->hand[] = $card;
    }

    public function showHand(): string
    {
        $cards = '';
        foreach ($this->hand as $card) {
            $cards .= $card->show() . " ";
        }

        return $this->name . " heeft " . $cards;
    }

    public function getScore(): string
    {
        return $this->blackjack->scoreHand($this->hand);
    }

    public function getLastCard(): Card
    {
        return end($this->hand);
    }
}
