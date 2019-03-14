<?php

//echo $total_qtys;
//echo $totals;
$output = '"","","","","","","","","","",'."\n";


$date=date('d-m-Y H:i:s');
$filename =  "Purchase Entry".$date.".csv";
header('Content-type: application/xls');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;

?>
