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
$date=date("Y");
		$month=date("m");
		 $year=date("d");
		 $hour=date("h");
		 $minute=date("i");
		$second=date("s");
		$random_sec = date('dmyhis');
		$random_no = rand(00000, 99999);
		$ip=$_SERVER['REMOTE_ADDR'];
?>
<input type="hidden" name="random_no" id="randomno" value="<?php echo $random_no; ?>"/> 
   <input type="hidden" name="random_sec" id="randomsec" value="<?php echo $random_sec; ?>"/>
      <input type="hidden" name="user_ipadd" id="user_ipadd" value="<?php echo $ip; ?>"/>
<div class="modal-body">
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="personname" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email</label>
											<input class="form-control" type="email" id="emailid" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Mobile No <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="mobile">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="designtion" name="designtion">
										</div>
									</div>
                                    	<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Shift Start Time <span class="text-danger">*</span></label>
											<input class="form-control" type="time" id="starttime" name="start_time" value="<?php echo date("H:i "); ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Shift End Time <span class="text-danger">*</span></label>
											<input class="form-control" type="time" id="endtime" value="<?php echo date("H:i"); ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">User Name</label>
											<input class="form-control" type="text" id="username" name="user_name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" type="password" id="passwrd" name="passwrd">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input class="form-control" type="password" id="confirmpassword" name="confirm_password">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Status</label>
											<select class="form-control"  id="status" name="status">
                                            <option value="1">Active</option>
                                             <option value="0">De-Active</option>

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
											 <img src="assets/img/users/user.png" name="image_name" width="95" height="80" id="image_name"/>
											<input class="form-control" type="hidden" id="img" name="imgsd" value="<?php echo "user.png"; ?>">
										</div>
									</div>
									
									
									
									
								</div>
								
								
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="button" id="add" name="add" onClick="add_sales_person(personname.value,emailid.value,mobile.value,designtion.value,starttime.value,endtime.value,username.value,passwrd.value,confirmpassword.value,status.value,'<?php echo $ses_user_id; ?>','<?php echo $ses_user_type; ?>',img.value,randomno.value,randomsec.value,user_ipadd.value)">Create User</button>
								</div>
							</form>
						</div>