<?php 
include "config.php";
?>
<!doctype html>
<html>
    <head>
        <title>Delete Multiple Selected Records with PHP</title>
		
		
		<head>
		<title>Coe</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">Messages List</h3>
			<br />
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
        <!-- <link href='style.css' rel='stylesheet' type='text/css'> -->

        <?php 
        if(isset($_POST['but_delete'])){

            if(isset($_POST['delete'])){
                foreach($_POST['delete'] as $deleteid){

                    $deleteUser = "DELETE from messages WHERE id=".$deleteid;
                    mysqli_query($con,$deleteUser);
                }
            }
            
        }
        ?>
    </head>
    <body>
        <div class='container'>

            <!-- Form -->
            <form method='post' action=''>
               
            

            <!-- Record list -->
            <div class="table-responsive">
				<table class="table table-bordered table-striped">
                <tr style='background: whitesmoke;'>
                    
										
					
					                    <th>TYPE</th>                                 
                                        <th>ATTACHEMENT</th>
									    <th>MESSAGE</th>
										<th>CREATED_AT</th>
										<th>STATUS</th>
										<th>ACTION</th>
                </tr>
				

                <?php 
                $query = "SELECT * FROM messages";
                $result = mysqli_query($con,$query);

                $count = 1;
                while($row = mysqli_fetch_array($result) ){
                    $id = $row['id'];
                    $type = $row['type'];
                    $attachement = $row['attachement'];
                    $message = $row['message']; 
					$created_at = $row['created_at'];
                    $status = $row['status'];
                ?>
                    <tr id='tr_<?= $id ?>'>

                        <td><?= $type ?></td>
                        <td><?= $attachement ?></td>
                        <td><?= $message ?></td>
                        <td><?= $created_at ?></td>
						<td><?= $status ?></td>

                        <!-- Checkbox -->
                        <td><input type='checkbox' name='delete[]' value='<?= $id ?>' ></td>
                        
                    </tr>
                <?php
                }
                ?>
            </table>
			<BR>
				 <input type='submit' value='Delete' name='but_delete'><br><br>
            </form>
        </div>
    </body>
</html>