<?php include "config/config.php" ?>
<?php include "helpers/formate.php" ?>
<?php include "lib/database.php" ?>
<?php 
 $datab = new Database();
 $frmt = new formate();
$ts_query = "select * from title_slogan where ts_id = '1' ";
$st_select_query = $datab->select($ts_query);
if ($st_select_query) {
    $ts_row = $st_select_query->fetch_array();

    $ts_title = $ts_row['ts_title'];
    $ts_slogan = $ts_row['ts_slogan'];

    $all = $ts_title.",".$ts_slogan;
 
}

define("WEB_TITLE", $ts_title);
define("KEYWORD",$all);

 ?>	

<!DOCTYPE html>
<html>
<head>
	<?php 
		if (isset($_GET['pg_id'])) {
			$crnt_pg_id = $_GET['pg_id'];

            $query = "select * from pages where page_id = $crnt_pg_id ";
            $pages_result = $datab->select($query);
            if ($pages_result) {
                while ($row = $pages_result->fetch_assoc()) {         
                    $pre_title = $row['page_name']; 
                }
            }
		}else if(isset($_GET['id'])){
			$id_post = $_GET['id'];
			 $query = "select * from post where post_id = $id_post ";
            $post_result = $datab->select($query);
            if ($post_result) {
                while ($row = $post_result->fetch_assoc()) {         
                    $pre_title = $row['post_title']; 
                }
            }
		}else{
			$pre_title="";
		}

	 ?>

	<title><?php echo !empty($pre_title)?$pre_title." - ".WEB_TITLE :$frmt->title().WEB_TITLE ; ?></title>



	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">


		<?php 
		 if(isset($_GET['id'])){
			$meta_cntn_id = $_GET['id'];
			 $query = "select * from post where post_id = $meta_cntn_id ";
            $tag_result = $datab->select($query);
            if ($tag_result) {
                while ($row = $tag_result->fetch_assoc()) {         
                    $tags = $row['post_tags']; 
            ?>
			<meta name="author" content="<?php echo $tags; ?>">
            
            <?php
                    
                }
            }
		}else{ ?> 
			
			<meta name="author" content="<?php echo KEYWORD; ?>">
			
			<?php
		}

	 ?>
	




	<!-- <meta name="keywords" content="blog,cms blog"> -->



	<link rel="stylesheet" href="../blog/font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="../blog/css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../blog/style.css">
	<!-- <script src="../blog/js/custom.js" type="text/javascript"></script> -->
	<script src="../blog/js/jquery.js" type="text/javascript"></script>
	<script src="../blog/js/jquery.nivo.slider.js" type="text/javascript"></script>
	

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>

</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">

 				<?php 

 					
                    $ts_query = "select * from title_slogan where ts_id = '1' ";
                    $st_select_query = $datab->select($ts_query);
                    if ($st_select_query) {
                        $ts_row = $st_select_query->fetch_array();

                        // $ts_id = $ts_row['ts_id'];
                        $ts_title = $ts_row['ts_title'];
                        $ts_slogan = $ts_row['ts_slogan'];
                        $ts_logo = $ts_row['ts_logo'];
                    }

                 ?>


				<img src="images/site_logo/<?php echo $ts_logo; ?>" alt="Logo"/>
				<h2><?php echo $ts_title; ?></h2>
				<p><?php echo $ts_slogan; ?></p>
			</div>
		</a>
		<div class="social clear">
			 <?php 

                    $s_query = "select * from social where s_id = '1' ";
                    $scial_select_query = $datab->select($s_query);
                    if ($scial_select_query) {
                        $s_row = $scial_select_query->fetch_array();

                        $s_id = $s_row['s_id'];
                        $facebook = $s_row['facebook'];
                        $twitter = $s_row['twitter'];
                        $linkedIn = $s_row['linkedIn'];
                        $instagram = $s_row['instagram'];
                    }

                 ?>
			<div class="icon clear">
				<a href="http://www.facebook.com/<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="http://www.twitter.com/<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="http://www.linkedin.com/in/<?php echo $linkedIn; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="https://www.instagram.com/<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li><a <?php echo ($frmt->pageName() == 'index')?"id='active'" : '' ?> href="index.php">Home</a></li>
		<?php 
            $query = "select * from pages order by page_name DESC ";
            $pages_result = $datab->select($query);
            if ($pages_result) {
                while ($row = $pages_result->fetch_assoc()) {
                    $page_id = $row['page_id'];
                    $page_name = $row['page_name'];
                    $page_body = $row['page_body'];
                ?>

                <li><a <?php echo (isset($_GET['pg_id']) && $_GET['pg_id']==$page_id)? "id='active'" : ''; ?> href="page.php?pg_id=<?php echo $page_id; ?>"><?php echo $page_name; ?></a></li>                

            <?php

                }

            }
    	?>

		 	
		<li><a <?php echo ($frmt->pageName() == 'contact')?"id='active'" : '' ?> href="contact.php">Contact</a></li>
	</ul>
</div>
