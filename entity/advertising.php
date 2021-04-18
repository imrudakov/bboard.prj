<?php

class Advertising
{

// свойства объекта
    public int $ad_id;
    public int $author_id;
    public string $title;
    public string $description;
    public float $price;
    public string $publication_date;

    public function __construct($ad_id, $author_id, $title, $description, $price, $publication_date)
    {
        $this->ad_id = $ad_id;
        $this->author_id = $author_id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->publication_date = $publication_date;
    }
}