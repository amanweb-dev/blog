<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <?php 
                	if (isset($_GET['del_user_id'])) {
                		$del_user_id = $_GET['del_user_id'];

                		$select_post_query = "select user_img from user where id = $del_user_id ";
                		$result_query = $db->select($select_post_query);
                		if ($result_query) {

	                		$image_row = $result_query->fetch_array();
	                		$user_img = $image_row['user_img'];
	                		unlink('../images/user_img/'.$user_img);
                			
                		}

                		$query = "delete from user where id = $del_user_id";
                		$user_del_result = $db->delete($query);
                		if ($user_del_result) {
                			echo "<p style='color:green;text-align:center;font-size:20px;'>user deleted successfully</p>";
                		}else{
                			echo "<p style='color:red;text-align:center;font-size:20px;'>fail to delete user</p>";
                		}
                	}

                 ?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="15%">Name</th>
							<th width="20%">Username</th>
							<th width="10%">Email</th>
							<th width="10%">Image</th>
							<th width="10%">Details</th>
							<th width="10%">Role</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							$query = "SELECT * FROM user ";
							$query_result = $db->select($query);
							$query_num_rows = mysqli_num_rows($query_result);
							if ($query_num_rows>0) {
								while ($rows = $query_result->fetch_assoc()) {
									$id=$rows['id'];
									$name=$rows['name'];
									$username=$rows['username'];
									// $password=$rows['password'];
									$user_email=$rows['user_email'];
									$user_img=$rows['user_img'];
									$user_details=$rows['user_details'];
									$user_role=$rows['user_role'];
									
						 ?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><a href="#"><?php echo $name; ?></a></td>
							<td><?php echo $username; ?></td>	
							<td><?php echo $user_email; ?></td>
							<td><img width="80px" height="80px" src="../images/user_img/<?php echo $user_img; ?> " alt=""></td>
							<td><?php echo $user_details; ?></td>
							<td>
								<?php
								 if($user_role == '0'){
								 	echo "No Role";
								 }else if($user_role == '1'){
								 	echo "Admin";

								 }else if($user_role == '2'){
								 	echo "Author";
								 	
								 }else if($user_role == '3'){
								 	echo "Editor";
								 }else{
								 	echo "Error";
								 }

								  ?>
									
								</td>
							<td><a href="viewprofile.php?editPost=<?php echo $id; ?>">View</a> || <a onclick="return confirm('Are you sure to delete?')" href="userlist.php?del_user_id=<?php echo $id;?>">Delete</a></td>
						</tr>

						<?php $i++; }

							}

						 ?>
						
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
       
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    
    
<?php include "inc/footer.php" ?>
