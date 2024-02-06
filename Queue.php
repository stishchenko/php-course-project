<?php
require_once "StructureBase.php";

//First In First Out
class Queue extends StructureBase
{
    public function get()
    {
        return array_shift($this->storage);
    }
}