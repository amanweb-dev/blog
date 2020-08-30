<?php include "inc/header.php" ?>
<?php  include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>View Massage</h2>
               <div class="block copyblock"> 
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
                        
                            }
                        
                        }

                     ?>
                 
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
                     <tr> 
                        <td>
                           <a href="inbox.php"> <button style="float:left;margin-top: 5%;padding: 8px 20px;">Ok</button></a>
                            <a href="replyMsg.php?msgId=<?php echo $cntct_id;?> "><button style="float:left;margin-left: 10%;margin-top: 5%;padding: 10px 15px;">Reply</button></a>
                            
                        </td>
                    </tr>
                   
                </div>
            </div>
        </div>
<?php include "inc/footer.php" ?>
