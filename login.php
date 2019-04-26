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

$onError = false;
	
if($_POST){
	$data = $database->select("tb_registered_users", [
        "id_user",
        "fname",
        "lname",
        "usr",
        "pwd"
    ],
    [
        "AND" => [
            "usr" => $_POST["usr"],
            "pwd" => md5( $_POST["pwd"] )
        ]
	]);
    
    $response = count($data);
    
if($response > 0){
    
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["usr"] = $_POST["usr"];
    $_SESSION["usrid"] = $data[0]["id_user"];
    
    
    header("location:index.php");
}else{
    $onError = true;
}
    
    }
?>


<html>
    <head>
        <title>
            Usuarios
        </title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
       
       <h1>Loguear</h1>
       
        <form action="login.php" method="post">
           
            <div class="form-field">
                <label for="">Username</label>
                    <input type="text" name="usr">
            </div>
            <div class="form-field">
                <label for="">Password</label>
                    <input type="password" name="pwd">
            </div>
               
               <?php
                    if($onError){
                        echo "<div class='form-field'><p> Usuario o Contraseña Incorrecta </p></div>";
                    }
                ?>
               
                <div class="form-field">
                    <input class="btn-submit" type="submit" value="Entrar">
            </div>
            
        </form>
    </body>
</html>