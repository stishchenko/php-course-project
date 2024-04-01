<?php

require_once 'Weapon.php';

abstract class Hero
{
    private static array $phrases = [
        'win' => ['I am the best!', 'I am the champion!', 'Best of the best!'],
        'lose' => ['I will be back!', 'I will win next time!', 'Hard luck!'],
        'say' => ['I won`t stop!', 'I will win!', 'Fight till the end!', 'I am super powerful!', 'Be careful!']
    ];

    public string $name;
    public float $health;
    public float $power; //base damage/loss per attack
    public float $stamina;
    public Weapon $weapon;

    public function __construct(string $name, float $health, float $power, float $stamina, Weapon $weapon)
    {
        $this->name = $name;
        $this->health = $health;
        $this->power = $power;
        $this->stamina = $stamina;
        $this->weapon = $weapon;
    }

    public function setWeapon(Weapon $weapon): void
    {
        $this->weapon = $weapon;
    }


    public function attack(): float
    {
        return $this->power + $this->weapon->damage;
    }

    public function defend(float $attackPower): void
    {
        $attackPower -= $this->weapon->defence;
        $this->health -= $attackPower;
        $this->stamina -= ($attackPower * 0.2);
    }

    public function isLoser(): bool
    {
        return $this->health <= 0 || $this->stamina <= 0;
    }

    protected function getRandomPhrase(string $for = 'say'): string
    {
        return self::$phrases[$for][array_rand(self::$phrases[$for])];
    }

    public abstract function say(): void;

    public abstract function sayOnWin(): void;

    public abstract function sayOnLose(): void;

    public abstract function printHero(): string;
}