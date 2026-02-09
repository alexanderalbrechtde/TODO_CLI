<?php

require_once('TodoAdministration.php');

$todoAdmin = new TodoAdministration();

$command = $argv[1] ?? null;
$arg1 = $argv[2] ?? null;
$arg2 = $argv[3] ?? null;
$arg3 = $argv[4] ?? null;

$output = match ($command) {
    'show-all' => $todoAdmin->getAllTodos(),
    'add' => $todoAdmin->addTodo($arg1, $arg2),
    'update' => $todoAdmin->updateTask($arg1, $arg2),
    default => 'unknown command'
};
echo $output;