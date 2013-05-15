<?php
session_start();
include('config.php');
//////REVENUE WIDGET START///////
$act = $_REQUEST['action'];

////get currents//////
if($act == 'getcur'){
	
	echo '<div style="padding:6px">
        
        <div class="infohead">
		<div class="headtext" style="width: 80px; border-right:solid thin #000;">Month</div>
    	<div class="headtext" style="width: 60px; border-right:solid thin #000; border-left:solid thin #CCC;">Year</div>
    	<div class="headtext" style="width: 75px;  border-left:solid thin #CCC;">Amount</div>
   		</div>';
       
        $s = mysql_query("SELECT * FROM revenue_out WHERE saasid = '".$_SESSION['saasid']."' ORDER BY rev_id ASC LIMIT 5");
		while($t = mysql_fetch_array($s)){
			echo '<div class="infoheadlinesa">
		<div class="headtext2" style="width: 80px;">'.$t["month"].'</div>
   		<div class="headtext2" style="width: 60px;">'.$t["year"].'</div>
   		<div class="headtext2" style="width: 75px;">$'.$t["amount"].'</div>
    	</div>';
		}
	
	echo'</div>';
}


?>