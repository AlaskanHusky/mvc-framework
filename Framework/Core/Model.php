<?php

namespace Framework\Core;

use Framework\Database\Db;

abstract class Model
{
    public $db;

    public function __construct() {
        $this->db = new DB;
    }
}