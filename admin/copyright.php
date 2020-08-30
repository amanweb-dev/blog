<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

<div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>

                    <?php 
                        if (isset($_POST['submit_cpy'])) {
                           
                            $footer_text = mysqli_real_escape_string($db->link,$_POST['copyright']);
                            

                            if (!empty($footer_text)) { 
                               $query = "update footer set footer_content = '$footer_text' where footer_id =  '1' ";
                                $update_footer = $db->update($query);
                                if ($update_footer) {
                                    echo "<p style='color:green;text-align:center;'>Copyright is updated Successfully</p>";
                                }else{
                                     echo "<p style='color:red;text-align:center;'>opps!! not updated</p>";
                                }

                            }else{
                                echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
                            }

                    }

                    ?>


                     <?php 

                        $f_query = "select * from footer where footer_id = '1' ";
                        $footer_select_query = $db->select($f_query);
                        if ($footer_select_query) {
                            $f_row = $footer_select_query->fetch_array();

                            $copy_text = $f_row['footer_content'];
                        }

                     ?>
        
                <div class="block copyblock"> 
                 <form action="copyright.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <p>Write only company / organization name, EX:(amanweb-dev.github.io)</p>
                                <input type="text" value="<?php echo $copy_text; ?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit_cpy" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        
<?php include "inc/footer.php" ?>
