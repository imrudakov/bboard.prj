<?php

include_once 'database.php'; //q это заменяют на неймспейсы? todo заменить на неймспейсы
include_once 'author.php';

$database = new Database();
$db = $database->getConnection();


function read($page = 1, $sort_by = 'date', $sort_direction = 'descending')
{

}

$current_page = 5;
$sort_by = 'date';
$sort_direction = 'ASC';

//Находим сколько всего записей в таблице
$stmt = $db->prepare("SELECT COUNT(1) FROM board_bd.ads"); //q Как сделать запрос сразу в ДБ
$stmt->execute();
//$total_page = $stmt->execute(); q возращает true как вернуть кол-во строк (если $total_rows = $stmt->fetchColumn(); неправильно)
$total_rows = $stmt->fetchColumn();

// Подсчет сколько всего возможно страниц
if ($total_rows % 10 != 0) {
    $total_page = intdiv($total_rows, 10) + 1;
} else {
    $total_page = $total_rows % 10;
};

if ($current_page > $total_page) {
    print('Такой страницы не существует'); // todo заменить на return
    die();
} else {
    $from = ($current_page - 1)*10;
}

switch ($sort_by) {
    case 'date':
        $sort_by = 'publication_date';
        break;
    case 'price':
        $sort_by = 'price';
        break;
};

//Запрос q как по другому можно было сделать маску?
$query = "SELECT a.title, a.price, p0.link FROM board_bd.ads a LEFT JOIN  board_bd.product_photos p0 ON  p0.photo_id = (
          SELECT p1.photo_id FROM board_bd.product_photos p1 WHERE p1.ad_id = a.ad_id LIMIT 1) ORDER BY :sort_by :sort_direction limit :from, 10";

//Реализация маски запроса
$array_in = [$sort_by, $sort_direction, $from];
$array_out = [':sort_by', ':sort_direction', ':from'];
$query = str_replace($array_out, $array_in, $query);

$stmt = $db->prepare($query);

// выполняем запрос
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print ('Title: ' . $row['title'] . ' Price: ' . $row['price'] . ' Photo link: ' . $row['link']);
    print('<br>');
};

print('<br>');
print ($current_page . ' page of ' . $total_page);

//e Перевести весь код в функцию