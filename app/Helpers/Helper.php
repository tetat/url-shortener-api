<?php

namespace App\Helpers;

class Helper
{
    public static function randomString(int $length = 1): string
    {
        $randomStr = '';
        for ($i = 0; $i < $length; $i++) {
            $randomStr .= ($i%2 === 0) ? 
            fake()->randomLetter() : 
            fake()->randomDigit();
        }
        return $randomStr;
    }
}
