<?php

use models\Fighter;
use models\Killer;
use models\Shooter;
use models\Tank;
use models\Weapon;
use models\Hero;
use models\Wizard;

class HeroFactory
{
    public static function createHero(string $class, string $name, float $health, float $power, float $stamina, ?Weapon $weapon): Hero
    {
        if ($health < 0 || $power < 0 || $stamina < 0) {
            throw new InvalidArgumentException('Invalid numerical hero parameters');
        }
        if ($weapon === null) {
            $weapon = new Weapon('Nothing', 0, 0);
        }
        return match ($class) {
            'Shooter' => new Shooter($name, $health, $power, $stamina, $weapon),
            'Fighter' => new Fighter($name, $health, $power, $stamina, $weapon),
            'Killer' => new Killer($name, $health, $power, $stamina, $weapon),
            'Wizard' => new Wizard($name, $health, $power, $stamina, $weapon),
            'Tank' => new Tank($name, $health, $power, $stamina, $weapon),
            default => throw new InvalidArgumentException('Invalid class')
        };
    }

}