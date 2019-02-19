<?php


require_once("../Entity/DeadlineTask.php");
require_once("../Entity/Task.php");

interface Database
{
    public function saveTask(int $year, int $month, int $week, int $day, Task $task);

    public function updateTask(int $year, int $month, int $week, int $day, Task $oldTask, Task $task);

    public function deleteTask(int $year, int $month, int $week, int $day, Task $task);

    public function createDeadlineTask(int $year, int $month, int $week,
                                       int $day, Task $task): DeadlineTask;

    public function createTask(int $taskId, string $description,
                               bool $importantTask): Task;

    public function getAllTask(): array;
}