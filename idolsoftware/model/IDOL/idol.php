<?php
require ("conn.php");

$type1= $_POST["type1"];
//$type1 = "checkIn";
if($type1 == "checkIn"){
	/*
	$Name = "Naveen";
	$Details = "Some";
	$Location = "Location";
	$image = "image";	
	*/
	$Name = $_POST["Name"];
	$Details = $_POST["Details"];
	$Location = $_POST["Location"];
	$image = $_POST["image"];
	
	$mysql_qry = "insert into idol_checkIn (Name, Details, Location, image) values 
	('$Name','$Details','$Location','$image');";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Check In successful" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}
	$conn->close();
}
else if($type1 == "Expenses"){
	$Name = $_POST["Name"];
	$Details = $_POST["Details"];
	$Date = $_POST["Date"];
	$Amount = $_POST["Amount"];
	
	$mysql_qry = "insert into idol_Expenses (Name, Details, Date, Amount) values 
	('$Name','$Details','$Date','$Amount');";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Expenses successful" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}
	$conn->close();
}
else if($type1 == "Collection"){
	$Name = $_POST["Name"];
	$Details = $_POST["Details"];
	$Location = $_POST["Location"];
	$Amount = $_POST["Amount"];
	
	$mysql_qry = "insert into idol_Collection (Name, Details, Location, Amount) values 
	('$Name','$Details','$Location','$Amount');";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Collection successful" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}
	$conn->close();
}
?>