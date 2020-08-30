<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <?php 
                	if (isset($_GET['del_post_id'])) {
                		$del_post_id = $_GET['del_post_id'];

                		$select_post_query = "select post_image from post where post_id = $del_post_id ";
                		$result_query = $db->select($select_post_query);
                		if ($result_query) {

	                		$image_row = $result_query->fetch_array();
	                		$post_image = $image_row['post_image'];
	                		unlink('../images/post_img/'.$post_image);
                			
                		}

                		$query = "delete from post where post_id = $del_post_id";
                		$post_del_result = $db->delete($query);
                		if ($post_del_result) {
                			echo "<p style='color:green;text-align:center;font-size:20px;'>post deleted successfully</p>";
                		}else{
                			echo "<p style='color:red;text-align:center;font-size:20px;'>fail to delete post</p>";
                		}
                	}

                 ?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="15%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							$query = "SELECT * FROM post ";
							$query_result = $db->select($query);
							$query_num_rows = mysqli_num_rows($query_result);
							if ($query_num_rows>0) {
								while ($rows = $query_result->fetch_assoc()) {
									$post_id=$rows['post_id'];
									$post_category_id=$rows['post_category_id'];
									$post_title=$rows['post_title'];
									$post_body=$rows['post_body'];
									$post_image=$rows['post_image'];
									$post_author=$rows['post_author'];
									$post_tags=$rows['post_tags'];
									$post_date=$rows['post_date'];
									$post_date=$fm->formateDate($post_date);

									$cat_query = "SELECT * FROM category WHERE cat_id = $post_category_id ";
									$cat_query_result = $db->select($cat_query);
									$cat_query_array = $cat_query_result->fetch_array();
									
								

						 ?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><a href="../post.php?id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></td>
							<td><?php echo $fm->makeShorter($post_body,100);  ?></td>	
							<td><?php echo $cat_query_array['cat_title']; ?></td>
							<td><img width="80px" height="80px" src="../images/post_img/<?php echo $post_image; ?> " alt=""></td>
							<td><?php echo $post_author; ?></td>
							<td><?php echo $post_tags; ?></td>
							<td> <?php echo $post_date ?></td>
							<td><a href="editPost.php?editPost=<?php echo $post_id; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="postlist.php?del_post_id=<?php echo $post_id;?>">Delete</a></td>
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
