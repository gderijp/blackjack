<?php

require_once('Card.php');

$card1 = new Card('klaveren', 'boer');
echo $card1->show();

$card2 = new Card('schoppen', 'aas');
echo $card2->show();

$card3 = new Card('harten', 8);
echo $card3->show();

$card4 = new Card('schoffels', 2);
echo $card4->show();