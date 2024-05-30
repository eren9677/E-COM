<!-- <script src="https://cdn.tailwindcss.com"></script> -->
<?php
include("config.php");

include("logged_in_check.php");



$query = "SELECT * FROM products;";

$products = berkhoca_query_parser($query);

if(isset($_GET["delete"]) &&  !empty($_GET["delete"])){

	$id =  $_GET["delete"];

	$query2 = "DELETE FROM products WHERE id = '$id' ;";

	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-ticaret";

   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $conn->query($query2);

	header("Location: product_list.php ");
	exit;


}







?>

<?php include('header.php'); ?>

<body>
<div id="wrapper">


    <?php include('top_bar.php'); ?>

    <?php include('left_sidebar.php'); ?>

    
    <div id="content">      
        
        <div id="content-header">
            <h1>PRODUCT LIST</h1>
        </div> <!-- #content-header --> 


        <div id="content-container">


            <div class="row">


                <div class="col-md-12">

					<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Product ID</th>
				            <th>Product Name</th>
				            <th>Product Image</th>
				            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Brand</th>
                            <th>Date Added</th>
							<th>Options</th>
				          </tr>
				        </thead>
				        <tbody>

						<?php

						foreach($products as $k => $v):
						
						?>

				          <tr>
				            <td><?php echo $v['id'] ?></td>
				            <td><?php echo $v['title'] ?></td>
							<th> <img src="../../<?php echo $v['img'] ?>" alt="Product image" height="100" width="150"></th>
							<td><?php echo $v['description'] ?></td>
                            <td><?php echo $v['price'] ?></td>
                            <td><?php echo $v['quantity'] ?></td>
                            <td><?php echo $v['brand'] ?></td>
                            <td><?php echo $v['date_added'] ?></td>
                            

				            <td>
				            	<a href="product_list.php?delete=<?php echo $v["id"]?>"><span class="label label-primary">Delete</span></a>
								
								<a href="edit_product.php?edit=<?php echo $v["id"]?>"><span class="label label-secondary">Update</span></a>
				            </td>
				          </tr>

						  <?php endforeach;?>
				        </tbody>
				      </table>
							
				</div>

            </div> <!-- /.row -->

        </div> <!-- /#content-container -->
        

    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>




