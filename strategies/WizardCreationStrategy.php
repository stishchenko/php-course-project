<?php

namespace strategies;

use InvalidArgumentException;
use models\Hero;
use models\Weapon;
use models\Wizard;

class WizardCreationStrategy extends HeroCreationStrategy
{
    public function createHero(string $name, float $health, float $power, float $stamina, ?Weapon $weapon): Hero
    {
        if ($health < 0 || $power < 0 || $stamina < 0) {
            throw new InvalidArgumentException('Invalid numerical hero parameters');
        }
        if ($weapon === null) {
            $weapon = new Weapon('Nothing', 0, 0);
        }

        return new Wizard($name, $health, $power, $stamina, $weapon);
    }
}