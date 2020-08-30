<?php 
$db = new Database();
$fm = new formate();



 ?>
<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
				<?php 
					$query = "select * from category";
					$get_cat_rows = $db->select($query);
					if ($get_cat_rows) {
						while ($row = $get_cat_rows->fetch_assoc() ) {
							$cat_id = $row['cat_id'];
							$cat_title = $row['cat_title'];
					

				 ?>
					<ul>
						<li><a href="category_posts.php?cat_id=<?php echo $cat_id; ?>"><?php echo $cat_title; ?></a></li>			
					</ul>
					<?php }
					}else{
						echo "no category";
					} ?>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
					<div class="popular clear">
						<?php 
						$query = "select * from post order by post_id desc limit 4";
						$get_latesr_posts = $db->select($query);
					if ($get_latesr_posts) {
						while ($row = $get_latesr_posts->fetch_assoc() ) {
							$post_id = $row['post_id'];
							$post_title = $row['post_title'];
							$post_image = $row['post_image'];
							$post_body = $row['post_body'];

						 ?>

						<h3><a href="post.php?id=<?php echo $post_id; ?>"><?php echo $post_title;  ?></a></h3>
						<a href="post.php?id=<?php echo $post_id; ?>"><img src="images/post_img/<?php echo $post_image; ?>" alt="post image"/></a>
						<p><?php echo $fm->makeShorter($post_body,90);  ?></p>
					<?php } } ?>

					</div>
	
			</div>
			
		</div>