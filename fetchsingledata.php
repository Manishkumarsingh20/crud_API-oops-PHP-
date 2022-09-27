<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
//header closed 

//include file open
require_once("apiconnection.php");
//include file close

$content = file_get_contents("php://input");
$data_content =json_decode($content,true);
$GLOBALS['info'] =$data_content['sid'];


class fetchsingleApi
{

      public function __construct()
    {
        $db = new databaseconnection();
        $this->con = $db->con;
    }

    public function fetch_single_data(){
        $info = $GLOBALS['info'];
         $sql = "SELECT * FROM unsubscriber WHERE id ='$info'";
         $sql_conn = $this->con->query($sql);
         if (mysqli_num_rows($sql_conn) > 0) {
             $data = $sql_conn->fetch_all(MYSQLI_ASSOC);
             echo json_encode($data);
         } else {
             echo json_encode(array('message' => 'no record found', 'status' => 'false'));
         }
     }

    }

$object = new fetchsingleApi();
$object->fetch_single_data();

    ?>
