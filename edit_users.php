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
	$database->update("tb_registered_users", [
        "pwd" => md5( $_POST["pwd"] )
    ],
    [
        "id_user" => $_POST["id_user"]
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
       
       <h1>Actualizar Contraseña</h1>
       
        <form action="edit_users.php" method="post">
           
            <div class="form-field">
                <label for="">Password</label>
                    <input type="password" name="pwd">
            </div>
                <div class="form-field">
                    <input class="btn-submit" type="submit" value="Cambiar">
            </div>
            
            <input type="hidden" name="id_user" value="1">
            
        </form>
    </body>
</html>