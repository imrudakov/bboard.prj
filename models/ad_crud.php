<?php


include_once 'core/database.php';
include_once 'objects/ad.php';

class Ad_crud
{

    static function getConnection()
    {

        // получаем соединение с базой данных
        $database = new Database();
        $db = $database->getConnection();

        // инициализируем объект
        $ad = new Ad($db);

        return $ad;

    }

    static function read()
    {

        $ad = Ad_crud::getConnection();

        //http://bboard.prj/read.php?page=1&sort_by=date&sort_direction=DESC
        //http://bboard.prj/ad?page=1&sort_by=date&sort_direction=DESC

        $current_page = (int)$_GET['page'];
        $sort_by = $_GET['sort_by'];
        $sort_direction = $_GET['sort_direction']; //todo тут должен быть парсинг параметров из запроса;

        // запрашиваем кол-во записей в базе
        $total_rows = $ad->read_rowcount();

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


        $stmt = $ad->read($from, $sort_by, $sort_direction);
        //q как писать документацию к функциям (чтобы отображалась в интелисенс)
        //q зачем результат  метода возвращать?

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

        $products_arr["page"] = [
            'current_page' => $current_page,
            'total_page' => $total_page
        ];

        return $products_arr;

    }

    static function read_one()
    {

        $ad = Ad_crud::getConnection();

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', trim($uri, '/'));
        $current_id = $uri_segments[1];
        $stmt = $ad->read_one($current_id);

        $products_arr = array();
        $products_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            // данные товара
            $product_item = [
                'Title' => $row['title'],
                'Photo link' => $row['link'],
                'Price' => $row['price']
            ];

            array_push($products_arr["records"], $product_item);

        }

        return $products_arr;

    }

    static function create()
    {

        $ad = Ad_crud::getConnection();

        $title = $_POST['title'];
        $description = $_POST['description'];
        $link = [];
        $price = $_POST['price'];
        $author_id = $_POST['author_id'];

        $id = $ad->create($title, $description, $link, $price, $author_id);

        return $id;


    }
}
