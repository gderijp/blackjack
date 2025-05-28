<?php

class Card
{
    private string $suit;
    private int|string $value;

    public function __construct(string $suit, int|string $value)
    {
        $this->suit = $this->validateSuit($suit);
        $this->value = $this->validateValue($value);
    }

    public function show(): string
    {
        return $this->suit . " " . $this->value . PHP_EOL;
    }

    private function validateSuit(string $suit): string
    {
        switch ($suit) {
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
                throw new InvalidArgumentException("Invalid suit given" . PHP_EOL);
                break;
        }

        return $suit;
    }

    private function validateValue(int|string $value): string
    {
        if (is_int($value) && $value >= 2 && $value <= 10) {
            return $value;
        } elseif (!is_int($value)) {
            switch ($value) {
                case 'aas':
                    return 'A';
                    break;
                case 'koning':
                    return 'K';
                    break;
                case 'vrouw':
                    return 'V';
                    break;
                case 'boer':
                    return 'B';
                    break;
                default:
                    throw new InvalidArgumentException("Error" . PHP_EOL);
                    break;
            }
        } else {
            throw new InvalidArgumentException("Value should be between 2 and 10" . PHP_EOL);
        }
    }
}
