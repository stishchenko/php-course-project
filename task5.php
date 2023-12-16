<?php

include "fibonacci.php";

$n = 10;
$start_time = time();
echo "Fibonacci sum for {$n} elements with recursion = " . fib_rec_sum($n) . ".\n";
echo "Recursion execution time = " . (time() - $start_time) . ".\n";
$start_time = time();
echo "Fibonacci sum for {$n} elements with recursion and array = " . fib_rec_array_sum($n) . ".\n";
echo "Recursion with array execution time = " . (time() - $start_time) . ".\n";
$start_time = time();
echo "Fibonacci sum for {$n} elements with loops only = " . fib_array_sum($n) . ".\n";
echo "Loop execution time = " . (time() - $start_time) . ".\n";
echo "-------------------------------------------\n";
$n = 25;
$start_time = time();
echo "Fibonacci sum for {$n} elements with recursion = " . fib_rec_sum($n) . ".\n";
echo "Recursion execution time = " . (time() - $start_time) . ".\n";
$start_time = time();
echo "Fibonacci sum for {$n} elements with recursion and array = " . fib_rec_array_sum($n) . ".\n";
echo "Recursion with array execution time = " . (time() - $start_time) . ".\n";
$start_time = time();
echo "Fibonacci sum for {$n} elements with loops only = " . fib_array_sum($n) . ".\n";
echo "Loop execution time = " . (time() - $start_time) . ".\n";
echo "-------------------------------------------\n";
$n = 34;
$start_time = time();
echo "Fibonacci sum for {$n} elements with recursion = " . fib_rec_sum($n) . ".\n";
echo "Recursion execution time = " . (time() - $start_time) . ".\n";
$start_time = time();
echo "Fibonacci sum for {$n} elements with recursion and array = " . fib_rec_array_sum($n) . ".\n";
echo "Recursion with array execution time = " . (time() - $start_time) . ".\n";
$start_time = time();
echo "Fibonacci sum for {$n} elements with loops only = " . fib_array_sum($n) . ".\n";
echo "Loop execution time = " . (time() - $start_time) . ".\n";
echo "-------------------------------------------\n";
echo "According to research array solution is faster than recursion solution although recursion looks better. The best way is to avoid recursion in such tasks";