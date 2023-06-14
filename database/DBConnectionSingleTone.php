<?php

namespace Database;

use Doctrine\DBAL\DriverManager;

class DBConnectionSingleTone {
  public function __construct()
  {
    $this->initConnection();
  }

  private function initConnection() {
      $dbParams = [
        'dbname' => env('DB_DATABASE'),
        'user' => env('DB_USERNAME'),
        'password' => env('MYSQL_ROOT_PASSWORD'),
        'host' => env('DB_HOST_DOC'),
        'driver' =>env('DB_CONNECTION'),
    ];
    
    $this->connection = DriverManager::getConnection($dbParams);
  }
}