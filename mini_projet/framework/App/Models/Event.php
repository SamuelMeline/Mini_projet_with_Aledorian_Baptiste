<?php

namespace App\Models;

use Libraries\MVC\AbstractModel;

class Event extends AbstractModel{

    public function findAll() : array 
    {
    
        return $this->db->getAll(
            'SELECT e.title, e.created_at, e.description, e.pictures, e.started_at, e.user_id, u.username, c.name
            FROM Events e
            INNER JOIN Users u ON e.user_id = u.id
            INNER JOIN Categories c ON e.category_id = c.id'
        );
    }
}