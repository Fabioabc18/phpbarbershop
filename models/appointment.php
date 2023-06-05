<?php
require_once('Base.php');


class Appointment extends Base
{



    public function getChoiceOfServices()
    {

        $query = $this->db->prepare("
            SELECT service_id, name, price, duration
            FROM services
            ORDER BY category_id
            ");
        $query->execute();
        return $query->fetchAll();


    }

    public function getChoiceOfEmployees()
    {
        $query = $this->db->prepare("
            SELECT  e.employee_id, e.first_name, e.last_name
            FROM employees AS e
            INNER JOIN employees_schedule AS es ON e.employee_id = es.employee_id
            

            ");
        $query->execute();

        return $query->fetchAll();


    }

    /* WHERE es.day_id  = DAYOFWEEK(?) */


    /* public function insertAppointment($data)
    {
        $query = $this->db->prepare("
            INSERT INTO appointments ( date_created, client_id, employee_id , start_time, end_time_expected, service_id)
            VALUES (  NOW(), ?,  ?,  ?, ?, ? )
        ");

        $query->execute([
            $data['employee_id'],
            $data['start_time'],
            $data['end_time_expected'],

        ]);

        return $this->db->lastInsertId();





    }  */
}

?>