<?php

require_once 'Card.php';

class Deck
{
    private array $cards = [];

    public function __construct()
    {
        $suit = ['harten', 'klaveren', 'ruiten', 'schoppen'];
        $deck = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'koning', 'vrouw', 'boer', 'aas'];

        for ($i = 0; $i < sizeof($deck); $i++) {
            for ($j = 0; $j < sizeof($suit); $j++) {
                $this->cards[] = new Card($suit[$j], $deck[$i]);
            }
        }
    }

    public function drawCard(): Card
    {
        shuffle($this->cards);
        $randomKey = array_rand($this->cards);
        $randomCard = $this->cards[$randomKey];
        unset($this->cards[$randomKey]);

        try {
            if (empty($this->cards)) {
                throw new Exception("Stapel is leeg") . PHP_EOL;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        return $randomCard;
    }
}
