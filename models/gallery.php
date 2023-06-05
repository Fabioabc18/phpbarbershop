<?php

require_once('models/base.php');

class Gallery extends Base
{

    public function get()
    {
        $query = $this->db->prepare("
            SELECT gallery_id, photo
            FROM gallery
        ");


        $query->execute();

        return $query->fetchAll();

    }
}