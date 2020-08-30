<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>
<?php 
if (isset($_GET['edit']) && $_GET['edit'] !=NULL) {
    $id = $_GET['edit'];


     $query = "select * from category where cat_id = $id ";
    $select_cat = $db->select($query);
    if ($select_cat) {

        $row = $select_cat->fetch_array();
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];     
        
    }else{
         echo "<p style='color:red;text-align:center;'>opps!! not found the category</p>"; 
    }
}



 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 

                <?php 
                    if (isset($_POST['update'])) {

                        $cat_id_up =$_POST['cat_id'];
                        $cat_title =$fm->validation($_POST['cat_name']);
                        $cat_title_up = mysqli_real_escape_string($db->link,$cat_title);

                        if (!empty($cat_title_up)) {
                            $query = "update  category set cat_title = '$cat_title_up' where cat_id =  $cat_id_up ";
                        $update = $db->update($query);
                        if ($update) {
                           echo "<p style='color:green;text-align:center;'>catagory updated successfully</p>";
                        }else{
                            echo "<p style='color:red;text-align:center;'>opps!! category is not updated</p>";
                        }

                        
                    }else{
                        echo "<p style='color:red;text-align:center;'>field must not be empty</p>";
                    }
                }


                     ?>
                 <form action="editCat.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value=" <?php echo (!empty($cat_title) ? $cat_title : '') ?> " name="cat_name" class="medium" />
                            </td>
                             <td>
                                <input type="hidden" value=" <?php echo (isset($_GET['edit']) ? $cat_id : $cat_id_up) ?> " name="cat_id" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php" ?>
