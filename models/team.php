<?php

require_once('models/base.php');

class Team extends Base
{

    public function get()
    {
        $query = $this->db->prepare("
            SELECT first_name , photo
            FROM employees 
        ");


        $query->execute();

        return $query->fetchAll();

    }
}