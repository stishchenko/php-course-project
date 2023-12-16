<?php

abstract class Animal
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function sleeping(): void
    {
        echo "{$this->name} is sleeping...\n";
    }

    public abstract function makeVoice();

}

class Cat extends Animal
{
    public function makeVoice(): void
    {
        echo "{$this->name} say M-i-a-u\n";
    }
}

class Elephant extends Animal
{

    public function makeVoice(): void
    {
        echo "{$this->name} say U-u-u-u\n";
    }
}

class Tiger extends Animal
{

    public function makeVoice(): void
    {
        echo "{$this->name} say R-r-r-r\n";
    }
}

class Shark extends Animal
{
    public function makeVoice(): void
    {
        echo "{$this->name} doesn`t have voice.\n";
    }
}