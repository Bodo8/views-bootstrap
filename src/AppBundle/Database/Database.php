<?php


interface Database
{
    public function saveTask(DeadlineTask $deadlineTask);

    public function getTaskForToday(int $year, int $month, int $week, int $day);

    public function createDeadlineTask(int $year, int $month, int $week,
                                       int $day, Task $task): DeadlineTask;

    public function createTask(string $description,
                               bool $importantTask): Task;


}