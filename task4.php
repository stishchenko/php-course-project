<?php
include "Animal.php";

$cat = new Cat("Kate");
echo "The cat was created. Her name is " . $cat->getName() . ".\n";
$cat->sleeping();
$cat->makeVoice();
echo "-------------------------------------------\n";
$elephant = new Elephant("John");
echo "The elephant was created. His name is " . $elephant->getName() . ".\n";
$elephant->sleeping();
$elephant->makeVoice();
echo "-------------------------------------------\n";
$tiger = new Tiger("Alan");
echo "The tiger was created. His name is " . $tiger->getName() . ".\n";
$tiger->sleeping();
$tiger->makeVoice();
echo "-------------------------------------------\n";
$shark = new Shark("Teresa");
echo "The shark was created. Her name is " . $shark->getName() . ".\n";
$shark->sleeping();
$shark->makeVoice();
echo "-------------------------------------------\n";