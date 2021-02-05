<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
include("database/db_connection.php"); 
$sa='body_temperature';
$s=98.7;
if ($sa=="body_temperature") {
    if ($s>97 && $s<99) {
        $a="healthy";
    }elseif ($s>99 && $s<100) {
        $a="unhealthy";# code...
    }else{
    	$a="need attention";
    }
}
elseif ($sa=="blood_pressure") {
    if ($s>80 && $s<120) {
    	$a="healthy";
    }elseif ($s>120 && $s<150) {
    	$a="unhealthy";
    }
}
print($a);
?>
</body>
</html>

