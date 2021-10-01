<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class UkrainianClockTest extends TestCase
{
    /**
     * @dataProvider timeExamples
     */
    public function testClock($time, $expectedResult): void
    {
        $clock = new \UkrainianClock(new \DateTime($time));
        $this->assertSame($expectedResult, (string) $clock);
    }

    public function timeExamples()
    {
        return [
            ['0:00', 'нуль годин нуль хвилин'],
            ['1:01', 'перша година одна хвилина'],
            ['7:32', 'сьома година тридцять дві хвилини'],
            ['12:40', 'дванадцята година сорок хвилин'],
            ['23:13', 'двадцять третя година тринадцять хвилин'],
        ];
    }
}

