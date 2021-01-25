<?php

require_once("model.php");

use Dcblogdev\PdoWrapper\Database;

class post
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
        $data = $this->db->rows("SELECT * FROM posts");
        return $data;
    }

    public function add_post($data)
    {
        $data = $this->db->insert("posts",$data);
        return $data;
    }
    public function up_post($data,$id)
    {
        $data = $this->db->update("posts",$data,$id);
        return $data;
    }
    public function del_post($id)
    {
        $data = $this->db->delete("posts",$id);
        return $data;
    }
}