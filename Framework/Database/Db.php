<?php

namespace Framework\Database;

use PDO;

class Db
{
    protected $db;

    public function __construct()
    {
        $config = require_once 'Framework/Config/DatabaseVars.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['user'], $config['pass']);
    }

    public function query($sql, $params)
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }

        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchColumn();
    }
}