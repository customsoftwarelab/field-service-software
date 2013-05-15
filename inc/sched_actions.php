<?php
error_reporting(0);
session_start();
include('config.php');
date_default_timezone_set('America/Chicago');
$act = $_REQUEST['action'];


//////----------------------------------Begin Scheduler Actions-----------------------------------------////////

/////GETS SCHEDULER BY DATE /////

if($act == 'getsched'){
	
	echo '<div class="infohead">
	<div class="headtext" style="width: 80px; border-right:solid thin #000; ">W/O ID <img src="images/desc_arr.png" width="9" height="9"></div>
	<div class="headtext" style="width: 197px; border-right:solid thin #000; cursor:pointer;border-left: solid thin #CCC;">Customer Name</div>
    <div class="headtext" style="width: 688px; border-right:solid thin #000; border-left:solid thin #CCC;">Duration [hrs]</div>
</div>';

$h = mysql_query("SELECT * FROM core_docs WHERE servicedate ='".$_REQUEST['getdate']."' AND sched_stat = '' AND doc_type = 'workorder' AND saasid = '".$_SESSION['saasid']."'");

	while($s = mysql_fetch_array($h)){
		
		///	company_id
		
		
		$t = mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$s["company_id"]."' AND saasid = '".$_SESSION['saasid']."'"));
		
		if($s["duration"] > '1'){
			$hr = $s["duration"].'hrs';
			
			$getLength = 49 * $s["duration"];
			
		}else{
			$hr = $s["duration"].'hr';
			$getLength = 49 * $s["duration"];
		}
		
		if($getLength > '882'){
			$getLength = '882';
		}
		
		if($getLength < '49'){
			$getLength = '49';
		}
		
		
		
		echo '<div class="infoheadlines">
<div class="headtext2" style="width: 80px;"><a href="work_orders.php?id='.$s["doc_id"].'">'.$s["doc_id"].'</a></div>
<div class="headtext2" style="width: 199px;">'.$t["companyname"].'</div>
<div class="headtextdrg" style="width: 689px;">
<div id="'.$s["doc_id"].'" class="drgbl" style="width:'.$getLength.'px; background-image:url(images/null_wrk.png); background-repeat:repeat-x; height:33px; -moz-border-radius: 2px; border-radius: 2px; position:absolute; cursor:move; font-family: \'Quantico\', sans-serif; text-shadow: -1px -1px #333; color:#FFF; font-size:17px; padding-top:5px; overflow:hidden"><span style="padding-left:15px;">'.$hr.'</span></div>
</div></div>';

	}
	
	$br = explode('/',$_REQUEST['getdate']);


$month_name = date( 'F', mktime(0, 0, 0, $br[0]) );


	echo '<div style="font-family: \'Quantico\', sans-serif; font-weight:normal; width:1010px; margin:auto; margin-top:30px"><strong>Assigned Work Orders</strong> </div>

<div class="infohead">
	<div class="headtext" style="width: 999px; border-right:solid thin #000; text-align:center; position:relative;"><span id="monhlf">'.$month_name.' '.$br[1].' '.$br[2].'</span> <input name="schedmov" id="schedmov" type="hidden" value=""> <img src="images/date_ico_white.png" width="16" height="17"onClick="opnCuscal()" /> 
	
	<div id="holdcal" style="padding:3px; position:absolute; right:320px; display:none; z-index:1000"></div>
	
	</div>
	
</div>';



echo '<div class="infohead">
	<div class="headtext" style="width: 117px; border-right:solid thin #000; ">Technician <img src="images/desc_arr.png" width="9" height="9"></div>
	<div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">7a</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">8a</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">9a</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">10a</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">11a</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">12p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">1p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">2p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">3p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">4p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">5p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">6p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">7p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">8p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">9p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">10p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">11p</div>
    <div class="headtext" style="width: 32px; border-right:solid thin #000; border-left:solid thin #CCC;">12p</div>
</div>';



/////get techs////

$thTim = date('G');


if($thTim == '7'){$mov = '155';}
if($thTim == '8'){$mov = '205';}
if($thTim == '9'){$mov = '255';}
if($thTim == '10'){$mov = '305';}
if($thTim == '11'){$mov = '355';}
if($thTim == '12'){$mov = '405';}
if($thTim == '13'){$mov = '455';}
if($thTim == '14'){$mov = '505';}
if($thTim == '15'){$mov = '550';}
if($thTim == '16'){$mov = '600';}
if($thTim == '17'){$mov = '648';}
if($thTim == '18'){$mov = '705';}
if($thTim == '19'){$mov = '755';}
if($thTim == '20'){$mov = '805';}
if($thTim == '21'){$mov = '855';}
if($thTim == '22'){$mov = '905';}
if($thTim == '23'){$mov = '955';}
if($thTim == '24'){$mov = '1005';}

echo '<div style="height:auto; position:relative;">';

echo '<div id="timebar" style="height:100%; width:5px; background-image:url(images/timebar.png); background-repeat:repeat-y; position:absolute; z-index:800; left:'.$mov.'px"></div>';

$ty = mysql_query("SELECT * FROM core_users WHERE saasid = '".$_SESSION['saasid']."' AND usrtyp = 'tech' AND active = 'true'");

	while($v = mysql_fetch_array($ty)){

echo '<div class="infoheadlines" style="position:relative">
<div id="glo'.$v["usr_id"].'" style="width:873px; height:37px; border: solid 2px #B08D00; position:absolute; left:134px; top:2px; display:none; -moz-box-shadow: 0 0 5px #B08D00;
-webkit-box-shadow: 0 0 5px #B08D00; box-shadow: 0px 0px 5px #B08D00; background-image:url(images/drag_cov.png); background-repeat:repeat-x;"></div>
<div class="headtext2" style="width: 119px;">'.$v["fname"].' '.$v["lname"].'</div>
<div id="'.$v["usr_id"].'" class="droppable" style="width:880px; height:45px; float:left; position:relative">';



$op = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'workorder' AND sched_stat = 'set' AND saasid='".$_SESSION['saasid']."' AND servicedate = '".$_REQUEST['getdate']."' AND assignedtech = '".$v["usr_id"]."' OR doc_type = 'invoice' AND sched_stat = 'set' AND saasid='".$_SESSION['saasid']."' AND servicedate = '".$_REQUEST['getdate']."' AND assignedtech = '".$v["usr_id"]."'") or die(mysql_error());

while($fe = mysql_fetch_array($op)){
	
	if($fe["duration"] > '1'){
			$hr = $fe["duration"].'hrs';
			
			$getLength = 49 * $fe["duration"];
			
		}else{
			$hr = $s["duration"].'hr';
			$getLength = 49 * $fe["duration"];
		}
		
		if($getLength > '882'){
			$getLength = '882';
		}
		
		if($getLength < '49'){
			$getLength = '49';
		}
		
		if($fe["doc_type"] == 'invoice'){
			$surLink = 'invoice';
		}else{
			$surLink = 'work_orders';
		}

echo'<div id="'.$fe["doc_id"].'" class="drgbl" style="left: '.$fe["posit"].'px; top:3px; width:'.$getLength.'px; background-image:url(images/act_wrk.png); background-repeat:repeat-x; height:33px; -moz-border-radius: 2px; border-radius: 2px; position:absolute; cursor:move; font-family: \'Quantico\', sans-serif; text-shadow: -1px -1px #333; color:#FFF; font-size:17px; padding-top:5px; overflow:hidden"><span style="padding-left:15px;"><a style="color:#fff" href="'.$surLink.'.php?id='.$fe["doc_id"].'">'.$fe["doc_id"].'</a> '.$hr.'</span></div>';
}

echo'</div></div>';

	}


echo '</div>';



}
//docheck&tech='+tech+'&workorder='+workorder+'&tim
if($act == 'docheck'){
	
	$t = mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$_REQUEST['workorder']."' AND saasid = '".$_SESSION['saasid']."'"));
		$s=mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_REQUEST['tech']."' AND saasid = '".$_SESSION['saasid']."'"));
	
		$f=mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$t["assignedtech"]."' AND saasid = '".$_SESSION['saasid']."'"));
	
		if($t["assignedtech"] != $_REQUEST['tech'] && $t["assignedtech"] != ''){
			die('Are you sure you wish to assign to '.$s["fname"].' '.$s["lname"].' at '.$_REQUEST['tim'].'');
		}else{
			die('Are you sure you wish to schedule this work order for '.$_REQUEST['tim'].'?');
		}
	
}


///setworkorder&tech='+tech+'&workorder='+workorder+'&tim='+tim+'&pos='+newPosX+'&datet

if($act == 'setworkorder'){
	
	mysql_query("UPDATE core_docs SET timset = '".$_REQUEST['tim']."', posit = '".$_REQUEST['pos']."', sched_stat = 'set', assignedtech = '".$_REQUEST['tech']."' WHERE doc_id = '".$_REQUEST['workorder']."'") or die(mysql_error());
}


?>