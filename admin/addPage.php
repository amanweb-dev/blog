<?php include "inc/header.php"; ?>
<?php  include "inc/sidebar.php"; ?>
 
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Page</h2>

                    <?php 
                        if (isset($_POST['create_page'])) {

                            $pg_name  = mysqli_real_escape_string($db->link,$_POST['pgname']);
                            $pg_body =  mysqli_real_escape_string($db->link,$_POST['pgbody']);


                            if (!empty($pg_name) && !empty($pg_body)) {
                               $query = "INSERT INTO pages(page_name,page_body) VALUES('{$pg_name}','{$pg_body}')";
                                $insert_query_rslt = $db->insert($query);
                                if ($insert_query_rslt) {
                                    echo "<p style='color:green;text-align:center;'>Page created successfully</p>";
                                }else{
                                     echo "<p style='color:red;text-align:center;'>opps!! page is not created</p>";
                                }

                            }else{
                                echo "<p style='color:red;text-align:center;'>Field must not be empty</p>";
                            }


                        }


                    ?>

                <div class="block">               
                     <form action="addPage.php" method="post">
                        <table class="form">
                           
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Enter Post Title" name="pgname" class="medium" />
                                </td>
                            </tr>
       
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="pgbody"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="create_page" Value="Create" />
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




 
