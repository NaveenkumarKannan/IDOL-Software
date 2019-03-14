// ADD
function add_company_details(username,passwrd,cnfrmpasswrd,companyname,contactper,designat,emailid,phno,address,status,packageval,userlimit,amtperuser)
{
	 var sendInfo = {
		   username: username,
		   passwrd:passwrd,
		    cnfrmpasswrd: cnfrmpasswrd,
		   companyname:companyname,
		    contactper: contactper,
		   designat:designat,
		   emailid: emailid,
		   phno:phno,
		   address: address,
		   status:status,
		   packageval:packageval,
		     userlimit:userlimit,
		   amtperuser:amtperuser,
		 
		   
      	};
	
	$.ajax({
    type: "POST",
    url: "model/companys.php?action=add",
    data: sendInfo,
    success: function(data) {
		$("#curd_message").html(data); 
		$("#curd_message").delay(5000).fadeOut();
		$( "#company_list" ).load( "index1.php?fopen=companys/admin" );
      window.location.reload(true);
		
    },
    error: function() {
        alert('error handing here');
    }
	});
   
}

// UPDATE
function edit_company_details(username,passwrd,cnfrmpasswrd,companyname,contactper,designat,emailid,phno,address,status,packageval,userlimit,amtperuser,update_id)
{

	   	var sendInfo = {
		    username: username,
		   passwrd:passwrd,
		    cnfrmpasswrd: cnfrmpasswrd,
		   companyname:companyname,
		    contactper: contactper,
		   designat:designat,
		   emailid: emailid,
		   phno:phno,
		   address: address,
		   status:status,
		   packageval:packageval,
		      userlimit:userlimit,
		   amtperuser:amtperuser,
            };
		$.ajax({
			type: "POST",
			url: "model/companys.php?action=edit&update_id="+update_id,
			data: sendInfo,
			success: function(data) {
				$("#curd_message").html(data); 
				$("#curd_message").delay(5000).fadeOut();
				$( "#company_list" ).load( "index1.php?fopen=companys/admin #example" );
				window.location.reload(true);
				hide_dialog();
			},
			error: function() {
				alert('error handing here');
			}
		});
	
}

// DELETE
function delete_comapany(id)

{ 
	if (confirm("Are you sure?"))
	{
		$.ajax({
			type: "POST",
			url: "model/companys.php?action=delete&delete_id="+id,
			success: function(data) {
				$("#curd_message").html(data); 
				$("#curd_message").delay(5000).fadeOut();
				$( "#company_list" ).load( "index1.php?fopen=companys/admin " );
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
	if (checkBox == true){
	
		var status="1";
		
		var hiddenval=menu_id+'@@'+user_type_id;
		document.getElementById('menus_value'+i_val).value=hiddenval;
	}
	else
	{
		document.getElementById('menus_value'+i_val).value="";
	}
}