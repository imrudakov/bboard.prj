<?php

require 'repository/ad_crud.php';

$products_arr = Ad_crud::read();

foreach ($products_arr['records'] as $product) {
    print ('Title: ' . $product['Title'] . ' Photo link: ' . $product['Photo link:'] . ' Price: ' . $product['Price']);
    print('<br>');
};

print('<br>');
print ($products_arr['page']['current_page'] . ' page of ' . $products_arr['page']['total_page']);