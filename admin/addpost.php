<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php 
                if (isset($_POST['create_post'])) {
                    $post_title = mysqli_real_escape_string($db->link,$_POST['title']);
                    $post_category =  mysqli_real_escape_string($db->link,$_POST['post_category']);
                    $post_author =  mysqli_real_escape_string($db->link,$_POST['author']);
                    $post_tag =  mysqli_real_escape_string($db->link,$_POST['tag']);
                    $post_body =  mysqli_real_escape_string($db->link,$_POST['body']);


                    ///image file query
                          $post_img = $_FILES['img']['name'];
                          $extension = strtolower(substr($post_img,strlen($post_img)-4,strlen($post_img)));
                          $allowed_extensions = array(".jpg","jpeg",".png",".gif");
                          if(in_array($extension,$allowed_extensions)){

                          $destination = "../images/post_img/".$post_img;  
                          $file = $_FILES['img']['tmp_name'];
                          move_uploaded_file($file, $destination);                    
                    ///ending image file query


                    if (!empty($post_title) && !empty($post_category) && !empty($post_author) && !empty($post_tag) && !empty($post_body)) {
                       $query = "INSERT INTO post(post_category_id,post_title,post_body,post_image,post_author,post_tags) VALUES('{$post_category}','{$post_title}','{$post_body}','{$post_img}','{$post_author}','{$post_tag}') ";
                        $insert_query_rslt = $db->insert($query);
                        if ($insert_query_rslt) {
                            echo "<p style='color:green;text-align:center;'>post created successfully</p>";
                        }else{
                             echo "<p style='color:red;text-align:center;'>opps!! post is not created</p>";
                        }

                    }else{
                        echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
                    }

                }else{
                  echo "<p style='color:red;text-align:center;'>image type must be (.jpg, jpeg, .png, .gif)</p>"; 
                }

            }




                 ?>

                <div class="block">               
                 <form action="addpost.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Post Title" name="title" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="post_category">
                                    <option>Select Category</option>
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
                                <input  type="file"  name="img" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author name</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Post Author" name="author" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Post Tags</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Post Tag" name="tag" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="create_post" Value="Save" />
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




 
