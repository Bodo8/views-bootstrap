<?php


class Task
{
    private $taskId;
    private $description;
    private $importantTask;

    /**
     * Task constructor.
     * @param $taskId
     * @param $description
     * @param $importantTask
     */
    public function __construct($taskId = null, string $description, bool $importantTask)
    {
        $this->description = $description;
        $this->importantTask = $importantTask;
        if ($taskId) {
            $this->taskId = $taskId;
        }
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isImportantTask(): bool
    {
        return $this->importantTask;
    }

}