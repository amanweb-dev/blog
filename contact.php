<?php include "inc/header.php"; ?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>

				 <?php 
				    if (isset($_POST['contact_submit'])) {

				        $cntct_firstname =$frmt->validation($_POST['firstname']);
				        $cntct_lastname =$frmt->validation($_POST['lastname']);
				        $cntct_mail =$frmt->validation($_POST['mail']);
				        $cntct_body =$frmt->validation($_POST['body']);

				        $cntct_firstname = mysqli_real_escape_string($datab->link,$cntct_firstname);
				        $cntct_lastname = mysqli_real_escape_string($datab->link,$cntct_lastname);
				        $cntct_mail = mysqli_real_escape_string($datab->link,$cntct_mail);
				        $cntct_body = mysqli_real_escape_string($datab->link,$cntct_body);

				        if (!empty($cntct_firstname) && !empty($cntct_lastname) && !empty($cntct_body) && filter_var($cntct_mail,FILTER_VALIDATE_EMAIL)) {
				            $query = "Insert into contact(cntct_fname,cntct_lname,cntct_email,cntct_massage) values('$cntct_firstname','$cntct_lastname','$cntct_mail','$cntct_body') ";
				        $create = $datab->insert($query);
				        if ($create) {
				           echo "<p style='color:green;text-align:center;'>Massage has been sent successfully</p>";
				        }else{
				            echo "<p style='color:red;text-align:center;'>opps!! Massage is not sent</p>";
				        }

				        
				    }else{
				        echo "<p style='color:red;text-align:center;'>field must not be empty</p>";
				    }
				}

				 ?>


				<form action="contact.php" method="post">
					<table>
						<tr>
							<td>Your First Name:</td>
							<td>
							<input type="text" name="firstname" placeholder="Enter first name" />
							</td>
						</tr>
						<tr>
							<td>Your Last Name:</td>
							<td>
							<input type="text" name="lastname" placeholder="Enter Last name" />
							</td>
						</tr>
						
						<tr>
							<td>Your Email Address:</td>
							<td>
							<input type="email" name="mail" placeholder="Enter Email Address" />
							</td>
						</tr>
						<tr>
							<td>Your Message:</td>
							<td>
							<textarea name="body"></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
							<input type="submit" name="contact_submit" value="Submit"/>
							</td>
						</tr>
					</table>
				<form>				
 			</div>
		</div>
		
<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>