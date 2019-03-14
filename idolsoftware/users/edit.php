<?php
error_reporting(0);

ob_start();
session_start();
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$ses_user_id= $_SESSION['sess_user_id'];
$ses_user_type= $_SESSION['ses_user_types'];

 $sql = "SELECT * FROM sale_person_creation  where sal_per_id='$_GET[edit_id]' ";
$rows = $db->fetch_all_array($sql);
foreach($rows as $record)
{
	
$person_name = $record['person_name'];
$person_email = $record['person_email'];
 $phn_no  = $record['phn_no'];
$designation  = $record['designation'];
$shift_start = $record['shift_start'];
$shift_end = $record['shift_end'];
 $username  = $record['username'];
$password  = $record['password'];
$confirm_password = $record['confirm_password'];
 $photo  = $record['photo'];
$status  = $record['status'];
 $user_company_id  = $record['user_company_id'];
$user_company_type  = $record['user_company_type'];
$random_no  = $record['random_no'];
 $random_sec  = $record['random_sec'];
$user_ip  = $record['user_ip'];
}

?>
<input type="hidden" name="random_no" id="randomno" value="<?php echo $random_no; ?>"/> 
   <input type="hidden" name="random_sec" id="randomsec" value="<?php echo $random_sec; ?>"/>
      <input type="hidden" name="user_ip" id="user_ip" value="<?php echo $user_ip; ?>"/>


				
                       
						<div class="modal-body">
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="personname" value="<?php echo $person_name; ?>" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email</label>
											<input class="form-control" type="email" id="emailid" value="<?php echo $person_email; ?>" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Mobile No <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="mobile" value="<?php echo $phn_no; ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="designtion" name="designtion" value="<?php echo $designation; ?>">
										</div>
									</div>
                                    	<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Shift Start Time <span class="text-danger">*</span></label>
											<input class="form-control" type="time" id="starttime" name="start_time" value="<?php echo $shift_start; ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Shift End Time <span class="text-danger">*</span></label>
											<input class="form-control" type="time" id="endtime" value="<?php echo $shift_end; ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">User Name</label>
											<input class="form-control" type="text" id="username" name="user_name" value="<?php echo $username; ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" type="password" id="passwrd" name="passwrd" value="<?php echo $password; ?>">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input class="form-control" type="password" id="confirmpassword" name="confirm_password" value="<?php echo $confirm_password; ?>">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Status</label>
											<select class="form-control"  id="status" name="status">
                                            <option value="1" <?php if($status='1') { ?> selected<?php } ?>>Active</option>
                                             <option value="0" <?php if($status='0') { ?> selected<?php } ?>>De-Active</option>

                                            </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Photo</label>
											<input class="form-control" type="file" id="photoper" name="photoper">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											 <img src="assets/img/users/<?php echo $photo; ?>" name="image_name" width="95" height="80" id="image_name"/>
											<input class="form-control" type="hidden" id="img" name="imgsd" value="<?php echo $photo; ?>">
										</div>
									</div>
									
									
									
									
								</div>
								
								
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="button" id="edit" name="edit" onClick="edit_sales_person(personname.value,emailid.value,mobile.value,designtion.value,starttime.value,endtime.value,username.value,passwrd.value,confirmpassword.value,status.value,'<?php echo $ses_user_id; ?>','<?php echo $ses_user_type; ?>',img.value,randomno.value,randomsec.value,user_ip.value,'<?php echo $_GET['edit_id']; ?>')">Create User</button>
								</div>
							</form>
						</div>
				