<?php

class Product_photo
{

// подключение к базе данных и таблице 'products'
    private $connection;
    private $table_name = "product_photos";

// свойства объекта q почему мы объявляем их как свойства, а не работаем с массивом


    public $photo_id;
    public $ad_id;

// конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // метод read() - получение товаров
    function read()
    {
        $query = "";

        // подготовка запроса
        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }

}