<?php
require_once 'Hero.php';
require_once 'Weapon.php';
require_once 'heroes.php';

class HeroCreator
{
    private array $weapons = [];

    public function __construct()
    {
        $prepareWeapons = [
            'Shooter' => [['Gun', 50, 10], ['Crossbow', 20, 10], ['Bow', 10, 10]],
            'Fighter' => [['Sword', 40, 25], ['Knuckles', 30, 20], ['Axe', 35, 20]],
            'Killer' => [['Knifes', 30, 15], ['Poniards', 40, 25], ['Gun', 50, 10]],
            'Wizard' => [['Staff', 50, 25], ['Artefact', 55, 5]],
            'Tank' => [['Armor', 15, 50], ['Body', 10, 20]]
        ];
        foreach ($prepareWeapons as $class => $weapons) {
            foreach ($weapons as $weapon) {
                $this->weapons[$class][] = new Weapon($weapon[0], $weapon[1], $weapon[2]);
            }
        }
    }

    public function getWeapons(): array
    {
        return $this->weapons;
    }

    public function getDefaultWeaponsForClass(string $class, bool $rand): array|Weapon
    {
        if ($rand) {
            return $this->weapons[$class][array_rand($this->weapons[$class])];
        } else {
            return $this->weapons[$class];
        }
    }

    public function createHero(string $class, string $name, float $health, float $power, float $stamina, ?Weapon $weapon): Hero
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