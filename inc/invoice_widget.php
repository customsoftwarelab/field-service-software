<?php
error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];
if($act == 'pullinvoicetrack'){
	echo '<div style="height:40px"></div>';
	$rt = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'invoice' AND active = 'true' AND ispaid != 'true' AND saasid = '".$_SESSION['saasid']."'");
		while($f=mysql_fetch_array($rt)){
		
			$sel = mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$f["company_id"]."'"));
	
if($sel["bill_term"] !='' && $f["inv_release_date"] !=''){
		
		$days_tillnes = date('m/d/Y', strtotime('+'.$sel["bill_term"].' days', strtotime($f["inv_release_date"])));
	
		if($sel["bill_term"] == '30' && date('m/d/Y') > $days_tillnes){
			
			$rt0.='o';
			
		}
		
		$calsixty = date('m/d/Y', strtotime('+60 days', strtotime($h["inv_release_date"])));
		
		if($sel["bill_term"] == '60' && $calsixty > $days_tillnes){
			
			$rt2.='o';
			
		}
		
		$calninty = date('m/d/Y', strtotime('+90 days', strtotime($f["inv_release_date"])));
		
		if($sel["bill_term"] == '90' && $calnintys > $days_tillne){
			
			$rt3.='o';
			
		}
		
		$onetwenty = date('m/d/Y', strtotime('+120 days', strtotime($f["inv_release_date"])));
		
		if($sel["bill_term"] == '120' && $onetwenty > $days_tillnes){
			
			$rt4.='o';
			
		}
		}else{
			
		}
		
		
		
		
		}
		
		
		$thirty = strlen($rt0);
		
		echo ' <div class="infoheadlinesa" style="border-top:none; height:45px">
		<div class="headtext2" style="width: 190px;">30 Days Past Due</div>
   		<div class="headtext2" style="width: 25px;">('.$thirty.')</div>
    	</div>';
		
		$sixty = strlen($rt2);
		
		echo ' <div class="infoheadlinesa" style="border-top:none; height:45px">
		<div class="headtext2" style="width: 190px;">60 Days Past Due</div>
   		<div class="headtext2" style="width: 25px;">('.$sixty.')</div>
    	</div>';
		
		$ninty = strlen($rt3);
		
		echo ' <div class="infoheadlinesa" style="border-top:none; height:45px">
		<div class="headtext2" style="width: 190px;">90 Days Past Due</div>
   		<div class="headtext2" style="width: 25px;">('.$ninty.')</div>
    	</div>';
		
		$onetw = strlen($rt4);
		
		echo ' <div class="infoheadlinesa" style="border:none; height:45px">
		<div class="headtext2" style="width: 190px;">120 Days Past Due</div>
   		<div class="headtext2" style="width: 25px;">('.$onetw.')</div>
    	</div>';
}

?>