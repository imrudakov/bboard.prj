<?php

include_once 'database.php'; //q это заменяют на неймспейсы? todo заменить на неймспейсы
include_once 'author.php';

$database = new Database();
$db = $database->getConnection();

$products_page = [
    'current_page' => '1',
    'total_page' => 2

];

var_dump($products_page);

Ad_crud::read();

