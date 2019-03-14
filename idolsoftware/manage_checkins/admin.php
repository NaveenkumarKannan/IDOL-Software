<!DOCTYPE html>
<html>
    
<?php
error_reporting(0);
ob_start();
session_start(); 
require_once("model/config.inc.php"); 
require_once("model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$cur_date=date("Y-m-d");
$ses_user_id= $_SESSION['sess_user_id'];
$ses_user_type= $_SESSION['ses_user_types'];
if($ses_user_type!='1')
{
$sql_cunt=mysql_num_rows(mysql_query("select * from check_in where  assign_user_id='$ses_user_id'"));
}
else
{
$sql_cunt=mysql_num_rows(mysql_query("select * from check_in "));

}
?>
    <body>
        <div class="main-wrapper">
            
            
            <div class="page-wrapper" id="company_list">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Manage Check-Ins</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
							
						</div>
					</div>
					<?php  if($sql_cunt!=0) {?>
					<div class="row staff-grid-row">
                   
                    <?php 
					if($ses_user_type!='1')
					{
					$sql="select * from check_in where assign_user_id='$ses_user_id'";
					}
					else
					{
					$sql="select * from check_in ";	
					}
					
						$rows = $db->fetch_all_array($sql);
						foreach($rows as $record){
						$sal_pr_id=mysql_fetch_array(mysql_query("select * from sale_person_creation where sal_per_id='$record[person_id]' "));

					?>
						<div class="col-lg-12">
							<div class="dash-widget clearfix card-box">
                           
								<div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="left">
									<h3 style="font-size:30px;"><?php echo ucfirst($record['place_work_name']); ?></h3>
                                    <span style="font-size:16px; color:#0bc1b0;">Date&nbsp;:&nbsp;<?php echo date("d-m-Y",strtotime($record['check_in_date'])); ?></span><br>
									<span style="font-size:16px; color:#0bc1b0;">Time&nbsp;:&nbsp; <?php echo date("H:i ",strtotime($record['check_in_time'])); ?></span>
                                   
								</div>
                                </div>
                                
                                
                                <div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="left">
									<h3 style="font-size:30px;"><?php echo $sal_pr_id['person_name']; ?></h3>
                                    <span style="font-size:16px; color:#0bc1b0;">Details&nbsp;:&nbsp;<?php echo ucfirst($record['details']); ?></span><br>
									<span style="font-size:16px; color:#0bc1b0;">Location Address&nbsp;:&nbsp; <?php echo ucfirst($record['location_address']); ?></span>
                                   
								</div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-lg-6">
								<div  align="left">
									 <button class="btn btn-primary" type="button" id="viewcheckin" name="viewcheckin" onClick="view_checkin_map('<?php echo $record['place_work_name']; ?>','<?php echo $record['lattitude']; ?>','<?php echo $record['longitutde']; ?>','<?php echo $record['location_address']; ?>')">View Check-In</button>
                                     <br>
                             <!-- <button class="btn btn-success" type="button" id="delete" name="delete" style="margin-top:50px;" onClick="delete_manage_users('<?php echo $record['sal_per_id']; ?>');" >Delete</button>-->
                                   
								</div>
                                </div>
							</div>
						</div>
                        <?php } //echo  $_SERVER['REMOTE_ADDR'];  ?>
						
						
						
						
						
			
					</div>
                    <?php  } else {?>
                    <div class="row staff-grid-row">
                    <div class="col-lg-12">
							<div class="dash-widget clearfix card-box">
                           
								<div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="left">
									
								</div>
                                </div>
                                
                                
                                <div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="left">
									
                                   No Checkins Available
								</div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-lg-6">
								<div  align="left">
									
                                   
                                   
								</div>
                                </div>
							</div>
						</div>
                        </div>
                    <?php } ?>
                </div>
				
            </div>
			
			
			
		</div>
		
    </body>

</html>
<script>


function view_checkin_map(place_nmae,lattitude,longitutde,location_address)
{
var url="manage_checkins/checkinmap.php?place_nmae="+place_nmae+"&lattitude="+lattitude+"&longitutde="+longitutde+"&location_address="+location_address;
onmouseover= window.open(url,'','height=450,width=550,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');

}

</script>

