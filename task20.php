<?php
require_once 'heroes.php';
require 'Arena.php';

$arena = new Arena();
$shooter = new Shooter('Mike', 100, 20, 100, 'Gun');
$fighter = new Fighter('John', 100, 30, 100, 'Sword');
$winner = $arena->fight($shooter, $fighter);
echo "In battle of {$shooter->printHero()} and {$fighter->printHero()} the winner is $winner->class $winner->name" .
    PHP_EOL;

$wizard = new Wizard('Harry', 100, 40, 100, 'Staff');
$tank = new Tank('Tom', 200, 20, 200, 'Armor');
$winner = $arena->fight($wizard, $tank);
echo "In battle of {$wizard->printHero()} and {$tank->printHero()} the winner is $winner->class $winner->name" .
    PHP_EOL;

$killer = new Killer('Jack', 100, 60, 100, 'Knifes');
$shooter = new Shooter('Stan', 100, 20, 100, 'Gun');
$winner = $arena->fight($killer, $shooter);
echo "In battle of {$killer->printHero()} and {$shooter->printHero()} the winner is $winner->class $winner->name" .
    PHP_EOL;