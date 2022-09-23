<?php

class databaseconnection{
    private $db_name = 'imerge';
    private $db_user = 'root';
    private$db_pass = 'hestabit';
    private $db_host = 'localhost';

    public function __construct(){

        $con = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if($con){
            echo "connected";
            return $this->con = $con;

        }else{
            echo "not connected";
        }

    }
}



?>