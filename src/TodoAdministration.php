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
        //alle Aufgabennamen plus id ausgeben
    }

    public function updateTask(): void
    {
        //Task updaten
    }

    public function updateFlagDone(): void
    {
        //statusflag auf done ändern
    }

    public function updateFlagInProgress(): void
    {
        //statusflag auf in progress ändern
    }

    public function deleteTodo(): void
    {
        //task anhand der id löschen
    }

    public function getAllDoneTodos(): void
    {
        //alle todos mit der statusflag done ausgeben
    }

    public function getAllInProgressTodos(): void
    {
        //alle todos mit der statusflag in progress ausgeben
    }

    public function getAllNotBegunTodos(): void
    {
        //alle todos mit der statusflag not begun ausgeben
    }

}