<?php

namespace App\Helpers\Math;

class ArithmeticHelper
{
    public static function add(...$nums)
    {
        if (sizeof($nums) < 1) {
            throw new \InvalidArgumentException("Must have atleast 1 argument");
        }

        $sum = 0;
        foreach ($nums as $num) {
            if (!(is_float($num) || is_int($num))) {
                throw new \InvalidArgumentException("Argument can only be numeric");
            }
            $sum += $num;
        }
        return $sum;
    }

    public static function minus(...$nums)
    {
        if (sizeof($nums) < 1) {
            throw new \InvalidArgumentException("Must have atleast 1 argument");
        }

        if (!(is_float($nums[0]) || is_int($nums[0]))) {
            throw new \InvalidArgumentException("Argument can only be numeric");
        }

        $subtraction = $nums[0];
        foreach (array_slice($nums, 1) as $num) {
            if (!(is_float($num) || is_int($num))) {
                throw new \InvalidArgumentException("Argument can only be numeric");
            }
            $subtraction -= $num;
        }
        return $subtraction;
    }
}
