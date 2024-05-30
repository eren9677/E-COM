<?php
include("config.php");

include("logged_in_check.php");


if(isset($_GET["edit"]) && !empty($_GET["edit"])){


    $_SESSION["product_id"] = $_GET["edit"];

    //echo "<pre>"; print_r($admin); die();
}
    $a = $_SESSION["product_id"];

    $query = "SELECT * FROM products WHERE id = '$a' ;";

    $product = berkhoca_query_parser($query);

    //echo "<pre>"; print_r($product); die();


$query2 = "SELECT * FROM categories;";

$categories = berkhoca_query_parser($query2);



if(isset($_POST["edit_product"]) && !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["quantity"])  && !empty($_POST["brand"])){

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

    $stmt = $conn->prepare("UPDATE products SET title = ?, img = ?, description = ?, price = ?, quantity = ?, category_id = ?, brand = ? WHERE id = ?");


    $stmt->bind_param("ssssssss", $product_name, $use, $product_description, $price, $quantity, $category_id, $brand, $a);
    $stmt->execute();


    move_uploaded_file($_FILES["img"]["tmp_name"], $folder);


   header('Location: edit_product.php?correct=1');
   exit;
}










?>

<?php include('header.php'); ?>

<html>
    <form action="edit_product.php" method="post" enctype="multipart/form-data">
        <body>
        
        <div id="wrapper">
        
        
            <?php include('top_bar.php'); ?>
        
            <?php include('left_sidebar.php'); ?>
                <div id="content">
        
                    <div id="content-header">
                        <h1>EDIT PRODUCT</h1>
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
                                        PRODUCT INFO
                                    </h3>
        
                                </div> <!-- /.portlet-header -->
        
                                <div class="portlet-content">
        
                                    <div class="row">
        
                                        <div class="col-sm-4">
        
                                            <div  class="form-group">
                                                <label for="text-input">PRODUCT NAME</label>
                                                <input name="title" type="text" id="text-input" class="form-control" value ="<?php echo $product[0]["title"]?>">
                                            </div>
                                        <div class="form-group">
                                                <label >PRODUCT IMAGE</label>
                                                <input  name = "img"  type="file" class="form-control" value =<?php echo $product[0]["img"]?>>
                                            </div>
                                        <div  class="form-group">
                                                <label for="text-input">PRODUCT DESCRIPTION</label>
                                                <textarea rows ="5" cols="100"  name="description" type="text"  class="form-control" > <?php echo $product[0]["description"]?> </textarea>
                                            </div>

                                            <div  class="form-group">
                                                <label for="text-input">PRODUCT PRICE</label>
                                                <input  name="price" type="text" id="text-input" class="form-control" value ="<?php echo $product[0]["price"]?>">
                                            </div>

                                            <div  class="form-group">
                                                <label for="text-input">PRODUCT QUANTITY</label>
                                                <input  name="quantity" type="text" id="text-input" class="form-control" value ="<?php echo $product[0]["quantity"]?>">
                                            </div>

                                            <div  class="form-group">
                                                <label for="text-input">PRODUCT BRAND</label>
                                                <input  name="brand" type="text" id="text-input" class="form-control" value ="<?php echo $product[0]["brand"]?>">
                                            </div>
    
                                        </div> <!-- /.col -->
        
                                    </div> <!-- /.row -->


                                    <div class="row">
        
                                        <div class="col-sm-4">
                                            <label>PRODUCT CATEGORY</label>
                                            <div class="form-group" name="product_cat">

                                            <?php foreach($categories as $k => $v):

                                            //echo "<pre>"; print_r($product);
                                                
                                                ?>


                                                <label class="radio-inline">
                                                    <input type="radio" name="product_cat" value=<?php echo $v["category_id"];?> <?php echo ($v["category_id"] == $product[0]["category_id"]) ?  "checked" : "" ;  ?>>
                                                    <?php echo $v["category_name"]?>
                                                </label>

                                               <?php endforeach;?> 
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->
    
                                    <button name="edit_product" type="submit" class="btn btn-default">FINISH EDIT</button>
        
        
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




