<script>
$(function(){
    $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            });
    });
</script>

  <?php
 $login=$_SESSION['sess_user_name'];
$user_type = $_SESSION['user_types'];
$user_id=$_SESSION['sess_user_id'];

	
 function get_permission($user_type,$pur_party_name)
{
      $sql_user1="select permission from  user_permissions where box_name='$pur_party_name' and user_id='$user_type'";
	 $rs_user1=mysql_query($sql_user1);
	while($rsdata_user2=mysql_fetch_object($rs_user1))
	{ 
	  $permission2=$rsdata_user2->permission;
	}
	return $permission2;
} 
/*if($login!=''){
 $file = $_GET['file'];*/
 ?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="row">
          <div class="col-md-12 col-xs-9" style="padding:0px;">
                <div class="navbar-header" style="margin-left:-25px;">
                    <a class="navbar-brand" style="padding:0px;" href="#"><img src="image/andavar.png" height="52" width="50"></a>
                </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" style="margin-left:25px;">
            
            	
           
                <?php  $rights=get_permission($user_type,'1'); if($rights=='1'){?>    <li class="dropdown">
                    <a accesskey="a" class="dropdown-toggle active" data-toggle="dropdown" href="index.php?fopen=accountyear/admin" style="font-size:14px;">
                    <img src="image/admin.png" height="20" width="20"> &nbsp;Admin</a>
                    <ul class="dropdown-menu">
<?php $rights=get_permission($user_type,'User Type'); if($rights=='1'){?>  <li> <a href="index1.php?fopen=usertypes/admin">User Type</a></li><?php }  ?>
<?php $rights=get_permission($user_type,'Add New User'); if($rights=='1'){?><li><a href="index1.php?fopen=addnewuser/admin">Add New User</a></li><?php }  ?>
<?php $rights=get_permission($user_type,'User Screen'); if($rights=='1'){?> <li> <a href="index1.php?fopen=adduserscreen/admin">User Screen</a></li><?php } ?>
<?php $rights=get_permission($user_type,'User Rights Creation'); if($rights=='1'){?><li><a href="index1.php?fopen=userrightscreation/admin">User Rights Creation</a></li><?php } ?>
<?php $rights=get_permission($user_type,'Company Creation'); if($rights=='1'){?><li><a href="index1.php?fopen=companycreation/admin">Company Creation</a></li><?php } ?>
              
                   </ul></li><?php }  ?>
                   
                   <?php  $rights=get_permission($user_type,'2'); if($rights=='1'){?>     <li class="dropdown">
                    <a accesskey="M" class="dropdown-toggle active" data-toggle="dropdown" href="index.php?fopen=accountyear/admin" style="font-size:14px;">
                    <img src="image/master.png" height="20" width="20"> &nbsp;Master Entry</a>
                    <ul class="dropdown-menu">
<?php $rights=get_permission($user_type,'Customer Creation'); if($rights=='1'){?><li> <a href="index1.php?fopen=customer_creation/admin">Customer Creation<span style="float:right; color:#903; font-size:10px;"></span></a></li><?php }  ?>
<?php $rights=get_permission($user_type,'File No Creation'); if($rights=='1'){?><li ><a href="index1.php?fopen=file_number_creation/admin">File No Creation<span style="float:right; color:#903; font-size:10px;"></span></a></li><?php }  ?>
<?php $rights=get_permission($user_type,'Colour Creation'); if($rights=='1'){?><li ><a href="index1.php?fopen=colour_creation/admin">Colour Creation<span style="float:right; color:#903; font-size:10px;"></span></a></li><?php }  ?>
<?php $rights=get_permission($user_type,'Fabric Size Creation'); if($rights=='1'){?><li ><a href="index1.php?fopen=fabric_size_creation/admin">Fabric Size Creation<span style="float:right; color:#903; font-size:10px;"></span></a></li><?php }  ?>
                   
                   </ul></li><?php }  ?>
                   
                 
  <?php  $rights=get_permission($user_type,'3'); if($rights=='1'){?>   <li class="dropdown">
              <a accesskey="s" class="dropdown-toggle active" data-toggle="dropdown" href="index.php?fopen=accountyear/admin" style="font-size:14px;">
              <img src="image/employee.png" height="20" width="20"> &nbsp;Sales Module</a>
                    <ul class="dropdown-menu">
                     <li class="active">
       <?php $rights=get_permission($user_type,'Sales Entry'); if($rights=='1'){?>     <li><a href="index1.php?fopen=sales_entry/admin">Sales Entry<span style="float:right; color:#903; font-size:10px;"></span></a></li>   <?php }  ?>
		  

                    </ul>
                    </li><?php }  ?>
                         
                   <?php  $rights=get_permission($user_type,'4'); if($rights=='1'){?>      <li class="dropdown">
              <a accesskey="s" class="dropdown-toggle active" data-toggle="dropdown" href="index.php?fopen=accountyear/admin" style="font-size:14px;">
              <img src="image/employee.png" height="20" width="20"> &nbsp;Report</a>
                    <ul class="dropdown-menu">
                     <li class="active">
 <?php $rights=get_permission($user_type,'Sales Report'); if($rights=='1'){?>    <li><a href="index1.php?fopen=sales_report/admin">Sales Report<span style="float:right; color:#903; font-size:10px;"></span></a></li>   <?php }  ?>
    <?php $rights=get_permission($user_type,'Sales Stock Report'); if($rights=='1'){?>          <li><a href="index1.php?fopen=sales_stock_report/admin">Sales Stock Report<span style="float:right; color:#903; font-size:10px;"></span></a></li>  <?php } ?>
		  

                    </ul>
                    </li><?php }  ?>
			
<script>
function win_open1(){
	
	jQuery.ajax({
		type: "GET",
	    url:"backup/backup6.php",
		data: "",
		success: function(msg){
			jQuery("#total_amount_div").html(msg);
	}
	});
	alert("DataBase BackUP Successfully Downloaded");

}

</script>    <li class="dropdown">
             
            <a accesskey="b" class="dropdown-toggle active" data-toggle="dropdown" href="#" onClick="win_open1();" style="font-size:14px;">
      <img src="image/db.png" height="20" width="20"> &nbsp;DB BackUp <span style="float:right; color:#FFF; font-size:10px;"><strong></strong></span></a>
          
             </li>            
                </ul>
         
     <script>
	 
	function logout_form()
	{
		if (confirm("Are you sure! Want to logout?"))
		  {
			  jQuery.ajax({
		type: "GET",
	    url:"backup/backup6.php",
		data: "",
		success: function(msg){
			jQuery("#total_amount_div").html(msg);
		}
		});
	
	     window.location.href="logout.php"; 
		   }
	}

	 </script>   
        
             	  
			   
              <div valign="middle"  align="right"  style="color:#fff; font-size:14px;font-family:arial; padding-top:15px; padding-right:12px; margin-right:-50px;"><strong style="padding-top:13px !important;"> </strong><strong style="padding-top:13px !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a accesskey="l" href="#" onClick="logout_form()" ><img src="image/logout.png" title="Logout"></a></strong></div>
              
                  
       
              </div>
              
          </div>
          <div class="col-md-12 col-xs-3">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    </div>
    
    <?php 
/*}
else
{
	echo "<script>alert('Session Invalid!!!');</script>";
	echo "<script>window.location.href='index.php'</script>";
}*/
?>
    </div>
    </div>
</nav>


<?php 
$db->close();
?>