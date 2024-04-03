<?php

namespace models;

class Arena
{
    public function fight(Hero $hero1, Hero $hero2): Hero
    {
        while (!$hero1->isLoser() && !$hero2->isLoser()) {
            $hero1->say();
            $hero2->defend($hero1->attack());
            $hero2->say();
            $hero1->defend($hero2->attack());
        }
        if ($hero2->isLoser()) {
            $hero1->sayOnWin();
            $hero2->sayOnLose();
            return $hero1;
        } else {
            $hero2->sayOnWin();
            $hero1->sayOnLose();
            return $hero2;
        }
    }
}