<?php

require_once('base.php');

class Categories extends Base
{
    public function getCategories()
    {
        $query = $this->db->prepare("
            SELECT c.name AS category_name, s.name, s.description, s.price
            FROM services_categories AS c
            INNER JOIN services AS s ON c.category_id = s.category_id
            ORDER BY c.category_id
            ");
        $query->execute();

        return $query->fetchAll();


    }
}