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

    $response = 0;

if($_GET){

  $data = $database->select("tb_votes", "*",
  [
    "AND" => [
      "id_recipe" => $_GET["recipe"],
      "id_user" => $_GET["user"]
    ]
  ]);

  $validate = count($data);

  if ($validate == 0) {

  //obtener los votos de la receta
  $votes = $database->select("tb_recipes", [
    "votes"
  ], [
      "id_recipe" => $_GET["recipe"]
    ]);

    //aumentar en 1 los votos de la receta
    $add = $votes[0]["votes"] + 1;
    $response = $add;

    //actualizar la receta
    $database->update("tb_recipes",[ "votes" => $add
  ], [
    "id_recipe" => $_GET["recipe"]
  ]);

    //insertar en la tb_recipes
    $database->insert("tb_votes", [
      "id_recipe" => $_GET["recipe"],
      "id_user" => $_GET["user"]
    ]);
}else {
  $votes = $database->select("tb_recipes", [
    "votes"
  ], [
      "id_recipe" => $_GET["recipe"]
    ]);
    $response = $votes[0]["votes"];
}
echo $response;

}

?>
