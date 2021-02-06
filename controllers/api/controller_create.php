<?php

require 'models/ad_crud.php';

header("Content-Type: application/json; charset=UTF-8");

$id = Ad_crud::create();
echo json_encode($id);