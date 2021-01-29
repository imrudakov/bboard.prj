<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// use product\Product;

// подключение к базе данных:

// подключение бзы данных и файл, содержащий объекты
include_once 'database.php';
include_once 'ad.php';

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$product = new Ad($db);

// чтение товаров:

// запрашиваем товары
$stmt = $product->read();
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей
if ($num>0) {

    // массив товаров
    $products_arr=array();
    $products_arr["records"]=array();

    // получаем содержимое нашей таблицы
    // fetch() быстрее, чем fetchAll() q что такое флетч?
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку
        extract($row); //q расспаковывет строку как переменные?

        $product_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );

        array_push($products_arr["records"], $product_item);
    }

    // устанавливаем код ответа - 200 OK
    http_response_code(200);


    // выводим данные о товаре в формате JSON
    // echo json_encode($products_arr); // todo проверить заголовок если html то вернуть html
    // Проверяем на заголовок

    if (header("фвву") == 'application/json') {
        echo json_encode($products_arr);
    } else {
        foreach ($products_arr['records'] as $product){

            echo $product['id'].' '.
                 $product['name'].' '.
                 $product['description'].' '.
                 $product['price'].' '.
                 $product['category_id'].' '.
                 $product['category_name'].PHP_EOL;

        }
    }
} // 'товары не найдены' :

// 'товары не найдены' :

else {

    // установим код ответа - 404 Не найдено
    http_response_code(404);

    // сообщаем пользователю, что товары не найдены
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}