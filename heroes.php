<?php
require_once 'Hero.php';

class Shooter extends Hero
{
    public string $class = 'Shooter';

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

class Fighter extends Hero
{
    public string $class = 'Fighter';

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

class Killer extends Hero
{
    public string $class = 'Killer';

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

class Wizard extends Hero
{
    public string $class = 'Wizard';

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