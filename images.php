<?php

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
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
        $img = generateRandomString().".".pathinfo($file_name, PATHINFO_EXTENSION); move_uploaded_file($file_tmp,"imgs/".$img);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
<html>
    <head>
        <title>Upload an image</title>
        
        <style>
            img{
                object-fit: scale-down;
            }
        </style>
        
    </head>

    <body>
      
    <form action="" method="POST" enctype="multipart/form-data">
        
        <img id="preview" src="#" alt="image to upload" width="150" height="150" />
        <input type="file" name="image" id="upload" onchange="readURL(this)" />
        <input type="submit"/>
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