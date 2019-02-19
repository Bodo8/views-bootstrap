<?php


class InSqlDatabase implements Database
{

    public function saveTask(int $year, int $month, int $week, int $day, Task $task)
    {
        // TODO: Implement saveTask() method.
    }

    public function updateTask(int $year, int $month, int $week, int $day, Task $oldTask, Task $task)
    {
        // TODO: Implement updateTask() method.
    }

    public function deleteTask(int $year, int $month, int $week, int $day, Task $task)
    {
        // TODO: Implement deleteTask() method.
    }

    public function createDeadlineTask(int $year, int $month, int $week, int $day, Task $task): DeadlineTask
    {
        // TODO: Implement createDeadlineTask() method.
    }

    public function createTask(int $taskId, string $description, bool $importantTask): Task
    {
        // TODO: Implement createTask() method.
    }

    public function getAllTask(): array
    {
        // TODO: Implement getAllTask() method.
    }
}