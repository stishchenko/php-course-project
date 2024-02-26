<?php
require_once 'Hero.php';

class Shooter extends Hero
{
    public string $class = 'Shooter';

    public function printHero(): string
    {
        return "$this->class $this->name";
    }
}

class Fighter extends Hero
{
    public string $class = 'Fighter';

    public function printHero(): string
    {
        return "$this->class $this->name";
    }
}

class Killer extends Hero
{
    public string $class = 'Killer';

    public function printHero(): string
    {
        return "$this->class $this->name";
    }

}

class Wizard extends Hero
{
    public string $class = 'Wizard';

    public function printHero(): string
    {
        return "$this->class $this->name";
    }
}

class Tank extends Hero
{
    public string $class = 'Tank';

    public function printHero(): string
    {
        return "$this->class $this->name";
    }
}