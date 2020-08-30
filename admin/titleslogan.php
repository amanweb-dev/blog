<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

<div class="grid_10">
        
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>

<?php 
    if (isset($_POST['submit'])) {
       
        $ts_title = mysqli_real_escape_string($db->link,$_POST['ts_title']);
        $ts_slogan =  mysqli_real_escape_string($db->link,$_POST['ts_slogan']);
        $post_img = $_FILES['logo']['name'];


        ///image file query
        if (!empty($post_img)) {

            $extension = strtolower(substr($post_img,strlen($post_img)-4,strlen($post_img)));
              $allowed_extensions = array(".png");

              if(in_array($extension,$allowed_extensions)){
               $same_img = 'logo'.$extension;
              $destination = "../images/site_logo/".$same_img;  
              $file = $_FILES['logo']['tmp_name'];
              move_uploaded_file($file, $destination); 
               }else{

                 echo "<p style='color:red;text-align:center;'>image type must be (.png)</p>"; 
            }
            
        }else {
                $query = "select ts_logo from title_slogan where ts_id = '1' ";
                $select_post_image = $db->select($query);
                if ($select_post_image) {

                    $row = $select_post_image->fetch_array();   
                     $same_img = $row['ts_logo'];
                     
                    
                }else{
                     echo "<p style='color:red;text-align:center;'>opps!! not found any Image</p>"; 
                }
            }

        ///ending image file query




        if (!empty($ts_title) && !empty($ts_slogan) && $same_img) { 
           $query = "update title_slogan set ts_title = '$ts_title',ts_slogan='$ts_slogan',ts_logo='$same_img' where ts_id =  '1' ";
            $update_post = $db->update($query);
            if ($update_post) {
                echo "<p style='color:red;text-align:center;'>title,slogan,logo updated Successfully</p>";
            }else{
                 echo "<p style='color:red;text-align:center;'>opps!! not updated</p>";
            }

        }else{
            echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
        }

}

?>


                <div class="block sloginblock"> 

                <?php 

                    $ts_query = "select * from title_slogan where ts_id = '1' ";
                    $st_select_query = $db->select($ts_query);
                    if ($st_select_query) {
                        $ts_row = $st_select_query->fetch_array();

                        $ts_id = $ts_row['ts_id'];
                        $ts_title = $ts_row['ts_title'];
                        $ts_slogan = $ts_row['ts_slogan'];
                        $ts_logo = $ts_row['ts_logo'];
                    }

                 ?>

                <div class="leftside">             
                     <form action="titleslogan.php" method="post" enctype="multipart/form-data">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label>Website Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $ts_title; ?>"  name="ts_title" class="medium" />
                                </td>
                            </tr>
    						 <tr>
                                <td>
                                    <label>Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $ts_slogan; ?>" name="ts_slogan" class="medium" />
                                </td>
                            </tr>

                             <tr>
                                <td>
                                    <label>Website Logo</label>
                                </td>
                                <td>
                                    <input type="file"   name="logo" class="medium" />
                                </td>
                            </tr>
    						 
    						
    						 <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div> 
                    <div class="rightside">
                        <img src="../images/site_logo/<?php echo  $ts_logo; ?> " alt="">
                    </div>
                </div>
            </div>
        </div>

<?php include "inc/footer.php" ?>
