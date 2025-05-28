<?php

class Card
{
    public string $suit;
    public string $value;

    public function __construct(string $suit, string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function show(): string
    {
        $suit = '';
        switch ($this->suit) {
            case 'harten':
                $suit = '♥';
                break;
            case 'klaveren':
                $suit = '♣';
                break;
            case 'ruiten':
                $suit = '♦';
                break;
            case 'schoppen':
                $suit = '♠';
                break;

            default:
                return 'fout' . PHP_EOL;
                break;
        }

        if ($this->value == 'koning') {
            $this->value = 'K';
        }

        if ($this->value == 'boer') {
            $this->value = 'B';
        }

        if ($this->value == 'vrouw') {
            $this->value = 'V';
        }

        return $suit . " " . $this->value . PHP_EOL;
    }
}
