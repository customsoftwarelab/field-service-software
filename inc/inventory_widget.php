<?php
error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];

if($act == 'getivoss'){
	$ty = mysql_query("SELECT * FROM productservi WHERE saasid = '".$_SESSION['saasid']."' AND item_typ = 'product' LIMIT 6")or die(mysql_error());
echo '<div style="padding:6px"><div class="infohead">
		<div class="headtext" style="width: 80px; border-right:solid thin #000;">ID</div>
		<div class="headtext" style="width: 160px; border-right:solid thin #000;">Name</div>
    	<div class="headtext" style="width: 45px;  border-left:solid thin #CCC;">Qty</div>
   		</div>';
        while($b = mysql_fetch_array($ty)){
			
			if($b["inventory"] < $b["min"] || $b["inventory"] == $b["min"]){
			
			if(strlen($b["item_name"]) > 11){
				$name = substr($b["item_name"], 0, 8).'...';
			}else{
				$name = $b["item_name"];
			}
			
       echo  '<div class="infoheadlinesa">
		<div class="headtext2" style="width: 80px;">'.$b["items_ids"].'</div>
		<div class="headtext2" style="width: 160px;">'.$name.'</div>
   		<div class="headtext2" style="width: 85px;">'.$b["inventory"].'</div>
    	</div>';
		}
        
        
        echo'</div>';
		}
}

?>