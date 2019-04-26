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
	
if($_POST){
	$database->insert("tb_registered_users", [
        "fname" => $_POST["fname"],
        "lname" => $_POST["lname"],
        "usr" => $_POST["usr"],
        "pwd" => md5( $_POST["pwd"] )
	]);
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
       
       <h1>Crear Usuario</h1>
       
        <form action="registration.php" method="post">
           
           <div class="form-field">
                <label for="">First Name</label>
                    <input type="text" name="fname">
            </div>
            <div class="form-field">
                <label for="">Last Name</label>
                    <input type="text" name="lname">
            </div>
            <div class="form-field">
                <label for="">Username</label>
                    <input type="text" name="usr">
            </div>
            <div class="form-field">
                <label for="">Password</label>
                    <input type="password" name="pwd">
            </div>
                <div class="form-field">
                    <input class="btn-submit" type="submit" value="Registrar">
            </div>
            
        </form>
    </body>
</html>