<?php
include "algorithms.php";

/*testSorts([3, 10, 5, 4, 6, 3, 7, 2, 17, 5]);
testSorts([]);
testSorts([1]);
testSorts([1, 2]);
testSorts([3, 2]);
testSorts(null);*/

$a = [3, 10, 5, 4, 6, 3, 7, 2, 17, 5];
search_smallest($a);
echo "Search the smallest item in the same array without sorting: " . searchSmallestWithoutSort($a) . PHP_EOL;
echo "---------------------" . PHP_EOL;

function search_smallest($a): void
{
    $insertionArray = insertionSort($a);
    $quickArray = quickSort($a);
    echo "Array to search the smallest number: ";
    echo print_array_or_empty($a);
    echo "---Results---" . PHP_EOL;
    echo "Insertion Sort: " . $insertionArray[0] . PHP_EOL;
    echo "Quick Sort: " . $quickArray[0] . PHP_EOL;
    echo "---------------------" . PHP_EOL;
}


function testSorts($a): void
{
    echo "Array to sort: ";
    print_array_or_empty($a);
    echo "---Results---" . PHP_EOL;
    echo "Insertion Sort: ";
    print_array_or_empty(insertionSort($a));
    echo "Quick Sort: ";
    print_array_or_empty(insertionSort($a));
    echo "---------------------" . PHP_EOL;
}

function print_array_or_empty($array): void
{
    if (empty($array)) {
        echo "Array is empty" . PHP_EOL;
    } else {
        foreach ($array as $value) {
            echo $value . " ";
        }
        echo PHP_EOL;
    }
}