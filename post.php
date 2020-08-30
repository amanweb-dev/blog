<?php include "inc/header.php"; ?>
<?php 
if (!isset($_GET['id']) || $_GET['id']== NULL) {
	header("Location:404.php");
}else{
	$id = $_GET['id'];
}

$db = new Database();
$fm= new formate();


 ?>

	<div class="contentsection contemplete clear">
		
		<div class="maincontent clear">
			<div class="about">
				<?php 
					$query = "select * from post where post_id = $id ";
					$single_post = $db->select($query);

					if ($single_post) {
						while ($row = $single_post->fetch_assoc()) {
							$post_id = $row['post_id'];
							$post_category_id = $row['post_category_id'];
							$post_title = $row['post_title'];
							$post_body = $row['post_body'];
							$post_image = $row['post_image'];
							$post_author = $row['post_author'];
							$post_tags = $row['post_tags'];
							$post_date = $row['post_date'];
							
					?>
				<h2><?php echo  $post_title; ?></h2>
				<h4><?php echo  $fm->formateDate($post_date)." , By"; ?>  <a href="#"><?php echo $post_author;  ?></a></h4>
				 <a href="post.php?id=<?php echo $post_id; ?>"><img src="images/post_img/<?php echo $post_image; ?>" alt="post image"/></a>
				<p><?php echo $post_body; ?></p>
				
				

				<?php 		}
					


				 ?>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>

					<?php 

						$query= "select * from post where post_category_id = $post_category_id and post_id != $post_id limit 6 ";
						$related_post = $db->select($query);

						if ($related_post) {
						while ($row = $related_post->fetch_assoc()) {
							$post_id = $row['post_id'];
							$post_image = $row['post_image'];

							?>
							<a href="post.php?id=<?php echo $post_id; ?> "><img src="images/post_img/<?php echo $post_image; ?>" alt="post image"/></a>

					<?php }

					}else{
						echo "no releted post available!";

					} 

					}else{
						header("Location:404.php");
					}



					  ?>

					
					
					
				</div>
				
			</div>

		</div>

<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>