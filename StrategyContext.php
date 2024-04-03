<?php

use models\Hero;
use models\Weapon;
use strategies\HeroCreationStrategy;

class StrategyContext
{
    private HeroCreationStrategy $strategy;

    public function __construct(HeroCreationStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeCreation(string $name, float $health, float $power, float $stamina, ?Weapon $weapon): Hero
    {
        return $this->strategy->createHero($name, $health, $power, $stamina, $weapon);
    }

}