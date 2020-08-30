<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New User</h2>
                <?php 
                    if (isset($_POST['create_user'])) {
                        $username = mysqli_real_escape_string($db->link,$_POST['username']);
                        $password =  mysqli_real_escape_string($db->link,$_POST['userpass']);
                        $user_role =  mysqli_real_escape_string($db->link,$_POST['user_role']);
                        $password = md5($password);
 

                        if (!empty($username) && !empty($password) && !empty($user_role)){

                            $query = "select * from user where username ='$username' ";
                            $login = $db->select($query);
                            if ($login == false) {


                               $query = "INSERT INTO user(username,password,user_role) VALUES('{$username}','{$password}',{$user_role}) ";
                                $insert_query_rslt = $db->insert($query);
                                if ($insert_query_rslt) {
                                    echo "<p style='color:green;text-align:center;'>User created successfully</p>";
                                }else{
                                     echo "<p style='color:red;text-align:center;'>opps!! user is not created</p>";
                                }

                                    
                                }else{

                                     echo "<span style='color:red;text-align:center;font-size:20px;'>username already exits</span>";
                                }

                        }else{
                            echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
                        }

                  }

                ?>

                <div class="block">               
                 <form action="adduser.php" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Your Name" name="username" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter Your Password" name="userpass" class="medium" />
                            </td>
                        </tr>

                       
                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select id="select" name="user_role">
                                    <option value="0">Select User Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Author</option>
                                    <option value="3">Editor</option>
                                                       
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="create_user" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

<?php include "inc/footer.php" ?>




 
