<?php
error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];

if($act == 'gettree'){
	$ty = mysql_query("SELECT * FROM access_monitor WHERE saasid = '".$_SESSION['saasid']."' ORDER BY accessstart DESC LIMIT 6")or die(mysql_error());
echo '<div style="padding:6px"><div class="infohead">
		<div class="headtext" style="width: 80px; border-right:solid thin #000;">User</div>
    	<div class="headtext" style="width: 45px;  border-left:solid thin #CCC;">Time</div>
   		</div>';
        while($b = mysql_fetch_array($ty)){
			$rt=mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$b["usrid"]."' AND saasid = '".$_SESSION['saasid']."'"));
			$full = $rt["fname"].' '.$rt["lname"];
			if(strlen($full) > 11){
				$name = substr($full, 0, 8).'...';
			}else{
				$name = $full;
			}
			
       echo  '<div class="infoheadlinesa">
		<div class="headtext2" style="width: 80px;">'.$name.'</div>
   		<div class="headtext2" style="width: 155px;">'.$b["accessstart"].'</div>
    	</div>';
		}
        
        
        echo'</div>';
}

?>