<?php
ob_start();
session_start();
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$ses_user_id= $_SESSION['sess_user_id'];
$ses_user_type= $_SESSION['ses_user_types'];
?>
<div class="modal-body">
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Title <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="wrktitle" >
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Details</label>
											<textarea class="form-control"  id="details" ></textarea>
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Deadline <span class="text-danger">*</span></label>
											<input class="form-control" type="date" id="dedaline" name="dedaline" value="<?php echo date("Y-m-d"); ?>">
										</div>
									</div>
                                    	<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Assign Employee <span class="text-danger">*</span></label>
										
                                            <select class="form-control" id="employee">
                                            <?php 
											$sql="select * from sale_person_creation";
											$sqlquery=mysql_query($sql);
											while ($row=mysql_fetch_array($sqlquery))
											{
												
											?>
                                            <option value="<?php echo $row['sal_per_id'];?>"><?php echo $row['person_name']; ?></option>
                                            <?php } ?>
                                            </select>
										</div>
									</div>
                                    <div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Work Type <span class="text-danger">*</span></label>
										
                                            <select class="form-control" id="worktype" onchange="get_coll_amt(worktype.value)">
                                            
                                            <option value="work">Work</option>
                                           <option value="collection">Collection</option>
                                            </select>
										</div>
									</div>
                                    <div class="col-sm-12" style="display:none;" id="coll_amt_div">
										<div class="form-group">
											<label class="control-label">Collection Amount <span class="text-danger">*</span></label>
										
                                            <input class="form-control" type="text" id="collamt" name="collamt" value="">

										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Set Priority <span class="text-danger">*</span></label>
										<input type="radio" name="priority" value="high" checked onClick="get_wrk_priority(this.value);"> 
										High &nbsp;&nbsp;&nbsp;<input type="radio" name="priority" value="medium" onClick="get_wrk_priority(this.value);"> Medium &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="priority" value="low" onClick="get_wrk_priority(this.value);">Low&nbsp;&nbsp;&nbsp;
                                        <input type="hidden" name="priorval" id="priorvalue" value="high">
										</div>
									</div>
									
									
								</div>
								
								
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="button" id="add" name="add" onClick="assign_work(wrktitle.value,details.value,dedaline.value,employee.value,priorval.value,worktype.value,collamt.value,'<?php echo $ses_user_id; ?>','<?php echo $ses_user_type; ?>')">Submit</button>
								</div>
							</form>
						</div>