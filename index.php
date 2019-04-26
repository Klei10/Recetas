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

	$data = $database->select("tb_recipes", [

		"[><]tb_recipe_category" => ["id_category" => "id_category"]

	], [
		"tb_recipes.id_recipe",
		"tb_recipes.recipe_name",
		"tb_recipes.recipe_prep_time",
		"tb_recipes.recipe_cook_time",
		"tb_recipes.recipe_serves",
		"tb_recipes.recipe_description",
		"tb_recipes.recipe_image",
		"tb_recipes.id_category",
		"tb_recipe_category.id_category",
        "tb_recipes.id_user",
        "tb_recipes.status",
        "tb_recipes.votes"
	],[
        "tb_recipes.status" => 1
    ],[
		"ORDER" => ["tb_recipes.id_recipe" => "DESC"]
	]);

?>



<html>
	<head>
		<title>Recipes</title>
		<style>
		body{
        margin: 0;
		padding: 0;
		font-family: Arial;
		}
		header{
		display: inline-block;
		width: 100%;
		height: 300px;
		background: url(./imgs/header.jpg) no-repeat center center;
		}
		h1{
		margin: 140px 0 0 0;
		font-size: 50px;
		text-align: center;
		text-shadow: 3px 1px 2px rgba(150, 150, 150, 1);
		}

        #ofe{
        margin-top: -190px;
        }

        .feo{
        float: right;
        display: inline;
        font-size: 15px;
        margin: 0 1.000em 0 1.000em;
        }

        .aaa{
        display: inline;
        font-size: 15px;
        margin: 0 1.000em 0 1.000em;
        }

        .log{
        float: right;
        text-decoration: none;
        font-weight: bolder;
        color: black;
        }

        .log:hover{
        transition: 1s;
        color: fuchsia;
        }

        #add{
        text-decoration: none;
        color: #FFE762;
        background: black;
        padding: 5px;
        }

        #usuario{
        float: right;
        margin-top: 0;
        font-weight: bolder;
        }

		#recipes{
		width:1050px;
		margin:auto;
		}

		.recipe{
		width:250px;
        height: 195px;
		float:left;
        text-align: center;
		margin:5px;
		border: 1px solid #ccc;
		background:#e74c3c;
        background-position: bottom;
        position: relative;
		}

		.recipe img{
		width:250px;
        height: 150px;
		}

		.recipe a{
		text-decoration:none;
		color: #000;
		}

		.recipe h3{
		color:#fff;
		font-size:11px;
        text-align: center;
		}

        .recipe p{
            /*display: none;*/
            position: absolute;
            width: 40px;
            background: #000;
            padding: 2px 0;
            left: 210px;
            top: 23px;
            color: #fff;
            font-size: 10px;
            text-align: center;
        }

        .heart{
            display: block;
            width: 24px;
            height: 25px;
            background: url(imgs/heart.png) #000 center no-repeat;
            position: absolute;
            left: 220px;
            top: 6px;
            border-radius: 15px;
            cursor: pointer;
        }

		</style>
	</head>
	<body>

		<header>
			<h1>OUR RECIPES</h1>
			<?php
            session_start();
            if(isset($_SESSION["usr"])){
			echo "<a id='ofe' class='log' href='edit_users.php'>Cambiar Contraseña</a>";
            }else{
            echo "<ul id='ofe'>
            <li class='feo'> <a class='log' href='login.php'>Ingresar</a> </li>
            <li class='feo'> <a class='log' href='registration.php'>Crear Usuario</a> </li>
            </ul>";
            }
            ?>
		</header>

		<section id="links">

		    <?php


            if(isset($_SESSION["usr"])){
            echo "<ul>
            <li class='aaa'> <a id='add' href='add_recipes.php'>Agregar Receta</a> </li>
            <li class='aaa'> <a id='add' href='mi_receta.php'>Mis Recetas</a> </li>
            <p id='usuario'>".$_SESSION["usr"]."</p>
            <li class='aaa'> <a href='log_out.php'>Salir</a></li>
						<input id='usrid' type='hidden' value='".$_SESSION["usrid"]."'>
            </ul>";
            }
            ?>

			<div id="recipes">

			<?php

                $len = count($data);
                echo "<script>
                    var data = [];
                </script>";

                for($i=0;$i<$len;$i++){

                    echo "<div class='recipe'>
                    <div id='".$data[$i]["id_recipe"]."' class='heart'></div>
                    <p id='p".$data[$i]["id_recipe"]."'>".$data[$i]["votes"]."</p>
					<a href='recipe.php?id_recipe=".$data[$i]["id_recipe"]."'>
						<img src='./imgs/".$data[$i]["recipe_image"]."'>
						<h3>".$data[$i]["recipe_name"]."</h3>
					</a>
				</div>";

                    echo "<script>
                    data.push(".$data[$i]["id_recipe"].");
                    </script>";

                }

				?>

			</div>

		</section>

		<script src="js/jquery-3.2.0.js"></script>
		<script>

            $('document').ready(function(){

                var len = data.length;
                for(var i=0; i<len; i++){

                    $('#'+data[i]).mouseenter(function(){
                        var id = $(this).attr('id');
                        $('#p'+id).fadeIn();
                    });

                    $('#'+data[i]).mouseleave(function(){
                        var id = $(this).attr('id');
                        $('#p'+id).fadeOut();
                    });

										$('#'+data[i]).click(function(){
											var id = $(this).attr('id');
											$.ajax({
													url: "vote.php",
													type: "get",
													data: { recipe:$(this).attr('id'), user:$('#usrid').val() },
													success: function (response) {
																$('#p' + id).text(response);
													},
													error: function(jqXHR, textStatus, errorThrown) {
														 console.log(textStatus, errorThrown);
													}

											});

                    });

                }

            });

        </script>

	</body>
</html>
