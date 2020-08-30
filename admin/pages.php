<?php include "inc/header.php"; ?>
<?php  include "inc/sidebar.php"; ?>
 
 <?php 
if (isset($_GET['pg_id'])){
    $page_id = $_GET['pg_id'];
     $query = "select * from pages where page_id = '$page_id' ";
    $pages_result = $db->select($query);
    if ($pages_result) {
        while ($row = $pages_result->fetch_assoc()) {
            $page_name = $row['page_name'];
            $page_body = $row['page_body'];
        }

    }else{
        echo "no pages";
    }
}

  ?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Page</h2>
                <?php 

                        if (isset($_GET['pg_del_id'])) {
                        $pg_del_id=$_GET['pg_del_id'];

                        $del_query = "delete from pages where page_id = '$pg_del_id' ";
                        $result = $db->delete($del_query);
                        if ($result) {

                             echo "<p style='color:red;text-align:center;font-size:20px;'>page has been deleted</p>";
                             echo "<script>alert('page has been deleted');</script>";
                             echo "<script>window.location = 'index.php'</script>";
                        }
                            
                        }

                    ?>


                    <?php 
                        if (isset($_POST['update_page'])) {

                            $pg_id_up  = mysqli_real_escape_string($db->link,$_POST['pgid']);
                            $pg_name_up  = mysqli_real_escape_string($db->link,$_POST['pgname']);
                            $pg_body_up =  mysqli_real_escape_string($db->link,$_POST['pgbody']);


                            if (!empty($pg_name_up) && !empty($pg_body_up)) {
                               $query = "update pages set page_name= '$pg_name_up',page_body ='$pg_body_up' where page_id = '$pg_id_up' ";
                                $insert_query_rslt = $db->insert($query);
                                if ($insert_query_rslt) {
                                    echo "<p style='color:green;text-align:center;'>Page update successfully</p>";
                                }else{
                                     echo "<p style='color:red;text-align:center;'>opps!! page is not updated</p>";
                                }

                            }else{
                                echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
                            }


                        }


                    ?>


                <div class="block">               
                     <form action="Pages.php" method="post">
                        <table class="form">
                           
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo isset($_GET['pg_id'])?$page_name : $pg_name_up ?>" name="pgname" class="medium" />
                                </td>
                            </tr>
       
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="pgbody"><?php echo isset($_GET['pg_id'])?$page_body : $pg_body_up?></textarea>
                                </td>
                            </tr>
                                
                                 <input type="hidden" value="<?php echo isset($_GET['pg_id'])?$page_id : "" ?>" name="pgid" class="medium" />
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="update_page" Value="Update" />
                                    <button style="background-color:red;font:black;padding: 5px 8px;margin-left: 54%"><a onclick="return confirm('Are you sure to delete?')" href="Pages.php?pg_del_id=<?php echo isset($_GET['pg_id'])?$page_id : $pg_id_up ?>">Delete</a></button>
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




 
