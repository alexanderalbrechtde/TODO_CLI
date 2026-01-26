<?php

class TaskAdministration
{
    private array $todos;
    private int $nextId;
    private string $todoData = "./data/todos.json";


    public function __construct()
    {
        $this->todos = $this->getTodoFile();
    }

    public function getAllTodos(): array
    {

    }


    public function addTodo(string $name, string $description): void
    {
        $task = new Task($this->nextId, $name, $description);
        $this->todos[] = $task->create();

        echo 'ToDo successfully created';
    }

    public function updateWorkingOnFlag(): void
    {

    }

    public function deleteTodo(): void
    {

    }

    public function getTodoFile()
    {
        //json decode json-file
    }

    public function getAllDoneTodos(): void
    {

    }

    public function getAllInProgressTodos(): void
    {

    }

    public function getAllNotBegunTodos: void
    {

    }

}