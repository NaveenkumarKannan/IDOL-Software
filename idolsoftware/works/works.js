// ADD
function assign_work(wrktitle,details,dedaline,employee,priorval,work_type,collamt,ses_user_id,ses_user_type)
{
	 var sendInfo = {
		   wrktitle: wrktitle,
		   details:details,
		    dedaline: dedaline,
		   employee:employee,
		    priorval: priorval,
			 work_type: work_type,
			  collamt: collamt,
		    ses_user_id:ses_user_id,
		    ses_user_type: ses_user_type,
		   
      	};
	
	$.ajax({
    type: "POST",
    url: "model/works.php?action=add",
    data: sendInfo,
    success: function(data) {
		$("#curd_message").html(data); 
		$("#curd_message").delay(5000).fadeOut();
		$( "#work_list" ).load( "index1.php?fopen=works/admin" );
       window.location.reload(true);
		
    },
    error: function() {
        alert('error handing here');
    }
	});
   
}

// UPDATE


function update_assign_work(wrktitle,details,dedaline,employee,priorval,work_type,collamt,ses_user_id,ses_user_type,update_id)
{

	   	var sendInfo = {
		    wrktitle: wrktitle,
		   details:details,
		    dedaline: dedaline,
		   employee:employee,
		    priorval: priorval,
			 work_type: work_type,
			  collamt: collamt,
			 ses_user_id:ses_user_id,
		    ses_user_type: ses_user_type,
            };
		$.ajax({
			type: "POST",
			url: "model/works.php?action=edit&update_id="+update_id,
			data: sendInfo,
			success: function(data) {
				$("#curd_message").html(data); 
				$("#curd_message").delay(5000).fadeOut();
				$( "#work_list" ).load( "index1.php?fopen=works/admin" );
				window.location.reload(true);
				hide_dialog();
			},
			error: function() {
				alert('error handing here');
			}
		});
	
}

// DELETE
function delete_manage_works(id)

{ 
	if (confirm("Are you sure?"))
	{
		$.ajax({
			type: "POST",
			url: "model/works.php?action=delete&delete_id="+id,
			success: function(data) {
				$("#curd_message").html(data); 
				$("#curd_message").delay(5000).fadeOut();
				$( "#work_list" ).load( "index1.php?fopen=works/admin " );
				window.location.reload(true);
				hide_dialog();
			},
			error: function() {
				alert('error handing here');
			}
		});
	}
}

function get_wrk_priority(value)
{
	if(value=='high')
	{
		document.getElementById('priorvalue').value='high';
	}
	if(value=='medium')
	{
		document.getElementById('priorvalue').value='medium';
	}
	if(value=='low')
	{
		document.getElementById('priorvalue').value='low';
	}
	
}
function get_coll_amt(worktype)
{
	if(worktype=='work')
	{
		document.getElementById("coll_amt_div").style.display = "none";
	}
	else
	{
		document.getElementById("coll_amt_div").style.display = "block";
	}
}