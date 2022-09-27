<?php
//include file open
require_once('apiconnection.php');
//include file close

//header file open
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method:DELETE");
header("Access-Control-Allow-Header:Access-Control-Allow-Header,Content-Type,Access-Control-Allow-Method,Authorizaton,X-Requested-With");
//header file close


$content = file_get_contents('php://input');
$data =json_decode($content,true);

$GLOBALS['id'] = $data['sid'];

class delete{

        public function __construct()
        {
            $db = new databaseconnection();
            $this->con = $db->con;
        }

     public function delete(){
        $ID =$GLOBALS['id'];

        $sql ="DELETE FROM unsubscriber WHERE id = $ID";
        $Sql_Conn = $this->con->query($sql);
        if($Sql_Conn){
            echo json_encode(array('message'=>'deleted Succesfully' , 'status'=>'true'));
        }else{
        echo json_encode(array('message'=>'deleted Not Succesfully' , 'status'=>'false'));
     }

}
}


$object = new delete();
$object->delete();

?>