<?php
// необходимые HTTP-заголовки
//q зачем это?
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

//http://bboard.prj/read.php?page=1&sort_by=date&sort_direction=DESC
//http://bboard.prj/ad?page=1&sort_by=date&sort_direction=DESC
$current_page = $_GET['page'];
$sort_by = $_GET['sort_by'];
$sort_direction = $_GET['sort_direction']; //todo тут должен быть парсинг параметров из запроса;


// запрашиваем кол-во записей в базе
$total_rows = $ad->read_rowcount();

//Находим сколько всего записей в таблице


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
    $from = ($current_page - 1) * 10;
}

switch ($sort_by) {
    case 'date':
        $sort_by = 'publication_date';
        break;
    case 'price':
        $sort_by = 'price';
        break;
};



$stmt = $ad->read($from, $sort_by, $sort_direction );
//q как писать документацию к функциям (чтобы отображалась в интелисенс)
//q зачем результат  метода возвращать?

$accept = getallheaders();

if ($accept['Accept'] != 'application/json') {


// Отдаем html

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print ('Title: ' . $row['title'] . ' Photo link: ' . $row['link'] . ' Price: ' . $row['price']);
        print('<br>');
    };

    print('<br>');
    print ($current_page . ' page of ' . $total_page);

}else {

//Отдаем json

    header("Content-Type: application/json; charset=UTF-8");

    $products_arr = array();
    $products_arr["records"] = array();
    $products_arr["page"];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // массив товаров


        $product_item = [
            'Title' => $row['title'],
            'Photo link' => $row['link'],
            'Price' => $row['price']
        ];


        array_push($products_arr["records"], $product_item);


    }

    print ($current_page);
    print (' ');
    print ($total_page);
    // q почему значение не поподает в массив
    $products_page = [
        'current_page' => $current_page,
        'total_page' => $total_page

    ];

    var_dump($products_page);
    array_push($products_arr["page"], $products_page);

    echo json_encode($products_arr);
}

//todo Добавить обработчик ошибок