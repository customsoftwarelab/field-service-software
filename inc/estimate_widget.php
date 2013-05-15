<?php
error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];

if($act == 'getest'){
	$ty = mysql_query("SELECT * FROM core_docs WHERE saasid = '".$_SESSION['saasid']."' AND doc_type = 'estimate' AND status != 'won' AND active = 'true' LIMIT 6");
echo '<div style="padding:6px"><div class="infohead">
		<div class="headtext" style="width: 80px; border-right:solid thin #000;">Customer</div>
    	<div class="headtext" style="width: 45px;  border-left:solid thin #CCC;">Total</div>
   		</div>';
        while($b = mysql_fetch_array($ty)){
			$rt=mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$b["company_id"]."' AND saasid = '".$_SESSION['saasid']."'"));
			
			if(strlen($rt["companyname"]) > 11){
				$name = substr($rt["companyname"], 0, 8).'...';
			}else{
				$name = $rt["companyname"];
			}
			
       echo  '<div class="infoheadlinesa">
		<div class="headtext2" style="width: 80px;">'.$name.'</div>
   		<div class="headtext2" style="width: 155px;">$'.$b["value"].'</div>
    	</div>';
		}
        
        
        echo'</div>';
}

?>