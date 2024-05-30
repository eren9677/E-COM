<?php
include("config.php");

include("logged_in_check.php");


$query2 = "SELECT * FROM categories;";

$categories = berkhoca_query_parser($query2);



if(isset($_POST["add_product"]) && !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["quantity"])  && !empty($_POST["brand"])){

   //echo "<pre>"; print_r($_POST); die(); //okayy our data collected is right.


   //select the categories in a different query here.


   $product_name = $_POST["title"];
   $product_description = $_POST["description"];
   $image = $_FILES["img"]["name"];

   $folder = "../../images/categories/".$image;
   $use = "/images/categories/".$image; 

   $price = $_POST["price"];
   $quantity = $_POST["quantity"];
   $brand = $_POST["brand"];

   $category_id = $_POST["product_cat"];


    //$query = " INSERT INTO products (title, img, description, price, quantity, category_id, brand) VALUES ('$product_name','$use','\$description', '$price','$quantity','$category_id','$brand')";
    
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-ticaret";
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    //$conn->query($query);
    $stmt = $conn->prepare("INSERT INTO products (title, img, description, price, quantity, category_id, brand) VALUES (?, ?, ?, ?, ?, ?, ?)");


    $stmt->bind_param("sssssss", $product_name, $use, $product_description, $price, $quantity, $category_id, $brand);
    $stmt->execute();


    move_uploaded_file($_FILES["img"]["tmp_name"], $folder);


   header('Location: add_product.php?correct=1');
   exit;
}










?>

<?php include('header.php'); ?>

<html>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <body>
        
        <div id="wrapper">
        
        
            <?php include('top_bar.php'); ?>
        
            <?php include('left_sidebar.php'); ?>
                <div id="content">
        
                    <div id="content-header">
                        <h1>ADD NEW PRODUCT</h1>
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
                                        PRODUCT INFO
                                    </h3>
        
                                </div> <!-- /.portlet-header -->
        
                                <div class="portlet-content">
        
                                    <div class="row">
        
                                        <div class="col-sm-4">
        
                                            <div  class="form-group">
                                                <label for="text-input">PRODUCT NAME</label>
                                                <input name="title" type="text" id="text-input" class="form-control">
                                            </div>
                                        <div class="form-group">
                                                <label >PRODUCT IMAGE</label>
                                                <input  name = "img"  type="file" class="form-control">
                                            </div>
                                        <div  class="form-group">
                                                <label for="text-input">PRODUCT DESCRIPTION</label>
                                                <input  name="description" type="text" id="text-input" class="form-control">
                                            </div>

                                            <div  class="form-group">
                                                <label for="text-input">PRODUCT PRICE</label>
                                                <input  name="price" type="text" id="text-input" class="form-control">
                                            </div>

                                            <div  class="form-group">
                                                <label for="text-input">PRODUCT QUANTITY</label>
                                                <input  name="quantity" type="text" id="text-input" class="form-control">
                                            </div>

                                            <div  class="form-group">
                                                <label for="text-input">PRODUCT BRAND</label>
                                                <input  name="brand" type="text" id="text-input" class="form-control">
                                            </div>
    
                                        </div> <!-- /.col -->
        
                                    </div> <!-- /.row -->


                                    <div class="row">
        
                                        <div class="col-sm-4">
                                            <label>PRODUCT CATEGORY</label>
                                            <div class="form-group" name="product_cat">

                                            <?php foreach($categories as $k => $v): ?>


                                                <label class="radio-inline">
                                                    <input type="radio" name="product_cat" value=<?php echo $v["category_id"]?>>
                                                    <?php echo $v["category_name"]?>
                                                </label>

                                               <?php endforeach;?> 
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->
    
                                    <button name="add_product" type="submit" class="btn btn-default">ADD PRODUCT</button>
        
        
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




