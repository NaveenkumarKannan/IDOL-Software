<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TMS</title>
</head>

<body style="background-color:#ebede9;">
<div class="wrapper">
		<div>
             <?php
				error_reporting(0);
				ob_start();
				session_start(); 
               require("model/config.inc.php"); 
			   require("model/Database.class.php"); 
               $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
               $db->connect(); 
			   require("include/common_function.php");
			   require("include/header.php");
		    ?>
            </div>

    <div class="container" style="background-color:#ebede9;">
        <div class="row">
          <div class="col-md-12">
          
             <div><?php include($content.'.php'); ?></div>
          </div>
       </div>
    </div>
  
<div><?php include("include/footer.php"); ?></div>

</div>
</body>
</html>
<script>


//  OPEN MODEL BOX
$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget); 
    $(this).find(".modal-body").load(link.attr("href"));
	var title = link.attr("title"); 
    $("#myModalLabel").text(title);

});
</script>
