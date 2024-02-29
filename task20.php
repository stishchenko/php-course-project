<?php
require_once 'Hero.php';
require_once 'Weapon.php';
require_once 'heroes.php';
require_once 'HeroCreator.php';
require 'Arena.php';

$heroCreator = new HeroCreator();

$arena = new Arena();
$shooter = $heroCreator->createHero('Shooter', 'Mike', 100, 20, 100,
    $heroCreator->getDefaultWeaponsForClass('Shooter', true));
$fighter = $heroCreator->createHero('Fighter', 'John', 100, 30, 100,
    $heroCreator->getDefaultWeaponsForClass('Fighter', true));
echo '-------------------------------------------------' . PHP_EOL;
echo "The battle between {$shooter->printHero()} and {$fighter->printHero()} is beginning" . PHP_EOL;
$winner = $arena->fight($shooter, $fighter);
echo "In battle of {$shooter->printHero()} and {$fighter->printHero()} the winner is {$winner->printHero()}" .
    PHP_EOL;

$wizard = $heroCreator->createHero('Wizard', 'Harry', 100, 40, 100,
    $heroCreator->getDefaultWeaponsForClass('Wizard', true));
$tank = $heroCreator->createHero('Tank', 'Tom', 200, 20, 200,
    $heroCreator->getDefaultWeaponsForClass('Tank', true));
echo '-------------------------------------------------' . PHP_EOL;
echo "The battle between {$wizard->printHero()} and {$tank->printHero()} is beginning" . PHP_EOL;
$winner = $arena->fight($wizard, $tank);
echo "In battle of {$wizard->printHero()} and {$tank->printHero()} the winner is {$winner->printHero()}" .
    PHP_EOL;

$killer = $heroCreator->createHero('Killer', 'Jack', 100, 60, 100,
    $heroCreator->getDefaultWeaponsForClass('Killer', true));
$shooter = $heroCreator->createHero('Shooter', 'Mike', 100, 20, 100,
    $heroCreator->getDefaultWeaponsForClass('Shooter', true));
echo '-------------------------------------------------' . PHP_EOL;
echo "The battle between {$killer->printHero()} and {$shooter->printHero()} is beginning" . PHP_EOL;
$winner = $arena->fight($killer, $shooter);
echo "In battle of {$killer->printHero()} and {$shooter->printHero()} the winner is {$winner->printHero()}" .
    PHP_EOL;