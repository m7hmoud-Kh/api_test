<?php

require_once("model.php");

use Dcblogdev\PdoWrapper\Database;

class categor
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
        $data = $this->db->rows("SELECT * FROM categor");
        return $data;
    }
    public function add_cat($data)
    {
        $data = $this->db->insert("categor",$data);
        return $data;
    }
    public function up_cat($data,$id)
    {
        $data = $this->db->update("categor",$data,$id);
        return $data;
    }
    public function del_cat($id)
    {
        $data = $this->db->delete("categor",$id);
        return $data;
    }
    public function getcatby_id($id)
    {
        $data = $this->db->row("SELECT * FROM categor WHERE cat_id = ?",$id);
        return $data;
    }
}
