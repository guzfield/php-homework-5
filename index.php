<?php
declare(strict_types=1);

function generateSchedule(int $year, int $month): void {
    $monthNames = [
        1 => 'Январь', 2 => 'Февраль', 3 => 'Март',
        4 => 'Апрель', 5 => 'Май', 6 => 'Июнь',
        7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь',
        10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь',
    ];
    
    $dayNames = [
        1 => 'Пн', 2 => 'Вт', 3 => 'Ср', 4 => 'Чт',
        5 => 'Пт', 6 => 'Сб', 7 => 'Вс',
    ];
    
    echo $monthNames[$month] . ' ' . $year . PHP_EOL;
    echo PHP_EOL;
    
    $daysInMonth = (int)date('t', strtotime("$year-$month-01"));
    $cycleDay = 0;

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $timestamp = strtotime("$year-$month-$day");
        $dayOfWeek = (int)date('N', $timestamp);
        $isWeekend = ($dayOfWeek >= 6);

        $isWorking = ($cycleDay === 0);

        if ($isWorking && $isWeekend) {
            echo "\033[33m{$day}({$dayNames[$dayOfWeek]})→\033[0m ";
            if ($dayOfWeek === 7) {
                echo PHP_EOL;
            }
            continue;
        }

        if ($isWorking) {
            echo "\033[32m{$day}({$dayNames[$dayOfWeek]})+\033[0m ";
        } else {
            echo "{$day}({$dayNames[$dayOfWeek]}) ";
        }

        if ($dayOfWeek === 7) {
            echo PHP_EOL;
        }

        $cycleDay = ($cycleDay + 1) % 3;
    }
    
    echo PHP_EOL;
}

generateSchedule(2026, 6);
