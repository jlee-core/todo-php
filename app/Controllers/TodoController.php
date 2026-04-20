<?php

require_once __DIR__ . '/../Services/TodoService.php';

class TodoController
{
    private TodoService $service;

    public function __construct()
    {
        $this->service = new TodoService(__DIR__ . '/../../todos.json');
    }

    public function index(): array {
        return $this->service->getAll();
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');

        if ($title !== '') {
            $this->service->add($title);
        }

        header('Location: index.php');
        exit;
    }

    public function delete(): void {
        $id = (int)($_GET['delete'] ?? 0);

        if ($id > 0) {
            $this->service->delete($id);
        }

        header('Location: index.php');
        exit;
    }
}
