<?php

class DeadlineFactory
{
    private $year;
    private $month;
    private $week;
    private $day;
    private $task;

    public static function director()
    {
        return new DeadlineFactory();
    }

    public function withYear(int $year): int
    {
        $this->year = $year;
        return $this->year;
    }

    public function withMonth(int $month): int
    {
        $this->month = $month;
        return $this->month;
    }

    public function withWeek(int $week): int
    {
        $this->week = $week;
        return $this->week;
    }

    public function withDay(int $day): int
    {
        $this->day = $day;
        return $this->day;
    }

    public function withTask($task): Task
    {
        $this->task = $task;
        return $this->task;
    }

    public function create(): DeadlineTask
    {
        return new DeadlineTask($this->year, $this->month,
            $this->week, $this->day, $this->task);
    }

    public function createWithParameters(int $year, int $month, int $week,
                                         int $day, Task $task): DeadlineTask
    {
        $director = self::director();
        $director->withYear($year);
        $director->withMonth($month);
        $director->withWeek($week);
        $director->withDay($day);
        $director->withTask($task);
        return $director->create();
    }
}