// ADD
function add_sales_person(personname,emailid,mobile,designtion,starttime,endtime,username,passwrd,confirmpassword,status,ses_user_id,ses_user_type,img,randomno,randomsec,user_ip)
{
	var file_data = jQuery("#photoper").prop("files")[0];
		var form_data = new FormData();
		form_data.append("personname", personname); 
		form_data.append("emailid", emailid);
		form_data.append("mobile", mobile);
		form_data.append("designtion", designtion);
		form_data.append("starttime", starttime);
		form_data.append("endtime", endtime);
		form_data.append("username", username);
		form_data.append("passwrd", passwrd);
		form_data.append("confirmpassword", confirmpassword);
		form_data.append("status", status);
		form_data.append("ses_user_id", ses_user_id);
		form_data.append("ses_user_type", ses_user_type);
		form_data.append("img", img);
		form_data.append("randomno", randomno);
		form_data.append("randomsec", randomsec);
		form_data.append("user_ip", user_ip);
		form_data.append("file_data", file_data);
			
		$.ajax({
			url: "model/users.php?action=add",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                        
			type: 'post',
			success: function(msg)
			{
			window.location.reload(true);
				
			}
		});
   
}

// UPDATE
function edit_sales_person(personname,emailid,mobile,designtion,starttime,endtime,username,passwrd,confirmpassword,status,ses_user_id,ses_user_type,img,randomno,randomsec,user_ip,update_id)
{
	
	var file_data = jQuery("#photoper").prop("files")[0];
		var form_data = new FormData();
		form_data.append("personname", personname); 
		form_data.append("emailid", emailid);
		form_data.append("mobile", mobile);
		form_data.append("designtion", designtion);
		form_data.append("starttime", starttime);
		form_data.append("endtime", endtime);
		form_data.append("username", username);
		form_data.append("passwrd", passwrd);
		form_data.append("confirmpassword", confirmpassword);
		form_data.append("status", status);
		form_data.append("ses_user_id", ses_user_id);
		form_data.append("ses_user_type", ses_user_type);
		form_data.append("img", img);
		form_data.append("randomno", randomno);
		form_data.append("randomsec", randomsec);
		form_data.append("user_ip", user_ip);
		form_data.append("file_data", file_data);
			form_data.append("update_id", update_id);
		$.ajax({
			url: "model/users.php?action=edit&update_id="+update_id,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                        
			type: 'post',
			success: function(msg)
			{
				window.location.reload(true);
				
			}
		});
	
	
}

// DELETE
function delete_manage_users(id)

{ 
	if (confirm("Are you sure?"))
	{
		$.ajax({
			type: "POST",
			url: "model/users.php?action=delete&delete_id="+id,
			success: function(data) {
				$("#curd_message").html(data); 
				$("#curd_message").delay(5000).fadeOut();
				$( "#user_list" ).load( "index1.php?fopen=users/admin " );
				window.location.reload(true);
				hide_dialog();
			},
			error: function() {
				alert('error handing here');
			}
		});
	}
}

function validate_file_number(file_number)
{ 
	if(file_number==='') { $("#file_number").addClass('errorClass'); return false;} else {$("#file_number").addClass('successClass');}

}
var loadFile = function(event) {
    var output = document.getElementById('image_name');
	
	document.getElementById('image_name').style.display = 'block';
	var test = document.getElementById('image_names');
	document.getElementById('img').value=test
    output.src = URL.createObjectURL(event.target.files[0]);
};