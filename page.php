<?php include "inc/header.php"; ?>
<?php 
$db = new Database();

 ?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">

				<?php 
					if (isset($_GET['pg_id'])){
					    $page_id = $_GET['pg_id'];
					     $query = "select * from pages where page_id = '$page_id' ";
					    $pages_result = $db->select($query);
					    if ($pages_result) {
					        while ($row = $pages_result->fetch_assoc()) {
					            $page_name = $row['page_name'];
					            $page_body = $row['page_body'];
					        
					            ?>
					            <h2><?php echo $page_name; ?></h2>
					            <p><?php echo $page_body; ?></p>

					      
					      <?php  }

					    }else{
					        header("Location:404.php");
					    }
					}

				?>	


				
	
				
				
				
			</div>

		</div>
		
	<?php include "inc/sidebar.php"; ?>
	<?php include "inc/footer.php"; ?>
