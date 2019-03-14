<?php
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 

 $sql = "SELECT * FROM package_details  where pack_id='$_GET[edit_id]' ";
$rows = $db->fetch_all_array($sql);
foreach($rows as $record)
{
	
$package_name = $record['package_name'];
$package_amount = $record['package_amount'];
 $package_validation  = $record['package_validation'];
$user_limit  = $record['user_limit'];
$description = $record['description'];
$package_code = $record['package_code'];
 $status  = $record['status'];
$hidden_val = $record['hidden_val'];
$user_type = $record['user_type'];
 $user_id  = $record['user_id'];

}
?>


				
                    <div class="modal-body">
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="packagename" name="packagename" value="<?php echo $package_name; ?>">
										</div>
									</div>
									  <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package Code</label>
											<input class="form-control" type="text" id="packcode" value="<?php echo $packcode; ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package Amount</label>
											<input class="form-control" type="text" id="amount" name="amount" value="<?php echo $package_amount; ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Package Validation<span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="validation" name="validation" value="<?php echo $package_amount; ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">User Limitation <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="userlimit" name="userlimit" value="<?php echo $user_limit; ?>">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Description</label>
											<textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
										</div>
									</div>
									
									
									
									
									
								</div><div class="table-responsive m-t-15">
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
										$i=0;
										$sql12="select * from menu_list";
					
						$rows12 = $db->fetch_all_array($sql12);
						foreach($rows12 as $record12){
							$i=$i+1;
							$chk=mysql_fetch_array(mysql_query("select * from package_limit where menu_id='$record12[menu_id]' and package_code='$package_code'"));
							echo $chk['menu_val'];
										 ?>
											<tr>
												<td><?php echo $record12['menu_name']; ?></td>
                                                <td><?php echo $record12['user_type']; ?></td>
												<td class="text-center">
													<input  type="checkbox" name="menu_li" id="menu<?php echo $i; ?>" onClick="get_menu_list('<?php echo $i; ?>','<?php echo $record12['menu_id']; ?>','<?php echo $record12['user_type_id'] ?>',menu<?php echo $i; ?>.value);" <?php if($chk['permission']=='1') { ?> checked="checked"<?php } ?>>
											<input type="text" name="menus_value" id="menus_value<?php echo $i; ?>" value='<?php echo $chk['menu_val']; ?>'/>
												</td>
												
											</tr>
                                            <?php } ?>
                                            </tbody>
                                    </table></div>
												<input type="text" name="hiddenval" id="hiddenval" value="<?php echo $hidden_val; ?>"/>

								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="button" id="button" name="edit" onClick="update_package_details(packagename.value,packcode.value,amount.value,packvalidation.value,userlimit.value,description.value,status.value,hiddenval.value,'<?php echo $_GET['edit_id'] ?>')">Update Package</button>
								</div>
							</form>
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
