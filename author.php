<?php

class Author
{

// подключение к базе данных и таблице 'products'
    private $connection;
    private $table_name = "authors";

    public $author_id;
    public $name;
    public $surname;


// конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // метод read() - получение товаров
    function read()
    {

        $query = "SELECT authors.author_id, authors.name, authors.surname
                  FROM board_bd.authors";

        // подготовка запроса
        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }
    function randread()
    {

        $query = "SELECT authors.author_id, authors.name, authors.surname
                  FROM board_bd.authors
                  ORDER BY RAND()";

        // подготовка запроса
        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }

}