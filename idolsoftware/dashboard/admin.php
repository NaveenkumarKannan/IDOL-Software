<!DOCTYPE html>
<html>
    

    <body>
        <div class="main-wrapper">
            
            
            <div class="page-wrapper" id="user_list">
            <?php
error_reporting(0);
ob_start();
session_start(); 
require_once("model/config.inc.php"); 
require_once("model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
 $ses_user_id= $_SESSION['sess_user_id'];
$ses_user_type=$_SESSION['ses_user_types'];

$cur_date=date("Y-m");
$current_date=date("Y-m-d");
$lastmonth= date('Y-m', strtotime($cur_date." -1 month"));
$user_count=mysql_num_rows(mysql_query("select * from user_creation where assign_user_id='$ses_user_id' "));
$sal_pr_id=mysql_fetch_array(mysql_query("select * from user_creation where user_id='$ses_user_id' and source='Manage Companys'"));
$company=mysql_fetch_array(mysql_query("select * from manage_companys where company_id='$sal_pr_id[insert_id]'"));
$pack_valid=mysql_fetch_array(mysql_query("select * from package_details where package_code='$company[package]'"));
 $com_dat=date("Y-m-d",strtotime($company[cr_date]));
 $valid=date('Y-m-d', strtotime($com_dat. ' +' .$pack_valid[package_validation] .'days'));
 $renew=date("Y-m-d",strtotime($company[renewal_date]));
if($ses_user_type!='1')
{
$assign_count=mysql_num_rows(mysql_query("select * from assign_work where user_login_id='$ses_user_id' and DATE_FORMAT(cr_date,'%Y-%m')='$cur_date'"));
$checkin_count=mysql_num_rows(mysql_query("select * from check_in where assign_user_id='$ses_user_id' and DATE_FORMAT(check_in_date,'%Y-%m')='$cur_date'"));
$exp_count=mysql_num_rows(mysql_query("select * from expense_creation where assign_user_id='$ses_user_id' and DATE_FORMAT(cr_date,'%Y-%m')='$cur_date'"));
$coll_count=mysql_num_rows(mysql_query("select * from collection_details where assign_user_id='$ses_user_id' and DATE_FORMAT(cr_date,'%Y-%m')='$cur_date'"));
$assign_count_last=mysql_num_rows(mysql_query("select * from assign_work where user_login_id='$ses_user_id' and DATE_FORMAT(cr_date,'%Y-%m')='$lastmonth'"));
$checkin_count_last=mysql_num_rows(mysql_query("select * from check_in where assign_user_id='$ses_user_id' and DATE_FORMAT(cr_date,'%Y-%m')='$lastmonth'"));
$exp_count_last=mysql_num_rows(mysql_query("select * from expense_creation where assign_user_id='$ses_user_id' and DATE_FORMAT(cr_date,'%Y-%m')='$lastmonth'"));
$coll_count_last=mysql_num_rows(mysql_query("select * from collection_details where assign_user_id='$ses_user_id' and DATE_FORMAT(cr_date,'%Y-%m')='$lastmonth'"));
}
else
{
$assign_count=mysql_num_rows(mysql_query("select * from assign_work where  DATE_FORMAT(cr_date,'%Y-%m')='$cur_date'"));
$checkin_count=mysql_num_rows(mysql_query("select * from check_in where DATE_FORMAT(check_in_date,'%Y-%m')='$cur_date'"));
$exp_count=mysql_num_rows(mysql_query("select * from expense_creation where DATE_FORMAT(cr_date,'%Y-%m')='$cur_date'"));
$coll_count=mysql_num_rows(mysql_query("select * from collection_details where DATE_FORMAT(cr_date,'%Y-%m')='$cur_date'"));
$assign_count_last=mysql_num_rows(mysql_query("select * from assign_work where DATE_FORMAT(cr_date,'%Y-%m')='$lastmonth'"));
$checkin_count_last=mysql_num_rows(mysql_query("select * from check_in where DATE_FORMAT(cr_date,'%Y-%m')='$lastmonth'"));
$exp_count_last=mysql_num_rows(mysql_query("select * from expense_creation where DATE_FORMAT(cr_date,'%Y-%m')='$lastmonth'"));
$coll_count_last=mysql_num_rows(mysql_query("select * from collection_details where DATE_FORMAT(cr_date,'%Y-%m')='$lastmonth'"));	
}
	 if(($current_date<=$renew)||($ses_user_type=='1'))
	 {
?>
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-12">
                         <h3 style=""><?php echo "Status"; ?></h3>
							<div class="dash-widget clearfix card-box">
                           
								<div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="center">
									<h3 style="border-bottom:solid 3px #999; margin-bottom:12px; font-size:40px;"><?php echo $checkin_count; ?></h3>
                                    <span style="font-size:13px; color:#0bc1b0;"><?php echo "Check - In"; ?></span><br>
									<span style="font-size:13px; color:#0bc1b0;">Last Month&nbsp;:&nbsp; <?php echo $checkin_count_last; ?></span>
                                   
								</div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="center">
									<h3 style="border-bottom:solid 3px #999; margin-bottom:12px;  font-size:40px;"><?php echo $assign_count; ?></h3>
                                    <span style="font-size:13px; color:#0bc1b0;"><?php echo "Assigned Work"; ?></span><br>
									<span style="font-size:13px; color:#0bc1b0;">Last Month&nbsp;:&nbsp; <?php echo $checkin_count_last; ?></span>
								</div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="center">
									<h3 style="border-bottom:solid 3px #999; margin-bottom:12px;  font-size:40px;"><?php echo $exp_count; ?></h3>
                                    <span style="font-size:13px; color:#0bc1b0;"><?php echo "Expense Reported"; ?></span><br>
									<span style="font-size:13px; color:#0bc1b0;">Last Month&nbsp;:&nbsp; <?php echo $checkin_count_last; ?></span>
								</div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="center">
									<h3 style="border-bottom:solid 3px #999; margin-bottom:12px;  font-size:40px;"><?php echo $coll_count; ?></h3>
                                    <span style="font-size:13px; color:#0bc1b0;"><?php echo "Collection Reported"; ?></span><br>
									<span style="font-size:13px; color:#0bc1b0;">Last Month&nbsp;:&nbsp; <?php echo $checkin_count_last; ?></span>
								</div>
                                </div>
                                
							</div>
						</div>
						
						
						
					</div>
                    

						<div class="col-md-12">
							<div class="row">
								
							<canvas id="graph" width="850" height="350" align="center" style="background-color:#FFF;"></canvas>
		
								
								
							</div>
						</div>
					</div>
					
					
					<div class="row staff-grid-row">
 <table width="90%" align="center">
                    <?php 
					if($ses_user_type!='1')
					{
					$sql="select * from sale_person_creation where DATE_FORMAT(create_date,'%Y-%m')='$cur_date' and user_company_id='$ses_user_id'";
					}
					else
					{
					$sql="select * from sale_person_creation where DATE_FORMAT(create_date,'%Y-%m')='$cur_date'";
	
					}
					
						$rows = $db->fetch_all_array($sql);
						foreach($rows as $record){
							if($record['status']=='1')
							{
								$status="<span style='color:#85ff00'>Active</span>";
								
							}
							else
							{
								$status="<span style='color:#ef0404'>De-Active</span>";
							}
							$user_sal_id=mysql_fetch_array(mysql_query("select * from user_creation where insert_id='$record[sal_per_id]' and source='Manage Users'"));
							
							
							$check_in_count=mysql_num_rows(mysql_query("select * from check_in where user_id='$user_sal_id[user_id]' and DATE_FORMAT(check_in_date,'%Y-%m')='$cur_date'"));
							$expense_amt=mysql_fetch_array(mysql_query("select sum(expense_amount) as exp_amt from expense_creation where user_id='$user_sal_id[user_id]' and DATE_FORMAT(expense_date,'%Y-%m')='$cur_date'"));
					?>

            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-12">
        
                                <tr class="profile-widget">
                           
                               <td width="33%" align="left" >
								<h3 class="heading07" style="font-size:26px;"><a href="#" data-toggle="modal" onClick="get_manage_user_edit('<?php echo $record['sal_per_id']; ?>');" data-target="#edit_employee"><?php echo $record['person_name']; ?></a></h3>
								<div style="color:#ead8d8;"><?php echo $record['designation']; ?>&nbsp; <?php echo $status; ?></div>
                                <div style="color:#ead8d8;"><?php echo $record['phn_no']; ?>&nbsp; <?php echo $record['person_email']; ?></div>
								</td>
                                  <td width="47%" align="center" style="padding-left:15px;">
								<h2 class="heading07" style="font-size:36px;"><?php echo $check_in_count; ?></h2>
								<div style="color:#ead8d8;"><?php echo "Check-In"; ?> </div>
								</td>
								 <td width="20%" align="center" style="padding-left:15px;">
								<h2 class="heading07" style="font-size:36px;">
								<?php if($expense_amt['exp_amt']!='') { echo number_format($expense_amt['exp_amt'],2); } else { echo "0.00"; }?></h2>
								<div style="color:#ead8d8;"><?php echo "Expense"; ?> </div>
								</td>
							
                            </tr>
						</div>
         	
           
                        <?php }   ?>
						</table>
						</div>
                        
                        
				</div>
				
            </div>
			
            </div>
            
		 </body>
		
		<?php
				for($i=1;$i<7;$i++)
{
	$previous_date=	 date('Y-m-d',strtotime("-$i days"));
	 $day[]=date('D',strtotime($previous_date));
if($ses_user_type!='1')
{
$checkin_gr[]=mysql_num_rows(mysql_query("select * from check_in where assign_user_id='$ses_user_id' and check_in_date='$previous_date'"));
}
else
{
$checkin_gr[]=mysql_num_rows(mysql_query("select * from check_in where  check_in_date='$previous_date'"));
	
}
}
 $dateara=json_encode($day);
 $countarr=json_encode($checkin_gr);

?>
   <?php } else { ?>
   <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-12" align="center">
						    Your Package is expired. Kindly renew / upgrade your package. </br> 
						    For More Details Contact <br> Mobile : +91 90879 24444<br> Email : ulixtechnology@gmail.com
						    </div>  </div>  </div>
   
   <?php } ?>
<script>		
		$( document ).ready(function() {
			var chartData = {
				node: "graph",
				
				dataset:<?php echo  $countarr; ?>,
				labels: <?php  echo $dateara; ?>,
				
				pathcolor: "#288ed4",
				fillcolor: "#8e8e8e",
				xPadding: 0,
				yPadding: 0,
				ybreakperiod: 2
			};
			drawlineChart(chartData);
		});
		
	</script>
	

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>
<script src="dashboard/topup.js"></script>