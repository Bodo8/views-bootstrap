<?php


class DeadlineTask
{
    private $year;
    private $month;
    private $week;
    private $day;
    private $task;

    /**
     * DeadlineTask constructor.
     * @param $year
     * @param $month
     * @param $week
     * @param $day
     * @param $task
     */
    public function __construct(int $year, int $month, int $week, int $day, Task $task)
    {
        $this->year = $year;
        $this->month = $month;
        $this->week = $week;
        $this->day = $day;
        $this->task = $task;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @param int $month
     */
    public function setMonth(int $month): void
    {
        $this->month = $month;
    }

    /**
     * @return int
     */
    public function getWeek(): int
    {
        return $this->week;
    }

    /**
     * @param int $week
     */
    public function setWeek(int $week): void
    {
        $this->week = $week;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    /**
     * @param int $day
     */
    public function setDay(int $day): void
    {
        $this->day = $day;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @param Task $task
     */
    public function setTask(Task $task): void
    {
        $this->task = $task;
    }


}