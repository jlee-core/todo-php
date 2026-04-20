<?php
class Todo
{
    private int $id;
    private string $title;
    private DateTime $createdAt;

    public function __construct(int $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
        $this->createdAt = new DateTime();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->createdAt->format('c'),
        ];
    }
    
    //データ復元用
    public static function fromArray(array $data): self
    {
        $todo = new self($data['id'], $data['title']);
        $todo->createdAt = new DateTime($data['created_at']);
        return $todo;
    }
}
