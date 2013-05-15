<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include('config.php');
session_start();
$totSet2 = 0;

				$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '22'  AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){


		$totSet += $tm["fld4"];
		
	}
	
	echo "this is gonig to what? $totSet";

?>
</body>
</html>