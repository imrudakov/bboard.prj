<?php

require 'models/ad_crud.php';

header("Content-Type: application/json; charset=UTF-8");

$products_arr = Ad_crud::read();
echo json_encode($products_arr);