<?php
$file_path="apk/idol.apk";
$file_name="idol.apk";
header('Content-Type: application/vnd.android.package-archive');
header("Content-length: " . filesize($file_path));
header('Content-Disposition: attachment; filename="' . $file_name . '"');
ob_end_flush();
readfile($file_path);
return true;
?>