<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>
<?php 
if (isset($_GET['editPost']) && $_GET['editPost'] !=NULL) {
    $id = $_GET['editPost'];


     $query = "select post.*,category.* from post inner join category on post.post_category_id = category.cat_id where post_id = $id ";
    $select_post = $db->select($query);
    if ($select_post) {

        $row = $select_post->fetch_array();
        $post_id_old = $row['post_id'];
        $post_category_id_old = $row['post_category_id'];     
        $category_name = $row['cat_title'];    
        $post_title_old = $row['post_title'];     
        $post_body_old = $row['post_body'];     
        $post_image_old = $row['post_image'];   
        $post_author_old = $row['post_author'];   
        $post_tags_old = $row['post_tags'];   
        $post_date_old = $row['post_date'];   
        
    }else{
         echo "<p style='color:red;text-align:center;'>opps!! not found the Post</p>"; 
    }
}

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <?php 
                if (isset($_POST['update_post'])) {
                    $post_id_up = $_POST['post_id_edit'];
                    $post_category_edit = $_POST['post_category_edit'];
                    $post_title = mysqli_real_escape_string($db->link,$_POST['title']);
                    $post_category =  mysqli_real_escape_string($db->link,$_POST['post_category']);
                    $post_author =  mysqli_real_escape_string($db->link,$_POST['author']);
                    $post_tag =  mysqli_real_escape_string($db->link,$_POST['tag']);
                    $post_body =  mysqli_real_escape_string($db->link,$_POST['body']);
                    $post_img = $_FILES['img']['name'];


                    ///image file query
                    if (!empty($post_img)) {
                        $extension = strtolower(substr($post_img,strlen($post_img)-4,strlen($post_img)));
                          $allowed_extensions = array(".jpg","jpeg",".png",".gif");

                          if(in_array($extension,$allowed_extensions)){

                          $destination = "../images/post_img/".$post_img;  
                          $file = $_FILES['img']['tmp_name'];
                          move_uploaded_file($file, $destination); 
                           }else{

                             echo "<p style='color:red;text-align:center;'>image type must be (.jpg, jpeg, .png, .gif)</p>"; 
                        }
                        
                    }else {
                            $query = "select post_image from post where post_id = $post_id_up ";
                            $select_post_image = $db->select($query);
                            if ($select_post_image) {

                                $row = $select_post_image->fetch_array();   
                                $post_img = $row['post_image'];
                                 
                                
                            }else{
                                 echo "<p style='color:red;text-align:center;'>opps!! not found any Image</p>"; 
                            }
                        }

                    ///ending image file query

            


                    if (!empty($post_title) && !empty($post_category) && !empty($post_author) && !empty($post_tag) && !empty($post_body) && !empty($post_img)) { 
                       $query = "update post set post_category_id = '$post_category',post_title='$post_title',post_body='$post_body',post_image='$post_img',post_author='$post_author',post_tags='$post_tag' where post_id =  $post_id_up ";
                        $update_post = $db->update($query);
                        if ($update_post) {
                            echo "<p style='color:green;text-align:center;'>Post updated Successfully</p>";
                        }else{
                             echo "<p style='color:red;text-align:center;'>opps!! post is not updated</p>";
                        }

                    }else{
                        echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
                    }

            }




                 ?>

                <div class="block">               
                 <form action="editPost.php" method="post" enctype="multipart/form-data">
                    <table class="form">
   
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo (isset($_GET['editPost']))?$post_title_old : $post_title?>" name="title" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="post_category">
                                    <?php 

                                        $query = "select * from category ";
                                        $cat_query = $db->select($query);
                                        $cat_num_rows = mysqli_num_rows($cat_query);
                                        if (!empty($cat_num_rows)) {
                                            while ($rows = $cat_query->fetch_assoc()) {
                                                $cat_id = $rows['cat_id'];
                                                $cat_title = $rows['cat_title'];
                                               echo "<option value='$cat_id'>$cat_title</option>";
                                            }
                                        }

                                     ?>                    
                                </select>
                            </td>
                        </tr>
                       
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <p>If you do not upload new image, old image will be there</p>
                                <input  type="file"  name="img" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author name</label>
                            </td>
                            <td>
                                <input type="text" value=" <?php echo (isset($_GET['editPost'])) ? $post_author_old : $post_author ?> " name="author" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Post Tags</label>
                            </td>
                            <td>
                                <input type="text" value=" <?php echo (isset($_GET['editPost'])) ? $post_tags_old : $post_tag ?> " name="tag" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <p></p>
                                <textarea class="tinymce" name="body"><?php echo (isset($_GET['editPost'])) ? $post_body_old : $post_body ?></textarea>
                            </td>
                        </tr>

                         <input type="hidden"  name="post_id_edit" value= " <?php echo (isset($_GET['editPost'])) ? $post_id_old : $post_id_up ?>" />

                         <input type="hidden"  name="post_category_edit" value= "<?php echo (isset($_GET['editPost']))?$category_name : $cat_title ?>" />

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="update_post" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>


<!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>


<?php include "inc/footer.php" ?>




 
