<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

                <?php 
                	if (isset($_GET['del'])) {
                		$del_id = $_GET['del'];

                		$query = "delete from category where cat_id = $del_id";
                		$del_result = $db->delete($query);
                		if ($del_result) {
                			echo "<p style='color:green;text-align:center;font-size:20px;'>category deleted successfully</p>";
                		}else{
                			echo "<p style='color:red;text-align:center;font-size:20px;'>fail to delete category</p>";
                		}
                	}

                 ?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query = "select * from category ";
							$cat_result = $db->select($query);
							if ($cat_result) {
								$number_of_rows = mysqli_num_rows($cat_result);
								$i=1;
								while ($row = $cat_result->fetch_assoc()) {
									$cat_id = $row['cat_id'];
									$cat_title = $row['cat_title'];


						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $cat_title; ?></td>
							<td><a href="editCat.php?edit=<?php echo $cat_id; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="catlist.php?del=<?php echo $cat_id;?>">Delete</a></td>
						</tr>
						<?php $i++; }
							}else{
								echo "<p style='color:red;text-align:center;font-size:20px;'>No category available</p>";
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



 