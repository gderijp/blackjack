<?php

class Card
{
    private string $suit;
    private string $value;

    public function __construct(string $suit, string $value)
    {
        $this->suit = $this->validateSuit($suit);
        $this->value = $this->validateValue($value);
    }

    public function show(): string
    {
        return $this->suit . $this->value;
    }

    public function score(): int
    {
        if (intval($this->value >= 2 && $this->value <= 10)) {
            return $this->value;
        }

        switch ($this->value) {
            case 'A':
                return 11;
                break;
            case 'K':
                return 10;
                break;
            case 'V':
                return 10;
                break;
            case 'B':
                return 10;
                break;
            default:
                throw new InvalidArgumentException("Invalid value" . PHP_EOL);
                break;
        }
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

    private function validateValue(string $value): string
    {
        if ($value >= 2 && $value <= 10) {
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
