</div>


	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="../blog/index.php">Home</a></li>
				
				<?php 
            $query = "select * from pages order by page_name DESC ";
            $pages_result = $datab->select($query);
            if ($pages_result) {
                while ($row = $pages_result->fetch_assoc()) {
                    $page_id = $row['page_id'];
                    $page_name = $row['page_name'];
                    $page_body = $row['page_body'];
                ?>
                 <li><a href="page.php?pg_id=<?php echo $page_id; ?>"><?php echo $page_name; ?></a></li>                

            <?php

                }

            }
    	?>
			<li><a href="../blog/contact.php">Contact</a></li>
		</ul>
	  </div>
		 <?php 

            $f_query = "select * from footer where footer_id = '1' ";
            $footer_select_query = $db->select($f_query);
            if ($footer_select_query) {
                $f_row = $footer_select_query->fetch_array();

                $copy_text = $f_row['footer_content'];
            }

         ?>

	  <p>Copyright &copy; <?php echo date("Y")." ".$copy_text.". "; ?>All rights reserved</p>
	</div>
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

	<div class="fixedicon clear">
		<a href="http://www.facebook.com/<?php echo $facebook; ?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="http://www.twitter.com/<?php echo $twitter; ?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="http://www.linkedin.com/in/<?php echo $linkedIn; ?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="https://www.instagram.com/<?php echo $instagram; ?>" target="_blank"><img src="images/gl.png" alt="instagram"/></a>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>