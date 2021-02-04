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


$accept = getallheaders();


//if ($accept['Accept'] == 'application/json') {

    //API

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // address (only)
    $uri_segments = explode('/', trim($uri, '/'));

    //var_dump($uri_segments);

    if ($uri_segments[0] = 'ad') {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            require 'read.php';

        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);
        }

    };


/*} else {
    echo("Это браузер!");
}*/




// Либо прописать класс ad с методами и сделать Route::start()
// Либо сделать ссылки на текущие файлы
// Либо прочитать еще раз про MVC и сделать как там

//E написать роутер
//E Нужно чтобы отдавался джсон

