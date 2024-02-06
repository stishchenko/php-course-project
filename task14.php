<?php
include "Stack.php";
include "Queue.php";

//test Stack
testStack();
echo "-------------------------------" . PHP_EOL;
//test Queue
testQueue();

function testStack(): void
{
    $stackArray = new Stack();
    echo "Created stack is empty: " . ($stackArray->isEmpty() ? "true" : "false") . PHP_EOL;
    for ($i = 0; $i < 5; $i ++) {
        $stackArray->add($i);
    }
    $counter = $stackArray->count();
    echo "Add several values. Stack size is " . $counter . PHP_EOL;
    echo "Get 2 values: ";
    for ($i = 0; $i < 2; $i ++) {
        echo $stackArray->get() . " ";
    }
    echo PHP_EOL . "Current size is " . $stackArray->count() . PHP_EOL;
    $stackArray->clear();
    echo "Clear stack. It is empty: " . ($stackArray->isEmpty() ? "true" : "false") . PHP_EOL;
}

function testQueue(): void
{
    $queueArray = new Queue();
    echo "Created queue is empty: " . ($queueArray->isEmpty() ? "true" : "false") . PHP_EOL;
    for ($i = 0; $i < 5; $i ++) {
        $queueArray->add($i);
    }
    $counter = $queueArray->count();
    echo "Add several values. Queue size is " . $counter . PHP_EOL;
    echo "Get 2 values: ";
    for ($i = 0; $i < 2; $i ++) {
        echo $queueArray->get() . " ";
    }
    echo PHP_EOL . "Current size is " . $queueArray->count() . PHP_EOL;
    $queueArray->clear();
    echo "Clear queue. It is empty: " . ($queueArray->isEmpty() ? "true" : "false") . PHP_EOL;
}


