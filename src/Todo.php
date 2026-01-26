<?php

class Todo
{
    private string $status = 'not begun';
    private string $created_at;


    public function __construct(
        private $id,
        private $name,
        private $description)
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function create(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "status" => $this->status,
            "createdAt" => $this->created_at
        ];
    }
}