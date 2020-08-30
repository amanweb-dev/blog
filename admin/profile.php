<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update user</h2>
                <?php 
                    $user_id = Session::get('userId');
                    $user_role = Session::get('user_role');
                    $ssn_username = Session::get('username');

                    $query = "SELECT * FROM user WHERE id = '$user_id' AND user_role = '$user_role' ";
                    $select_user = $db->select($query);

                    if ($select_user) {

                        $row = $select_user->fetch_array();

                        $id_old = $row['id'];
                        $name_old = $row['name'];     
                        $username_old = $row['username'];    
                        $password_old = $row['password'];     
                        $user_email_old = $row['user_email'];     
                        $user_img_old = $row['user_img'];   
                        $user_details_old = $row['user_details'];   
                            
                        
                    }else{
                         echo "<p style='color:red;text-align:center;'>opps!! not found the User</p>"; 
                    }

                ?>


                <?php 
                if (isset($_POST['update_user'])) {
                    $id_up = $_POST['user_id_edit'];
                    $username = mysqli_real_escape_string($db->link,$_POST['username']);
                    $name = mysqli_real_escape_string($db->link,$_POST['name']);
                    $userpass = mysqli_real_escape_string($db->link,$_POST['userpass']);
                    $useremail =  mysqli_real_escape_string($db->link,$_POST['useremail']);
                    $user_img = $_FILES['img']['name'];
                    $user_body =  mysqli_real_escape_string($db->link,$_POST['body']);

                    $userpass = md5($userpass);
                    

                   
                    ///image file query
                    if (!empty($user_img)) {
                        $extension = strtolower(substr($user_img,strlen($user_img)-4,strlen($user_img)));
                          $allowed_extensions = array(".jpg","jpeg",".png");

                           if(in_array($extension,$allowed_extensions)){
                           $same_img = $id_up.$extension;
                          $destination = "../images/user_img/".$same_img;  
                          $file = $_FILES['img']['tmp_name'];
                          move_uploaded_file($file, $destination); 
                           }else{

                             echo "<p style='color:red;text-align:center;'>image type must be (jpg, jpeg, png)</p>"; 
                        }
                        
                    }else {
                            $query = "select user_img from user where id = $user_id ";
                            $select_user_image = $db->select($query);
                            if ($select_user_image) {

                                $row = $select_user_image->fetch_array();   
                                $same_img = $row['user_img'];
                                 
                                
                            }else{
                                 $same_img = NULL; 
                            }
                        }

                    ///ending image file query

                     $query = "select id,username from user where username ='$username'  ";
                    $validation = $db->select($query);
                   if($validation == true){
                     $row = mysqli_num_rows($validation);
                     $value = mysqli_fetch_array($validation);
                    if($row>0 && $row<2){
                        
                        if ($user_id == $value['id']) {
                             if (!empty($username) && !empty($name) && !empty($userpass) && !empty($useremail) && !empty($user_body)) { 
                               $query = "update user set username = '$username',name = '$name',password = '$userpass',user_email='$useremail',user_img='$same_img',user_details='$user_body' where id = '$id_up' ";
                                $update_user = $db->update($query);
                                if ($update_user) {
                                    echo "<p style='color:green;text-align:center;'>Profile updated Successfully</p>";
                                }else{
                                     echo "<p style='color:red;text-align:center;'>opps!! Profile is not updated</p>";
                                }

                            }else{
                                echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
                            }
                        }else{
                            echo "<p style='color:red;text-align:center;'>please choose defferent user name</p>"; 
                        }
                        
                    }else{
                         echo "<p style='color:red;text-align:center;'>username has been taken by another one. please choose defferent one</p>";
                    }

                   }else{
                    echo "<p style='color:red;text-align:center;'>username not found</p>";
                   }


                   

            }




                 ?>

                <div class="block">               
                 <form action="profile.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo !empty($username_old) ?$username_old : $ssn_username ?>" name="username" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo !empty($name_old) ? $name_old : '' ?>" name="name" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password"  value="<?php echo !empty($password_old) ? '' : '' ?>" name="userpass" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" value="<?php echo !empty($user_email_old) ? $user_email_old : '' ?>" name="useremail" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                 <p>if do not upload a photo, previous photo will be saved</p>
                                <input  type="file"  name="img" />
                            </td>
                        </tr>

                         <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>User details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo !empty($user_details_old) ? $user_details_old : '' ?></textarea>
                            </td>
                        </tr>
                             <input type="hidden" value="<?php echo $user_id; ?>" name="user_id_edit" />
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="update_user" Value="Update" />
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




 
