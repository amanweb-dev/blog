<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

<div class="grid_10">
            <div class="box round first grid">
                <h2>Update Social Media</h2>

<?php 
    if (isset($_POST['submit'])) {
       
        $facebook = mysqli_real_escape_string($db->link,$_POST['facebook']);
        $twitter =  mysqli_real_escape_string($db->link,$_POST['twitter']);
        $linkedin =  mysqli_real_escape_string($db->link,$_POST['linkedin']);
        $instagram =  mysqli_real_escape_string($db->link,$_POST['instagram']);
        

        if (!empty($facebook) && !empty($twitter) && !empty($linkedin) && !empty($instagram)) { 
           $query = "update social set facebook = '$facebook',twitter='$twitter',linkedin='$linkedin',instagram='$instagram' where s_id =  '1' ";
            $update_social = $db->update($query);
            if ($update_social) {
                echo "<p style='color:green;text-align:center;'>social links are updated Successfully</p>";
            }else{
                 echo "<p style='color:red;text-align:center;'>opps!! not updated</p>";
            }

        }else{
            echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
        }

}

?>

        

                <?php 

                    $s_query = "select * from social where s_id = '1' ";
                    $scial_select_query = $db->select($s_query);
                    if ($scial_select_query) {
                        $s_row = $scial_select_query->fetch_array();

                        $s_id = $s_row['s_id'];
                        $facebook = $s_row['facebook'];
                        $twitter = $s_row['twitter'];
                        $linkedIn = $s_row['linkedIn'];
                        $instagram = $s_row['instagram'];
                    }

                 ?>


                <div class="block">               
                 <form action="social.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $facebook ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $twitter ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $linkedIn ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Instagram</label>
                            </td>
                            <td>
                                <input type="text" name="instagram" value="<?php echo $instagram ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>


<?php include "inc/footer.php" ?>
