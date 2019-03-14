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
<div class="modal-dialog">
	
					<div class="modal-content modal-lg">
						
						<div class="modal-body">
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="packagename" >
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package Code</label>
											<input class="form-control" type="text" id="packcode" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package Amount</label>
											<input class="form-control" type="text" id="amount" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package Validation <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="packvalidation">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">User Limitation <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="userlimit" name="userlimit">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Description <span class="text-danger">*</span></label>
											<textarea class="form-control"  id="description" name="description"></textarea>
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
									
									
									
								</div>
								<div class="table-responsive m-t-15">
									<table class="table table-striped custom-table">
                                    <thead>
											<tr>
												<th><strong>Module Name</strong></th>
                                                <th><strong>User Type</strong></th>
												<th class="text-center"><strong>Permission</strong></th>
												
											</tr>
										</thead>
										<tbody>
                                        <?php 
										$sql12="select * from menu_list";
					
						$rows12 = $db->fetch_all_array($sql12);
						foreach($rows12 as $record12){
							$i=$i+1;
										 ?>
											<tr>
												<td><?php echo $record12['menu_name']; ?></td>
                                                <td><?php echo $record12['user_type']; ?></td>
												<td class="text-center">
													<input  type="checkbox" name="menu_li" id="menu<?php echo $i; ?>" onClick="get_menu_list('<?php echo $i; ?>','<?php echo $record12['menu_id']; ?>','<?php echo $record12['user_type_id'] ?>',menu<?php echo $i; ?>.value);">
												</td>
												<input type="hidden" name="menus_value" id="menus_value<?php echo $i; ?>"/>
											</tr>
                                            <?php } ?>
                                            </tbody>
                                    </table></div>
								<input type="hidden" name="hiddenval" id="hiddenval"/>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="button" id="button" name="add" onClick="add_package_details(packagename.value,packcode.value,amount.value,packvalidation.value,userlimit.value,description.value,status.value,hiddenval.value)">Create Package</button>
								</div>
							</form>
						</div>
					</div>
				</div>
 <script>

$(document).ready(function() {
	$("#button").click(function(){
		var arrNumber = [];
		$('input[name=menus_value]').each(function(){
			arrNumber.push($(this).val());
		});
		$("#hiddenval").val(arrNumber);
	});
});
        
$(document).ready(function() {
	$("#button").focus(function(){
		var arrNumber = [];
		$('input[name=menus_value]').each(function(){
			arrNumber.push($(this).val());
		});
		$("#hiddenval").val(arrNumber);
	});
});
     
</script>