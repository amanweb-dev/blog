<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php 
                    if (isset($_POST['submit'])) {

                        $cat_title =$fm->validation($_POST['cat_name']);
                        $cat_title = mysqli_real_escape_string($db->link,$cat_title);

                        if (!empty($cat_title)) {
                            $query = "Insert into category(cat_title) values('$cat_title') ";
                        $create = $db->insert($query);
                        if ($create) {
                           echo "<p style='color:green;text-align:center;'>catagory created successfully</p>";
                        }else{
                            echo "<p style='color:red;text-align:center;'>opps!! category is not created</p>";
                        }

                        
                    }else{
                        echo "<p style='color:red;text-align:center;'>field must not be empty</p>";
                    }
                }


                     ?>
                 <form action="addcat.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name" name="cat_name" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php" ?>
