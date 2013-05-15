<?php
date_default_timezone_set('America/Chicago');
error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];

////INSERT CONTENT INTO NEW ADD////

if($act == 'getformgrp'){
echo 'New Group Name:<br>
    <input style="width:224px;" class="makerrs" name="groupname" id="groupname" type="text">
    <div style="height:25px"></div>
    
    <div class="infohead">
	<div class="headtext" style="width:345px; border-right:solid thin #000; cursor:pointer;">Group Name</div>
    <div class="headtext" style="width:70px; border-right:solid thin #000; border-left:solid thin #CCC; text-align:center"">Read</div>
    <div class="headtext" style="width:70px; border-right:solid thin #000; border-left:solid thin #CCC; text-align:center"">Write</div>
    <div class="headtext" style="width:50px; border-left:solid thin #CCC; text-align:center"">Delete</div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Customers</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="cusread" id="cusread" type="checkbox" value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="cuswrite" id="cuswrite" type="checkbox" value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="cusdelete" id="cusdelete" type="checkbox" value=""></div>
</div>


<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Estimates</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="estiread" id="estiread" type="checkbox" value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="estiwrite" id="estiwrite" type="checkbox" value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="estidelete" id="estidelete" type="checkbox" value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Work Orders</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="wrkread" id="wrkread" type="checkbox" value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="wrkwrite" id="wrkwrite" type="checkbox" value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="wrkdelete" id="wrkdelete" type="checkbox" value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Scheduler</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="scedread" id="scedread" type="checkbox" value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="scedwrite" id="scedwrite" type="checkbox" value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="sceddelete" id="sceddelete" type="checkbox" value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Invoice</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="invread" id="invread" type="checkbox" value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="invwrite" id="invwrite" type="checkbox" value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="invdelete" id="invdelete" type="checkbox" value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Purchase Orders</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="purread" id="purread" type="checkbox" value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="purwrite" id="purwrite" type="checkbox" value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="purdelete" id="purdelete" type="checkbox" value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Accounting</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="acctread" id="acctread" type="checkbox" value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="acctwrite" id="acctwrite" type="checkbox" value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="accdelete" id="accdelete" type="checkbox" value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Admin</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="admread" id="admread" type="checkbox" value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="admwrite" id="admwrite" type="checkbox" value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="admdelete" id="admdelete" type="checkbox" value=""></div>
</div>

<div style="height:30px"></div>
<div id="adgrpgh" onClick="finAdd()">Add Group</div>';	
}

///MAKE NEW GROUP///
if($act == 'subgroup'){

$groupname=mysql_real_escape_string($_REQUEST["groupname"]);
$cusread=$_REQUEST["cusread"];
$cuswrite=$_REQUEST["cuswrite"];
$cusdelete=$_REQUEST["cusdelete"];
	$fullCustomer = "$cusread,$cuswrite,$cusdelete";
$estiread=$_REQUEST["estiread"];
$estiwrite=$_REQUEST["estiwrite"];
$estidelete=$_REQUEST["estidelete"];
	$fullEstimate = "$estiread,$estiwrite,$estidelete";
$wrkread=$_REQUEST["wrkread"];
$wrkwrite=$_REQUEST["wrkwrite"];
$wrkdelete=$_REQUEST["wrkdelete"];
	$fullWorkorder = "$wrkread,$wrkwrite,$wrkdelete";
$scedread=$_REQUEST["scedread"];
$scedwrite=$_REQUEST["scedwrite"];
$sceddelete=$_REQUEST["sceddelete"];
	$fullSchedual = "$scedread,$scedwrite,$sceddelete";
$invread=$_REQUEST["invread"];
$invwrite=$_REQUEST["invwrite"];
$invdelete=$_REQUEST["invdelete"];
	$fullInvoice = "$invread,$invwrite,$invdelete";
$purread=$_REQUEST["purread"];
$purwrite=$_REQUEST["purwrite"];
$purdelete=$_REQUEST["purdelete"];
	$fullPurchase = "$purread,$purwrite,$purdelete";
$acctread=$_REQUEST["acctread"];
$acctwrite=$_REQUEST["acctwrite"];
$accdelete=$_REQUEST["accdelete"];
	$fullAccounting = "$acctread,$acctwrite,$accdelete";
$admread=$_REQUEST["admread"];
$admwrite=$_REQUEST["admwrite"];
$admdelete=$_REQUEST["admdelete"];
	$fullAdmin = "$admread,$admwrite,$admdelete";
	

mysql_query("INSERT INTO group_tab SET grp_name = '$groupname', customer_access = '$fullCustomer', estimate_access = '$fullEstimate', workorder_access = '$fullWorkorder', scheduler_access = '$fullSchedual', invoice_access = '$fullInvoice', purchase_access = '$fullPurchase', accounting_access = '$fullAccounting', admin_access = '$fullAdmin', saasid='".$_SESSION['saasid']."', active = 'true'");
}

if($act == 'getlines'){
	
	$rt = mysql_query("SELECT * FROM group_tab WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."'");
		while($tr = mysql_fetch_array($rt)){
	
	
	echo '<div class="infoheadlines">
<div class="headtext2" style="width: 860px;">'.$tr["grp_name"].'</div>
<div class="headtext2" style="width:75px; text-align:right">
<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="editGroup(\''.$tr["grp_id"].'\')"></div>
<div class="delete_icon" title="Delete" onclick="delGrp(\''.$tr["grp_id"].'\')"></div>
</div></div>';
		}
}



/////EDIT GROUPS/////
if($act == 'editgroup'){
$yi = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));

///customer_access	estimate_access	workorder_access	scheduler_access	invoice_access	purchase_access	accounting_access	admin_access

$cu = explode(',',$yi["customer_access"]);
if($cu[0] == 'true'){$cucheck = 'checked="checked"';}else{$cucheck = '';}
if($cu[1] == 'true'){$cucheck2 = 'checked="checked"';}else{$cucheck2 = '';}
if($cu[2] == 'true'){$cucheck3 = 'checked="checked"';}else{$cucheck3 = '';}


$ea = explode(',',$yi["estimate_access"]);
if($ea[0] == 'true'){$eacheck = 'checked="checked"';}else{$eacheck = '';}
if($ea[1] == 'true'){$eacheck2 = 'checked="checked"';}else{$eacheck2 = '';}
if($ea[2] == 'true'){$eacheck3 = 'checked="checked"';}else{$eacheck3 = '';}


$wa = explode(',',$yi["workorder_access"]);
if($wa[0] == 'true'){$wacheck = 'checked="checked"';}else{$wacheck = '';}
if($wa[1] == 'true'){$wacheck2 = 'checked="checked"';}else{$wacheck2 = '';}
if($wa[2] == 'true'){$wacheck3 = 'checked="checked"';}else{$wacheck3 = '';}


$sc = explode(',',$yi["scheduler_access"]);
if($sc[0] == 'true'){$sccheck = 'checked="checked"';}else{$sccheck = '';}
if($sc[1] == 'true'){$sccheck2 = 'checked="checked"';}else{$sccheck2 = '';}
if($sc[2] == 'true'){$sccheck3 = 'checked="checked"';}else{$sccheck3 = '';}


$ia = explode(',',$yi["invoice_access"]);
if($ia[0] == 'true'){$iacheck = 'checked="checked"';}else{$iacheck = '';}
if($ia[1] == 'true'){$iacheck2 = 'checked="checked"';}else{$iacheck2 = '';}
if($ia[2] == 'true'){$iacheck3 = 'checked="checked"';}else{$iacheck3 = '';}


$po = explode(',',$yi["purchase_access"]);
if($po[0] == 'true'){$pocheck = 'checked="checked"';}else{$pocheck = '';}
if($po[1] == 'true'){$pocheck2 = 'checked="checked"';}else{$pocheck2 = '';}
if($po[2] == 'true'){$pocheck3 = 'checked="checked"';}else{$pocheck3 = '';}


$aa = explode(',',$yi["accounting_access"]);
if($aa[0] == 'true'){$aacheck = 'checked="checked"';}else{$aacheck = '';}
if($aa[1] == 'true'){$aacheck2 = 'checked="checked"';}else{$aacheck2 = '';}
if($aa[2] == 'true'){$aacheck3 = 'checked="checked"';}else{$aacheck3 = '';}


$aas = explode(',',$yi["admin_access"]);
if($aas[0] == 'true'){$aascheck = 'checked="checked"';}else{$aascheck = '';}
if($aas[1] == 'true'){$aascheck2 = 'checked="checked"';}else{$aascheck2 = '';}
if($aas[2] == 'true'){$aascheck3 = 'checked="checked"';}else{$aascheck3 = '';}


echo 'Group Name:<br>
    <input style="width:224px;" class="makerrs" name="groupname" id="groupname" type="text" value="'.$yi["grp_name"].'">
    <div style="height:25px"></div>
    
    <div class="infohead">
	<div class="headtext" style="width:345px; border-right:solid thin #000; cursor:pointer;">Group Name</div>
    <div class="headtext" style="width:70px; border-right:solid thin #000; border-left:solid thin #CCC; text-align:center"">Read</div>
    <div class="headtext" style="width:70px; border-right:solid thin #000; border-left:solid thin #CCC; text-align:center"">Write</div>
    <div class="headtext" style="width:50px; border-left:solid thin #CCC; text-align:center"">Delete</div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Customers</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="cusread" id="cusread" type="checkbox" '.$cucheck.' value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="cuswrite" id="cuswrite" type="checkbox" '.$cucheck2.' value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="cusdelete" id="cusdelete" type="checkbox" '.$cucheck3.' value=""></div>
</div>


<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Estimates</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="estiread" id="estiread" type="checkbox" '.$eacheck.' value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="estiwrite" id="estiwrite" type="checkbox" '.$eacheck2.' value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="estidelete" id="estidelete" type="checkbox" '.$eacheck3.' value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Work Orders</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="wrkread" id="wrkread" type="checkbox" '.$wacheck.' value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="wrkwrite" id="wrkwrite" type="checkbox" '.$wacheck2.' value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="wrkdelete" id="wrkdelete" type="checkbox" '.$wacheck3.' value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Scheduler</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="scedread" id="scedread" type="checkbox" '.$sccheck.' value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="scedwrite" id="scedwrite" type="checkbox" '.$sccheck2.' value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="sceddelete" id="sceddelete" type="checkbox" '.$sccheck3.' value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Invoice</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="invread" id="invread" type="checkbox" '.$iacheck.' value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="invwrite" id="invwrite" type="checkbox" '.$iacheck2.' value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="invdelete" id="invdelete" type="checkbox" '.$iacheck3.' value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Purchase Orders</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="purread" id="purread" type="checkbox" '.$pocheck.' value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="purwrite" id="purwrite" type="checkbox" '.$pocheck2.' value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="purdelete" id="purdelete" type="checkbox" '.$pocheck3.' value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Accounting</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="acctread" id="acctread" type="checkbox" '.$aacheck.' value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="acctwrite" id="acctwrite" type="checkbox" '.$aacheck2.' value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="accdelete" id="accdelete" type="checkbox" '.$aacheck3.' value=""></div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width:345px;">Admin</div>
<div class="headtext2" style="width:70px; text-align:center"><input name="admread" id="admread" type="checkbox" '.$aascheck.' value=""></div>
<div class="headtext2" style="width:70px; text-align:center"><input name="admwrite" id="admwrite" type="checkbox" '.$aascheck2.' value=""></div>
<div class="headtext2" style="width:50px; text-align:center"><input name="admdelete" id="admdelete" type="checkbox" '.$aascheck3.' value=""></div>
</div>

<div style="height:30px"></div>
<div id="adgrpgh" onClick="fingrpEdit(\''.$_REQUEST['id'].'\')">Edit Group</div>';
}

///FINISH EDIT GROUP////
if($act == 'finedigroup'){

$groupname=mysql_real_escape_string($_REQUEST["groupname"]);
$cusread=$_REQUEST["cusread"];
$cuswrite=$_REQUEST["cuswrite"];
$cusdelete=$_REQUEST["cusdelete"];
	$fullCustomer = "$cusread,$cuswrite,$cusdelete";
$estiread=$_REQUEST["estiread"];
$estiwrite=$_REQUEST["estiwrite"];
$estidelete=$_REQUEST["estidelete"];
	$fullEstimate = "$estiread,$estiwrite,$estidelete";
$wrkread=$_REQUEST["wrkread"];
$wrkwrite=$_REQUEST["wrkwrite"];
$wrkdelete=$_REQUEST["wrkdelete"];
	$fullWorkorder = "$wrkread,$wrkwrite,$wrkdelete";
$scedread=$_REQUEST["scedread"];
$scedwrite=$_REQUEST["scedwrite"];
$sceddelete=$_REQUEST["sceddelete"];
	$fullSchedual = "$scedread,$scedwrite,$sceddelete";
$invread=$_REQUEST["invread"];
$invwrite=$_REQUEST["invwrite"];
$invdelete=$_REQUEST["invdelete"];
	$fullInvoice = "$invread,$invwrite,$invdelete";
$purread=$_REQUEST["purread"];
$purwrite=$_REQUEST["purwrite"];
$purdelete=$_REQUEST["purdelete"];
	$fullPurchase = "$purread,$purwrite,$purdelete";
$acctread=$_REQUEST["acctread"];
$acctwrite=$_REQUEST["acctwrite"];
$accdelete=$_REQUEST["accdelete"];
	$fullAccounting = "$acctread,$acctwrite,$accdelete";
$admread=$_REQUEST["admread"];
$admwrite=$_REQUEST["admwrite"];
$admdelete=$_REQUEST["admdelete"];
	$fullAdmin = "$admread,$admwrite,$admdelete";
	
	echo $_REQUEST['id'];

mysql_query("UPDATE group_tab SET grp_name = '$groupname', customer_access = '$fullCustomer', estimate_access = '$fullEstimate', workorder_access = '$fullWorkorder', scheduler_access = '$fullSchedual', invoice_access = '$fullInvoice', purchase_access = '$fullPurchase', accounting_access = '$fullAccounting', admin_access = '$fullAdmin' WHERE saasid='".$_SESSION['saasid']."' AND grp_id = '".$_REQUEST['id']."'")or die(mysql_error());
}

////DELETE GROUP////
//delgrp&id
if($act == 'delgrp'){
	mysql_query("UPDATE group_tab SET active = 'false' WHERE saasid='".$_SESSION['saasid']."' AND grp_id = '".$_REQUEST['id']."'");
	
}

////USER ACTIONS////

///get user list///
if($act == 'getusers'){
	
	
	$rowsPerPage = 15;
//$rowsPerPage2=12;
// by default we show first page


// if $_GET['page'] defined, use it as page number
if($_REQUEST['page']=='undefined' || $_REQUEST['page']==''){
$pageNum = 1;	
}else{$pageNum = $_REQUEST['page'];}

//if($_POST['page']!='')
//{
	//echo $_POST['page'];
	//$pageNum = $_POST['page'];
//}else{
//$pageNum = 1;	
//}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
//echo $offset;

if(isset($_REQUEST['search'])){
	$serc = $_REQUEST['searchval'];
	//echo 'set';
	$query  = "SELECT * FROM core_users WHERE saasid = '".$_SESSION['saasid']."' AND active = 'true' AND fname LIKE '$serc%' OR saasid = '".$_SESSION['saasid']."' AND active = 'true' AND lname LIKE '$serc%' OR CONCAT(fname,' ',lname) LIKE '$serc%'";
	
}else{
$query  = "SELECT * FROM core_users WHERE saasid = '".$_SESSION['saasid']."' AND active = 'true' ORDER BY usr_id $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:20px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Active Users..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				
				$rt=mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$h["att_grp"]."'"));
	if($rt["grp_name"] == ''){
	$group = '<span style="color:#D83232">No Group Attached</span>';	
	}else{
	$group = $rt["grp_name"];
	}
	echo '<div class="infoheadlines">
				
						<div class="headtext2" style="width: 220px;">'.$h["fname"].' '.$h["lname"].'</div>
   							 <div class="headtext2" style="width: 380px;">'.$h["usrname"].'</div>
   								 <div class="headtext2" style="width: 212px;">'.$group.'</div>
    					
   						 <div class="headtext2" style="width:95px; text-align:center">
                         
   					 <div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="edUser(\''.$h["usr_id"].'\')"></div>
    			<div class="delete_icon" title="Delete" onclick="delUser(\''.$h["usr_id"].'\')"></div>
   			 </div>
		</div>';
			}
	}
 $query   = "SELECT COUNT(usr_id) AS numrows FROM core_users WHERE active='true' AND saasid = '".$_SESSION['saasid']."'";
$result  = mysql_query($query) or die(mysql_error());
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
///echo $numrows;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav = '';
for($page = 1; $page <= $maxPage; $page++)
{
	if ($page == $pageNum)
	{
		//$nav .= " $page ";   // no need to create a link to current page
		
		$nav .='<div class="pagact">'.$page.'</div>';
	}
	else
	{
		$nav .= '<div class="pagnull" onclick="getUser(\''.$page.'\')">'.$page.'</div>';
	}		
}

// creating previous and next link
// plus the link to go straight to
// the first and last page

if ($pageNum > 1)
{
	$page = $pageNum - 1;
	$prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
	
	//$first = " <a href=\"$self?page=1\">First</a> ";
} 
else
{
	$prev  = '&nbsp;'; // we're on page one, don't print previous link
	$first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
	$page = $pageNum + 1;
	$next = '<div class="pagnull" onclick="getUser(\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getUser(\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:30px">'.$first .  $next .$nav . $last.'</div>';
	
}

//PULL NEW USER FORM////
if($act == 'getusrfrm'){
	
echo '
    <div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    First Name:<br><input class="makerrs" name="fname" id="fname" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Last Name:<br><input class="makerrs" name="lname" id="lname" type="text">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:30px;">
    <div style="width:300px; height:40px; float:left">
    Email:<br><input style="width:234px;" class="makerrs" name="email" id="email" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Group:<br><select class="makerrs" name="grpsel" id="grpsel">';
	
	echo '<option value="none" selected="selected">Select a group...</option>';
	
	$rt = mysql_query("SELECT * FROM group_tab WHERE active = 'true' AND saasid = '".$_SESSION["saasid"]."'");
		while($s = mysql_fetch_array($rt)){
			echo '<option value="'.$s["grp_id"].'">'.$s["grp_name"].'</option>';
		}
	
	
	echo '</select>
    </div> 
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Address:<br><input style="width:234px;" class="makerrs" name="address" id="address" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    City:<br><input class="makerrs" name="city" id="city" type="text">
    </div>
    </div>
	
	
	<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    State:<br><select class="makerrs" name="state" id="state">
	<option value="none">Select State...</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Zip:<br><input style="width:90px" class="makerrs" name="zip" id="zip" type="text" maxlength="5">
    </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    User Type:<br><select class="makerrs" id="usrtyp" name="usrtyp">
	<option value="none" selected="selected">Select Type...</option>
	<option value="admin">System Admin</option>
	<option value="salesman">Sales Man</option>
	<option value="tech">Tech</option>
	<option value="employee">Employee</option>
	</select>
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Password:<br><input class="makerrs" name="pass" id="pass" type="password">
    </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Phone:<br><input class="makerrs" name="phone" id="phone" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    
    </div>
    </div>
    
    <div id="adusr" onclick="finAddus()">Add User</div>';	
}


/////FINISH ADD OF USER///
//addusr&fname='+fname+'&lname='+lname+'&email='+email+'&address='+address+'&city='+city+'&state='+state+'&zip='+zip+'&usrtyp='+usrtyp+'&pass
if($act == 'addusr'){
	$fname = mysql_real_escape_string($_REQUEST['fname']);
	$lname = mysql_real_escape_string($_REQUEST['lname']);
	$email = mysql_real_escape_string($_REQUEST['email']);
	$address = mysql_real_escape_string($_REQUEST['address']);
	$city = mysql_real_escape_string($_REQUEST['city']);
	$state = mysql_real_escape_string($_REQUEST['state']);
	$zip = mysql_real_escape_string($_REQUEST['zip']);
	$usrtyp = mysql_real_escape_string($_REQUEST['usrtyp']);
	$pass = mysql_real_escape_string($_REQUEST['pass']);
	$phone = mysql_real_escape_string($_REQUEST['phone']);
	$grpsel = mysql_real_escape_string($_REQUEST['grpsel']);
	
	$session = md5($pass.date('mdysi'));
	
	mysql_query("INSERT INTO core_users SET fname = '$fname',	lname = '$lname',	usrtyp = '$usrtyp',	usrname = '$email',	usrpass = '$pass',	address = '$address',	city = '$city',	state = '$state',	zip = '$zip',	phone = '$phone',	att_grp = '$grpsel',	active = 'true',	saasid = '".$_SESSION['saasid']."',	sessid = '$session',	isowner = 'false'");
}


////GET EDIT USER FORM///
if($act == 'getsinuser'){
	$ty=mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_REQUEST['id']."'"));
echo '
    <div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    First Name:<br><input class="makerrs" name="fname" id="fname" type="text" value="'.$ty["fname"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Last Name:<br><input class="makerrs" name="lname" id="lname" type="text" value="'.$ty["lname"].'">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:30px;">
    <div style="width:300px; height:40px; float:left">
    Email:<br><input style="width:234px;" class="makerrs" name="email" id="email" type="text" value="'.$ty["usrname"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Group:<br><select class="makerrs" name="grpsel" id="grpsel">';
	
	
	
	$rt = mysql_query("SELECT * FROM group_tab WHERE active = 'true' AND saasid = '".$_SESSION["saasid"]."'");
	if($ty["att_grp"] == ''){
	echo '<option value="none" selected="selected">Select a group...</option>';	
	}
		while($s = mysql_fetch_array($rt)){
			if($ty["att_grp"] == $s["grp_id"]){
				$sel = 'selected="selected"';
			}else{
				$sel = '';
			}
			echo '<option value="'.$s["grp_id"].'" '.$sel.'>'.$s["grp_name"].'</option>';
		}
	
	
	echo '</select>
    </div> 
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Address:<br><input style="width:234px;" class="makerrs" name="address" id="address" type="text" value="'.$ty["address"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    City:<br><input class="makerrs" name="city" id="city" type="text" value="'.$ty["city"].'">
    </div>
    </div>
	
	
	<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    State:<br><select class="makerrs" name="state" id="state">
	<option value="'.$ty["state"].'" selected="selected">'.$ty["state"].'</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Zip:<br><input style="width:90px" class="makerrs" name="zip" id="zip" type="text" maxlength="5" value="'.$ty["zip"].'">
    </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    User Type:<br><select class="makerrs" id="usrtyp" name="usrtyp">
	<option value="'.$ty["usrtyp"].'" selected="selected">'.$ty["usrtyp"].'</option>
	<option value="admin">System Admin</option>
	<option value="salesman">Sales Man</option>
	<option value="tech">Tech</option>
	<option value="employee">Employee</option>
	</select>
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Password:<br><input class="makerrs" name="pass" id="pass" type="password" value="'.$ty["usrpass"].'">
    </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Phone:<br><input class="makerrs" name="phone" id="phone" type="text" value="'.$ty["phone"].'">
    </div>';
	
	if($ty["groups"] == 'true'){$ck1 = 'checked="checked"';}else{$ck1 = '';}
	if($ty["users"] == 'true'){$ck2 = 'checked="checked"';}else{$ck2 = '';}
	if($ty["vendor"] == 'true'){$ck3 = 'checked="checked"';}else{$ck3 = '';}
	if($ty["inventory"] == 'true'){$ck4 = 'checked="checked"';}else{$ck4 = '';}
	if($ty["auditlog"] == 'true'){$ck5 = 'checked="checked"';}else{$ck5 = '';}
	if($ty["reports"] == 'true'){$ck6 = 'checked="checked"';}else{$ck6 = '';}
	if($ty["tax"] == 'true'){$ck7 = 'checked="checked"';}else{$ck7 = '';}
	
	if($ty["usrtyp"] == 'admin'){
	
	
	echo '<div style="width:300px; height:40px; float:left">
    Admin Access:<br><input name="aceschk" id="aceschk" type="checkbox" value="group" '.$ck1.'/> Group <input name="aceschk1" id="aceschk1" type="checkbox" value="users" '.$ck2.'/> Users <input name="aceschk2" id="aceschk2" type="checkbox" value="vendors" '.$ck3.'/> Vendors <input name="aceschk3" id="aceschk3" type="checkbox" value="inventory" '.$ck4.'/> Inventory <input name="aceschk4" id="aceschk4" type="checkbox" value="auditlog" '.$ck5.'/> Audit Log <input name="aceschk5" id="aceschk5" type="checkbox" value="reports" '.$ck6.'/> Reports <input name="aceschk6" id="aceschk6" type="checkbox" value="tax" '.$ck7.'/> Tax Manager
    </div>
    </div>';
	
	}
    
    echo'<div id="adusr" onclick="fineditus(\''.$_REQUEST['id'].'\')">Edit User</div>';		
}

///INSERT USER EDITS INTO DB///
if($act == 'editusr'){
	$fname = mysql_real_escape_string($_REQUEST['fname']);
	$lname = mysql_real_escape_string($_REQUEST['lname']);
	$email = mysql_real_escape_string($_REQUEST['email']);
	$address = mysql_real_escape_string($_REQUEST['address']);
	$city = mysql_real_escape_string($_REQUEST['city']);
	$state = mysql_real_escape_string($_REQUEST['state']);
	$zip = mysql_real_escape_string($_REQUEST['zip']);
	$usrtyp = mysql_real_escape_string($_REQUEST['usrtyp']);
	$pass = mysql_real_escape_string($_REQUEST['pass']);
	$phone = mysql_real_escape_string($_REQUEST['phone']);
	$grpsel = mysql_real_escape_string($_REQUEST['grpsel']);
	
	///group='+group+'&users='+users+'&vendors='+vendors+'&inventory='+inventory+'&auditlog='+auditlog+'&reports='+reports+'&tax
	$group = $_REQUEST['group'];
	$users = $_REQUEST['users'];
	$vendors = $_REQUEST['vendors'];
	$inventory = $_REQUEST['inventory'];
	$auditlog = $_REQUEST['auditlog'];
	$reports = $_REQUEST['reports'];
	$tax = $_REQUEST['tax'];
	
	echo $group;
	
	$session = md5($pass.date('mdysi'));
	
	mysql_query("UPDATE core_users SET fname = '$fname', lname = '$lname', usrtyp = '$usrtyp',	usrname = '$email',	usrpass = '$pass',	address = '$address',	city = '$city',	state = '$state',	zip = '$zip',	phone = '$phone',	att_grp = '$grpsel', groups = '$group', users = '$users', vendor = '$vendors', inventory = '$inventory', auditlog = '$auditlog', reports = '$reports', tax = '$tax' WHERE usr_id = '".$_REQUEST['id']."'")or die(mysql_error());
}

///REMOVE USERS//
if($act == 'deluser'){
mysql_query("UPDATE core_users SET active = 'false' WHERE usr_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
echo 'deleted';
}


////GET VENDOR ADD FORM////
if($act == 'getvendform'){
echo '
    <div style="width:603px; height:40px; margin-bottom:10px">
     <div style="width:300px; height:40px; float:left">
    GL#:<br><select class="makerrs" name="subacct" id="subacct">
    <option value="none">Select sub account if needed...</option>';
     
	 $br = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'expense' AND active = 'true' AND subacct = 'none' AND saasid = '".$_SESSION['saasid']."'");
	 	while($r = mysql_fetch_array($br)){
		echo '<option value="'.$r["glid"].'">'.$r["fld1"].'</option>';	
		}
	
    echo '</select>
	
	
   </div>
	<div style="width:300px; height:40px; float:left">
    REF-NUM#:<br><input class="makerrs" name="gl_id" id="gl_id" type="text" value="">
    </div>
    </div>
    
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:300px; height:40px;">
    Vendor Name:<br><input class="makerrs" name="ven_name" id="ven_name" type="text" value="">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Address:<br><input style="width:250px" class="makerrs" name="ven_address" id="ven_address" type="text" value="">
    </div>
    <div style="width:270px; height:40px; float:left">
    Address2:<br><input style="width:250px" class="makerrs" name="ven_address2" id="ven_address2" type="text" value="">
    </div>
    </div>
    
    
    
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:150px; height:40px; float:left">
    City:<br><input  class="makerrs" name="ven_city" id="ven_city" type="text" value="">
    </div>
    <div style="width:200px; height:40px; float:left">
    State:<br><select class="makerrs" name="ven_state" id="ven_state">
	<option value="none" selected="selected">Select State...</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
    </div>
    <div style="width:100px; height:40px; float:left">
    Zip:<br><input style="width:90px"  class="makerrs" name="ven_zip" id="ven_zip" type="text" value="">
    </div>
    </div>
	
	 <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:150px; height:40px; float:left">
    Fed ID #:<br><input  class="makerrs" name="fed_num" id="fed_num" type="text" value="">
    </div>
	 <div style="width:150px; height:40px; float:left">
    Select Term:<br><select class="makerrs" name="selterm" id="selterm"><option value="none" selected="selected">Select Term...</option>';
	$rb = mysql_query("SELECT * FROM ven_terms WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."'");
	while($gb = mysql_fetch_array($rb)){
		echo '<option value="'.$gb["term_id"].'">'.$gb["percent"].'% '.$gb["days"].' days Net '.$gb["net"].'</option>';
	}
	
	echo '</select>
    </div>
	</div>
	
	
	
	<div style="width:603px; height:110px; margin-bottom:10px">
    <div style="width:150px; height:80px; float:left">
    Notes:<br><textarea class="makerrs" style="width:418px; height:87px; resize:none" name="ven_notes" id="ven_notes" cols="" rows=""></textarea>
    </div>
	</div>
    
	<div style="clear:both"></div>
    
    <div style="border-bottom:solid thin #ccc; margin-top:15px; margin-bottom:15px;"></div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Certificate of Insurance Exp. Date:<br><input style="width:230px; float:left" class="makerrs" name="ven_coied" id="ven_coied" type="text" value="">
    </div>
    <div style="width:270px; height:40px; float:left">
    Certificate of WC Exp. Date:<br><input style="width:230px; float:left" class="makerrs" name="ven_cowed" id="ven_cowed" type="text" value="">
    </div>
    </div>
    
    <div style="border-bottom:solid thin #ccc; margin-top:20px; margin-bottom:15px;"></div>
    
    <div style="font-size:18px; font-weight:bold;">Contact Person</div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:160px; height:40px; float:left">
    Firstname:<br><input  class="makerrs" name="vencon_fname" id="vencon_fname" type="text" value="">
    </div>
    <div style="width:270px; height:40px; float:left">
    Lastname:<br><input class="makerrs" name="vencon_lname" id="vencon_lname" type="text" value="">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Email:<br><input style="width:230px;"  class="makerrs" name="vencon_email" id="vencon_email" type="text" value="">
    </div>
    <div style="width:220px; height:40px; float:left">
    Phone:<br><input style="width:210px;" class="makerrs" name="vencon_phone" id="vencon_phone" type="text" value="">
    </div>
    </div>
    
     <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:220px; height:40px; float:left">
    Phone2:<br><input style="width:210px;" class="makerrs" name="vencon_phone2" id="vencon_phone2" type="text" value="">
    </div>
	<div style="width:220px; height:40px; float:left">
    Fax:<br><input style="width:210px;" class="makerrs" name="vencon_fax" id="vencon_fax" type="text" value="">
    </div>
    
    </div>
    
    <div style="height:30px"></div>
    
    <div id="advens" onclick="finaddVen()">Add Vendor</div>';	
}

/////INSERT VENDOR INFO INTO DB//
if($act == 'finaddven'){
$gl_id = mysql_real_escape_string($_REQUEST['gl_id']);
$ven_name = mysql_real_escape_string($_REQUEST['ven_name']);
$ven_address = mysql_real_escape_string($_REQUEST['ven_address']);
$ven_address2 = mysql_real_escape_string($_REQUEST['ven_address2']);
$ven_city = mysql_real_escape_string($_REQUEST['ven_city']);
$ven_state = mysql_real_escape_string($_REQUEST['ven_state']);
$ven_zip = mysql_real_escape_string($_REQUEST['ven_zip']);
$ven_coied = mysql_real_escape_string($_REQUEST['ven_coied']);
$ven_cowed = mysql_real_escape_string($_REQUEST['ven_cowed']);
$vencon_fname = mysql_real_escape_string($_REQUEST['vencon_fname']);
$vencon_lname = mysql_real_escape_string($_REQUEST['vencon_lname']);
$vencon_email = mysql_real_escape_string($_REQUEST['vencon_email']);
$vencon_phone = mysql_real_escape_string($_REQUEST['vencon_phone']);
$vencon_fax = mysql_real_escape_string($_REQUEST['vencon_fax']);
$subacct = mysql_real_escape_string($_REQUEST['subacct']);
$vencon_phone2 = mysql_real_escape_string($_REQUEST['vencon_phone2']);
$ven_notes = mysql_real_escape_string($_REQUEST['ven_notes']);
$fed_num = mysql_real_escape_string($_REQUEST['fed_num']);
$selterm = mysql_real_escape_string($_REQUEST['selterm']);

if($subacct == ''){
$subacct = 'none';	
}

mysql_query("INSERT INTO ledger_tabs SET fld2 = '$gl_id', fld1 = '$ven_name', addressset = '$ven_address', ven_address2 = '$ven_address2', fld7 = '$ven_city', fld6 = '$ven_state', fld8 = '$ven_zip', ven_coied = '$ven_coied', ven_cowed = '$ven_cowed', vencon_fname = '$vencon_fname', vencon_lname = '$vencon_lname', vencon_email = '$vencon_email', vencon_phone = '$vencon_phone', vencon_fax = '$vencon_fax', active = 'true', type = 'expense', is_vend = 'true', subacct = '$subacct', saasid = '".$_SESSION['saasid']."', vencon_phone2='$vencon_phone2', ven_notes = '$ven_notes', fed_num = '$fed_num', selterm = '$selterm'")or die(mysql_error());

//mysql_query("INSERT INTO vendors SET gl_id = '$gl_id', ven_name = '$ven_name', ven_address = '$ven_address', ven_address2 = '$ven_address2', ven_city = '$ven_city', ven_state = '$ven_state', ven_zip = '$ven_zip', ven_coied = '$ven_coied', ven_cowed = '$ven_cowed', vencon_fname = '$vencon_fname', vencon_lname = '$vencon_lname', vencon_email = '$vencon_email', vencon_phone = '$vencon_phone', vencon_fax = '$vencon_fax', active = 'true', saasid = '".$_SESSION['saasid']."'");
}

/////GET VENDOR LIST///
if($act == 'getvendlist'){

		///////start page stuff/////
		
		$rowsPerPage = 15;
//$rowsPerPage2=12;
// by default we show first page


// if $_GET['page'] defined, use it as page number
if($_REQUEST['page']=='undefined' || $_REQUEST['page']==''){
$pageNum = 1;	
}else{$pageNum = $_REQUEST['page'];}

//if($_POST['page']!='')
//{
	//echo $_POST['page'];
	//$pageNum = $_POST['page'];
//}else{
//$pageNum = 1;	
//}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
//echo $offset;

if(isset($_REQUEST['search'])){
	$serc = $_REQUEST['searchval'];
	//echo 'set';
	$query  = "SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND is_vend = 'true' AND fld1 LIKE '$serc%'";
	
}else{
$query  = "SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND is_vend = 'true' ORDER BY glid $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:20px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Active Vendors..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				
			
	echo '<div class="infoheadlines">
				
						<div class="headtext2" style="width: 210px;">'.$h["fld1"].'</div>
   							 <div class="headtext2" style="width: 220px;">'.$h["vencon_fname"].' '.$h["vencon_lname"].'</div>
   								 <div class="headtext2" style="width: 228px;">'.$h["vencon_email"].'</div>
                                 <div class="headtext2" style="width: 122px;">'.$h["vencon_phone"].'</div>
    					
   						 <div class="headtext2" style="width:95px; text-align:center">
                         
   					 <div class="edit_icon" title="Edit" style="margin-right:6px;margin-left: 20px;" onclick="edVend(\''.$h["glid"].'\')"></div>
    			<div class="delete_icon" title="Delete" onclick="delVend(\''.$h["glid"].'\')"></div>
   			 </div>
		</div>';
			}
	}
 $query   = "SELECT COUNT(glid) AS numrows FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND is_vend = 'true'";
$result  = mysql_query($query) or die(mysql_error());
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
///echo $numrows;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav = '';
for($page = 1; $page <= $maxPage; $page++)
{
	if ($page == $pageNum)
	{
		//$nav .= " $page ";   // no need to create a link to current page
		
		$nav .='<div class="pagact">'.$page.'</div>';
	}
	else
	{
		$nav .= '<div class="pagnull" onclick="getUser(\''.$page.'\')">'.$page.'</div>';
	}		
}

// creating previous and next link
// plus the link to go straight to
// the first and last page

if ($pageNum > 1)
{
	$page = $pageNum - 1;
	$prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
	
	//$first = " <a href=\"$self?page=1\">First</a> ";
} 
else
{
	$prev  = '&nbsp;'; // we're on page one, don't print previous link
	$first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
	$page = $pageNum + 1;
	$next = '<div class="pagnull" onclick="getUser(\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getUser(\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:30px">'.$first .  $next .$nav . $last.'</div>';
		
		
}


////EDIT VENDOR FORM///
if($act == 'getvendor'){
$a = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['id']."'  AND saasid = '".$_SESSION['saasid']."'"));
///gl_id	ven_name	ven_address	ven_address2	ven_city	ven_state	ven_zip	ven_coied	ven_cowed	vencon_fname	vencon_lname	vencon_email	vencon_phone	vencon_fax
echo '
<div style="width:603px; height:40px; margin-bottom:10px">
     <div style="width:300px; height:40px; float:left">
    GL#:<br><select class="makerrs" name="subacct" id="subacct">
    <option value="none">Select sub account if needed...</option>';
     
	 $br = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'expense' AND active = 'true' AND subacct = 'none' AND saasid = '".$_SESSION['saasid']."'");
	 	while($r = mysql_fetch_array($br)){
			if($a["subacct"] == $r["glid"]){
		echo '<option value="'.$r["glid"].'">'.$r["fld1"].'</option>';	
			}else{
			echo '<option value="'.$r["glid"].'" selected="selected">'.$r["fld1"].'</option>';	
			}
		}
	
    echo '</select>
	
	
   </div>
	<div style="width:300px; height:40px; float:left">
    REF-NUM#:<br><input class="makerrs" name="gl_id" id="gl_id" type="text" value="'.$a["fld2"].'">
    </div>
    </div>

    
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:300px; height:40px;">
    Vendor Name:<br><input class="makerrs" name="ven_name" id="ven_name" type="text" value="'.$a["fld1"].'">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Address:<br><input style="width:250px" class="makerrs" name="ven_address" id="ven_address" type="text" value="'.$a["addressset"].'">
    </div>
    <div style="width:270px; height:40px; float:left">
    Address2:<br><input style="width:250px" class="makerrs" name="ven_address2" id="ven_address2" type="text" value="'.$a["ven_address2"].'">
    </div>
    </div>
    
    
    
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:150px; height:40px; float:left">
    City:<br><input  class="makerrs" name="ven_city" id="ven_city" type="text" value="'.$a["fld7"].'">
    </div>
    <div style="width:200px; height:40px; float:left">
    State:<br><select class="makerrs" name="ven_state" id="ven_state">
	<option value="'.$a["fld6"].'" selected="selected">'.$a["fld6"].'</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
    </div>
    <div style="width:100px; height:40px; float:left">
    Zip:<br><input style="width:90px"  class="makerrs" name="ven_zip" id="ven_zip" type="text" value="'.$a["fld8"].'">
    </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:150px; height:40px; float:left">
    Fed ID #:<br><input  class="makerrs" name="fed_num" id="fed_num" type="text" value="'.$a["fed_num"].'">
    </div>
	<div style="width:150px; height:40px; float:left">
    Select Term:<br><select class="makerrs" name="selterm" id="selterm"><option value="none">Select Term...</option>';
	$rb = mysql_query("SELECT * FROM ven_terms WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."'");
	while($gb = mysql_fetch_array($rb)){
		if($a["selterm"] == $gb["term_id"]){
		echo '<option value="'.$gb["term_id"].'" selected="selected">'.$gb["percent"].'% '.$gb["days"].' days Net '.$gb["net"].'</option>';	
		}else{
			echo '<option value="'.$gb["term_id"].'">'.$gb["percent"].'% '.$gb["days"].' days Net '.$gb["net"].'</option>';
		}
		
	}
	
	echo '</select>
    </div>
	</div>
	
	<div style="width:603px; height:110px; margin-bottom:10px">
    <div style="width:150px; height:80px; float:left">
    Notes:<br><textarea class="makerrs" style="width:418px; height:87px; resize:none" name="ven_notes" id="ven_notes" cols="" rows="">'.$a["ven_notes"].'</textarea>
    </div>
	</div>
    
	<div style="clear:both"></div>
    
    
    <div style="border-bottom:solid thin #ccc; margin-top:15px; margin-bottom:15px;"></div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Certificate of Insurance Exp. Date:<br><input style="width:230px; float:left" class="makerrs" name="ven_coied" id="ven_coied" type="text" value="'.$a["ven_coied"].'">
    </div>
    <div style="width:270px; height:40px; float:left">
    Certificate of WC Exp. Date:<br><input style="width:230px; float:left" class="makerrs" name="ven_cowed" id="ven_cowed" type="text" value="'.$a["ven_cowed"].'">
    </div>
    </div>
    
    <div style="border-bottom:solid thin #ccc; margin-top:20px; margin-bottom:15px;"></div>
    
    <div style="font-size:18px; font-weight:bold;">Contact Person</div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:160px; height:40px; float:left">
    Firstname:<br><input  class="makerrs" name="vencon_fname" id="vencon_fname" type="text" value="'.$a["vencon_fname"].'">
    </div>
    <div style="width:270px; height:40px; float:left">
    Lastname:<br><input class="makerrs" name="vencon_lname" id="vencon_lname" type="text" value="'.$a["vencon_lname"].'">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Email:<br><input style="width:230px;"  class="makerrs" name="vencon_email" id="vencon_email" type="text" value="'.$a["vencon_email"].'">
    </div>
    <div style="width:220px; height:40px; float:left">
    Phone:<br><input style="width:210px;" class="makerrs" name="vencon_phone" id="vencon_phone" type="text" value="'.$a["vencon_phone"].'">
    </div>
    </div>
    
     <div style="width:603px; height:40px; margin-bottom:10px">
	  <div style="width:220px; height:40px; float:left">
    Phone2:<br><input style="width:210px;" class="makerrs" name="vencon_phone2" id="vencon_phone2" type="text" value="'.$a["vencon_phone2"].'">
    </div>
    <div style="width:220px; height:40px; float:left">
    Fax:<br><input style="width:210px;" class="makerrs" name="vencon_fax" id="vencon_fax" type="text" value="'.$a["vencon_fax"].'">
    </div>
    
    </div>
    
    <div style="height:30px"></div>
    
    <div id="advens" onclick="fineditVen(\''.$_REQUEST['id'].'\')">Edit Vendor</div>';


}


if($act == 'fineditven'){
$gl_id = mysql_real_escape_string($_REQUEST['gl_id']);
$ven_name = mysql_real_escape_string($_REQUEST['ven_name']);
$ven_address = mysql_real_escape_string($_REQUEST['ven_address']);
$ven_address2 = mysql_real_escape_string($_REQUEST['ven_address2']);
$ven_city = mysql_real_escape_string($_REQUEST['ven_city']);
$ven_state = mysql_real_escape_string($_REQUEST['ven_state']);
$ven_zip = mysql_real_escape_string($_REQUEST['ven_zip']);
$ven_coied = mysql_real_escape_string($_REQUEST['ven_coied']);
$ven_cowed = mysql_real_escape_string($_REQUEST['ven_cowed']);
$vencon_fname = mysql_real_escape_string($_REQUEST['vencon_fname']);
$vencon_lname = mysql_real_escape_string($_REQUEST['vencon_lname']);
$vencon_email = mysql_real_escape_string($_REQUEST['vencon_email']);
$vencon_phone = mysql_real_escape_string($_REQUEST['vencon_phone']);
$vencon_fax = mysql_real_escape_string($_REQUEST['vencon_fax']);
$subacct = mysql_real_escape_string($_REQUEST['subacct']);
$vencon_phone2 = mysql_real_escape_string($_REQUEST['vencon_phone2']);
$ven_notes = mysql_real_escape_string($_REQUEST['ven_notes']);
$fed_num = mysql_real_escape_string($_REQUEST['fed_num']);
$selterm = mysql_real_escape_string($_REQUEST['selterm']);


mysql_query("UPDATE ledger_tabs SET fld2 = '$gl_id', fld1 = '$ven_name', addressset = '$ven_address', ven_address2 = '$ven_address2', fld7 = '$ven_city', fld6 = '$ven_state', fld8 = '$ven_zip', ven_coied = '$ven_coied', ven_cowed = '$ven_cowed', vencon_fname = '$vencon_fname', vencon_lname = '$vencon_lname', vencon_email = '$vencon_email', vencon_phone = '$vencon_phone', vencon_fax = '$vencon_fax', active = 'true', type = 'expense', is_vend = 'true', subacct = '$subacct', vencon_phone2 = '$vencon_phone2', ven_notes = '$ven_notes', fed_num = '$fed_num', selterm = '$selterm' WHERE glid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'")or die(mysql_error());

//mysql_query("UPDATE vendors SET gl_id = '$gl_id', ven_name = '$ven_name', ven_address = '$ven_address', ven_address2 = '$ven_address2', ven_city = '$ven_city', ven_state = '$ven_state', ven_zip = '$ven_zip', ven_coied = '$ven_coied', ven_cowed = '$ven_cowed', vencon_fname = '$vencon_fname', vencon_lname = '$vencon_lname', vencon_email = '$vencon_email', vencon_phone = '$vencon_phone', vencon_fax = '$vencon_fax' WHERE ven_id = '".$_REQUEST['id']."'");
}

////DELETE VENDOR///
if($act == 'delvend'){
mysql_query("UPDATE ledger_tabs SET active = 'false' WHERE glid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
	
}



/////GIVE USER SELECT FOR PRODUCT OR SERVICE////

if($act == 'selectyp'){
	echo '<div style="padding:30px;">
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Create New:<br>
	<select name="prodtypss" class="makerrs" onchange="runItemtyp(this.value)">
	<option value="none" selected="selected" >Select</option>
	<option value="product">Product</option>
	<option value="part">Part</option>
	<option value="service" >Service</option>
	</select>
    </div>
    </div>
	
	</div>';
	
}


if($act == 'serviceform'){
	
	echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Service Name:<br><input style="width:250px" class="makerrs" name="item_name" id="item_name" type="text" value="">
    </div>
    <div style="width:120px; height:40px; float:left">
    Price:<br><input style="width:90px" class="makerrs" name="servprice" id="servprice" type="text" value="">
    </div>
    </div>
	
	<div style="width:603px; height:95px; margin-bottom:10px">
    <div style="width:300px; height:89px; float:left">
    Service Description:<br><textarea style="width:434px; height:89px;" class="makerrs" name="proddesc" id="proddesc" cols="" rows=""></textarea>
    </div>
    
	</div>
	<div style="margin-top:30px;"></div>
	<div id="adprods" onclick="finprodAddserv()">Save</div>
	';
	
}


//subservice&item_name='+item_name+'&servprice='+servprice+'&proddesc
///ENTER SERVICE INTO DB///
if($act == 'subservice'){
	$item_name = mysql_real_escape_string($_REQUEST['item_name']);
	$servprice = mysql_real_escape_string($_REQUEST['servprice']);
	$proddesc = mysql_real_escape_string($_REQUEST['proddesc']);
	
	mysql_query("INSERT INTO productservi SET item_name = '$item_name',	decs = '$proddesc',	status = 'In Stock',	price = '$servprice',	active = 'true',	item_typ = 'service',	saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
}

if($act == 'serviceformed'){
	
	$rt=mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));
	
	echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Service Name:<br><input style="width:250px" class="makerrs" name="item_name" id="item_name" type="text" value="'.$rt["item_name"].'">
    </div>
    <div style="width:120px; height:40px; float:left">
    Price:<br><input style="width:90px" class="makerrs" name="servprice" id="servprice" type="text" value="'.$rt["price"].'">
    </div>
    </div>
	
	<div style="width:603px; height:95px; margin-bottom:10px">
    <div style="width:300px; height:89px; float:left">
    Service Description:<br><textarea style="width:434px; height:89px;" class="makerrs" name="proddesc" id="proddesc" cols="" rows="">'.$rt["decs"].'</textarea>
    </div>
    
	</div>
	<div style="margin-top:30px;"></div>
	<div id="adprods" onclick="finprodEditserv(\''.$_REQUEST['id'].'\')">Save</div>
	';
	
}

if($act == 'subeditservice'){
	$item_name = mysql_real_escape_string($_REQUEST['item_name']);
	$servprice = mysql_real_escape_string($_REQUEST['servprice']);
	$proddesc = mysql_real_escape_string($_REQUEST['proddesc']);
	
	mysql_query("UPDATE productservi SET item_name = '$item_name', decs = '$proddesc', price = '$servprice' WHERE items_ids = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
}


//////GET NEW PRODUCT / SERVICE FORM////

if($act == 'getproductform'){
	
	$er = mysql_query("SELECT * FROM productservi WHERE saasid = '".$_SESSION['saasid']."' ORDER BY items_ids DESC");
		$nu = mysql_fetch_array($er);
		
		$number = $nu["items_ids"];
		
		echo '<input name="lastid" id="lastid" type="hidden" value="'.$number.'" />';
	
echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Product Name:<br><input style="width:250px" class="makerrs" name="item_name" id="item_name" type="text" value="">
    </div>
    <div style="width:120px; height:40px; float:left">
    Qty Available:<br><input style="width:90px" class="makerrs" name="inventory" id="inventory" type="text" value="">
    </div>
    </div>
    
    <div style="width:633px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Vendor:<br><select class="makerrs" id="attc_vend" name="attc_vend"><option value="none" selected="selected">Select Vendor</option>';
	
	$t = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND is_vend = 'true'")or die(mysql_error());
		while($fgh = mysql_fetch_array($t)){
		echo '<option value="'.$fgh["glid"].'">'.$fgh["fld1"].'</option>';	
		}
	
	
    echo '</select></div>
    <div style="width:120px; height:40px; float:left">
    Cost:<br><input style="width:90px" class="makerrs" name="cost" id="cost" type="text" value="">
    </div>
    
    <div style="width:120px; height:40px; float:left">
    Sale Price:<br><input style="width:90px" class="makerrs" name="price" id="price" type="text" value="">
    </div>
    
    <div style="width:120px; height:40px; float:left">
    Rental Price:<br><input style="width:90px" class="makerrs" name="rent_price" id="rent_price" type="text" value="">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:120px; height:40px; float:left">
    
    Min Threshold:<br><input style="width:90px" class="makerrs" name="mins" id="mins" type="text" value="">
    </div>
    <div style="width:120px; height:40px; float:left">
    Max Threshold:<br><input style="width:90px" class="makerrs" name="maxs" id="maxs" type="text" value="">
    </div>
	</div>
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:300px; height:40px; float:left">
    SKU:<br><input style="width:250px" class="makerrs" name="sku" id="sku" type="text" value="">
    </div>
    
	</div>
	
	<div style="width:603px; height:95px; margin-bottom:10px">
    <div style="width:300px; height:89px; float:left">
    Product Description:<br><textarea style="width:434px; height:89px;" class="makerrs" name="proddesc" id="proddesc" cols="" rows=""></textarea>
    </div>
    
	</div>
	
	
 
    
    
    <div style="margin-top:30px; margin-bottom:30px; border-bottom:solid thin #ccc"></div>
    
    
    <div style="font-size:18px; font-weight:bold;">Part List | <a style="font-size:12px; color:#0066FF" href="javascript:openParts()">Attach Part(s) to Product</a></div>
	<div id="loaderfin" style="width: 24px; height: 24px; padding: 15px; display: none; position:absolute; left: 45%; top: 73%; "><img style="padding-top:9px" src="images/loader.gif" width="24" height="24"></div>
    <!--product add screen -->
    <div style="margin-top:30px;">
	
	
    
   <div class="infohead" style="width:605px">
									
    									<div class="headtext" style="width: 190px; border-right:solid thin #000; border-left:solid thin #CCC;">Part Name</div>
    										<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Cost</div>
   												 <div class="headtext" style="width: 50px; border-right:solid thin #000; border-left:solid thin #CCC;">Qty</div>
    												<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Inventory on Hand</div>
   														
														</div>
                                                        
                                                        
                                                        <div id="attachprod" style="width:603px; height:143px; overflow-y:scroll; border:solid thin #999">';
														
														$rt = mysql_query("SELECT * FROM productservi WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND tie_prod = '' AND item_typ = 'parts'");
															while($e = mysql_fetch_array($rt)){
																$t = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$e["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
														//echo '<div class="infoheadlines">
//<div class="headtext2" style="width:35px;"><input class="checkers" name="" type="checkbox" value="'.$e["items_ids"].'" onclick="checkCheck()"></div>
//<div class="headtext2" style="width:190px;">'.$e["item_name"].'</div>
//<div class="headtext2" style="width:90px;">'.$e["cost"].'</div>
//<div class="headtext2" style="width:50px;"><input style="width:40px;" name="qty'.$e["items_ids"].'" id="qty'.$e["items_ids"].'" type="text" value="1"/></div>
//<div class="headtext2" style="width:120px;">'.$e["inventory"].'</div>
//</div>';
}
    
    
    echo'</div>
    <!--end product attachment-->
    
    <div style="margin-top:40px"></div>
    <input name="checkvals" id="checkvals" type="hidden" value="" />
    <div id="adprods" onclick="finprodAdd()">Add Product / Service</div>';	
}

if($act == 'partsbin'){
	
	echo 'Search Parts:<br><input name="serc" id="serc" type="text" /> <input name="ser" id="ser" type="button" value="Search" onClick="runnerPartsearch()"/><br><br>';
	
	 echo '<div class="infohead" style="">
									
    									<div class="headtext" style="width: 190px; border-right:solid thin #000; border-left:solid thin #CCC;">Item Name</div>
    										<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Cost</div>
   												 <div class="headtext" style="width: 50px; border-right:solid thin #000; border-left:solid thin #CCC;">Qty</div>
    												<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Inventory</div>
   														
														</div>';
														
														echo '<div id="partsspitter" style="height:200px; overflow-y:scroll;">';
	
	$rt = mysql_query("SELECT * FROM productservi WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND tie_prod = '' AND item_typ = 'parts'");
															while($e = mysql_fetch_array($rt)){
																$t = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$e["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
														echo '<div style="cursor:move" class="infoheadlines" id="'.$e["items_ids"].'">
<div class="headtext2" style="width:190px;">'.$e["item_name"].'</div>
<div class="headtext2" style="width:90px;">'.$e["cost"].'</div>
<div class="headtext2" style="width:50px;"><input style="width:40px;" name="qty'.$e["items_ids"].'" id="qty'.$e["items_ids"].'" type="text" value="1"/></div>
<div class="headtext2" style="width:120px;">'.$e["inventory"].'</div>
</div>';
}
echo '</div>';
}

///SEARCH PARTS///
if($act == 'searchparts'){
	
	$search = mysql_real_escape_string($_REQUEST['search']);
	$rtg = mysql_query("SELECT * FROM productservi WHERE item_name LIKE '$search%' AND saasid = '".$_SESSION['saasid']."' AND item_typ = 'parts' OR sku LIKE '$search%' AND saasid = '".$_SESSION['saasid']."' AND item_typ = 'parts'")or die(mysql_error());
	
		while($e = mysql_fetch_array($rtg)){
		echo '<div style="cursor:move" class="infoheadlines" id="'.$e["items_ids"].'">
<div class="headtext2" style="width:190px;">'.$e["item_name"].'</div>
<div class="headtext2" style="width:90px;">'.$e["cost"].'</div>
<div class="headtext2" style="width:50px;"><input style="width:40px;" name="qty'.$e["items_ids"].'" id="qty'.$e["items_ids"].'" type="text" value="1"/></div>
<div class="headtext2" style="width:120px;">'.$e["inventory"].'</div>
</div>';	
		}
	
}


//////FIXED ASSET ADD///

if($act == 'getproductform2'){
	
	$er = mysql_query("SELECT * FROM productservi WHERE saasid = '".$_SESSION['saasid']."' ORDER BY items_ids DESC");
		$nu = mysql_fetch_array($er);
		
		$number = $nu["items_ids"];
		
		echo '<input name="lastid" id="lastid" type="hidden" value="'.$number.'" />';
	
echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Fixed Asset:<br><input style="width:250px" class="makerrs" name="item_name" id="item_name" type="text" value="">
    </div>
    <div style="width:120px; height:40px; float:left">
    <!--Qty Available:<br><input style="width:90px" class="makerrs" name="inventory" id="inventory" type="text" value="">-->
    </div>
    </div>
    
    <div style="width:633px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Vendor:<br><select class="makerrs" id="attc_vend" name="attc_vend"><option value="none" selected="selected">Select Vendor</option>';
	
	$t = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND is_vend = 'true'")or die(mysql_error());
		while($fgh = mysql_fetch_array($t)){
		echo '<option value="'.$fgh["glid"].'">'.$fgh["fld1"].'</option>';	
		}
	
	
    echo '</select></div>
    <div style="width:120px; height:40px; float:left">
    Purchase Price:<br><input style="width:90px" class="makerrs" name="cost" id="cost" type="text" value="">
    </div>
    
    <div style="width:120px; height:40px; float:left">
    <!--Sale Price:<br><input style="width:90px" class="makerrs" name="price" id="price" type="text" value="">-->
    </div>
    
    <div style="width:120px; height:40px; float:left">
    Rental Price:<br><input style="width:90px" class="makerrs" name="rent_price" id="rent_price" type="text" value="">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:120px; height:40px; float:left">
    
   <!-- Min Threshold:<br><input style="width:90px" class="makerrs" name="mins" id="mins" type="text" value="">-->
    </div>
    <div style="width:120px; height:40px; float:left">
    <!--Max Threshold:<br><input style="width:90px" class="makerrs" name="maxs" id="maxs" type="text" value="">-->
    </div>
	</div>
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:300px; height:40px; float:left">
    SKU:<br><input style="width:250px" class="makerrs" name="sku" id="sku" type="text" value="">
    </div>
    
	</div>
	
	<div style="width:603px; height:95px; margin-bottom:10px">
    <div style="width:300px; height:89px; float:left">
    Asset Description:<br><textarea style="width:434px; height:89px;" class="makerrs" name="proddesc" id="proddesc" cols="" rows=""></textarea>
    </div>
    
	</div>
	
	
 
    
    
    <div style="margin-top:30px; margin-bottom:30px; border-bottom:solid thin #ccc"></div>
    
    
    <!--<div style="font-size:18px; font-weight:bold;">Part List | <a style="font-size:12px; color:#0066FF" href="javascript:openParts()">Attach Part(s) to Product</a></div>
	<div id="loaderfin" style="width: 24px; height: 24px; padding: 15px; display: none; position:absolute; left: 45%; top: 73%; "><img style="padding-top:9px" src="images/loader.gif" width="24" height="24"></div>
  
    <div style="margin-top:30px;">
	
	
    
   <div class="infohead" style="width:605px">
									
    									<div class="headtext" style="width: 190px; border-right:solid thin #000; border-left:solid thin #CCC;">Part Name</div>
    										<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Cost</div>
   												 <div class="headtext" style="width: 50px; border-right:solid thin #000; border-left:solid thin #CCC;">Qty</div>
    												<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Inventory on Hand</div>
   														
														</div>
                                                        
                                                        
                                                        <div id="attachprod" style="width:603px; height:143px; overflow-y:scroll; border:solid thin #999">';
														
														$rt = mysql_query("SELECT * FROM productservi WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND tie_prod = '' AND item_typ = 'parts'");
															while($e = mysql_fetch_array($rt)){
																$t = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$e["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
														//echo '<div class="infoheadlines">
//<div class="headtext2" style="width:35px;"><input class="checkers" name="" type="checkbox" value="'.$e["items_ids"].'" onclick="checkCheck()"></div>
//<div class="headtext2" style="width:190px;">'.$e["item_name"].'</div>
//<div class="headtext2" style="width:90px;">'.$e["cost"].'</div>
//<div class="headtext2" style="width:50px;"><input style="width:40px;" name="qty'.$e["items_ids"].'" id="qty'.$e["items_ids"].'" type="text" value="1"/></div>
//<div class="headtext2" style="width:120px;">'.$e["inventory"].'</div>
//</div>';
}
    
    
    echo'</div>-->
    <!--end product attachment-->
    
    <div style="margin-top:40px"></div>
    <input name="checkvals" id="checkvals" type="hidden" value="" />
    <div id="adprods" onclick="finprodAdd2du()">Add Asset</div>';	
}

if($act == 'partsbin'){
	
	echo 'Search Parts:<br><input name="serc" id="serc" type="text" /> <input name="ser" id="ser" type="button" value="Search" onClick="runnerPartsearch()"/><br><br>';
	
	 echo '<div class="infohead" style="">
									
    									<div class="headtext" style="width: 190px; border-right:solid thin #000; border-left:solid thin #CCC;">Item Name</div>
    										<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Cost</div>
   												 <div class="headtext" style="width: 50px; border-right:solid thin #000; border-left:solid thin #CCC;">Qty</div>
    												<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Inventory</div>
   														
														</div>';
														
														echo '<div id="partsspitter" style="height:200px; overflow-y:scroll;">';
	
	$rt = mysql_query("SELECT * FROM productservi WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND tie_prod = '' AND item_typ = 'parts'");
															while($e = mysql_fetch_array($rt)){
																$t = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$e["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
														echo '<div style="cursor:move" class="infoheadlines" id="'.$e["items_ids"].'">
<div class="headtext2" style="width:190px;">'.$e["item_name"].'</div>
<div class="headtext2" style="width:90px;">'.$e["cost"].'</div>
<div class="headtext2" style="width:50px;"><input style="width:40px;" name="qty'.$e["items_ids"].'" id="qty'.$e["items_ids"].'" type="text" value="1"/></div>
<div class="headtext2" style="width:120px;">'.$e["inventory"].'</div>
</div>';
}
echo '</div>';
}

///SEARCH PARTS///
if($act == 'searchparts'){
	
	$search = mysql_real_escape_string($_REQUEST['search']);
	$rtg = mysql_query("SELECT * FROM productservi WHERE item_name LIKE '$search%' AND saasid = '".$_SESSION['saasid']."' AND item_typ = 'parts' OR sku LIKE '$search%' AND saasid = '".$_SESSION['saasid']."' AND item_typ = 'parts'")or die(mysql_error());
	
		while($e = mysql_fetch_array($rtg)){
		echo '<div style="cursor:move" class="infoheadlines" id="'.$e["items_ids"].'">
<div class="headtext2" style="width:190px;">'.$e["item_name"].'</div>
<div class="headtext2" style="width:90px;">'.$e["cost"].'</div>
<div class="headtext2" style="width:50px;"><input style="width:40px;" name="qty'.$e["items_ids"].'" id="qty'.$e["items_ids"].'" type="text" value="1"/></div>
<div class="headtext2" style="width:120px;">'.$e["inventory"].'</div>
</div>';	
		}
	

}


////ADD PARTS TO DB/////
if($act == 'addpartsset'){
	//part='+thid+'&productid='+lastid+'&qty
	$part = mysql_real_escape_string($_REQUEST['part']);
	$productid = mysql_real_escape_string($_REQUEST['productid']);
	$qty = mysql_real_escape_string($_REQUEST['qty']);
	
	mysql_query("INSERT INTO attach_parts SET product_id = '$productid', part = '$part', qty = '$qty', saasid = '".$_SESSION['saasid']."'");
}


////RECALL ADDED PARTS/////
if($act == 'getadded'){
	$productid = mysql_real_escape_string($_REQUEST['productid']);
	$er = mysql_query("SELECT * FROM attach_parts WHERE product_id = '$productid' AND saasid = '".$_SESSION['saasid']."'");
		while($t=mysql_fetch_array($er)){
			
			$rt = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$t["part"]."' AND saasid = '".$_SESSION['saasid']."'"));
			
			echo '<div style="cursor:move" class="infoheadlines" id="'.$rt["items_ids"].'">
<div class="headtext2" style="width:190px;">'.$rt["item_name"].'</div>
<div class="headtext2" style="width:90px;">'.$rt["cost"].'</div>
<div class="headtext2" style="width:50px;"><input disabled="disabled" style="width:40px;" name="qty'.$rt["items_ids"].'" id="qty'.$rt["items_ids"].'" type="text" value="'.$t["qty"].'"/></div>
<div class="headtext2" style="width:90px;">'.$rt["inventory"].'</div>
<div class="headtext2" style="width:26px;"><img style="cursor:pointer" src="images/big_del.png" width="26" height="26" onClick="delParts(\''.$t["part"].'\',\''.$productid.'\')"/></div>
</div>';
			
		}
	
}

////DELETE PARTS FROM PRODUCTS///
if($act == 'delpart'){
	mysql_query("DELETE FROM attach_parts WHERE part = '".$_REQUEST['part']."' AND saasid = '".$_SESSION['saasid']."'");
	
}


////INSERT PRODUCTS / SERVICES INTO DB////
if($act == 'enterprods'){
$item_name = mysql_real_escape_string($_REQUEST['item_name']);
$inventory = mysql_real_escape_string($_REQUEST['inventory']);
$attc_vend = mysql_real_escape_string($_REQUEST['attc_vend']);
$cost = mysql_real_escape_string($_REQUEST['cost']);
$price = mysql_real_escape_string($_REQUEST['price']);
$rent_price = mysql_real_escape_string($_REQUEST['rent_price']);
$checkvals = mysql_real_escape_string($_REQUEST['checkvals']);
$sku = mysql_real_escape_string($_REQUEST['sku']);
$proddesc = mysql_real_escape_string($_REQUEST['proddesc']);
$mins = mysql_real_escape_string($_REQUEST['mins']);
$maxs = mysql_real_escape_string($_REQUEST['maxs']);


///adjust inventory//

//$tags = explode(',', $checkvals);

//foreach($tags as $key) {
	
	//$a = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '$key'"));
	//$deduct = $a["inventory"] - 1;
	//mysql_query("UPDATE productservi SET inventory = '$deduct' WHERE  items_ids = '$key'");
	
//}




mysql_query("INSERT INTO productservi SET item_name = '$item_name',	sku = '$sku',	decs = '$proddesc',	status = 'In Stock',	inventory = '$inventory',	price = '$price',	cost = '$cost',	rental = '$rent_price',	vendor = '$attc_vend',	min = '$mins',	max = '$maxs',	tie_prod = '$checkvals',	active = 'true',	item_typ = 'product',	saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
	
}

////INSERT ASSETS DB////
if($act == 'enterprodsrent'){
$item_name = mysql_real_escape_string($_REQUEST['item_name']);
//$inventory = mysql_real_escape_string($_REQUEST['inventory']);
$attc_vend = mysql_real_escape_string($_REQUEST['attc_vend']);
$cost = mysql_real_escape_string($_REQUEST['cost']);
//$price = mysql_real_escape_string($_REQUEST['price']);
$rent_price = mysql_real_escape_string($_REQUEST['rent_price']);
$checkvals = mysql_real_escape_string($_REQUEST['checkvals']);
$sku = mysql_real_escape_string($_REQUEST['sku']);
$proddesc = mysql_real_escape_string($_REQUEST['proddesc']);
//$mins = mysql_real_escape_string($_REQUEST['mins']);
//$maxs = mysql_real_escape_string($_REQUEST['maxs']);


///adjust inventory//

//$tags = explode(',', $checkvals);

//foreach($tags as $key) {
	
	//$a = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '$key'"));
	//$deduct = $a["inventory"] - 1;
	//mysql_query("UPDATE productservi SET inventory = '$deduct' WHERE  items_ids = '$key'");
	
//}




mysql_query("INSERT INTO productservi SET item_name = '$item_name',	sku = '$sku',	decs = '$proddesc',	status = 'In Stock', cost = '$cost',	rental = '$rent_price',	vendor = '$attc_vend', tie_prod = '$checkvals',	active = 'true',	item_typ = 'asset',	saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
	
}


/////GET PRODUCT LIST VIEW////
if($act == 'pullproducts' ){
	
	if($_REQUEST['order'] == 'DESC'){
		$sorterImg = '<img src="images/desc_arr.png" width="9" height="9">';
		$dirs = 'DESC';
$click = 'onclick="pullProds(\''.$_REQUEST['page'].'\',\'ASC\')"';
	}else{
		$dirs = 'ASC';
	$click = 'onclick="pullProds(\''.$_REQUEST['page'].'\',\'DESC\')"';
		$sorterImg = '<img src="images/asc_arr.png" width="9" height="9">';
	}
	
	echo '<div class="infohead">
    <div class="headtext" style="width: 140px; border-right:solid thin #000; ">SKU #</div>
    <div class="headtext" style="width: 160px; border-right:solid thin #000; border-left: solid thin #CCC;">Item Name</div>
    <div class="headtext" style="width: 140px; border-right:solid thin #000; border-left:solid thin #CCC; cursor:pointer" '.$click.'>Item Type '.$sorterImg.'</div>
    <div class="headtext" style="width: 70px; border-right:solid thin #000; border-left:solid thin #CCC;">Cost</div>
    <div class="headtext" style="width: 70px; border-right:solid thin #000; border-left:solid thin #CCC;">Sale</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Rental</div>
    <div class="headtext" style="width: 75px; border-right:solid thin #000; border-left:solid thin #CCC;">Inventory</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div></div>';
///////start page stuff/////
		
		$rowsPerPage = 15;
//$rowsPerPage2=12;
// by default we show first page


// if $_GET['page'] defined, use it as page number
if($_REQUEST['page']=='undefined' || $_REQUEST['page']==''){
$pageNum = 1;	
}else{$pageNum = $_REQUEST['page'];}

//if($_POST['page']!='')
//{
	//echo $_POST['page'];
	//$pageNum = $_POST['page'];
//}else{
//$pageNum = 1;	
//}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
//echo $offset;

if(isset($_REQUEST['search'])){
	$serc = $_REQUEST['searchval'];
	//echo 'set';
	$query  = "SELECT * FROM productservi WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND item_typ != 'asset' AND item_name LIKE '$serc%' OR active = 'true' AND saasid = '".$_SESSION['saasid']."' AND item_typ != 'asset' AND sku LIKE '$serc%'";
	
}else{
$query  = "SELECT * FROM productservi WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND item_typ != 'asset' ORDER BY item_typ $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Active Vendors..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				$t = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$h["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
				
				if($h["item_typ"] == 'service'){
					$rental = 'Service';
					$cost = 'Service';
					$inventory = 'Service';
				}else{
					$rental = $h["rental"];
					$cost = $h["cost"];
					$inventory = $h["inventory"];
				}
				
				if($h["sku"] == ''){
				$sku = 	'Not Set ****';
				}else{
				$sku = 	$h["sku"];
				}
				
				if($h["item_typ"] == 'product'){
				$procs = 'Product';
				}
				
				if($h["item_typ"] == 'parts'){
				$procs = 'Part';
				}
				
				if($h["item_typ"] == 'service'){
				$procs = 'Service';
				}
				
				if(strlen($h["item_name"]) > 20){
					$itmName = substr($h["item_name"], 0, 15).'...';
				}else{
					$itmName = $h["item_name"];
				}
				
				if($h["item_typ"] == 'parts' || $h["item_typ"] == 'product' || $h["item_typ"] == 'asset'){
					$boneAction = 'edProd(\''.$h["items_ids"].'\')';
				}else{
					$boneAction = 'pullServiced(\''.$h["items_ids"].'\')';
				}
			
	echo '<div class="infoheadlines">
				
						<div class="headtext2" style="width: 140px;">'.$sku.'</div>
   							 <div class="headtext2" style="width: 170px;">'.$itmName.'</div>
   								 <div class="headtext2" style="width: 140px;">'.$procs.'</div>
                                 <div class="headtext2" style="width: 70px;">'.$cost.'</div>
                                 <div class="headtext2" style="width: 70px;">'.$h["price"].'</div>
                                 <div class="headtext2" style="width: 95px;">'.$rental.'</div>
                                 <div class="headtext2" style="width: 70px;">'.$inventory.'</div>
    					
   						 <div class="headtext2" style="width:95px; text-align:center">
                         
   					 <div class="edit_icon" title="Edit" style="margin-right:6px;margin-left: 20px;" onclick="'.$boneAction.'"></div>
    			<div class="delete_icon" title="Delete" onclick="delProd(\''.$h["items_ids"].'\')"></div>
   			 </div>
		</div>';	
			}
	}
 $query   = "SELECT COUNT(items_ids) AS numrows FROM productservi WHERE active='true' AND item_typ != 'asset' AND saasid = '".$_SESSION['saasid']."'";
$result  = mysql_query($query) or die(mysql_error());
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
///echo $numrows;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav = '';
for($page = 1; $page <= $maxPage; $page++)
{
	if ($page == $pageNum)
	{
		//$nav .= " $page ";   // no need to create a link to current page
		
		$nav .='<div class="pagact">'.$page.'</div>';
	}
	else
	{
		$nav .= '<div class="pagnull" onclick="pullProds(\''.$page.'\',\''.$dirs.'\')">'.$page.'</div>';
	}		
}

// creating previous and next link
// plus the link to go straight to
// the first and last page

if ($pageNum > 1)
{
	$page = $pageNum - 1;
	$prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
	
	//$first = " <a href=\"$self?page=1\">First</a> ";
} 
else
{
	$prev  = '&nbsp;'; // we're on page one, don't print previous link
	$first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
	$page = $pageNum + 1;
	$next = '<div class="pagnull" onclick="pullProds(\''.$page.'\',\''.$dirs.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="pullProds(\''.$maxPage.'\',\''.$dirs.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:30px">'.$first .  $next .$nav . $last.'</div>';
}


//////EDIT PRODUCTS
if($act == 'editproduct'){
	
	$ty = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$_REQUEST['id']."' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'"));
	
	echo '<input name="lastid" id="lastid" type="hidden" value="'.$_REQUEST['id'].'" />';
	//item_name	sku	decs	status	inventory	price	cost	rental	vendor	min	max	tie_prod	active	item_typ	saasid
	echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Part Name:<br><input style="width:250px" class="makerrs" name="item_name" id="item_name" type="text" value="'.$ty["item_name"].'">
    </div>
    <div style="width:120px; height:40px; float:left">
    Qty Available:<br><input style="width:90px" class="makerrs" name="inventory" id="inventory" type="text" value="'.$ty["inventory"].'">
    </div>
    </div>
    
    <div style="width:633px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Vendor:<br><select class="makerrs" id="attc_vend" name="attc_vend">';
	if($ty["vendor"] == '' || $ty["vendor"] == 'none'){
		echo '<option value="none" selected="selected">Select Vendor</option>';
	}else{
		
	}
	
	
	$t = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND is_vend = 'true'");
		while($fgh = mysql_fetch_array($t)){
		if($ty["vendor"] == $fgh["glid"]){
				$sel = 'selected="selected"';
			}else{
				$sel = '';
			}
		echo '<option value="'.$fgh["glid"].'" '.$sel.'>'.$fgh["fld1"].'</option>';	
		}
	
	
	
	
	
    echo '</select></div>
    <div style="width:120px; height:40px; float:left">
    Cost:<br><input style="width:90px" class="makerrs" name="cost" id="cost" type="text" value="'.$ty["cost"].'">
    </div>
    
    <div style="width:120px; height:40px; float:left">
    Sale Price:<br><input style="width:90px" class="makerrs" name="price" id="price" type="text" value="'.$ty["price"].'">
    </div>
    
    <div style="width:120px; height:40px; float:left">
    Rental Price:<br><input style="width:90px" class="makerrs" name="rent_price" id="rent_price" type="text" value="'.$ty["rental"].'">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:120px; height:40px; float:left">
    
    Min Threshold:<br><input style="width:90px" class="makerrs" name="mins" id="mins" type="text" value="'.$ty["min"].'">
    </div>
    <div style="width:120px; height:40px; float:left">
    Max Threshold:<br><input style="width:90px" class="makerrs" name="maxs" id="maxs" type="text" value="'.$ty["max"].'">
    </div>
	</div>
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:300px; height:40px; float:left">
    SKU:<br><input style="width:250px" class="makerrs" name="sku" id="sku" type="text" value="'.$ty["sku"].'">
    </div>
    
	</div>
	
	<div style="width:603px; height:95px; margin-bottom:10px">
    <div style="width:300px; height:89px; float:left">
    Part Description:<br><textarea style="width:434px; height:89px;" class="makerrs" name="proddesc" id="proddesc" cols="" rows="">'.$ty["decs"].'</textarea>
    </div>
    
	</div>
	
	
 
    
    
    <div style="margin-top:30px; margin-bottom:30px; border-bottom:solid thin #ccc"></div>';
	
	if($ty["item_typ"] == 'parts'){
					
				}else{
					
				
    
    
    echo'<div style="font-size:18px; font-weight:bold;">Part List | <a style="font-size:12px; color:#0066FF" href="javascript:openParts()">Attach Parts to Product</a></div>
    <!--product add screen -->
    <div style="margin-top:30px;">
    
    <div class="infohead" style="width:605px">
									
    									<div class="headtext" style="width: 190px; border-right:solid thin #000; border-left:solid thin #CCC;">Part Name</div>
    										<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Cost</div>
   												 <div class="headtext" style="width: 50px; border-right:solid thin #000; border-left:solid thin #CCC;">Qty</div>
    												<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Inventory on Hand</div>
   														
														</div>
                                                        
                                                        
                                                        <div id="attachprod" style="width:603px; height:143px; overflow-y:scroll; border:solid thin #999">';
														
														$er = mysql_query("SELECT * FROM attach_parts WHERE product_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
		while($t=mysql_fetch_array($er)){
			
			$rt = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$t["part"]."' AND saasid = '".$_SESSION['saasid']."'"));
			
			echo '<div style="cursor:move" class="infoheadlines" id="'.$rt["items_ids"].'">
<div class="headtext2" style="width:190px;">'.$rt["item_name"].'</div>
<div class="headtext2" style="width:90px;">'.$rt["cost"].'</div>
<div class="headtext2" style="width:50px;"><input disabled="disabled" style="width:40px;" name="qty'.$rt["items_ids"].'" id="qty'.$rt["items_ids"].'" type="text" value="'.$t["qty"].'"/></div>
<div class="headtext2" style="width:90px;">'.$rt["inventory"].'</div>
<div class="headtext2" style="width:26px;"><img style="cursor:pointer" src="images/big_del.png" width="26" height="26" onClick="delParts(\''.$t["part"].'\',\''.$_REQUEST['id'].'\')"/></div>
</div>';
			
		}
		
		}
    
    
    echo'</div>
    <!--end product attachment-->
    
    <div style="margin-top:40px"></div>
    <input name="checkvals" id="checkvals" type="hidden" value="'.$ty["tie_prod"].'" />
    <div id="adprods" onclick="finprodEdit(\''.$_REQUEST['id'].'\')">Save</div>';	
	
}
////FINISH PRODUCT EDIT////
if($act == 'editprods'){
$item_name = mysql_real_escape_string($_REQUEST['item_name']);
$inventory = mysql_real_escape_string($_REQUEST['inventory']);
$attc_vend = mysql_real_escape_string($_REQUEST['attc_vend']);
$cost = mysql_real_escape_string($_REQUEST['cost']);
$price = mysql_real_escape_string($_REQUEST['price']);
$rent_price = mysql_real_escape_string($_REQUEST['rent_price']);
$checkvals = mysql_real_escape_string($_REQUEST['checkvals']);
$sku = mysql_real_escape_string($_REQUEST['sku']);
$proddesc = mysql_real_escape_string($_REQUEST['proddesc']);
$mins = mysql_real_escape_string($_REQUEST['mins']);
$maxs = mysql_real_escape_string($_REQUEST['maxs']);




mysql_query("UPDATE productservi SET item_name = '$item_name',	sku = '$sku',	decs = '$proddesc',	status = 'In Stock',	inventory = '$inventory',	price = '$price',	cost = '$cost',	rental = '$rent_price',	vendor = '$attc_vend',	min = '$mins',	max = '$maxs',	tie_prod = '$checkvals' WHERE items_ids = '".$_REQUEST['id']."'")or die(mysql_error());
	
}

if($act == 'editprods2d'){
$item_name = mysql_real_escape_string($_REQUEST['item_name']);
//$inventory = mysql_real_escape_string($_REQUEST['inventory']);
$attc_vend = mysql_real_escape_string($_REQUEST['attc_vend']);
$cost = mysql_real_escape_string($_REQUEST['cost']);
//$price = mysql_real_escape_string($_REQUEST['price']);
$rent_price = mysql_real_escape_string($_REQUEST['rent_price']);
$checkvals = mysql_real_escape_string($_REQUEST['checkvals']);
$sku = mysql_real_escape_string($_REQUEST['sku']);
$proddesc = mysql_real_escape_string($_REQUEST['proddesc']);
//$mins = mysql_real_escape_string($_REQUEST['mins']);
//$maxs = mysql_real_escape_string($_REQUEST['maxs']);




mysql_query("UPDATE productservi SET item_name = '$item_name',	sku = '$sku',	decs = '$proddesc',	status = 'In Stock', cost = '$cost', rental = '$rent_price', vendor = '$attc_vend', tie_prod = '$checkvals' WHERE items_ids = '".$_REQUEST['id']."'")or die(mysql_error());
	
}



//////////////EDIT PRODUCTS
if($act == 'editproduct2ds'){
	
	$ty = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$_REQUEST['id']."' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'"));
	
	echo '<input name="lastid" id="lastid" type="hidden" value="'.$_REQUEST['id'].'" />';
	//item_name	sku	decs	status	inventory	price	cost	rental	vendor	min	max	tie_prod	active	item_typ	saasid
	echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Asset Name:<br><input style="width:250px" class="makerrs" name="item_name" id="item_name" type="text" value="'.$ty["item_name"].'">
    </div>
    <div style="width:120px; height:40px; float:left">
   <!-- Qty Available:<br><input style="width:90px" class="makerrs" name="inventory" id="inventory" type="text" value="'.$ty["inventory"].'">-->
    </div>
    </div>
    
    <div style="width:633px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Vendor:<br><select class="makerrs" id="attc_vend" name="attc_vend">';
	if($ty["vendor"] == '' || $ty["vendor"] == 'none'){
		echo '<option value="none" selected="selected">Select Vendor</option>';
	}else{
		
	}
	
	
	$t = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND is_vend = 'true'");
		while($fgh = mysql_fetch_array($t)){
		if($ty["vendor"] == $fgh["glid"]){
				$sel = 'selected="selected"';
			}else{
				$sel = '';
			}
		echo '<option value="'.$fgh["glid"].'" '.$sel.'>'.$fgh["fld1"].'</option>';	
		}
	
	
	
	
	
    echo '</select></div>
    <div style="width:120px; height:40px; float:left">
    Cost:<br><input style="width:90px" class="makerrs" name="cost" id="cost" type="text" value="'.$ty["cost"].'">
    </div>
    
    <div style="width:120px; height:40px; float:left">
    <!--Sale Price:<br><input style="width:90px" class="makerrs" name="price" id="price" type="text" value="'.$ty["price"].'">-->
    </div>
    
    <div style="width:120px; height:40px; float:left">
    Rental Price:<br><input style="width:90px" class="makerrs" name="rent_price" id="rent_price" type="text" value="'.$ty["rental"].'">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:120px; height:40px; float:left">
    
   <!-- Min Threshold:<br><input style="width:90px" class="makerrs" name="mins" id="mins" type="text" value="'.$ty["min"].'">-->
    </div>
    <div style="width:120px; height:40px; float:left">
   <!--Max Threshold:<br><input style="width:90px" class="makerrs" name="maxs" id="maxs" type="text" value="'.$ty["max"].'">-->
    </div>
	</div>
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:300px; height:40px; float:left">
    SKU:<br><input style="width:250px" class="makerrs" name="sku" id="sku" type="text" value="'.$ty["sku"].'">
    </div>
    
	</div>
	
	<div style="width:603px; height:95px; margin-bottom:10px">
    <div style="width:300px; height:89px; float:left">
    Asset Description:<br><textarea style="width:434px; height:89px;" class="makerrs" name="proddesc" id="proddesc" cols="" rows="">'.$ty["decs"].'</textarea>
    </div>
    
	</div>
	
	
 
    
    
    <div style="margin-top:30px; margin-bottom:30px; border-bottom:solid thin #ccc"></div>';
	
	if($ty["item_typ"] == 'parts'){
					
				}else{
					
				
    
    
    echo'<!--<div style="font-size:18px; font-weight:bold;">Part List | <a style="font-size:12px; color:#0066FF" href="javascript:openParts()">Attach Parts to Product</a></div>
   
    <div style="margin-top:30px;">
    
    <div class="infohead" style="width:605px">
									
    									<div class="headtext" style="width: 190px; border-right:solid thin #000; border-left:solid thin #CCC;">Part Name</div>
    										<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Cost</div>
   												 <div class="headtext" style="width: 50px; border-right:solid thin #000; border-left:solid thin #CCC;">Qty</div>
    												<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Inventory on Hand</div>
   														
														</div>
                                                        
                                                        
                                                        <div id="attachprod" style="width:603px; height:143px; overflow-y:scroll; border:solid thin #999">';
														
														$er = mysql_query("SELECT * FROM attach_parts WHERE product_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
		while($t=mysql_fetch_array($er)){
			
			$rt = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$t["part"]."' AND saasid = '".$_SESSION['saasid']."'"));
			
			echo '<div style="cursor:move" class="infoheadlines" id="'.$rt["items_ids"].'">
<div class="headtext2" style="width:190px;">'.$rt["item_name"].'</div>
<div class="headtext2" style="width:90px;">'.$rt["cost"].'</div>
<div class="headtext2" style="width:50px;"><input disabled="disabled" style="width:40px;" name="qty'.$rt["items_ids"].'" id="qty'.$rt["items_ids"].'" type="text" value="'.$t["qty"].'"/></div>
<div class="headtext2" style="width:90px;">'.$rt["inventory"].'</div>
<div class="headtext2" style="width:26px;"><img style="cursor:pointer" src="images/big_del.png" width="26" height="26" onClick="delParts(\''.$t["part"].'\',\''.$_REQUEST['id'].'\')"/></div>
</div>';
			
		}
		
		}
    
    
    echo'</div>-->
    
    
    <div style="margin-top:40px"></div>
    <input name="checkvals" id="checkvals" type="hidden" value="'.$ty["tie_prod"].'" />
    <div id="adprods" onclick="finprodEdit(\''.$_REQUEST['id'].'\')">Save</div>';	
	
}


///DELETE PRODUCTS//
if($act == 'remprod'){
mysql_query("UPDATE productservi SET active = 'false' WHERE items_ids = '".$_REQUEST['id']."'");
	
	
}


/////FIXED ASSETS////-----------------------------------------------------------------

if($act == 'pullproductsdus' ){
	
	if($_REQUEST['order'] == 'DESC'){
		$sorterImg = '<img src="images/desc_arr.png" width="9" height="9">';
		$dirs = 'DESC';
$click = 'onclick="pullProds(\''.$_REQUEST['page'].'\',\'ASC\')"';
	}else{
		$dirs = 'ASC';
	$click = 'onclick="pullProds(\''.$_REQUEST['page'].'\',\'DESC\')"';
		$sorterImg = '<img src="images/asc_arr.png" width="9" height="9">';
	}
	
	echo '<div class="infohead">
    <div class="headtext" style="width: 140px; border-right:solid thin #000; ">SKU #</div>
    <div class="headtext" style="width: 160px; border-right:solid thin #000; border-left: solid thin #CCC;">Item Name</div>
    <div class="headtext" style="width: 140px; border-right:solid thin #000; border-left:solid thin #CCC; cursor:pointer" '.$click.'>Item Type '.$sorterImg.'</div>
    <div class="headtext" style="width: 70px; border-right:solid thin #000; border-left:solid thin #CCC;">Cost</div>
   <!-- <div class="headtext" style="width: 70px; border-right:solid thin #000; border-left:solid thin #CCC;">Sale</div>-->
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Rental</div>
    <!--<div class="headtext" style="width: 75px; border-right:solid thin #000; border-left:solid thin #CCC;">Inventory</div>-->
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div></div>';
///////start page stuff/////
		
		$rowsPerPage = 15;
//$rowsPerPage2=12;
// by default we show first page


// if $_GET['page'] defined, use it as page number
if($_REQUEST['page']=='undefined' || $_REQUEST['page']==''){
$pageNum = 1;	
}else{$pageNum = $_REQUEST['page'];}

//if($_POST['page']!='')
//{
	//echo $_POST['page'];
	//$pageNum = $_POST['page'];
//}else{
//$pageNum = 1;	
//}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
//echo $offset;

if(isset($_REQUEST['search'])){
	$serc = $_REQUEST['searchval'];
	//echo 'set';
	$query  = "SELECT * FROM productservi WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND item_typ = 'asset' AND item_name LIKE '$serc%' OR active = 'true' AND saasid = '".$_SESSION['saasid']."' AND item_typ = 'asset' AND sku LIKE '$serc%'";
	
}else{
$query  = "SELECT * FROM productservi WHERE active = 'true' AND item_typ = 'asset' AND saasid = '".$_SESSION['saasid']."' ORDER BY item_typ $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Active Assets..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				$t = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$h["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
				
				if($h["item_typ"] == 'service'){
					$rental = 'Service';
					$cost = 'Service';
					$inventory = 'Service';
				}else{
					$rental = $h["rental"];
					$cost = $h["cost"];
					$inventory = $h["inventory"];
				}
				
				if($h["sku"] == ''){
				$sku = 	'Not Set ****';
				}else{
				$sku = 	$h["sku"];
				}
				
				if($h["item_typ"] == 'product'){
				$procs = 'Product';
				}
				
				if($h["item_typ"] == 'parts'){
				$procs = 'Part';
				}
				
				if($h["item_typ"] == 'service'){
				$procs = 'Service';
				}
				
				if(strlen($h["item_name"]) > 20){
					$itmName = substr($h["item_name"], 0, 15).'...';
				}else{
					$itmName = $h["item_name"];
				}
				
				if($h["item_typ"] == 'parts' || $h["item_typ"] == 'product' || $h["item_typ"] == 'asset'){
					$boneAction = 'edProd2d(\''.$h["items_ids"].'\')';
				}else{
					$boneAction = 'pullServiced(\''.$h["items_ids"].'\')';
				}
			
	echo '<div class="infoheadlines">
				
						<div class="headtext2" style="width: 140px;">'.$sku.'</div>
   							 <div class="headtext2" style="width: 170px;">'.$itmName.'</div>
   								 <div class="headtext2" style="width: 140px;">Asset</div>
                                 <div class="headtext2" style="width: 70px;">'.$cost.'</div>
                                 <!--<div class="headtext2" style="width: 70px;">'.$h["price"].'</div>-->
                                 <div class="headtext2" style="width: 95px;">'.$rental.'</div>
                                <!-- <div class="headtext2" style="width: 70px;">'.$inventory.'</div>-->
    					
   						 <div class="headtext2" style="width:95px; text-align:center">
                         
   					 <div class="edit_icon" title="Edit" style="margin-right:6px;margin-left: 20px;" onclick="'.$boneAction.'"></div>
    			<div class="delete_icon" title="Delete" onclick="delProd(\''.$h["items_ids"].'\')"></div>
   			 </div>
		</div>';	
			}
	}
 $query   = "SELECT COUNT(items_ids) AS numrows FROM productservi WHERE active='true' AND item_typ = 'asset' AND saasid = '".$_SESSION['saasid']."'";
$result  = mysql_query($query) or die(mysql_error());
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
///echo $numrows;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav = '';
for($page = 1; $page <= $maxPage; $page++)
{
	if ($page == $pageNum)
	{
		//$nav .= " $page ";   // no need to create a link to current page
		
		$nav .='<div class="pagact">'.$page.'</div>';
	}
	else
	{
		$nav .= '<div class="pagnull" onclick="pullProds(\''.$page.'\',\''.$dirs.'\')">'.$page.'</div>';
	}		
}

// creating previous and next link
// plus the link to go straight to
// the first and last page

if ($pageNum > 1)
{
	$page = $pageNum - 1;
	$prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
	
	//$first = " <a href=\"$self?page=1\">First</a> ";
} 
else
{
	$prev  = '&nbsp;'; // we're on page one, don't print previous link
	$first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
	$page = $pageNum + 1;
	$next = '<div class="pagnull" onclick="pullProds(\''.$page.'\',\''.$dirs.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="pullProds(\''.$maxPage.'\',\''.$dirs.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:30px">'.$first .  $next .$nav . $last.'</div>';
}


//////GET NEW PARTS////

if($act == 'getpartform'){
echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Part Name:<br><input style="width:250px" class="makerrs" name="item_name" id="item_name" type="text" value="">
    </div>
    <div style="width:120px; height:40px; float:left">
    Qty Available:<br><input style="width:90px" class="makerrs" name="inventory" id="inventory" type="text" value="">
    </div>
    </div>
    
    <div style="width:633px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    
    Vendor:<br><select class="makerrs" id="attc_vend" name="attc_vend"><option value="none" selected="selected">Select Vendor</option>';
	
	$t = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND is_vend = 'true'")or die(mysql_error());
		while($fgh = mysql_fetch_array($t)){
		echo '<option value="'.$fgh["glid"].'">'.$fgh["fld1"].'</option>';	
		}
	
	
    echo '</select></div>
    <div style="width:120px; height:40px; float:left">
    Cost:<br><input style="width:90px" class="makerrs" name="cost" id="cost" type="text" value="">
    </div>
    
    <div style="width:120px; height:40px; float:left">
    Sale Price:<br><input style="width:90px" class="makerrs" name="price" id="price" type="text" value="">
    </div>
    
    <div style="width:120px; height:40px; float:left">
    Rental Price:<br><input style="width:90px" class="makerrs" name="rent_price" id="rent_price" type="text" value="">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:120px; height:40px; float:left">
    
    Min Threshold:<br><input style="width:90px" class="makerrs" name="mins" id="mins" type="text" value="">
    </div>
    <div style="width:120px; height:40px; float:left">
    Max Threshold:<br><input style="width:90px" class="makerrs" name="maxs" id="maxs" type="text" value="">
    </div>
	</div>
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:300px; height:40px; float:left">
    SKU:<br><input style="width:250px" class="makerrs" name="sku" id="sku" type="text" value="">
    </div>
    
	</div>
	
	<div style="width:603px; height:95px; margin-bottom:10px">
    <div style="width:300px; height:89px; float:left">
    Part Description:<br><textarea style="width:434px; height:89px;" class="makerrs" name="proddesc" id="proddesc" cols="" rows=""></textarea>
    </div>
    
	</div>
	
	
 
    
    
    <div style="margin-top:30px; margin-bottom:30px; border-bottom:solid thin #ccc"></div>';
       
    
    echo'</div>
    <!--end product attachment-->
    
    <div style="margin-top:40px"></div>
    <input name="checkvals" id="checkvals" type="hidden" value="" />
    <div id="adprods" onclick="finpartAdd()">Save</div>';	
}


////INSERT PARTS INTO DB////
if($act == 'enterpart'){
$item_name = mysql_real_escape_string($_REQUEST['item_name']);
$inventory = mysql_real_escape_string($_REQUEST['inventory']);
$attc_vend = mysql_real_escape_string($_REQUEST['attc_vend']);
$cost = mysql_real_escape_string($_REQUEST['cost']);
$price = mysql_real_escape_string($_REQUEST['price']);
$rent_price = mysql_real_escape_string($_REQUEST['rent_price']);
$sku = mysql_real_escape_string($_REQUEST['sku']);
$proddesc = mysql_real_escape_string($_REQUEST['proddesc']);
$mins = mysql_real_escape_string($_REQUEST['mins']);
$maxs = mysql_real_escape_string($_REQUEST['maxs']);


///adjust inventory//

//$tags = explode(',', $checkvals);

//foreach($tags as $key) {
	
	//$a = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '$key'"));
	//$deduct = $a["inventory"] - 1;
	//mysql_query("UPDATE productservi SET inventory = '$deduct' WHERE  items_ids = '$key'");
	
//}




mysql_query("INSERT INTO productservi SET item_name = '$item_name',	sku = '$sku',	decs = '$proddesc',	status = 'In Stock',	inventory = '$inventory',	price = '$price',	cost = '$cost',	rental = '$rent_price',	vendor = '$attc_vend',	min = '$mins',	max = '$maxs',	active = 'true',	item_typ = 'parts',	saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
	
}




/////PULL AUDIT LIST///

if($act == 'pullaudit' ){
	
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];
	
	if($start == ''){
		$start = date("m/d/Y", strtotime("-1 day")).' - 7:00am';
	}else{
	$start = $_REQUEST['start'];	
	}
	
	if($end == ''){
		$end = date("m/d/Y - g:ia");
	}else{
	$end = $_REQUEST['end'];	
	}
	
///////start page stuff/////
		
		$rowsPerPage = 40;
//$rowsPerPage2=12;
// by default we show first page


// if $_GET['page'] defined, use it as page number
if($_REQUEST['page']=='undefined' || $_REQUEST['page']==''){
$pageNum = 1;	
}else{$pageNum = $_REQUEST['page'];}

//if($_POST['page']!='')
//{
	//echo $_POST['page'];
	//$pageNum = $_POST['page'];
//}else{
//$pageNum = 1;	
//}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
//echo $offset;

if(isset($_REQUEST['search'])){
	$serc = $_REQUEST['searchval'];
	//echo 'set';
	$query  = "SELECT customers.companyname, customers.cust_id, customers.zip, customers.state, customers.county, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.companyname LIKE '$serc%' AND customers.saasid = '".$_SESSION['saasid']."' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.zip LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.state LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.county LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.firstname LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND CONCAT(contacts.firstname, ' ', contacts.lastname)  LIKE '$serc%' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM access_monitor WHERE accessstart BETWEEN '$start' AND '$end' AND saasid = '".$_SESSION['saasid']."' ORDER BY accessstart DESC LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:20px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Activity for Selected Dates..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				$r = mysql_fetch_array(mysql_query("SELECT * FROM  core_users WHERE usr_id = '".$h["usrid"]."' AND saasid = '".$_SESSION['saasid']."'"));
				
			
	echo '<div class="infoheadlines">
<div class="headtext2" style="width: 205px;">'.$h["accessstart"].'</div>
<div class="headtext2" style="width: 130px;">'.$r["fname"].' '.$r["lname"].'</div>
<div class="headtext2" style="width: 200px;">'.$h["page_view"].'</div>
<div class="headtext2" style="width: 350px;">'.$h["action"].'</div>
</div>';	
			}
	}
 $query   = "SELECT COUNT(page_view) AS numrows FROM access_monitor WHERE accessstart BETWEEN '$start' AND '$end' AND saasid = '".$_SESSION['saasid']."'";
$result  = mysql_query($query) or die(mysql_error());
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
///echo $numrows;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav = '';
for($page = 1; $page <= $maxPage; $page++)
{
	if ($page == $pageNum)
	{
		//$nav .= " $page ";   // no need to create a link to current page
		
		$nav .='<div class="pagact">'.$page.'</div>';
	}
	else
	{
		$nav .= '<div class="pagnull" onclick="getAudit(\''.$page.'\')">'.$page.'</div>';
	}		
}

// creating previous and next link
// plus the link to go straight to
// the first and last page

if ($pageNum > 1)
{
	$page = $pageNum - 1;
	$prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
	
	//$first = " <a href=\"$self?page=1\">First</a> ";
} 
else
{
	$prev  = '&nbsp;'; // we're on page one, don't print previous link
	$first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
	$page = $pageNum + 1;
	$next = '<div class="pagnull" onclick="getAudit(\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getAudit(\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:30px">'.$first .  $next .$nav . $last.'</div>';
}


////NEW TAX///
if($act == 'addnewtax'){
	echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Tax Name:<br><input style="width:250px" class="makerrs" name="tax_name" id="tax_name" type="text" value="">
    </div>
    <div style="width:270px; height:40px; float:left">
    State:<br><select class="makerrs" name="state" id="state"> 
<option value="" selected="selected">Select a State</option> 
<option value="AL">Alabama</option> 
<option value="AK">Alaska</option> 
<option value="AZ">Arizona</option> 
<option value="AR">Arkansas</option> 
<option value="CA">California</option> 
<option value="CO">Colorado</option> 
<option value="CT">Connecticut</option> 
<option value="DE">Delaware</option> 
<option value="DC">District Of Columbia</option> 
<option value="FL">Florida</option> 
<option value="GA">Georgia</option> 
<option value="HI">Hawaii</option> 
<option value="ID">Idaho</option> 
<option value="IL">Illinois</option> 
<option value="IN">Indiana</option> 
<option value="IA">Iowa</option> 
<option value="KS">Kansas</option> 
<option value="KY">Kentucky</option> 
<option value="LA">Louisiana</option> 
<option value="ME">Maine</option> 
<option value="MD">Maryland</option> 
<option value="MA">Massachusetts</option> 
<option value="MI">Michigan</option> 
<option value="MN">Minnesota</option> 
<option value="MS">Mississippi</option> 
<option value="MO">Missouri</option> 
<option value="MT">Montana</option> 
<option value="NE">Nebraska</option> 
<option value="NV">Nevada</option> 
<option value="NH">New Hampshire</option> 
<option value="NJ">New Jersey</option> 
<option value="NM">New Mexico</option> 
<option value="NY">New York</option> 
<option value="NC">North Carolina</option> 
<option value="ND">North Dakota</option> 
<option value="OH">Ohio</option> 
<option value="OK">Oklahoma</option> 
<option value="OR">Oregon</option> 
<option value="PA">Pennsylvania</option> 
<option value="RI">Rhode Island</option> 
<option value="SC">South Carolina</option> 
<option value="SD">South Dakota</option> 
<option value="TN">Tennessee</option> 
<option value="TX">Texas</option> 
<option value="UT">Utah</option> 
<option value="VT">Vermont</option> 
<option value="VA">Virginia</option> 
<option value="WA">Washington</option> 
<option value="WV">West Virginia</option> 
<option value="WI">Wisconsin</option> 
<option value="WY">Wyoming</option>
</select>
    </div>
    </div>
	
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Tax Percent:<br><input style="width:250px" class="makerrs" name="percent" id="percent" type="text" value="">
    </div>
    <div style="width:270px; height:40px; float:left">
    County:<br><input style="width:250px" class="makerrs" name="county" id="county" type="text" value="">
    </div>
    </div>
	
	<div id="adtax" style="margin:35px;" onclick="addTax()">Add Tax</div>';
}

//settax
////ENTER TAX///
if($act == 'settax'){
$tax_name = mysql_real_escape_string($_REQUEST['tax_name']);
$state = mysql_real_escape_string($_REQUEST['state']);
$percent = mysql_real_escape_string($_REQUEST['percent']);
$county = mysql_real_escape_string($_REQUEST['county']);
mysql_query("INSERT INTO tax_table SET tax_name = '$tax_name', state = '$state', percent = '$percent',	county = '$county', active = 'true', saasid = '".$_SESSION['saasid']."'");
}

////////------------EDIT TAX--------------//////
////NEW TAX///
if($act == 'edittax'){
	
	$fg = mysql_fetch_array(mysql_query("SELECT * FROM tax_table WHERE tax_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));
	
	echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Tax Name:<br><input style="width:250px" class="makerrs" name="tax_name" id="tax_name" type="text" value="'.$fg["tax_name"].'">
    </div>
    <div style="width:270px; height:40px; float:left">
    State:<br><select class="makerrs" name="state" id="state"> 
<option value="'.$fg["state"].'" selected="selected">'.$fg["state"].'</option> 
<option value="AL">Alabama</option> 
<option value="AK">Alaska</option> 
<option value="AZ">Arizona</option> 
<option value="AR">Arkansas</option> 
<option value="CA">California</option> 
<option value="CO">Colorado</option> 
<option value="CT">Connecticut</option> 
<option value="DE">Delaware</option> 
<option value="DC">District Of Columbia</option> 
<option value="FL">Florida</option> 
<option value="GA">Georgia</option> 
<option value="HI">Hawaii</option> 
<option value="ID">Idaho</option> 
<option value="IL">Illinois</option> 
<option value="IN">Indiana</option> 
<option value="IA">Iowa</option> 
<option value="KS">Kansas</option> 
<option value="KY">Kentucky</option> 
<option value="LA">Louisiana</option> 
<option value="ME">Maine</option> 
<option value="MD">Maryland</option> 
<option value="MA">Massachusetts</option> 
<option value="MI">Michigan</option> 
<option value="MN">Minnesota</option> 
<option value="MS">Mississippi</option> 
<option value="MO">Missouri</option> 
<option value="MT">Montana</option> 
<option value="NE">Nebraska</option> 
<option value="NV">Nevada</option> 
<option value="NH">New Hampshire</option> 
<option value="NJ">New Jersey</option> 
<option value="NM">New Mexico</option> 
<option value="NY">New York</option> 
<option value="NC">North Carolina</option> 
<option value="ND">North Dakota</option> 
<option value="OH">Ohio</option> 
<option value="OK">Oklahoma</option> 
<option value="OR">Oregon</option> 
<option value="PA">Pennsylvania</option> 
<option value="RI">Rhode Island</option> 
<option value="SC">South Carolina</option> 
<option value="SD">South Dakota</option> 
<option value="TN">Tennessee</option> 
<option value="TX">Texas</option> 
<option value="UT">Utah</option> 
<option value="VT">Vermont</option> 
<option value="VA">Virginia</option> 
<option value="WA">Washington</option> 
<option value="WV">West Virginia</option> 
<option value="WI">Wisconsin</option> 
<option value="WY">Wyoming</option>
</select>
    </div>
    </div>
	
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Tax Percent:<br><input style="width:250px" class="makerrs" name="percent" id="percent" type="text" value="'.$fg["percent"].'">
    </div>
    <div style="width:270px; height:40px; float:left">
    County:<br><input style="width:250px" class="makerrs" name="county" id="county" type="text" value="'.$fg["county"].'">
    </div>
    </div>
	
	<div id="adtax" style="margin:35px;" onclick="finEdTax(\''.$_REQUEST['id'].'\')">Edit Tax</div>';
}


///EDITS TAX////
if($act == 'editdtax'){
$tax_name = mysql_real_escape_string($_REQUEST['tax_name']);
$state = mysql_real_escape_string($_REQUEST['state']);
$percent = mysql_real_escape_string($_REQUEST['percent']);
$county = mysql_real_escape_string($_REQUEST['county']);
mysql_query("UPDATE tax_table SET tax_name = '$tax_name', state = '$state', percent = '$percent',	county = '$county' WHERE tax_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
}

////RECALL TAX LIST////
if($act == 'gettax'){
	$r = mysql_query("SELECT * FROM tax_table WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."'");

while($b = mysql_fetch_array($r)){
	

echo '<div class="infoheadlines">
				
						<div class="headtext2" style="width: 210px;">'.$b["tax_name"].'</div>
   							 <div class="headtext2" style="width: 220px;">'.$b["state"].'</div>
   								 <div class="headtext2" style="width: 228px;">'.$b["county"].'</div>
                                 <div class="headtext2" style="width: 122px;">'.$b["percent"].'</div>
    					
   						 <div class="headtext2" style="width:95px; text-align:center">
                         
   					 <div class="edit_icon" title="Edit" style="margin-right:6px;margin-left: 20px;" onclick="editsTax(\''.$b["tax_id"].'\')"></div>
    			<div class="delete_icon" title="Delete" onclick="delTax(\''.$b["tax_id"].'\')"></div>
   			 </div>
		</div>';
}
}


////DELETE TAX///
if($act == 'deltax'){
	mysql_query("UPDATE tax_table SET active = 'false' WHERE tax_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
}


/////ADD TERMS////

if($act == 'addterms'){
	echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Term %:<br><input style="width:250px" class="makerrs" name="precent" id="precent" type="text" value="">
    </div>
    <div style="width:270px; height:40px; float:left">
    Days:<br><input style="width:250px" class="makerrs" name="days" id="days" type="text" value="">
    </div>
    </div>
	
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Net:<br><input style="width:250px" class="makerrs" name="net" id="net" type="text" value="">
    </div>
    <div style="width:270px; height:40px; float:left">
    <!--County:<br><input style="width:250px" class="makerrs" name="county" id="county" type="text" value="">-->
    </div>
    </div>
	
	<div id="adtermmy" style="margin:35px;" onclick="addTermfin()">Add Term</div>';
}

//setterms&precent='+precent+'&days='+days+'&net
if($act == 'setterms'){
	$precent = mysql_real_escape_string($_REQUEST['precent']);
	$days = mysql_real_escape_string($_REQUEST['days']);
	$net = mysql_real_escape_string($_REQUEST['net']);
	
	mysql_query("INSERT INTO ven_terms SET percent = '$precent', days = '$days', net = '$net', active = 'true', saasid = '".$_SESSION['saasid']."'");
	
}

if($act == 'getterms'){
	$rt = mysql_query("SELECT * FROM ven_terms WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."'");
		while($t = mysql_fetch_array($rt)){
			
			echo '<div class="infoheadlines">
<div class="headtext2" style="width: 100px;">'.$t["percent"].'%</div>
<div class="headtext2" style="width: 130px;">'.$t["days"].'</div>
<div class="headtext2" style="width: 470px;">'.$t["net"].'</div>
<div class="headtext" style="width: 200px;"><div class="edit_icon" title="Edit" style="margin-right:6px;margin-left: 20px;" onclick="editTerm(\''.$t["term_id"].'\')"></div>
    <div class="delete_icon" title="Delete" onclick="delTerm(\''.$t["term_id"].'\')"></div></div>
</div>';
			
		}
	
}


///EDIT FUNCTION//
if($act == 'editterms'){
	
	$r = mysql_fetch_array(mysql_query("SELECT * FROM ven_terms WHERE term_id = '".$_REQUEST['id']."' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'"));
	
	echo '<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Term %:<br><input style="width:250px" class="makerrs" name="precent" id="precent" type="text" value="'.$r["percent"].'">
    </div>
    <div style="width:270px; height:40px; float:left">
    Days:<br><input style="width:250px" class="makerrs" name="days" id="days" type="text" value="'.$r["days"].'">
    </div>
    </div>
	
	
	<div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:270px; height:40px; float:left">
    Net:<br><input style="width:250px" class="makerrs" name="net" id="net" type="text" value="'.$r["net"].'">
    </div>
    <div style="width:270px; height:40px; float:left">
    <!--County:<br><input style="width:250px" class="makerrs" name="county" id="county" type="text" value="">-->
    </div>
    </div>
	
	<div id="adtermmy" style="margin:35px;" onclick="editTermfin(\''.$_REQUEST['id'].'\')">Edit Term</div>';
}

if($act == 'edittermss'){
	$precent = mysql_real_escape_string($_REQUEST['precent']);
	$days = mysql_real_escape_string($_REQUEST['days']);
	$net = mysql_real_escape_string($_REQUEST['net']);
	
	mysql_query("UPDATE ven_terms SET percent = '$precent', days = '$days', net = '$net' WHERE term_id = '".$_REQUEST['id']."' AND  saasid = '".$_SESSION['saasid']."'");
	
}

if($act == 'delterm'){
	mysql_query("UPDATE ven_terms SET active = 'false' WHERE term_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
}


/////getworksfor&tech

if($act == 'getworksfor'){
	$a = mysql_query("SELECT * FROM core_docs WHERE assignedtech = '".$_REQUEST['tech']."' AND saasid = '".$_SESSION['saasid']."'");
	
	$gh = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_REQUEST['tech']."' AND saasid = '".$_SESSION['saasid']."'"));
	
	echo '<div style="padding:5px;"><strong>Workorders for: '.$gh["fname"].' '.$gh["lname"].'</strong></div>';
	
	
	echo '<div style="width:100%; height:25px; background-color:#FFF;">
<div style="width:100px; float:left; height:25px; padding-left:4px">WO#</div>
<div style="width:100px; float:left; height:25px;">Date</div>
<div style="width:100px; float:left; height:25px;">Duration</div>
<div style="width:140px; float:left; height:25px;">Status</div>
<div style="width:100px; float:left; height:25px;">Price</div>
</div>';
$t=0;
	while($b=mysql_fetch_array($a)){
		
		if($t==0){
			$t=1;
			$col = '#FFF';
		}else{
		$t=0;
			$col = '#EEE';	
		}
		
		if($b["doc_type"] == 'workorder'){
			$link = 'work_order.php?id='.$b["doc_id"].'';
		}
		
		if($b["doc_type"] == 'invoice'){
			$link = 'invoice.php?id='.$b["doc_id"].'';
		}
		
		echo '<div style="width:100%; height:25px; background-color:'.$col.';">
<div style="width:100px; float:left; height:25px; padding-left:4px"><a href="'.$link.'">'.$b["doc_id"].'</a></div>
<div style="width:100px; float:left; height:25px;">'.$b["servicedate"].'</div>
<div style="width:100px; float:left; height:25px;">'.$b["duration"].'hr(s)</div>
<div style="width:140px; float:left; height:25px;">'.$b["status"].'</div>
<div style="width:100px; float:left; height:25px;">$'.$b["estprice"].'</div>
</div>';
	}
	
}

?>