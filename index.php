<?php include "inc/header.php"; ?>
<?php include "inc/slider.php"; ?>

<?php 
$db = new Database();
$fm = new formate();



 ?>
	
	<div class="contentsection contemplete clear">

		<div class="maincontent clear">
		<!-- pagination -->
			<?php 
				$post_per_page =3;
				if (isset($_GET['page_no'])) {
					$page_no = $_GET['page_no'];
				}else{
					$page_no=1;
				}
				$offset = ($page_no-1)*$post_per_page;


			 ?>

		<!-- pagination -->

			<?php 
				$query = "select * from post limit $offset,$post_per_page";
				$post = $db->select($query);
				if ($post) { 
					
				while ($result = $post->fetch_assoc() ) {
					$post_id = $result['post_id'];
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
			$query= "select * from post";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_pages = ceil($total_rows/$post_per_page);
			$prev_page = $page_no-1;
			$next_page = $page_no+1;

			if ($total_pages>1) {
				echo " <span id='myDIV' class='pagination'><a href='index.php?page_no=1'>".'First page'."</a> ";
			}else{
				echo "<h3 style='text-align:center'>No More Page</h3>";
			}
			

			if ($page_no>1) {
				echo " <span id='myDIV' class='pagination'><a href='index.php?page_no=$prev_page'>".'Prev'."</a> ";
			}

		
		

		$total_page_limit = 10;
		$first_part_limit = $page_no+3;
		$last_part_limit = $total_pages-3;
		

		if ($total_pages>$total_page_limit && $first_part_limit<$last_part_limit) {
			
			for ($i=$page_no; $i <=$first_part_limit ; $i++) { 
			echo "<a  href='index.php?page_no=$i'>$i</a>";
		}
		echo "....";
		for ($i=$last_part_limit; $i <$total_pages ; $i++) { 
			echo "<a href='index.php?page_no=$i'>$i</a>";
		}


		}else{
		for ($i=2; $i <$total_pages ; $i++) { 
			echo "<a href='index.php?page_no=$i'>$i</a>";
		}
		}
		if ($page_no<$total_pages) {
			echo "<a href='index.php?page_no=$next_page'>".'Next'."</a>";
		}
		 if ($total_pages>1) {
				 echo "<a href='index.php?page_no=$total_pages'>".'Last page'."</a></span>"; 
			}
		 
		?>
		<!-- pagination -->




		<?php  }else{
			header("Location:404.php");
		} ?>

		</div>
		

<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>
		