<?php include "inc/header.php"; ?>

<?php 
$db = new Database();
$fm = new formate();



 ?>
	
	<div class="contentsection contemplete clear">

		<div class="maincontent clear">
		<!-- pagination -->
			<?php 
				$post_per_page =2;
				if (isset($_GET['page_no'])) {
					$page_no = $_GET['page_no'];
				}else{
					$page_no=1;
				}
				$offset = ($page_no-1)*$post_per_page;


			 ?>

		<!-- pagination -->

			<?php 
			if (isset($_GET['cat_id']) && $_GET['cat_id']!=NULL) {
				$cat_id=mysqli_real_escape_string($db->link,$_GET['cat_id']);
			
				$query = "select * from post where post_category_id = $cat_id limit $offset,$post_per_page ";
				$post = $db->select($query);
				if ($post) { 
					
				while ($result = $post->fetch_assoc() ) {
					$post_id = $result['post_id'];
					$cat_id = $result['post_category_id'];
					$post_title = $result['post_title'];
					$post_body = $result['post_body'];
					$post_image = $result['post_image'];
					$post_author = $result['post_author'];
					$post_tags = $result['post_tags'];
					$post_date = $result['post_date'];
					
				

			 ?>

			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $post_id; ?>"><?php echo  $post_title; ?></a></h2>
				<h4><?php echo  $fm->formateDate($post_date)." , By"; ?>  <a href="#"><?php echo $post_author;  ?></a></h4>
				 <a href="#"><img src="images/post_img/<?php echo $post_image; ?>" alt="post image"/></a>
				<p>
					<?php echo $fm->makeShorter($post_body);  ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $post_id; ?>">Read More</a>
				</div>
			</div>


		<?php } ?> <!-- end while loop -->

		<!-- pagination -->

		<?php 
			$query= "select * from post where post_category_id = $cat_id";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_pages = ceil($total_rows/$post_per_page);
			$prev_page = $page_no-1;
			$next_page = $page_no+1;
			if ($total_pages>1) {
				echo " <span id='myDIV' class='pagination'><a href='category_posts.php?page_no=1&cat_id=$cat_id'>".'First page'."</a> ";
			}else{
				echo "<h3 style='text-align:center'>No More Page</h3>";
			}

			if ($page_no>1) {
				echo " <span id='myDIV' class='pagination'><a href='category_posts.php?page_no=$prev_page&cat_id=$cat_id'>".'Prev'."</a> ";
			}

		
		

		$total_page_limit = 10;
		$first_part_limit = $page_no+3;
		$last_part_limit = $total_pages-3;
		

		if ($total_pages>$total_page_limit && $first_part_limit<$last_part_limit) {
			
			for ($i=$page_no; $i <=$first_part_limit ; $i++) { 
			echo "<a  href='category_posts.php?page_no=$i&cat_id=$cat_id'>$i</a>";
		}
		echo "....";
		for ($i=$last_part_limit; $i <$total_pages ; $i++) { 
			echo "<a href='category_posts.php?page_no=$i&cat_id=$cat_id'>$i</a>";
		}


		}else{
		for ($i=2; $i <$total_pages ; $i++) { 
			echo "<a href='category_posts.php?page_no=$i&cat_id=$cat_id'>$i</a>";
		}
		}
		if ($page_no<$total_pages) {
			echo "<a href='category_posts.php?page_no=$next_page&cat_id=$cat_id'>".'Next'."</a>";
		}
		 
		 if ($total_pages>1) {
				echo "<a href='category_posts.php?page_no=$total_pages&cat_id=$cat_id'>".'Last page'."</a></span>"; 
			}
		 ?>
		<!-- pagination -->




		<?php  }else{
			echo "<p style='color:red;text-align:center;font-size:20px;'>No Post available</p>";
		} }else if(!isset($_GET['cat_id']) || $_GET['cat_id']==NULL){
			 header("Location:404.php");
			
		}else{
			echo "category not found";
		} ?>

		</div>
		

<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>
		