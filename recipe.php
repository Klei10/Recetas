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
    $data = $database->select("tb_recipes", [
        "id_recipe",
		"recipe_name",
		"recipe_prep_time",
		"recipe_cook_time",
		"recipe_serves",
		"recipe_description",
        "recipe_image",
        "id_category"
    ], [
    "id_recipe" => $_GET["id_recipe"]
]);
}


?>

<html>
    <head>
        <title>Recipe</title>
        <!--<link rel="stylesheet" href="css/main.css">-->
        <style>
        .bck{
        background: yellow;
        padding: 10px 0;
        text-decoration: none;
        }
        </style>
    </head>
    <body>
	
	<?php
        
		echo "<h3> Recipe Name: ".$data[0]["recipe_name"]."</h3>
		<p> Preparation Time: ".$data[0]["recipe_prep_time"]."</p>
		<p> Cook Time: ".$data[0]["recipe_cook_time"]."</p>
		<p> Serves: ".$data[0]["recipe_serves"]."</p>
		<p> Description: ".$data[0]["recipe_description"]."</p>
		<img src='./imgs/".$data[0]["recipe_image"]."'>

		<br>
		
		<a class='bck' href='index.php'>Back</a>";

    ?>
            
    </body>
</html>




