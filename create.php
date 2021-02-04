<?php
// необходимые HTTP-заголовки

header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

// use product\Product;

// подключение к базе данных:

// подключение бзы данных и файл, содержащий объекты
include_once 'database.php';
include_once 'ad.php';

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$ad = new Ad($db);

//http://bboard.prj/read_one.php?title=1&description=1&link=1&price=1&author_id=1
$title = '';
$description = '';
$link = [];
$price = 100;
$author_id = 1;


$stmt = $ad->create($title, $description, $link, $price , $author_id);

var_dump($stmt);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print ('Title: ' . $row['title'] . ' Price: ' . $row['price'] . ' Photo link: ' . $row['link']);
    print('<br>');
};



//todo Добавить обработчик ошибок