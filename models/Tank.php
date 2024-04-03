<?php

namespace models;

use models\Hero;

class Tank extends Hero
{
    public string $class = 'Tank';

    public function printHero(): string
    {
        return "$this->class $this->name";
    }

    public function say(): void
    {
        echo $this->printHero() . ': ' . $this->getRandomPhrase() . PHP_EOL;
    }

    public function sayOnWin(): void
    {
        echo $this->printHero() . ': ' . $this->getRandomPhrase('win') . PHP_EOL;
    }

    public function sayOnLose(): void
    {
        echo $this->printHero() . ': ' . $this->getRandomPhrase('lose') . PHP_EOL;
    }
}