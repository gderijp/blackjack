<?php

class Player
{
    private string $name;
    private array $hand = [];

    public function __construct(string $name)
    {
        $this->name = $name;
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
}
