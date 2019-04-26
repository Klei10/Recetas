<?php

require  'medoo.php';
 
    $database = new medoo([
        // required
        'database_type' => 'mysql',
        'database_name' => 'examen',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8'
    ]);

if($_GET){
    
    if($_GET["status"] == "0"){
        $new_status = "1";
    }else{
        $new_status = "0";
    }
    $database->update("tb_recipes", [
        "status" => $new_status
    ],[
        "id_recipe" =>$_GET["id_recipe"]
    ]);
    
    header("location:activar.php");
}

?>