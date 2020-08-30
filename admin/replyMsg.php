<?php include "inc/header.php"; ?>
<?php  include "inc/sidebar.php"; ?>
 
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Massage</h2>

                <?php 
                    if (isset($_GET['msgId'])) {
                        $msgId = $_GET['msgId'];

                        $query = "select * from contact where cntct_id = '$msgId' ";
                            $cntct_result = $db->select($query);
                            if ($cntct_result) {
                                while ($row = $cntct_result->fetch_assoc()) {
                                   $cntct_id = $row['cntct_id'];
                                    $cntct_fname = $row['cntct_fname'];
                                    $cntct_lname = $row['cntct_lname'];
                                    $cntct_email = $row['cntct_email'];
                                    $cntct_massage = $row['cntct_massage'];
                                    $cntct_status = $row['cntct_status'];
                                    $cntct_date  = $row['cntct_date'];

                                    $cntct_full_name = $cntct_fname." ".$cntct_lname;
                                }
                        
                            }?> 

                            <table class="form">                    
                                <tr>
                                    <td>
                                        <p><b>Date: </b><?php echo $fm->formateDate($cntct_date); ?></p>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>From: </b><?php echo $cntct_full_name; ?></p>
                                       
                                    </td>
                                </tr>
                                <tr> 
                                    <td>
                                        <p><b>Email: </b><?php echo $cntct_email; ?></p>
                                        
                                    </td>
                                </tr>
                                <tr> 
                                    <td>
                                        <b>Massage:</b>
                                        <p><?php echo $cntct_massage; ?></p>
                                    </td>
                                </tr>
                            </table>

                            <?php
                        
                        }

                     ?>

                    <?php 
                        if (isset($_POST['sendmail'])) {

                            $tomail = $fm->validation($_POST['tomail']);
                            $frommail = $fm->validation($_POST['frommail']);
                            $subject = $fm->validation($_POST['subject']);
                            $massage = $fm->validation($_POST['massage']);

                            $tomail  = mysqli_real_escape_string($db->link,$tomail);
                            $frommail =  mysqli_real_escape_string($db->link,$frommail);
                            $subject =  mysqli_real_escape_string($db->link,$subject);
                            $massage =  mysqli_real_escape_string($db->link,$massage);


                            $sendMail = mail($tomail, $subject, $massage, $frommail);
                            if ($sendMail) {
                                echo "<p style='color:green;text-align:center;font-size:20px;'>Massage is sent successfully</p>";
                            }else{
                                echo "<p style='color:red;text-align:center;font-size:20px;'>Massage sending failed</p>"; 
                            }

                        }


                    ?>

                    
                    
                <h2>Your Reply: </h2>
                <div class="block">               
                     <form action="replyMsg.php" method="post" enctype="multipart/form-data">
                        <table class="form">
                           
                            <tr>
                                <td>
                                    <label>To: </label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo isset($_GET['msgId']) ? $cntct_email : ''; ?>" name="tomail" class="medium" />
                                </td>
                            </tr>

                             <tr>
                                <td>
                                    <label>From: </label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Enter Email" name="frommail" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Subject: </label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Enter Subject" name="subject" class="medium" />
                                </td>
                            </tr>
       
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Massage</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="massage"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="sendmail" Value="Send Email" />
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




 
