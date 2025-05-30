<?php

class Blackjack
{
    public function scoreHand(array $hand): string
    {
        $score = 0;
        $sumCards = count($hand);

        foreach ($hand as $card) {
            $score += $card->score();
        }

        if ($score === 21 && $sumCards === 2) {
            return 'Blackjack';
        }
        if ($sumCards > 2 && $score === 21) {
            return 'Twenty-One';
        }
        if ($sumCards === 5 && $score < 21) {
            return 'Five Card Charlie';
        }
        if ($score > 21) {
            return 'Busted';
        }

        return $score;
    }
}
