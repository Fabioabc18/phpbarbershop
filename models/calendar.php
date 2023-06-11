<?php

require_once('base.php');



class Calendar extends Base
{
    public function getCategories()
    {
        $query = $this->db->prepare("
        Select employee_id
        from employees_schedule
        where employee_id = ?
        and day_id = DAYOFWEEK(?)
        and ? between from_hour and to_hour
        and ? between from_hour and to_hour
            ");
        $query->execute();

        return $query->fetchAll();


    }


}