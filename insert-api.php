<?php
//include file open
require_once("apiconnection.php");
//include file close

//header file open
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method:POST");
header("Access-Control-Allow-Header:Access-Control-Allow-Header,Content-Type,Access-Control-Allow-Method,Authorizaton,X-Requested-With");
//header file close


$content = file_get_contents("php://input");
$data =json_decode($content,true);

$GLOBALS ['receiver']= $data['receiver'];
$GLOBALS ['sender'] =$data['sender'];
$GLOBALS ['message'] = $data['message'];
$GLOBALS ['flag '] = $data['flag'];


Class insert_data{

    public function __construct()
    {
        $db = new databaseconnection();
        $this->con = $db->con;
    }

    public function insert_Api(){
       $receiver =$GLOBALS ['receiver'];
       $sender=$GLOBALS ['sender'] ;
       $message =$GLOBALS ['message']  ;
       $flag=$GLOBALS ['flag '];

        $sql_insert = "INSERT INTO unsubscriber(receiver , sender,`message` ,flag )VALUES('$receiver','$sender','$message','$flag')";
        $sql_connection = $this->con->query($sql_insert);
        if($sql_connection){
            echo json_encode(array('message'=>'Inserted Successfully', 'status'=>'200'));
        }else{
        echo json_encode(array('message'=>'Not Inserted Successfully', 'status'=>'False'));
        }
    }

}

$insert_connection = new insert_data();
$insert_connection->insert_Api();









?>