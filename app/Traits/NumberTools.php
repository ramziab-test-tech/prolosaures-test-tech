<?php

namespace App\Traits;

trait NumberTools {

    protected function isValidNumber($num, $fail): bool {
        $num = (int) $num;
        if ($num < config('constants.ALTITUDE.MIN') || $num > config('constants.ALTITUDE.MAX')) {
            $fail("Chaque nombre doit être un entier compris entre 0 et 100000.");
            return false;
        }

        return true;
    }
}
