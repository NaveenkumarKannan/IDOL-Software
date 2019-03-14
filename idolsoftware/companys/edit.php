<?php
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 

  $sql = "SELECT * FROM manage_companys  where company_id='$_GET[edit_id]' ";
$rows = $db->fetch_all_array($sql);
foreach($rows as $record)
{
	
$user_name = $record['user_name'];
$password = $record['password'];
 $confirm_paassword  = $record['confirm_paassword'];
$company_name  = $record['company_name'];
$email = $record['email'];
$phone_no = $record['phone_no'];
 $address  = $record['address'];
$password  = $record['password'];
$designation = $record['designation'];
 $contact_person  = $record['contact_person'];
$package  = $record['package'];
 $status  = $record['status'];
 $user_limit  = $record['user_limit'];
 $amt_per_user  = $record['amt_per_user'];

}
?>


				
                       
						<div class="modal-body">
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">User Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="username" value="<?php echo $user_name ?>" >
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" type="text" id="passwrd" value="<?php echo $password ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input class="form-control" type="text" id="cnfrmpasswrd" value="<?php echo $confirm_paassword ?>">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Company Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="companyname" value="<?php echo $company_name ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Contact Person <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="contactper" name="contactperson" value="<?php echo $contact_person ?>">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="designat" name="designation" value="<?php echo $designation ?>">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="emailid" name="email" value="<?php echo $email ?>">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Phone No<span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="phno" name="phnum" value="<?php echo $phone_no ?>">
										</div>
									</div>
                                    <div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Address <span class="text-danger">*</span></label>
											<textarea class="form-control"  id="address" ><?php echo $address ?></textarea>
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package</label>
											<select class="form-control"  id="packageval" name="packagedet">
                                             <?php 
											$sql="select * from package_details";
											$sqlquery=mysql_query($sql);
											while ($row=mysql_fetch_array($sqlquery))
											{
												
											?>
                                            <option value="<?php echo $row['package_code'];?>" <?php if($package==$row['package_code']) { ?> selected="selected" <?php } ?>><?php echo $row['package_name']; ?></option>
                                            <?php } ?>

                                            </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Status</label>
											<select class="form-control"  id="status" name="statuscom">
                                            <option value="1" <?php if($status=='1') { ?> selected="selected"<?php } ?>>Active</option>
                                             <option value="0" <?php if($status=='0') { ?> selected="selected"<?php } ?>>De-Active</option>

                                            </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">User Limit <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="userlimit" name="userlimit" value="<?php echo $user_limit ?>">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Amt Per User<span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="amtperuser" name="amtperuser" value="<?php echo $amt_per_user ?>">
										</div>
									</div>
									
									
								</div>
								
								
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="button" id="button" name="add" onClick="edit_company_details(username.value,passwrd.value,cnfrmpasswrd.value,companyname.value,contactper.value,designat.value,emailid.value,phno.value,address.value,status.value,packageval.value,userlimit.value,amtperuser.value,'<?php echo $_GET['edit_id']; ?>')">Update Company</button>
								</div>
							</form>
						</div>
				