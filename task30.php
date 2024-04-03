<?php

use strategies\ShooterCreationStrategy;

require_once 'StrategyContext.php';
require_once 'HeroFactory.php';

require __DIR__ . '/vendor/autoload.php';

$context = new StrategyContext(new ShooterCreationStrategy());
$strategyShooter = $context->executeCreation('Legolas', 100, 50, 50, null);

$factoryShooter = HeroFactory::createHero('Shooter', 'Legolas', 100, 50, 50, null);

echo "Strategy shooter: " . PHP_EOL;
print_r($strategyShooter);

echo "Factory shooter: " . PHP_EOL;
print_r($factoryShooter);

