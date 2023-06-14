<?php

namespace Config\Core;

use Database\DBConnectionSingleTone;
use Illuminate\Database\PDO\Connection;
use Illuminate\Database\Connectors\Connector;
use Config\Core\BaseView;

class BaseController {
    public $model;
    public $view;

    function __construct(){
        $dbSingletone = new DBConnectionSingleTone;
        $this->conn = $dbSingletone->connection;
        $this->view = new BaseView;
    }

    public function index(){}
}
