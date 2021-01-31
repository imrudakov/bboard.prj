<?php

class Ad
{

// подключение к базе данных и таблице 'products'
    private $connection;
    private $table_name = "ads";

// свойства объекта q почему мы объявляем их как свойства, а не работаем с массивом
    public $ad_id;
    public $author_id;
    public $title;
    public $description;
    public $price;
    public $publication_date;

    public $author_name;
    public $author_surname;

    public $photo;

// конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // метод read() - получение товаров
    function read()
    {

        /*
        $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        FROM " . $this->table_name . " as p ! LEFT JOIN categories c ! ON p.category_id = c.id ORDER BY p.created DESC";
        q почему использовались с и p вместо полных имен?
        q почему categories объявли не в класе? !!
        */

        // выбираем все записи
        // q Как нужно выравнивать запрос?
        // q как правильно? authors as authors

        $query = "SELECT ads.ad_id, ads.author_id, ads.title, ads.description, ads.price, ads.publication_date
                  FROM " . $this->table_name . " as ads 
                  LEFT JOIN authors as authors ON ads.author_id = authors.author_id 
                  LEFT JOIN product_photos as pp ON ads.ad_id = pp.ad_id                   
                  ORDER BY ads.publication_date DESC";

        //q можно ли как то это протестить из консоли как в питоне?


        // подготовка запроса
        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }
    function read_row_count(){
        $query = "SELECT COUNT(1) FROM board_bd.ads";

        // подготовка запроса
        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }

}