<?php

class Author
{

    public int $author_id;
    public string $name;
    public string $surname;


    public function __construct($author_id, $name, $surname)
    {
        $this->author_id = $author_id;
        $this->name = $name;
        $this->surname = $surname;
    }
}