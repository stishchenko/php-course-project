<?php

abstract class StructureBase
{
    protected array $storage;

    public function __construct()
    {
        $this->storage = [];
    }

    abstract public function get();

    public function add($item): void
    {
        $this->storage[] = $item;
    }

    public function count(): int
    {
        return count($this->storage);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function clear(): void
    {
        $this->storage = [];
    }

}