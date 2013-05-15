<?php
error_reporting(0);
session_start();
include('config.php');

$act = $_REQUEST['action'];

///////////////////////////////////////////////////////////-------------------LOGIN------------------------///////////////////////////////////////////

if($act == 'login'){
	
	$username = $_REQUEST['username'];
	$adpass = $_REQUEST['adpass'];
	
	$g = mysql_query("SELECT * FROM core_users WHERE usrname = '$username' AND usrpass = '$adpass'")or die(mysql_error());
		$p = mysql_fetch_array($g);
			$s = mysql_num_rows($g);
		
			if($s == 1){
				//echo 'good'.$p["sess"];
				
					mysql_query("INSERT INTO access_monitor SET usrid = '".$p["usr_id"]."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'Logged In', saasid='".$p["saasid"]."'")or die(mysql_error());
				session_start();
				$_SESSION['acssess'] = $p["sessid"];
				$_SESSION['usrid'] = $p["usr_id"];
				$_SESSION['saasid'] = $p["saasid"];
			}else{
					echo 'bad';	
			}
	
}

///////////////////////////////////////////////////////////-------------------LOGIN END------------------------///////////////////////////////////////////



////*********************************************\\\\




///////////////////////////////////////////////////////////-------------------LOGOUT------------------------///////////////////////////////////////////

if($act == 'logout'){
	  session_start();
    session_unset();
    session_destroy();
}

///////////////////////////////////////////////////////////-------------------LOGOUT END------------------------///////////////////////////////////////////



?>