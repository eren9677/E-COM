<?php
include("config.php");

include("logged_in_check.php");



$query = "SELECT * FROM admin_table;";

$admins = berkhoca_query_parser($query);

if(isset($_GET["delete"]) &&  !empty($_GET["delete"])){

	$id =  $_GET["delete"];

	$query2 = "DELETE FROM admin_table WHERE admin_id = '$id' ;";

	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-ticaret";

   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $conn->query($query2);

	header("Location: admin_list.php ");
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
            <h1>ADMIN LIST</h1>
        </div> <!-- #content-header --> 


        <div id="content-container">


            <div class="row">


                <div class="col-md-12">

					<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Admin ID</th>
				            <th>First Name</th>
				            <th>Last Name</th>
				            <th>Username</th>
							<th>Password</th>
				            <th>Status</th>
							<th>Options</th>
				          </tr>
				        </thead>
				        <tbody>

						<?php

						foreach($admins as $k => $v):
						
						?>

				          <tr>
				            <td><?php echo $v['admin_id'] ?></td>
				            <td><?php echo $v['admin_name'] ?></td>
							<th><?php echo $v['admin_surname'] ?></th>
				            <td>@<?php echo $v['admin_username'] ?></td>
				            <td><?php echo $v['admin_pass'] ?></td>
							<td><?php echo $v['admin_status'] ?></td>
				            <td>
				            	<a href="admin_list.php?delete=<?php echo $v["admin_id"]?>"><span class="label label-primary">Delete</span></a>
								
								<a href="edit_admin.php?edit=<?php echo $v["admin_id"]?>"><span class="label label-secondary">Update</span></a>
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




