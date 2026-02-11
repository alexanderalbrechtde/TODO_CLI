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

    public function addTodo(string $name, string $description): string
    {
        require_once('Todo.php');
        //Task erstellen
        $todo = new Todo($this->nextId, $name, $description);
        // task im Arrayformat hinzufügen
        $this->todos[] = $todo->create();
        $this->saveTodoFile();
        $this->nextId++;

        return 'ToDo successfully created!';
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

    public function getAllTodos(): string
    {
        //alle Aufgabennamen plus id ausgeben
        $todos = $this->getTodoFile();
        $output = '';

        foreach ($todos as $todo) {
            $output .= "-----------------------\n";
            $output .= "Todo: " . $todo['name'] . " ID: " . $todo['id'] . "\n";
            $output .= "-----------------------\n";
        }
        return $output;
    }

    public function updateTask(int $id, string $value): string
    {
        //Task updaten
        $todos = $this->getTodoFile();
        $found = false;

        foreach ($todos as &$todo) {
            if ($todo['id'] == $id) {
                $todo['name'] = $value;
                $found = true;
                break;
            }
        }
        if ($found) {
            $this->todos = $todos;
            $this->saveTodoFile();
            return 'ToDo successfully updated!';
        }
        return 'ToDo not updated!';
    }

    public function updateFlagDone(int $id): string
    {
        //statusflag auf done ändern

        $todos = $this->getTodoFile();
        $found = false;

        foreach ($todos as &$todo) {
            if ($todo['id'] == $id) {
                $todo['status'] = 'done';
                $found = true;
                break;
            }
        }
        if ($found) {
            $this->todos = $todos;
            $this->saveTodoFile();
            return 'ToDo marked done!';
        }
        return 'ToDo not found!';
    }

    public function updateFlagInProgress(int $id): string
    {
        //statusflag auf in progress ändern
        $todos = $this->getTodoFile();
        $found = false;

        foreach ($todos as &$todo) {
            if ($todo['id'] == $id) {
                $todo['status'] = 'in Progress';
                $found = true;
                break;
            }
        }
        if ($found) {
            $this->todos = $todos;
            $this->saveTodoFile();
            return 'ToDo marked in Progress!';
        }
        return 'ToDo not found!';
    }

    public function deleteTodo(int $id): string
    {
        $todos = $this->getTodoFile();

        //task anhand der id löschen
        foreach ($todos as $index => $todo) {
            if ($todo['id'] == $id) {
                unset($todos[$index]);
                $this->todos = array_values($todos);

                $this->saveTodoFile();
                return 'ToDo successfully deleted';
            }

        }
        return 'ToDo not found';
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