<?php

namespace App\Services;

class ProtectedAreaCalculator
{
    public function getProtectedAreaCount(string $altitudes): int
    {
        return $this->calculateProtectedArea($this->stringToGenerator($altitudes));
    }

    private function stringToGenerator(string $altitudes): \Generator
    {
        $number = '';
        for ($i = 0, $length = strlen($altitudes); $i < $length; $i++) {
            $char = $altitudes[$i];

            if ($char === ' ') {
                if ($number !== '') {
                    yield (int) $number;
                    $number = null;
                }
            } else {
                $number .= $char;
            }
        }

        if ($number !== null) {
            yield (int) $number;
        }
    }

    private function calculateProtectedArea(\Generator $generator): int
    {
        $prev = null;
        $areaCount = 0;
        foreach ($generator as $item) {

            if($prev === null) {
                $prev = $item;
                continue;
            }
            if($prev > $item) {
                $areaCount++;
                continue;
            }

            $prev = $item;
        }

        return $areaCount;
    }
}
