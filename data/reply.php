<?php

require_once("model.php");

use Dcblogdev\PdoWrapper\Database;

class reply
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

    public function get_all_reply_by_user_id($id)
    {
        $data = $this->db->rows("SELECT * FROM reply WHERE `user_id` = ?", $id);
        return $data;
    }
    public function add_re($data)
    {
        $data = $this->db->insert("reply", $data);
        return $data;
    }
    public function get_reply_by_meg_user($meg_id, $user_id)
    {
        $data = $this->db->row("SELECT * FROM reply WHERE meg_id = ? AND `user_id` = ?", [$meg_id, $user_id]);
        return $data;
    }
}
