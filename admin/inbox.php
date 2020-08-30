<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php 
					if (isset($_GET['seenId'])) {
						$seenId = $_GET['seenId'];
						 $query = "update  contact set cntct_status = '1' where cntct_id =  $seenId ";
					    $update = $db->update($query);
					    if ($update) {
					       echo "<p style='color:green;text-align:center;'>Massage is moved to SEen box</p>";
					    }else{
					        echo "<p style='color:red;text-align:center;'>opps!! Massage is not moved</p>";
					    }
					}

				?>		


                <div class="block">        
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th>Serial No.</th>
								<th>Name</th>
								<th>Email</th>
								<th>Message</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$query = "select * from contact where cntct_status = '0' order by cntct_id desc ";
								$cntct_result = $db->select($query);
								if ($cntct_result) {
									$number_of_rows = mysqli_num_rows($cntct_result);
									$i=1;
									while ($row = $cntct_result->fetch_assoc()) {
										$cntct_id = $row['cntct_id'];
										$cntct_fname = $row['cntct_fname'];
										$cntct_lname = $row['cntct_lname'];
										$cntct_email = $row['cntct_email'];
										$cntct_massage = $row['cntct_massage'];
										$cntct_status = $row['cntct_status'];
										$cntct_date	 = $row['cntct_date'];

										$cntct_full_name = $cntct_fname." ".$cntct_lname;


							 ?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $cntct_full_name; ?></td>
								<td><?php echo $cntct_email; ?></td>
								<td><?php echo $cntct_massage; ?></td>
								<td><?php echo $cntct_date; ?></td>
								<td>
									<a href="viewMsg.php?msgId=<?php echo $cntct_id; ?>">View</a> || 
									<a href="replyMsg.php?msgId=<?php echo $cntct_id;?>">Reply</a> || 
									<a onclick="return confirm('Are you sure to move Seen Box?')" href="inbox.php?seenId=<?php echo $cntct_id;?>">Seen</a>
								</td>
							</tr>
							<?php $i++; }
								}else{
									echo "<p style='color:red;text-align:center;font-size:20px;'>No Massage available</p>";
								}
							 ?>
							
						</tbody>
					</table>
               </div>
            </div>
            <div class="box round first grid">
                <h2>Seen Massage</h2>
                <?php 
					if (isset($_GET['msgdelId'])) {
						$msgdelId = $_GET['msgdelId'];
						 $query = "delete from  contact where cntct_id =  $msgdelId ";
					    $delete = $db->delete($query);
					    if ($delete) {
					       echo "<p style='color:green;text-align:center;'>Massage is deleted Succesfully</p>";
					    }else{
					        echo "<p style='color:red;text-align:center;'>opps!! Massage is not deleted</p>";
					    }
					}

				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th>Serial No.</th>
								<th>Name</th>
								<th>Email</th>
								<th>Message</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$query = "select * from contact where cntct_status = '1' order by cntct_id desc ";
								$cntct_result = $db->select($query);
								if ($cntct_result) {
									$number_of_rows = mysqli_num_rows($cntct_result);
									$i=1;
									while ($row = $cntct_result->fetch_assoc()) {
										$cntct_id = $row['cntct_id'];
										$cntct_fname = $row['cntct_fname'];
										$cntct_lname = $row['cntct_lname'];
										$cntct_email = $row['cntct_email'];
										$cntct_massage = $row['cntct_massage'];
										$cntct_status = $row['cntct_status'];
										$cntct_date	 = $row['cntct_date'];

										$cntct_full_name = $cntct_fname." ".$cntct_lname;


							 ?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $cntct_full_name; ?></td>
								<td><?php echo $cntct_email; ?></td>
								<td><?php echo $cntct_massage; ?></td>
								<td><?php echo $cntct_date; ?></td>
								<td><a href="viewMsg.php?msgId=<?php echo $cntct_id; ?>">View</a> ||
								<a onclick="return confirm('Are you sure to delete?')" href="inbox.php?msgdelId=<?php echo $cntct_id; ?>">Delete</a></td>
							</tr>
							<?php $i++; }
								}else{
									echo "<p style='color:red;text-align:center;font-size:20px;'>No Massage available</p>";
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
