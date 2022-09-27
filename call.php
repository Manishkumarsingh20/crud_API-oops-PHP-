<?php
require_once("apiconnection.php");
require_once("insert-api.php");


function call(){

    $insert_connection = new insert_data();
    $insert_connection->insert_Api();
}


?>