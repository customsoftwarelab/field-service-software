<?php
//error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];
if($act == 'getpos'){
	
	$ty = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'po' AND saasid = '".$_SESSION['saasid']."' AND status != 'closed' AND active = 'true'");
	echo '<div style="padding:6px">
        
        <div class="infohead">
		<div class="headtext" style="width: 80px; border-right:solid thin #000;">Vendor</div>
    	<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Customer</div>
        <div class="headtext" style="width: 75px;  border-left:solid thin #CCC;">Due</div>
        <div class="headtext" style="width: 75px;  border-left:solid thin #CCC;">Amount</div>
   		</div>';
	
		while($df = mysql_fetch_array($ty)){
$sel = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$df["company_id"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());

if(strlen($sel["fld1"]) > 11){
	$vendor = substr($rt["fld1"], 0, 8).'...';
}else{
	$vendor = $sel["fld1"];
}
$bob = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'invoice' AND saasid = '".$_SESSION['saasid']."' AND active = 'true' AND clipo = '".$df["doc_id"]."'");
if(mysql_num_rows($bob) > 0 ){
	$tyB = mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_type = 'invoice' AND saasid = '".$_SESSION['saasid']."' AND active = 'true' AND clipo = '".$df["doc_id"]."'"));
	
	$eft = mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$tyB["company_id"]."' AND saasid = '".$_SESSION['saasid']."'"));
	
	if(strlen($eft["companyname"]) > 11){
	$customer = substr($eft["companyname"], 0, 8).'...';
}else{
	$customer = $eft["companyname"];
}
	
}else{
$customer = 'Not Attached';	
}

        echo'<div class="infoheadlinesa">
		<div class="headtext2" style="width: 80px;">'.$vendor.'</div>
        <div class="headtext2" style="width: 90px;">'.$customer.'</div>
   		<div class="headtext2" style="width: 75px;">'.$df["valid_untill"].'</div>
   		<div class="headtext2" style="width: 75px;">$'.$df["estprice"].'</div>
    	</div></div>';
		}
}

?>