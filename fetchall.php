<?php
//header required open
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
//header closed 

//include file open
require_once("apiconnection.php");
//include file close



class fetchallApi
{

    public function __construct()
    {
        $db = new databaseconnection();
        $this->con = $db->con;
    }

    //fetching All data
    public function selectall()
    {
        $sql = "SELECT * FROM unsubscriber";
        $sql_conn = $this->con->query($sql);
        if (mysqli_num_rows($sql_conn) > 0) {
            $data = $sql_conn->fetch_all(MYSQLI_ASSOC);
            echo json_encode($data);
        } else {
            echo json_encode(array('message' => 'no record found', 'status' => 'Failed'));
        }
    }
}
$object = new fetchallApi();
$object->selectall();
