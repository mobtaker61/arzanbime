<?php
namespace Core;
use mysqli;

class Model {
    protected $db;

    public function __construct() {
        $config = require 'config/config.php';
        $this->db = new mysqli(
            $config['db']['host'], 
            $config['db']['user'], 
            $config['db']['pass'], 
            $config['db']['name']
        );

        if ($this->db->connect_error) {
            die("Database connection error: " . $this->db->connect_error);
        }
    }
}
