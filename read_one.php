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

//http://bboard.prj/read_one.php?id=1
$current_id = 111;


$stmt = $ad->read_one($current_id);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print ('Title: ' . $row['title'] . ' Price: ' . $row['price'] . ' Photo link: ' . $row['link']);
    print('<br>');
};



//todo Добавить обработчик ошибок