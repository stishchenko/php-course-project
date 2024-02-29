<?php

class Weapon
{
    public string $type;
    public float $damage;
    public float $defence;

    public function __construct(string $type, float $damage, float $defence)
    {
        $this->type = $type;
        $this->damage = $damage;
        $this->defence = $defence;
    }

}