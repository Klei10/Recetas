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
		"tb_recipes.recipe_description",
        "tb_recipes.status"
	],[
		"ORDER" => ["tb_recipes.id_recipe" => "DESC"]
	]);
?>


<html>
    <head>
		<title>ACTIVAR RECETA</title>
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
		
		</style>
	</head>
    <body>
       
       <header>
           <h1>REGISTRAR RECETAS</h1>
		</header>
        
        <div id="recipes">
        <table>
            
            <?php
                
                $len = count($data);
                
                for($i=0;$i<$len;$i++){
                    
                    if($data[$i]["status"] == "0"){
                        $label="ACTIVAR";
                    }else{
                        $label="DESACTIVAR";
                    }
                    
                    echo "<tr>
                    <td>".$data[$i]["id_recipe"]."</td>
					<td>".$data[$i]["recipe_name"]."</td>
				    <td>".$data[$i]["recipe_description"]."</td>
				    <td><a href='check_recipe.php?id_recipe=".$data[$i]["id_recipe"]."&status=".$data[$i]["status"]."'>".$label."</a></td>".
                    "</tr>";
                
                }
				
				?>
            
        </table>
        </div>
        
        
    </body>
</html>