<?php
error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];

if($act == 'getsap'){
	$ty = mysql_query("SELECT * FROM transandpays WHERE saasid = '".$_SESSION['saasid']."' AND numtype = 'Submitted Bill' AND status = 'open'");
echo '<div style="padding:6px"><div class="infohead">
		<div class="headtext" style="width: 80px; border-right:solid thin #000;">Vendor</div>
    	<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Due</div>
    	<div class="headtext" style="width: 45px;  border-left:solid thin #CCC;">Status</div>
   		</div>';
        while($b = mysql_fetch_array($ty)){
			$rt=mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$b["gl_act"]."' AND saasid = '".$_SESSION['saasid']."'"));
			
			if(strlen($rt["fld1"]) > 11){
				$name = substr($rt["fld1"], 0, 8).'...';
			}else{
				$name = $rt["fld1"];
			}
			
       echo  '<div class="infoheadlinesa">
		<div class="headtext2" style="width: 80px;">'.$name.'</div>
   		<div class="headtext2" style="width: 90px;">'.$b["due_date"].'</div>
   		<div class="headtext2" style="width: 45px;">Open</div>
    	</div>';
		}
        
        
        echo'</div>';
}

?>