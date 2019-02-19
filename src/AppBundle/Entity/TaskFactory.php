<?php


class TaskFactory
{
    private $taskId;
    private $description;
    private $importantTask;

    public static function director(): TaskFactory
    {
        return new TaskFactory();
    }

    public function withId(int $taskId): int
    {
        $this->taskId = $taskId;
        return $this->taskId;
    }

    public function withDescription(string $description): string
    {
        $this->description = $description;
        return $this->description;
    }

    public function withImportantTask(bool $importantTask): bool
    {
        $this->importantTask = $importantTask;
        return $this->importantTask;
    }

    public function create(): Task
    {
        return new Task($this->taskId, $this->description, $this->importantTask);
    }

    public function createWithId(int $taskId, string $description, bool $importantTask): Task
    {
        $director = self::director();
        $director->withId($taskId);
        $director->withDescription($description);
        $director->withImportantTask($importantTask);
        return $director->create();
    }

    public function createWithoutId(string $description, bool $importantTask): Task
    {
        $director = self::director();
        $director->withDescription($description);
        $director->withImportantTask($importantTask);
        return $director->create();
    }
}

