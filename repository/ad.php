<?php

class Ad
{

// подключение к базе данных и таблице 'products'
    private $connection;
    private $table_name = "ads";

// свойства объекта q почему мы объявляем их как свойства, а не работаем с массивом
//q зачем их вообще прописывать?
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

/*  Метод получения списка объявлений
    - нужна пагинация, на одной странице должно присутствовать 10 объявлений
    - нужна возможность сортировки: по цене (возрастание/убывание) и по дате создания (возрастание/убывание)
    - поля в ответе: название объявления, ссылка на главное фото (первое в списке), цена*/

    function read($from, $sort_by, $sort_direction ){ //todo переименовать в ad list

        if ($sort_by == null){$sort_by = '';}
        if ($sort_direction == null){$sort_direction = '';}

        $query = "SELECT a.title,a.description, a.price, p0.link  FROM board_bd.ads a
                  LEFT JOIN  board_bd.product_photos p0 ON  a.ad_id = p0.ad_id where number = 1
                  limit :from, 10";
                 // ORDER BY :sort_by :sort_direction limit :from 10";



        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':from', $from);

        // выполняем запрос
        //$stmt->execute(array(':sort_by'=>$sort_by, ':sort_direction'=>$sort_direction, ':from'=>$from));
        $stmt->execute();

        return $stmt;//q зачем возвращать?
    }
    function read_one($current_id){

        $query = "SELECT a.title,a.description, a.price, p0.link  FROM board_bd.ads a
                  LEFT JOIN  board_bd.product_photos p0 ON  a.ad_id = p0.ad_id where  number = 1 and a.ad_id = :current_id";

        //Реализация маски запроса
        $array_in = [$current_id];
        $array_out = [':current_id'];
        $query = str_replace($array_out, $array_in, $query);

        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }
    function create($title, $description, $link, $price , $author_id){
        $query = "INSERT INTO board_bd.ads VALUES (default, '$author_id','$title', '$description', '$price',current_date)";

        // подготовка запроса
        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        $id = $this->connection->lastInsertId(); //q как это делаеться в интерпрайзе ? todo не работает!

        $query = "INSERT INTO board_bd.product_photos VALUES (default, '$id', '$link', 1)";

        // подготовка запроса
        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $id;
    }
    function read_rowcount(){
        // $stmt = $db->prepare("SELECT COUNT(1) FROM board_bd.ads"); //q Как сделать запрос сразу в ДБ
        $query = "SELECT COUNT(1) FROM board_bd.ads";

        // подготовка запроса
        $stmt = $this->connection->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt->fetchColumn();
    }

}