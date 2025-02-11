<?php

namespace Test\Unit;

use App\Helpers\Math\ArithmeticHelper;
use PHPUnit\Framework\TestCase;

class ArithmeticHelperTest extends TestCase
{
    public function test_add_can_sum_numbers_up()
    {
        $num1 = 5;
        $num2 = 10;
        $sum = $num1 + $num2;

        $result = ArithmeticHelper::add($num1, $num2);

        $this->assertSame($sum, $result, 'Does not add numbers correctly');
    }

    public function test_add_can_take_in_multiple_numbers() {}

    public function test_add_can_only_take_in_numeric_arguments() {}

    public function test_add_needs_at_least_one_argument() {}
}
