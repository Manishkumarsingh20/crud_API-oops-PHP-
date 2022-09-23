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


$content = file_get_contents('php://input');
$data = json_decode($content,true);
$GLOBALS['search'] = $data['search'];


class search{
      
   
        public function __construct()
        {
            $db = new databaseconnection();
            $this->con = $db->con;
        }
    

        public function searchbox(){
            $search =$GLOBALS['search'];
            $sql ="SELECT * FROM `unsubscriber` WHERE receiver LIKE '%{$search}%'";
            $sql_conn = $this->con->query($sql);
            if(mysqli_num_rows($sql_conn)>0){
                $data = $sql_conn->fetch_all(MYSQLI_ASSOC);
                echo json_encode($data);
            }else{
                echo json_encode(array('message'=>'search was not found','status'=>'false'));
            }

         }
  
  
}
$object=new search();
$object->searchbox();

?>