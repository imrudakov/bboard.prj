<?php

require 'repository/ad_crud.php';

header("Content-Type: application/json; charset=UTF-8");

var_dump($_POST);
die;

$id = Ad_crud::create();
echo json_encode($id);

//todo Реализовать тут проверки
//todo Сформировать объект
//todo Передать в репо