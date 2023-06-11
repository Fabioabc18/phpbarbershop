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


    public function getAvailableTimeslots($data)
    {
        $query = $this->db->prepare("
        SELECT es.from_hour, es.to_hour
        FROM employees_schedule AS es
        INNER JOIN employees AS e ON es.employee_id = e.employee_id
        WHERE es.day_id = DAYOFWEEK(?)
        AND ? BETWEEN es.from_hour AND es.to_hour
    ");
        $query->execute([
            $data["selected_date"]
        ]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }




    public function getAvailableBarbers()
    {
        $query = $this->db->prepare("
            SELECT es.from_hour, es.to_hour, e.employee_id, e.first_name, e.last_name
            FROM employees_schedule AS es
            INNER JOIN employees AS e ON es.employee_id = e.employee_id
            WHERE es.day_id 
        ");
        $query->execute();

        return $query->fetchAll();
    }



    public function insertAppointment($data)
    {
        $query = $this->db->prepare("
            INSERT INTO appointments ( date_created, client_id, employee_id , start_time, end_time_expected, service_id)
            VALUES (  NOW(), ?,  ?,  ?, ?, ? )
        ");

        $query->execute([
            $data['date_created'],
            $data['client_id'],
            $data['employee_id'],
            $data['start_time'],
            $data['end_time_expected'],
            $data['service_id']

        ]);

        return $this->db->lastInsertId();





    }
}

?>