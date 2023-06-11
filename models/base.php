<?php

class Base
{
    public $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . ENV["DB_HOST"] . ";dbname=" . ENV["DB_NAME"] . ";charset=utf8mb4",
            ENV["DB_USER"],
            ENV["DB_PASSWORD"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    function countItems($item, $table)
    {
        global $con;
        $stat_ = $con->prepare("SELECT COUNT($item) FROM $table");
        $stat_->execute();

        return $stat_->fetchColumn();
    }


    function checkItem($select, $from, $value)
    {
        global $con;
        $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
        $statment->execute(array($value));
        $count = $statment->rowCount();

        return $count;
    }





}