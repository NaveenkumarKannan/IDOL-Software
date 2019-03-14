<?php
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
?>
<div class="modal-body">
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">User Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="username" >
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" type="text" id="passwrd" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input class="form-control" type="text" id="cnfrmpasswrd" >
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Company Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="companyname">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Contact Person <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="contactper" name="contactperson">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="designat" name="designation">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="emailid" name="email">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Phone No<span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="phno" name="phnum">
										</div>
									</div>
                                    <div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Address <span class="text-danger">*</span></label>
											<textarea class="form-control"  id="address" ></textarea>
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
                                            <option value="<?php echo $row['package_code'];?>"><?php echo $row['package_name']; ?></option>
                                            <?php } ?>

                                            </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Status</label>
											<select class="form-control"  id="status" name="statuscom">
                                            <option value="1">Active</option>
                                             <option value="0">De-Active</option>

                                            </select>
										</div>
									</div>
									
									 <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">User Limit <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="userlimit" name="userlimit">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Amount Per User<span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="amtperuser" name="amtperuser">
										</div>
									</div>
									
								</div>
								
								
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="button" id="button" name="add" onClick="add_company_details(username.value,passwrd.value,cnfrmpasswrd.value,companyname.value,contactper.value,designat.value,emailid.value,phno.value,address.value,status.value,packageval.value,userlimit.value,amtperuser.value)">Create Company</button>
								</div>
							</form>
						</div>