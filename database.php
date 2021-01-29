<?php

class Database
{

    // укажите свои учетные данные базы данных
    private $host = "localhost";
    private $db_name = "board_bd";
    private $username = "root";
    private $password = "root";
    public $connection;

    // получаем соединение с БД
    public function getConnection()
    {

        $this->connection = null;

        try { //q Как работать с обработчиком ошибок
            $this->connection = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name, // q что такое PDO (расшифровка)
                                        $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage(); //q что делает функция getMessage
        }
        return $this->connection;
    }

}

