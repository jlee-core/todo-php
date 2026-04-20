<?php
require_once __DIR__ . '/../Models/Todo.php';

class TodoService
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function getAll(): array
    {
        // 存在確認
        if (!file_exists($this->filePath)) {
            return [];
        }

        $json = file_get_contents($this->filePath);
        $data = json_decode($json, true) ?? [];

        $todos = [];

        foreach ($data as $item) {
            $todos[] = Todo::fromArray($item);
        }

        return $todos;
    }

    public function save(array $todos): void
    {
        $data = array_map(fn($t) => $t->toArray(), $todos);
        file_put_contents(
            $this->filePath,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }

    public function add(string $title): void
    {
        $todos = $this->getAll();
        $todo = new Todo(count($todos) + 1, $title);
        $todos[] = $todo;
        $this->save($todos);
    }

    public function delete(int $id): void
    {
        $todos = array_filter(
            $this->getAll(),
            fn($todo) => $todo->toArray()['id'] !== $id
        );
        
        $this->save(array_values($todos));
    }
}
