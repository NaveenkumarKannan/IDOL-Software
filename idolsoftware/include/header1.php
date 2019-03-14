<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="css/jquery-ui.css" />
  

  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
  <!-- DataTables -->
  <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="bootstrap/css/jquery-ui.css">

 <!-- jQuery 2.2.0 -->
 <script src="bootstrap/js/jquery-1.12.3.js"></script>
<script language="javascript">
function numbersOnly(oToCheckField, oKeyEvent) {        
        var s = String.fromCharCode(oKeyEvent.charCode);
        var containsDecimalPoint = /\./.test(oToCheckField.value);
        return oKeyEvent.charCode === 0 || /\d/.test(s) || 
            /\./.test(s) && !containsDecimalPoint;
      }

</script>	

<?php
 $content = $_GET['fopen'];
?>

<!------------------Menu------------->

<?php include("include/menu.php"); ?>

<!------------------Menu------------->





