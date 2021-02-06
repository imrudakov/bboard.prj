<?php


// Весь список GET http://bboard.prj/advertisement?параметры
// На получение конкретного объявления  будет GET http://bboard.prj/advertisement/1
// На создание POST http://bboard.prj/advertisement


//var_dump($_SERVER['REQUEST_URI']);
//var_dump($_SERVER['REQUEST_METHOD']);
//var_dump($_SERVER['PHP_UL_PATH']);

//var_dump($_SERVER);

/*тебе нужно разделить свое приложение на слои.
главный слой -  в нем содержится вся бизнес логика и вся работа с данными.
и это слой не знает ни о json, ни о html, ни о консольных командах.
он просто работате с объектами котолрые в него запихали и возвращает объекты
ты этот слой используешь в 2х разных контроллерах
один контроллер вернет html, а другой json*/

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // address (only)
$uri_segments = explode('/', trim($uri, '/'));

$accept = getallheaders();


if ($accept['Accept'] == 'application/json') {

    //API
    if ($uri_segments[0] = 'ad') {

        if ($uri_segments[1]) {

            require 'controllers/api/controller_read_one.php';

        } else {

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                require 'controllers/api/controller_read.php';

            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

                require 'controllers/api/controller_create.php';
            }

        }
    }


} else {
    if ($uri_segments[0] = 'ad') {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            require 'controllers/html/controller_read.php';

        }
    }
}


// E разбить на паттерны MVC
// Либо прописать класс ad с методами и сделать Route::start()
// Либо сделать ссылки на текущие файлы
// Либо прочитать еще раз про MVC и сделать как там

//E написать роутер
//E Нужно чтобы отдавался джсон
//E добавить обработку частных случаев ( read если параметры неверные, read_one если объекта несуществует,


