<?php

class Card
{
    public string $suit;
    public int|string $value;

    public function __construct(string $suit, int|string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }
}
