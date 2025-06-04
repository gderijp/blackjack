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

    public function name(): string
    {
        return $this->name;
    }

    public function hand(): array
    {
        return $this->hand;
    }

    public function getLastCard(): Card
    {
        return end($this->hand);
    }
}
