<?php

namespace Config\Core;

class BaseRepository{
    public function __construct($connection){
        $this->conn = $connection;
    }
}
