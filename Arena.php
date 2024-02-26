<?php
require_once 'Hero.php';

class Arena
{
    public function fight(Hero $hero1, Hero $hero2): Hero
    {
        while (!$hero1->isLoser() && !$hero2->isLoser()) {
            $hero2->defend($hero1->attack());
            $hero1->defend($hero2->attack());
        }
        if ($hero2->isLoser()) {
            return $hero1;
        } else {
            return $hero2;
        }
    }
}