<?php

require_once "StructureBase.php";
//Last In First Out
class Stack extends StructureBase
{
    public function get()
    {
        return array_pop($this->storage);
    }

}