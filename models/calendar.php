<?php

require_once('base.php');



class Calendar extends Base
{
    public function getCategories()
    {
        $query = $this->db->prepare("
        SELECT employee_id
        FROM employees_schedule
        WHERE employee_id = ?
              and day_id = ?
              and ? between from_hour and to_hour
              and ? between from_hour and to_hour
            ");
        $query->execute();

        return $query->fetchAll();


    }
}