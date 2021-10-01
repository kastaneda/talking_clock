<?php

class UkrainianClock
{
    // Кількісні числівники жіночого роду
    const CARDINAL_NUMERALS = [
        0 => 'нуль',
        1 => 'одна',
        2 => 'дві',
        3 => 'три',
        4 => 'чотири',
        5 => 'п\'ять',
        6 => 'шість',
        7 => 'сім',
        8 => 'вісім',
        9 => 'дев\'ять',
        10 => 'десять',
        11 => 'одинадцять',
        12 => 'дванадцять',
        13 => 'тринадцять',
        14 => 'чотирнадцять',
        15 => 'п\'ятнадцять',
        16 => 'шістнадцять',
        17 => 'сімнадцять',
        18 => 'вісімнадцять',
        19 => 'дев\'ятнадцять',
        20 => 'двадцять',
        30 => 'тридцять',
        40 => 'сорок',
        50 => 'п\'ятдесят',
    ];

    // Порядкові числівники жіночого роду
    const ORDINAL_NUMERALS = [
        1 => 'перша',
        2 => 'друга',
        3 => 'третя',
        4 => 'четверта',
        5 => 'п\'ята',
        6 => 'шоста',
        7 => 'сьома',
        8 => 'восьма',
        9 => 'дев\'ята',
        10 => 'десята',
        11 => 'одинадцята',
        12 => 'дванадцята',
        13 => 'тринадцята',
        14 => 'чотирнадцята',
        15 => 'п\'ятнадцята',
        16 => 'шістнадцята',
        17 => 'сімнадцята',
        18 => 'вісімнадцята',
        19 => 'дев\'ятнадцята',
        20 => 'двадцята',
    ];

    const HOURS = 'година';
    const HOUR_ZERO = 'годин';

    const MINUTES = 'хвилин';
    const MINUTE_ONE = 'хвилина';
    const MINUTE_TWO = 'хвилини';

    public function __construct(
        protected \DateTimeInterface $dt,
    ) {}

    public function getHours(): array
    {
        $hour = (int) $this->dt->format('H');

        if ($hour == 0) {
            return [
                self::CARDINAL_NUMERALS[0],         // нуль
                self::HOUR_ZERO,                    // годин
            ];
        }

        if ($hour <= 20) {
            return [
                self::ORDINAL_NUMERALS[$hour],      // одинадцята
                self::HOURS,                        // година
            ];
        }

        return [
            self::CARDINAL_NUMERALS[20],            // двадцять
            self::ORDINAL_NUMERALS[$hour - 20],     // третя
            self::HOURS,                            // година
        ];
    }

    public function getMinutes(): array
    {
        $min = (int) $this->dt->format('i');
        $result = [];

        if ($min > 20) {
            $result[] = self::CARDINAL_NUMERALS[intdiv($min, 10) * 10];
            $min %= 10;
        }

        if ($min || empty($result)) {
            $result[] = self::CARDINAL_NUMERALS[$min];
        }

        if ($min == 1) {
            $result[] = self::MINUTE_ONE;           // одна хвилина
        } elseif ($min >= 2 && $min <= 4) {
            $result[] = self::MINUTE_TWO;           // три хвилини
        } else {
            $result[] = self::MINUTES;              // сім хвилин
        }

        return $result;
    }

    public function getClock(): array
    {
        return [...$this->getHours(), ...$this->getMinutes()];
    }

    public function __toString(): string
    {
        return join(' ', $this->getClock());
    }
}
