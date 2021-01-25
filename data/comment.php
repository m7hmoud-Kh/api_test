<?php 

require_once("model.php");

use Dcblogdev\PdoWrapper\Database ;

class comment 
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
        $data = $this->db->rows("SELECT * FROM comment");
        return $data;
    }

    public function add_com($data)
    {
        $data = $this->db->insert("comment",$data);
        return $data;
    }

    public function update_com($data,$id)
    {
        $data = $this->db->update("comment",$data,$id);
        return $data;
    }
    public function del_com($id)
    {
        $data =  $this->db->delete("comment",$id);
        return $data;
    }

}
