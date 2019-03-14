<?php
ob_start();
session_start();
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$ses_user_id= $_SESSION['sess_user_id'];
$ses_user_type= $_SESSION['ses_user_types'];
 $sql = "SELECT * FROM assign_work  where work_id='$_GET[edit_id]' ";
$rows = $db->fetch_all_array($sql);
foreach($rows as $record)
{
	
$user_login_id = $record['user_login_id'];
$work_title = $record['work_title'];
 $details  = $record['details'];
$deadline  = $record['deadline'];
$priority = $record['priority'];
$assign_employee = $record['assign_employee'];
 $work_status  = $record['work_status'];
$work_type = $record['work_type'];
 $collamt  = $record['collection_amt'];

}
?>


				
                       
						<div class="modal-body">
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Title <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="wrktitle" value="<?php echo $work_title; ?>" >
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Details</label>
											<textarea class="form-control"  id="details" ><?php echo $details; ?></textarea>
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Deadline <span class="text-danger">*</span></label>
											<input class="form-control" type="date" id="dedaline" name="dedaline" value="<?php echo "2018-08-20"; ?>">
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
                                            <option value="<?php echo $row['sal_per_id'];?>" <?php if($assign_employee==$row['sal_per_id']){ ?> selected="selected" <?php } ?>><?php echo $row['person_name']; ?></option>
                                            <?php } ?>
                                            </select>
										</div>
									</div>
                                    <div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Work Type <span class="text-danger">*</span></label>
										
                                            <select class="form-control" id="worktype">
                                            
                                            <option value="work"<?php if($work_type=='work') { ?> selected="selected" <?php } ?>>Work</option>
                                           <option value="collection"<?php if($work_type=='collection') { ?> selected="selected" <?php } ?>>Collection</option>
                                            </select>
										</div>
									</div>
                                    <div class="col-sm-12" style="display:none;">
										<div class="form-group">
											<label class="control-label">Collection Amount <span class="text-danger">*</span></label>
										
                                            <input class="form-control" type="text" id="collamt" name="collamt" value="<?php echo $collamt; ?>">

										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Set Priority <span class="text-danger">*</span></label>
										<input type="radio" name="priority" value="high" onClick="get_wrk_priority(this.value);" <?php if($priority=='high') { ?> checked="checked" <?php } ?> > 
										High &nbsp;&nbsp;&nbsp;<input type="radio" name="priority" onClick="get_wrk_priority(this.value);" value="medium" <?php if($priority=='medium') { ?> checked="checked" <?php } ?>> Medium &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="priority" value="low" onClick="get_wrk_priority(this.value);" <?php if($priority=='low') { ?> checked="checked" <?php } ?>>Low&nbsp;&nbsp;&nbsp;
                                        <input type="hidden" name="priorval" id="priorvalue" value="<?php echo $priority; ?>">
										</div>
									</div>
									
									
								</div>
								
								
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="button" id="edit" name="edit" onClick="update_assign_work(wrktitle.value,details.value,dedaline.value,employee.value,priorval.value,worktype.value,collamt.value,'<?php echo $ses_user_id; ?>','<?php echo $ses_user_type; ?>','<?php echo $_GET['edit_id']; ?>')">Update</button>
								</div>
							</form>
						</div>
				