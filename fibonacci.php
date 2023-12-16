<?php

function fibonacci(int $n): int
{
    if ($n == 1 || $n == 0) {
        return $n;
    }

    return fibonacci($n - 2) + fibonacci($n - 1);
}

function fib_rec_sum(int $n): int
{
    $sum = 0;

    for ($i = 0; $i < $n; $i++) {
        $sum += fibonacci($i);
    }
    return $sum;
}

function fib_rec_array_sum(int $n): int
{
    $fib_array = array();

    for ($i = 0; $i < $n; $i++) {
        $fib_array[$i] = fibonacci($i);
    }
    return array_sum($fib_array);
}

function fib_array_sum(int $n): int
{
    $fib_array = array(0, 1);
    for ($i = 2; $i < $n; $i++) {
        $fib_array[$i] = $fib_array[$i - 2] + $fib_array[$i - 1];
    }
    return array_sum($fib_array);
}