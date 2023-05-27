<?php

require('base.php');

class Contact extends Base
{
    public function saveContact($data)
    {

        $query = $this->db->prepare("
            INSERT INTO contact
            (name, email, subject, message)
            VALUES(?, ?, ?, ?)
        ");

        $result = $query->execute([
            $data["name"],
            $data["email"],
            $data["subject"],
            $data["message"]

        ]);

        return $this->db->lastInsertId();
    }
}