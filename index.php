<?php

require_once("data/categor.php");
require_once("data/user.php");
require_once("data/post.php");
require_once("data/message.php");
require_once("data/comment.php");
require_once("data/reply.php");
header("content-Type:application/json");

$url_pure = trim($_SERVER["REQUEST_URI"], "/");
$url = explode("/", $url_pure);


if ($url[1] == "v1") {
    // table of database 
    if ($url[2] == "categor") {
        $cat = new categor();
        //method
        if ($url[3] == "all") {
            $data = $cat->get_all();
            if ($data) {
                $res = [
                    "status" => 200,
                    "data" => $data,
                ];
                echo json_encode($res);
            }
        } elseif ($url[3] == 'add') {
            header("Access-Control-Allow-Methods: POST");
            $data_on_postman = file_get_contents("php://input");
            $data_array  = json_decode($data_on_postman, true);
            $res = $cat->add_cat($data_array);
            if ($res) {
                $res = [
                    "status" => 201,
                    "meg" => "category added"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'update') {
            header("Access-Control-Allow-Methods: PUT");
            $data_up = file_get_contents("php://input");
            $data_array = json_decode($data_up, true);
            $id = ["cat_id" => $data_array["cat_id"]];
            $data = $data_array["categor"];
            $res = $cat->up_cat($data, $id);
            if ($res) {
                $res = [
                    "status" => 201,
                    "meg" => "category update ..!"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error ..!"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'delete') {
            header("Access-Control-Allow-Methods: DELETE");
            $id_del = file_get_contents("php://input");
            $id_arr = json_decode($id_del, true);
            $id = ["cat_id" => $id_arr["cat_id"]];
            $res = $cat->del_cat($id_arr);
            if ($res) {
                $res = [
                    "status" => 200,
                    "meg" => "category deleted !...",
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error !...",
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == "cat_id") {
            $get_id = file_get_contents("php://input");
            $id_ser = json_decode($get_id, true);
            $id = [$id_ser["cat_id"]];
            $data = $cat->getcatby_id($id);
            if ($data) {
                $res = [
                    "status" => 200,
                    "data" => $data
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "not found this catgory"
                ];
            }
            echo json_encode($res);
        }
    } elseif ($url[2] == 'user') {
        $user = new user();

        if ($url[3] == "all") {
            $data = $user->get_all();
            if ($data) {
                $res = [
                    "status" => 200,
                    "data" => $data
                ];
            } else {
                $res = [
                    "status" => 200,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == "add") {
            header("Access-Control-Allow-Methods: POST");
            $data = file_get_contents("php://input");
            $data_array = json_decode($data, true);
            $res  = $user->add_user($data_array);
            if ($res) {
                $res = [
                    "status" => 201,
                    "meg" => "user added successfully"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == "update") {
            header("Access-Control-Allow-Methods:PUT");
            $id_up = file_get_contents("php://input");
            $id_arr = json_decode($id_up, true);
            $id = ["user_id" => $id_arr["user_id"]];
            $data_arr = $id_arr["user_info"];
            $res = $user->update_user($data_arr, $id);
            if ($res) {
                $res = [
                    "status" => 201,
                    "meg" => "user update successfully"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'delete') {
            header("Access-Control-Allow-Methods: DELETE");
            $id = file_get_contents("php://input");
            $id_del = json_decode($id, true);
            $id_fin = ["user_id" => $id_del["user_id"]];
            $res = $user->del_user($id_fin);
            if ($res) {
                $res = [
                    "status" => 201,
                    "meg" => "user deleted !..."
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == "user_id") {
            $id = file_get_contents("php://input");
            $id_user = json_decode($id, true);
            $id_user = [$id_user["user_id"]];
            $data = $user->getuser_by_id($id_user);
            if ($data) {
                $res = [
                    "status" => 200,
                    "data" => $data
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "not found user with this id"
                ];
            }
            echo json_encode($res);
        }
    } elseif ($url[2] == "post") {
        $post = new post();
        if ($url[3] == 'all') {
            $data = $post->get_all();
            if ($data) {
                $res = [
                    "status" => 200,
                    "data" => $data
                ];
            } else {
                $res = [
                    "status" => 400,
                    "data" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'add') {
            header("Access-Control-Allow-Methods: POST");
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);
            $res = $post->add_post($data);
            if ($res) {
                $res = [
                    "status" => 201,
                    "meg" => "post added successfuly"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'update') {
            header("Access-Control-Allow-Methods: PUT");
            $alldata = file_get_contents("php://input");
            $alldata = json_decode($alldata, true);
            $id = ["post_id" => $alldata['post_id']];
            $data = $alldata["post"];
            $res = $post->up_post($data, $id);
            if ($res) {
                $res = [
                    "status" => 200,
                    "meg" => "post updated successfully..!",
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error",
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == "delete") {
            header("Access-Control-Allow-Methods: DELETE");
            $id = file_get_contents("php://input");
            $id = json_decode($id, true);
            $id_del = ["post_id" => $id["post_id"]];
            $res = $post->del_post($id_del);
            if ($res) {
                $res = [
                    "status" => 200,
                    "meg" => "post deleted"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }

            echo json_encode($res);
        }
    } elseif ($url[2] == 'message') {
        $meg = new message();
        if ($url[3] == 'all') {
            $data = $meg->get_all();
            if ($data) {
                $res = [
                    "status" => 200,
                    "data" => $data
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "not found any data"
                ];
            }

            echo json_encode($res);
        } elseif ($url[3] == 'add') {
            header("Access-Control-Allow-Methods: POST");
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);
            $res = $meg->add_meg($data);
            if ($res) {
                $res = [
                    "status" => 200,
                    "meg" => "message added successfully"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == "delete") {
            header("Acess-Control-Allow-Methods: DELETE");
            $id = file_get_contents("php://input");
            $id = json_decode($id, true);
            $id_fin = ["meg_id" => $id["meg_id"]];
            $res = $meg->del_meg($id_fin);
            if ($res) {
                $res = [
                    "status" => 200,
                    "meg" => "message deleted "
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo  json_encode($res);
        }
    } elseif ($url[2] == "comment") {
        $com = new comment();

        if ($url[3] == 'all') {
            $data = $com->get_all();
            if ($data) {
                $res = [
                    "status" => 200,
                    "data" => $data
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'add') {
            header("Access-Control-Allow-Methods:POST");
            $alldata = file_get_contents("php://input");
            $alldata = json_decode($alldata, true);
            $res = $com->add_com($alldata);
            if ($res) {
                $res = [
                    "status" => 201,
                    "meg" => "comment added successfully"
                ];
            } else {

                $res = [
                    "status" => 201,
                    "meg" => "comment added successfully"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == "update") {
            // update only status 
            header("Access-Control-Allow-Methods: PUT");
            $alldata = file_get_contents("php://input");
            $alldata = json_decode($alldata, true);
            $id_com  = ["com_id" => $alldata["com_id"]];
            $data    = ["com_status" => $alldata["com_status"]];
            $res  = $com->update_com($data, $id_com);
            if ($res) {
                $res = [
                    "status" => 200,
                    "meg" => "comment updated "
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'delete') {
            header("Access-Control-Allow-Methods: DELETE");
            $id = file_get_contents("php://input");
            $id = json_decode($id, true);
            $id = ["com_id" => $id["com_id"]];
            $res = $com->del_com($id);
            if ($res) {
                $res = [
                    "status" => 200,
                    "meg" => "comment deleted successfully"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        }
    } elseif ($url[2] == 'reply') {
        $re = new reply();
        if ($url[3] == "getbyid") {
            header("Access-Control-Allow-Methods:POST");
            $id = file_get_contents("php://input");
            $id = json_decode($id, true);
            $id =  [$id["user_id"]];
            $data = $re->get_all_reply_by_user_id($id);
            if ($data) {
                $res = [
                    "status" => 200,
                    "data" => $data
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == "add") {
            header("Access-Control-Allow-Methods:POST");
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);
            $res = $re->add_re($data);
            if ($data) {
                $res = [
                    "status" => 200,
                    "meg" => "reply added successfully"
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'getmeguser') {

            header("Access-Control-Allow-Methods:POST");
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);
            $user_id = $data["user_id"];
            $meg_id = $data["meg_id"];
            $data_en = $re->get_reply_by_meg_user($meg_id, $user_id);
            if ($data_en) {
                $res = [
                    "status" => 200,
                    "data" => $data_en
                ];
            } else {
                $res = [
                    "status" => 400,
                    "meg" => "error"
                ];
            }
            echo json_encode($res);
        }
    }
}
