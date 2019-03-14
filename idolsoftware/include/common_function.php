<?php

//GET File No
function get_file_no($id)
{
	$state=mysql_fetch_array(mysql_query("select file_no from file_no where id='$id'"));
	return $state['file_no'];
}

//GET color name
function get_colour_creation($file_id,$color_id)
{
	$state=mysql_fetch_array(mysql_query("select colour_name from colour_creation where  file_no_id='$file_id' and color_id='$color_id'"));
	return $state['colour_name'];
}

//GET fabric name
function get_fabric_name($file_id,$color_id,$fab_id)
{
$state=mysql_fetch_array(mysql_query("select fabric_size from fabric_size_creation where file_no='$file_id' and color='$color_id' and fab_id='$fab_id'"));
return $state['fabric_size'];
}

//GET color name
function get_company_name($id)
{
	$state=mysql_fetch_array(mysql_query("select * from company_details where id='$id'"));
	return $state['company_name'];
}


//GET color name
function get_customer_name($id)
{
	$state=mysql_fetch_array(mysql_query("select * from customer_creation where cust_id='$id'"));
	return $state['customer_name']."-".$state['mobile_no'];
}


?>