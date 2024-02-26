<?php

abstract class Hero
{
    public string $name;
    public float $health;
    public float $power;
    public float $stamina;
    public string $weapon;

    public function __construct(string $name, float $health, float $power, float $stamina, string $weapon)
    {
        $this->name = $name;
        $this->health = $health;
        $this->power = $power;
        $this->stamina = $stamina;
        $this->weapon = $weapon;
    }

    public function attack(): float
    {
        return $this->power;
    }

    public function defend(float $attackPower): void
    {
        $this->health -= $attackPower;
        $this->stamina -= ($attackPower * 0.2);
    }

    public function isLoser(): bool
    {
        return $this->health <= 0 || $this->stamina <= 0;
    }

    public abstract function printHero(): string;
}