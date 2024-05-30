<?php
include("config.php");

include("logged_in_check.php");



if(isset($_POST["add_category"]) && !empty($_POST["category_name"]) && !empty($_POST["category_description"])){

   //echo "<pre>"; print_r($_POST); die(); //okayy our data collected is right.

    


   $category_name = $_POST["category_name"];
   $category_description = $_POST["category_description"];
   $image = $_FILES["category_image"]["name"];

   $folder = "../../images/categories/".$image;
   $use = "/images/categories/".$image; 


   $query = " INSERT INTO categories (category_name, category_img, category_description) VALUES ('$category_name','$use','$category_description')";



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-ticaret";

   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $conn->query($query);

    move_uploaded_file($_FILES["category_image"]["tmp_name"], $folder);


   header('Location: add_category.php?correct=1');
   exit;
}










?>

<?php include('header.php'); ?>

<html>
    <form action="add_category.php" method="post" enctype="multipart/form-data">
        <body>
        
        <div id="wrapper">
        
        
            <?php include('top_bar.php'); ?>
        
            <?php include('left_sidebar.php'); ?>
                <div id="content">
        
                    <div id="content-header">
                        <h1>ADD NEW CATEGORY</h1>
                    </div> <!-- #content-header -->

                    <div id="content-container">
                        <div class="row">

                        <?php 

                        if(!empty($_GET['correct']) && $_GET['correct'] == 1) {

                     ?>
                        <div class="alert alert-danger">
                            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                            <strong>Congrats!</strong> Data successfully injected!
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
                                                <input name="category_name" type="text" id="text-input" class="form-control">
                                            </div>
                                        <div class="form-group">
                                                <label >CATEGORY IMAGE</label>
                                                <input  name = "category_image"  type="file" class="form-control">
                                            </div>
                                        <div  class="form-group">
                                                <label for="text-input">CATEGORY DESCRIPTION</label>
                                                <input  name="category_description" type="text" id="text-input" class="form-control">
                                            </div>
        
    
                                        </div> <!-- /.col -->
        
                                    </div> <!-- /.row -->
    
                                    <button name="add_category" type="submit" class="btn btn-default">ADD CATEGORY</button>
        
        
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




