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
			if (isset($_GET['search'])) {
				$search=$_GET['search'];
			
				$query = "select * from post where post_title like '%$search%' or post_body like '%$search%' or post_tags like '%$search%' limit $offset,$post_per_page";
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
				 <a href="post.php?id=<?php echo $post_id; ?>"><img src="images/post_img/<?php echo $post_image; ?>" alt="post image"/></a>
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
			$query= "select * from post where post_title like '%$search%' or post_body like '%$search%' or post_tags like '%$search%' and post_id != $post_id";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_pages = ceil($total_rows/$post_per_page);
			$prev_page = $page_no-1;
			$next_page = $page_no+1;
			if ($total_pages>1) {
				echo " <span id='myDIV' class='pagination'><a href='search.php?page_no=1&search=$search'>".'First page'."</a> ";
			}else{
				echo "<h3 style='text-align:center'>No More Page</h3>";
			}

			if ($page_no>1) {
				echo " <span id='myDIV' class='pagination'><a href='search.php?page_no=$prev_page&search=$search'>".'Prev'."</a> ";
			}

		
		

		$total_page_limit = 10;
		$first_part_limit = $page_no+3;
		$last_part_limit = $total_pages-3;
		

		if ($total_pages>$total_page_limit && $first_part_limit<$last_part_limit) {
			
			for ($i=$page_no; $i <=$first_part_limit ; $i++) { 
			echo "<a  href='search.php?page_no=$i&search=$search'>$i</a>";
		}
		echo "....";
		for ($i=$last_part_limit; $i <$total_pages ; $i++) { 
			echo "<a href='search.php?page_no=$i&search=$search'>$i</a>";
		}


		}else{
		for ($i=2; $i <$total_pages ; $i++) { 
			echo "<a href='search.php?page_no=$i&search=$search'>$i</a>";
		}
		}
		if ($page_no<$total_pages) {
			echo "<a href='search.php?page_no=$next_page&search=$search'>".'Next'."</a>";
		}
		 
		 if ($total_pages>1) {
				echo "<a href='search.php?page_no=$total_pages&search=$search'>".'Last page'."</a></span>"; 
			}
		 ?>
		<!-- pagination -->




		<?php  }else{
			echo "<h3 style='color:red;text-align:center;'>search keyword not found</h3>";
		}  }else{
		header("Location:404.php");	
		}?>

		</div>
		

<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>
