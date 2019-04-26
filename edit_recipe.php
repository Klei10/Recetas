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

    $categories = $database->select("tb_recipe_category", "*");

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    if($_GET){

        $my_recipe = $database->select("tb_recipes", [
            "id_recipe",
            "recipe_name",
            "recipe_prep_time",
            "recipe_cook_time",
            "recipe_serves",
            "recipe_description",
            "recipe_image",
            "id_category",
            "id_category"
        ], [
            "id_recipe" => $_GET["id_recipe"]
        ]);

    }

    if(isset($_FILES['image'])){
       $errors= array();
       $file_name = $_FILES['image']['name'];
       $file_size = $_FILES['image']['size'];
       $file_tmp = $_FILES['image']['tmp_name'];
       $file_type = $_FILES['image']['type'];
       $file_ext_arr = explode('.',$_FILES['image']['name']);

       $file_ext = end($file_ext_arr);

      $img_ext = array("jpeg","jpg","png");

      if(in_array($file_ext, $img_ext) === false){
         $errors[] = "choose a JPEG or PNG file.";
      }

      if($file_size > 2097152){
         $errors[]='2 MB Max';
      }

      if(empty($errors)){
          $img = generateRandomString().".".pathinfo($file_name, PATHINFO_EXTENSION);
          move_uploaded_file($file_tmp,"imgs/".$img);

          if($_POST){

              session_start();

                $database->insert("tb_recipes", [

                    "recipe_name" => $_POST["recipe_name"],
                    "recipe_prep_time" => $_POST["recipe_prep_time"],
                    "recipe_cook_time" => $_POST["recipe_cook_time"],
                    "recipe_serves" => $_POST["recipe_serves"],
                    "recipe_description" => $_POST["recipe_description"],
                    "recipe_image" => $img,
                    "id_category" => $_POST["id_category"],
                    "id_user" => $_SESSION["usrid"],
                    "status" => 0
                ]);

              header("location:my_recipes.php");
            }
      }else{
         print_r($errors);
      }
   }

?>

<html>
    <head>
        <title>Recipe</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>

        <form action="add_recipes.php" method="POST" enctype="multipart/form-data">
            <div class="form-field">
               <img id="preview" src="./imgs/<?php echo $my_recipe[0]["recipe_image"]  ?>" alt="image to upload" width="150" height="150" />
                <label for="">Recipe Image</label>
                <input type="file" name="image" id="upload" onchange="readURL(this)" />
            </div>
            <div class="form-field">
                <label for="">Recipe Name</label>
                <input type="text" name="recipe_name" value="<?php echo $my_recipe[0]["recipe_name"]  ?>">
            </div>
            <div class="form-field">
                <label for="">Category</label>
                <select name="id_category" id="">

                <?php

                    $len = count($categories);

                    for($i=0; $i<$len; $i++){

                        if($categories[$i]["id_category"] == $my_recipe[0]["id_category"]){
                            echo "<option selected value='".$categories[$i]["id_category"]."'>".$categories[$i]["category_name"]."</option>";
                        }else{
                            echo "<option value='".$categories[$i]["id_category"]."'>".$categories[$i]["category_name"]."</option>";
                        }

                    }

                ?>

                </select>
            </div>
            <div class="form-field">
                <label for="">Prep. Time</label>
                <input type="text" name="recipe_prep_time" value="<?php echo $my_recipe[0]["recipe_prep_time"]  ?>">
            </div>
            <div class="form-field">
                <label for="">Cook Time</label>
                <input type="text" name="recipe_cook_time" value="<?php echo $my_recipe[0]["recipe_cook_time"]  ?>">
            </div>
            <div class="form-field">
                <label for="">Serves</label>
                <input type="text" name="recipe_serves" value="<?php echo $my_recipe[0]["recipe_serves"]  ?>">
            </div>
            <div class="form-field">
                <label for="">Description</label>
                <textarea name="recipe_description" cols="30" rows="10"><?php echo $my_recipe[0]["recipe_description"]  ?></textarea>
            </div>

            <div class="form-field">
                <input class="btn-submit" type="submit" value="UPDATE">
                <input class="btn-submit" type="button" onclick="history.back();" value="CANCEL">
            </div>

        </form>

        <script>
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var item = document.getElementById('preview');
                        item.src = e.target.result;
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

        </script>

    </body>
</html> 
