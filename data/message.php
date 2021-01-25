<?php

require_once("model.php");

use Dcblogdev\PdoWrapper\Database;

class message
{

    private $db;
    public function __construct()
    {
        // make a connection to mysql here
        $options = [
            //required
            'username' => 'root',
            'database' => 'mvc_porject',
            //optional
            'password' => '',
            'type' => 'mysql',
            'charset' => 'utf8',
            'host' => 'localhost',
            'port' => '3306'
        ];
        $this->db = new Database($options);
    }
    public function get_all()
    {
        $data = $this->db->rows("SELECT * FROM `message`");
        return $data;
    }
    public function add_meg($data)
    {
        $data = $this->db->insert("message",$data);
        return $data;
    }
    public function del_meg($id)
    {
        $data = $this->db->delete("message",$id);
        return $data;
    }
}