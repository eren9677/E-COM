<?php
include("config.php");

include("logged_in_check.php");



$query = "SELECT * FROM orders;";

$orders = berkhoca_query_parser($query);

if(isset($_GET["delete"]) &&  !empty($_GET["delete"])){

	$id =  $_GET["delete"];

	$query2 = "DELETE FROM orders WHERE order_id = '$id' ;";

	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-ticaret";

   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $conn->query($query2);

	header("Location: order_list.php ");
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
            <h1>ORDER LIST</h1>
        </div> <!-- #content-header --> 


        <div id="content-container">


            <div class="row">


                <div class="col-md-12">

					<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Order ID</th>
				            <th>Customer Name</th>
				            <th>Customer Surname</th>
				            <th>Address</th>
                            <th>Zipcode</th>
				            <th>Country</th>
                            <th>City</th>
				            <th>E-mail</th>
                            <th>Products</th>
				            <th>Order Date</th>
                            <th>Phone Number</th>
				            <th>Total</th>
                            <th>Options</th>
				          </tr>
				        </thead>
				        <tbody>

						<?php

						foreach($orders as $k => $v):
									
						
						?>

				          <tr>
				            <td><?php echo $v['order_id'] ?></td>
				            <td><?php echo $v['name'] ?></td>
                            <td><?php echo $v['surname'] ?></td>
				            <td><?php echo $v['Address'] ?></td>
                            <td><?php echo $v['zipcode'] ?></td>
				            <td><?php echo $v['country'] ?></td>
                            <td><?php echo $v['city'] ?></td>
				            <td><?php echo $v['email'] ?></td>


                            <td> 

								<?php 
									$prods = json_decode($v["products"],true);
									//echo "<pre>"; print_r($prods); 
									$product_ids = array_keys($prods);

									//echo "<pre>"; print_r($product_ids); 

									$q = "SELECT * FROM products WHERE id IN (";
									foreach ($product_ids as $id) {
										$q .= $id . ",";
									}
									// Remove the trailing comma
									$q = rtrim($q, ",");
									$q .= ")";
									
									$products = berkhoca_query_parser($q);
									foreach($products as $product):
								
								
								?>
								
							
							
							
							
								<img src="../../<?php echo $product["img"] ?>" alt="prods" height="50" width="25">
								X <?php echo $prods[$product["id"]]?>
						
						
							<?php endforeach;?>
						
							</td>




				            <td><?php echo $v['order_date'] ?></td>
                            <td><?php echo $v['phone_num'] ?></td>
				            <td>₺<?php echo number_format($v["total"],2,".",",") ?></td>
                            <td>
				            	<a href="order_list.php?delete=<?php echo $v["order_id"]?>"><span class="label label-primary">Delete</span></a>
				            </td>
				          </tr>

						  <?php 
						  	endforeach;
						  
						  ?>
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




