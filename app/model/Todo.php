<?php
class Todo
{
    private $id;
    private $title;
    private $createdAt;

    public function __construct($title)
    {
        $this->title = $title;
        $this->createdAt = new DateTime();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
