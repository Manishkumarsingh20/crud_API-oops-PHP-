<?php
 //include file open
 require_once("apiconnection.php");
 //include file close

//header file open
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method:PUT");
header("Access-Control-Allow-Header:Access-Control-Allow-Header,Content-Type,Access-Control-Allow-Method,Authorizaton,X-Requested-With");
//header file close



$content = file_get_contents("php://input");
$data = json_decode($content,true);
$GLOBALS ['id']= $data['sid'];
$GLOBALS ['receiver']= $data['sreceiver'];
$GLOBALS ['sender'] =$data['ssender'];
$GLOBALS ['message'] = $data['smessage'];
$GLOBALS ['flag '] = $data['sflag'];


class update{

    public function __construct()
    {
        $db = new databaseconnection();
        $this->con = $db->con;
    }

  public function update_data(){
    $id=$GLOBALS ['id'];
    $receiver=$GLOBALS ['receiver'];
    $sender=$GLOBALS ['sender'];
    $message=$GLOBALS ['message'];
    $flag=$GLOBALS ['flag '] ;

    $sql_update = "UPDATE `unsubscriber` SET receiver='$receiver', sender= '$sender',   `message`= '$message', flag= '$flag' WHERE id='$id'";
    $sql_update_connection = $this->con->query($sql_update);
    if($sql_update_connection){
        echo json_encode(array('message'=>'updated successefully' , 'status'=>'true'));
    }else{
        echo json_encode(array('message'=>'not updated','status'=>'false'));
    }


  }


}

$object = new  update();
$object->update_data();






?>