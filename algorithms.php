<?php

function insertionSort($arrayToSort): array|null
{
    if ($arrayToSort == null) {
        return null;
    }
    $n = count($arrayToSort);
    if ($n < 2) {
        return $arrayToSort;
    } elseif ($n === 2) {
        if ($arrayToSort[0] > $arrayToSort[1]) {
            return [$arrayToSort[1], $arrayToSort[0]];
        } else {
            return $arrayToSort;
        }
    }

    for ($i = 0; $i < $n; $i ++) {
        $val = $arrayToSort[$i];
        $j = $i - 1;
        while ($j >= 0 && $arrayToSort[$j] > $val) {
            $arrayToSort[$j + 1] = $arrayToSort[$j];
            $j --;
        }
        $arrayToSort[$j + 1] = $val;
    }

    return $arrayToSort;
}

function quickSort($arrayToSort): array|null
{
    if ($arrayToSort == null) {
        return null;
    }
    $n = count($arrayToSort);
    if ($n < 2) {
        return $arrayToSort;
    } elseif ($n === 2) {
        if ($arrayToSort[0] > $arrayToSort[1]) {
            return [$arrayToSort[1], $arrayToSort[0]];
        } else {
            return $arrayToSort;
        }
    }

    $pivot = $arrayToSort[0];
    $left = array();
    $right = array();
    for ($i = 1; $i < $n; $i ++) {
        if ($arrayToSort[$i] < $pivot) {
            $left[] = $arrayToSort[$i];
        } else {
            $right[] = $arrayToSort[$i];
        }
    }
    return array_merge(quickSort($left), [$pivot], quickSort($right));
}

function searchSmallestWithoutSort($array): int|null
{
    if (empty($array)) {
        return null;
    }
    if (count($array) === 1) {
        return $array[0];
    }
    $min = $array[0];
    for ($i = 1; $i < count($array); $i ++) {
        if ($array[$i] < $min) {
            $min = $array[$i];
        }
    }

    return $min;
}