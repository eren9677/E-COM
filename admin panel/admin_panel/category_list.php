<?php
include("config.php");

include("logged_in_check.php");



$query = "SELECT * FROM categories;";

$categories = berkhoca_query_parser($query);

if(isset($_GET["delete"]) &&  !empty($_GET["delete"])){

	$id =  $_GET["delete"];

	$query2 = "DELETE FROM categories WHERE category_id = '$id' ;";

	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-ticaret";

   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $conn->query($query2);

	header("Location: category_list.php ");
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
            <h1>CATEGORY LIST</h1>
        </div> <!-- #content-header --> 


        <div id="content-container">


            <div class="row">


                <div class="col-md-12">

					<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Category ID</th>
				            <th>Category Name</th>
				            <th>Category Image</th>
				            <th>Description</th>
							<th>Options</th>
				          </tr>
				        </thead>
				        <tbody>

						<?php

						foreach($categories as $k => $v):
						
						?>

				          <tr>
				            <td><?php echo $v['category_id'] ?></td>
				            <td><?php echo $v['category_name'] ?></td>
							<th> <img src="../../<?php echo $v['category_img'] ?>" alt="Category image" height="100" width="150"></th>
							<td><?php echo $v['category_description'] ?></td>
				            <td>
				            	<a href="category_list.php?delete=<?php echo $v["category_id"]?>"><span class="label label-primary">Delete</span></a>
								
								<a href="edit_category.php?edit=<?php echo $v["category_id"]?>"><span class="label label-secondary">Update</span></a>
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




