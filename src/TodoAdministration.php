<?php

class TodoAdministration
{
    private array $todos = [];
    private int $nextId = 1;
    private string $todoData = "./data/todos.json";


    public function __construct()
    {
        $this->todos = $this->getTodoFile();
        if (!empty($this->todos)) {
            $lastTodo = end($this->todos);
            $this->nextId = $lastTodo['id'] + 1;
        }
    }

    public function addTodo(string $name, string $description): void
    {
        require_once('Todo.php');
        //Task erstellen
        $todo = new Todo($this->nextId, $name, $description);
        // task im Arrayformat hinzufügen
        $this->todos[] = $todo->create();
        $this->saveTodoFile();
        $this->nextId++;

        echo 'ToDo successfully created';
    }

    public function saveTodoFile(): void
    {
        //Array in json speichern
        $jsonContent = json_encode($this->todos, JSON_PRETTY_PRINT);
        file_put_contents($this->todoData, $jsonContent);
    }

    public function getTodoFile(): array
    {
        $fileContent = file_get_contents($this->todoData);
        return json_decode($fileContent, true) ?? [];
    }

    public function getAllTodos(): array
    {

    }

    public function updateTask(): void
    {

    }

    public function updateFlagDone(): void
    {

    }

    public function updateFlagInProgress(): void
    {

    }

    public function deleteTodo(): void
    {

    }

    public function getAllDoneTodos(): void
    {

    }

    public function getAllInProgressTodos(): void
    {

    }

    public function getAllNotBegunTodos(): void
    {

    }

}