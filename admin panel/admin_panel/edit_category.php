<?php
include("config.php");

include("logged_in_check.php");

if(isset($_GET["edit"]) && !empty($_GET["edit"])){


    $_SESSION["category_id"] = $_GET["edit"];

    //echo "<pre>"; print_r($admin); die();
}
    $a = $_SESSION["category_id"];

    $query = "SELECT * FROM categories WHERE category_id = '$a' ;";

    $category = berkhoca_query_parser($query);



if(isset($_POST["finish_edit"]) && !empty($_POST["category_name"]) && !empty($_FILES["category_image"]) ){

   //echo "<pre>"; print_r($_POST); die(); //okayy our data collected is right.



   $image = $_FILES["category_image"]["name"];
   $folder = "../../images/categories/".$image; //dosyanın kaydedileceği konum
   $use = "/images/categories/".$image; //dosyanın referans olarak gösterilip database'e iletileceği konum

   $category_name = $_POST["category_name"];
   $category_description = $_POST["category_description"];

//    $query2 = "UPDATE categories SET 
//            category_name = '$category_name',
//            category_img = '$use',
//            category_description = '$category_description'
//            WHERE category_id = '$a';";






   //echo "$query2";

   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "e-ticaret";

   $conn = new mysqli($servername, $username, $password, $dbname);
   
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
    $stmt = $conn->prepare("UPDATE categories SET 
    category_name = ?,
    category_img = ?,
    category_description = ?
    WHERE category_id = ?");

    $stmt->bind_param("ssss", $category_name, $use, $category_description, $a);
    $stmt->execute();


//    $conn->query($query2);


   move_uploaded_file($_FILES["category_image"]["tmp_name"], $folder);

   header('Location: edit_category.php?correct=1');
   exit;


}










?>

<?php include('header.php'); ?>

<html>
    <form action="edit_category.php" method="post" enctype="multipart/form-data">
        <body>
        
        <div id="wrapper">
        
        
            <?php include('top_bar.php'); ?>
        
            <?php include('left_sidebar.php'); ?>
                <div id="content">
        
                    <div id="content-header">
                        <h1>EDIT CATEGORY</h1>
                    </div> <!-- #content-header -->

                    <div id="content-container">
                        <div class="row">

                        <?php 

                        if(!empty($_GET['correct']) && $_GET['correct'] == 1) {

                     ?>
                        <div class="alert alert-danger">
                            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                            <strong>Congrats!</strong> Data successfully Edited!
                        </div>
                    <?php 
                    } 

                    ?>
                            <div class="portlet">
        
                                <div class="portlet-header">
        
                                    <h3>
                                        <i class="fa fa-tasks"></i>
                                        CATEGORY INFO
                                    </h3>
        
                                </div> <!-- /.portlet-header -->
        
                                <div class="portlet-content">
        
                                    <div class="row">
        
                                        <div class="col-sm-4">
        
                                            <div  class="form-group">
                                                <label for="text-input">CATEGORY NAME</label>
                                                <input name="category_name" type="text" id="text-input" class="form-control" value ="<?php echo $category[0]["category_name"]?>">
                                            </div>
                                        <div class="form-group">
                                                <label >CATEGORY IMAGE</label>
                                                <input  name = "category_image"  type="file" class="form-control" value ="<?php echo $category[0]["category_img"]?>">
                                            </div>
                                        <div  class="form-group">
                                                <label for="text-input">CATEGORY DESCRIPTION</label>
                                                <input  name="category_description" type="text" id="text-input" class="form-control" value ="<?php echo $category[0]["category_description"]?>">
                                            </div>
        
    
                                        </div> <!-- /.col -->
        
                                    </div> <!-- /.row -->
    
                                    <button name="finish_edit" type="submit" class="btn btn-default">FINISH EDIT</button>
        
        
                                </div> <!-- /.portlet-content -->
        
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- /#content-container -->
        
                </div> <!-- #content -->
        
        
        </div> <!-- #wrapper -->
        
        <?php include('footer.php'); ?>
        
        </body>
    </form>
</html>




