<html>
    <head>
        <title>Call AJAX</title>
    </head>
    <body>
        <script src="js/jquery-3.2.0.js"></script>
        <script>
        
            $('document').ready(function(){
                
                var values = 'data';
                $.ajax({
                    url: "vote.php",
                    type: "post",
                    data: values ,
                    success: function (response) {                
                        console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus, errorThrown);
                    }

                });
                
            });
        
        </script>
    </body>
</html>