// ADD
function add_package_details(packagename,packcode,amount,packvalidation,userlimit,description,status,hiddenval)
{alert(hiddenval);
	 var sendInfo = {
		   packagename: packagename,
		   packcode:packcode,
		    amount: amount,
		   packvalidation:packvalidation,
		    userlimit: userlimit,
		   description:description,
		   status: status,
		   hiddenval:hiddenval,
		 
		   
      	};
	
	$.ajax({
    type: "POST",
    url: "model/package.php?action=add",
    data: sendInfo,
    success: function(data) {
		$("#curd_message").html(data); 
		$("#curd_message").delay(5000).fadeOut();
		$( "#pack_list" ).load( "index1.php?fopen=package/admin" );
        window.location.reload(true);
		
    },
    error: function() {
        alert('error handing here');
    }
	});
   
}

// UPDATE
function update_package_details(packagename,packcode,amount,packvalidation,userlimit,description,status,hiddenval,update_id)
{

	   	var sendInfo = {
		     packagename: packagename,
		   packcode:packcode,
		    amount: amount,
		   packvalidation:packvalidation,
		    userlimit: userlimit,
		   description:description,
		   status: status,
		   hiddenval:hiddenval,
            };
		$.ajax({
			type: "POST",
			url: "model/package.php?action=edit&update_id="+update_id,
			data: sendInfo,
			success: function(data) {
				$("#curd_message").html(data); 
				$("#curd_message").delay(5000).fadeOut();
				$( "#pack_list" ).load( "index1.php?fopen=package/admin #example" );
				window.location.reload(true);
			//	hide_dialog();
			},
			error: function() {
				alert('error handing here');
			}
		});
	
}

// DELETE
function delete_package_details(id)

{ 
	if (confirm("Are you sure?"))
	{
		$.ajax({
			type: "POST",
			url: "model/package.php?action=delete&delete_id="+id,
			success: function(data) {
				$("#curd_message").html(data); 
				$("#curd_message").delay(5000).fadeOut();
				$( "#pack_list" ).load( "index1.php?fopen=package/admin #example" );
				window.location.reload(true);
				hide_dialog();
			},
			error: function() {
				alert('error handing here');
			}
		});
	}
}


function get_menu_list(i_val,menu_id,user_type_id,menu)
{
	 var checkBox = document.getElementById("menu"+i_val).checked;
	 //	alert(checkBox);
	
	if (checkBox == true){
//	alert();
		var status="1";
		
		var hiddenval=menu_id+'@@'+user_type_id;
		document.getElementById('menus_value'+i_val).value=hiddenval;
	}
	else
	{
		document.getElementById('menus_value'+i_val).value="";
	}
}