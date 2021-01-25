<?php 

require_once("model.php");

use Dcblogdev\PdoWrapper\Database;

class user 
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
        $data = $this->db->rows("SELECT * FROM user");
        return $data;
    }

    public function add_user($data)
    {
        $data = $this->db->insert("user",$data);
        return $data;
    }

    public function update_user($data,$id)
    {
        $data = $this->db->update("user",$data,$id);
        return $data;
    }
    public function del_user($id)
    {
        $data = $this->db->delete("user",$id);
        return $data;
    }
    public function getuser_by_id($id)
    {
        $data = $this->db->row("SELECT * FROM user WHERE `user_id` = ?",$id);
        return $data;
    }
}