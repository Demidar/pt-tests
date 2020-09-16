<?php

function sumBigIntegers(string $summand1, string $summand2): string
{
    // $summand1 будет длиннее или равно $summand2
    if (strlen($summand1) < strlen($summand2)) {
        $temp = $summand1;
        $summand1 = $summand2;
        $summand2 = $temp;
        unset($temp);
    }

    $result = [];

    // складываем цифры. Количество итерации равно длине $summand1
    for (
        $firstSummandDigitPostition = strlen($summand1) - 1,
            $secondSummandDigitPostition = strlen($summand2) - 1,
            $incrementNext = false;
        $firstSummandDigitPostition >= 0 || $incrementNext;
        $firstSummandDigitPostition--, $secondSummandDigitPostition--
    ) {
        $digit1 = 0;
        $digit2 = 0;
        if ($firstSummandDigitPostition >= 0) {
            // если дошло до этого места, значит сложение окончено
            // и нужно добавить единицу в начало результирующего массива, т.к. $incrementNext = true
            $digit1 = (int) ($summand1[$firstSummandDigitPostition]);
        }
        if ($secondSummandDigitPostition >= 0) {
            // если дошло до этого места, значит сложение прекратилось и происходит перенос цифр с первого слагаемого.
            $digit2 = (int) ($summand2[$secondSummandDigitPostition]);
        }

        $sum = $digit1 + $digit2 + ($incrementNext ? 1 : 0);

        $incrementNext = $sum >= 10;

        if ($firstSummandDigitPostition !== 0 || $sum !== 0 || $incrementNext) {
            array_unshift($result, $sum % 10);
        }
    }

    return implode('', $result);
}

function isEqual($val1, $val2): bool
{
    if($val1 !== $val2) {
        throw new RuntimeException("$val1 is not equal to $val2");
    }
    return true;
}


isEqual(sumBigIntegers('40', '80'), '120');

isEqual(sumBigIntegers('80', '40'), '120');

isEqual(sumBigIntegers('5', '7'),  '12');

isEqual(sumBigIntegers('15', '7'),  '22');

isEqual(sumBigIntegers(
        '122',
    '3555555'
),  '3555677');

isEqual(sumBigIntegers(
              '1222222222222222222222222222222222222',
    '35555555555555555555555555555555555555555555555'
),  '35555555556777777777777777777777777777777777777');

isEqual(sumBigIntegers(
    '7888',
    '2223'
), '10111');

isEqual(sumBigIntegers(
          '725252525252525252525252525252525252525252525',
    '100000284848484848484848484848484848484848484848484'
),  '100001010101010101010101010101010101010101010101009');
