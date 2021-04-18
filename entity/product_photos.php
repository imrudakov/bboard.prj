<?php

class Product_photo
{

    public int $photo_id;
    public int $ad_id;
    public string $link;
    public int $number;

    public function __construct($photo_id, $ad_id, $link, $number)
    {
        $this->photo_id = $photo_id;
        $this->ad_id = $ad_id;
        $this->link = $link;
        $this->number = $number;
    }
}
