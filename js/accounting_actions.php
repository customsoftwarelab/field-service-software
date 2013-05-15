<?php
error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];

////GET LEDGER TYPE DROP DOWN////

if($act == 'gettypes'){
echo '<div style="padding:20px; background-color:#F0F0F0">
    Select Entry Type:<br>
    <select class="makerrs" name="ledgertype" id="ledgertype" onChange="runLedgtype(this.value)">
    <option value="none">Select Type...</option>
    <option value="expense">Expense</option>
    <option value="bankinfo">Bank Account</option>
    </select>
    </div>';	
}


/////Add Expense/////
if($act == 'addexpense'){
	echo '<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Name:<br><input class="makerrs" text" name="name" id="name" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Sub Account:<br>
    
    <select class="makerrs" name="subacct" id="subacct">
    <option value="none">Select sub account if needed...</option>';
     
	 $br = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'expense' AND active = 'true' AND subacct = 'none' AND saasid = '".$_SESSION['saasid']."'");
	 	while($r = mysql_fetch_array($br)){
		echo '<option value="'.$r["glid"].'">'.$r["fld1"].'</option>';	
		}
	
    echo '</select>
    
    </div>
    </div>
    
    <!--<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Date:<br>
    <input style="float:left" class="makerrs text" name="setdate" id="setdate" type="text" value="'.date('m/d/Y').'">
    </div>
    
     <div style="width:300px; height:40px; float:left">Amount of expense:<br>
       <input class="makerrs text" name="amount" id="amount" type="text" />
     </div>
    </div>-->
	
	<div id="adbutton" onClick="subEntry(\'expense\')">Add Expense GL</div>
';
}

///EDIT EXPENSE////
if($act == 'editxpense'){
	$rt = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));
	echo '<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Name:<br><input class="makerrs" text" name="name" id="name" type="text" value="'.$rt["fld1"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Sub Account:<br>
    
    <select class="makerrs" name="subacct" id="subacct" disabled="disabled">
    <option value="none">Select sub account if needed...</option>';
     
	 $br = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'expense' AND active = 'true' AND subacct = 'none' AND saasid = '".$_SESSION['saasid']."'");
	 	while($r = mysql_fetch_array($br)){
			if($rt["glid"] == $r["glid"]){
		echo '<option value="'.$r["glid"].'" selected="selected">'.$r["fld1"].'</option>';
			}else{
				echo '<option value="'.$r["glid"].'">'.$r["fld1"].'</option>';
			}
		}
	
    echo '</select>
    
    </div>
    </div>
    
    <!--<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Date:<br>
    <input style="float:left" class="makerrs text" name="setdate" id="setdate" type="text" value="'.date('m/d/Y').'">
    </div>
    
     <div style="width:300px; height:40px; float:left">Amount of expense:<br>
       <input class="makerrs text" name="amount" id="amount" type="text" />
     </div>
    </div>-->
	
	<div id="adbutton" onClick="finExedit(\''.$_REQUEST['id'].'\')">Edit Expense GL</div>
';
}


/////COMPLETE EDIT OF EXPENSE///
///updatreexp&name
if($act == 'updatreexp'){
	mysql_query("UPDATE ledger_tabs SET fld1 = '".mysql_real_escape_string($_REQUEST['name'])."' WHERE glid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
	
}

//subexpense&name='+name+'&subacct='+subacct+'&setdate='+setdate+'&amount
if($act == 'subexpense'){
	$name = mysql_real_escape_string($_REQUEST['name']);
	$subacct = mysql_real_escape_string($_REQUEST['subacct']);
	$setdate = mysql_real_escape_string($_REQUEST['setdate']);
	$amount = mysql_real_escape_string($_REQUEST['amount']);
	
	mysql_query("INSERT INTO ledger_tabs SET fld1 = '$name', subacct = '$subacct', fld3 ='$setdate', fld4 ='$amount', type = 'expense', saasid = '".$_SESSION['saasid']."', active = 'true'")or die(mysql_error());
}

////GET EXPENCES////
if($act == 'getexpense'){

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
	$query  = "SELECT * FROM ledger_tabs WHERE type = 'expense' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct = 'none' AND fld1 LIKE '$serc%' ORDER BY fld1 $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM ledger_tabs WHERE type = 'expense' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct = 'none' ORDER BY fld1 $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				
				$totSet2 = 0;
				$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND subacct != 'none' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		$flg = $tm["fld4"] * 1;
		
		$totSet2 += $tm["fld4"];
	}
	
	
	
	$mainBal = number_format($totSet2 + $h["fld4"],2);
	
	if($h["is_vend"] != 'true'){$ed = '<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="edExpe(\''.$h["glid"].'\')"></div>'; $delsa = '<div class="delete_icon" title="Delete" onclick="delExpe(\''.$h["glid"].'\')"></div>';}else{$ed = ''; $delsa = '';}
				
			
	echo '<div class="infoheadlines">
<div class="headtext2" style="width: 110px;">'.$h["glid"].'</div>
<div class="headtext2" style="width: 443px;">'.$h["fld1"].'</div>
<div class="headtext2" style="width: 130px;"></div>
<div class="headtext2" style="width: 85px; text-align: center;">
<div id="ico'.$h["glid"].'" class="epand_icon" title="expand/contract" onclick="expandFun(\''.$h["glid"].'\')"></div>
'.$ed.' '.$delsa.'
</div></div><div id="lines'.$h["glid"].'" style="padding:10px; display:none; border-left:solid thin #CCC; border-right:solid thin #CCC; border-bottom:solid thin #CCC;">';

if($h["fld1"] != 'Vendors'){

$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["fld1"].'</div>
		<div style="width:126px; height:22px; float:left"></div>
		<div style="width:126px; height:22px; float:left"><a href="javascript:opnRuls(\''.$tm["glid"].'\')">View Details</a></div>
		</div>';
			
	}
}else{
	$yu = mysql_query("SELECT * FROM vendors WHERE saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["ven_name"].'</div>
		<div style="width:126px; height:22px; float:left"></div>
		<div style="width:126px; height:22px; float:left"><a href="javascript:opnRuls2(\''.$tm["ven_id"].'\')">View Details</a></div>
		</div>';
			
	}
}




echo '</div>';
			}
	}
 $query   = "SELECT COUNT(fld1) AS numrows FROM ledger_tabs WHERE type = 'expense' AND active='true' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getLines(\'expense\',\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';



}


/////Add Expense/////
if($act == 'addloan'){
	echo '<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Name:<br><input class="makerrs" text" name="name" id="name" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Sub Account:<br>
    
    <select class="makerrs" name="subacctloan" id="subacctloan">
    <option value="none">Select sub account if needed...</option>';
     
	 $br = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'loan' AND active = 'true' AND subacct = 'none' AND saasid = '".$_SESSION['saasid']."'");
	 	while($r = mysql_fetch_array($br)){
		echo '<option value="'.$r["glid"].'">'.$r["fld1"].'</option>';	
		}
	
    echo '</select>
    
    </div>
    </div>
    
<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Date:<br>
    <input style="float:left" class="makerrs text" name="setdate" id="setdate" type="text" value="'.date('m/d/Y').'">
    </div>
    
     <div style="width:300px; height:40px; float:left">Terms(months):<br>
       <input class="makerrs text" name="terms" id="terms" type="text" />
     </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Opening Balance:<br>
    <input style="float:left" class="makerrs text" name="balance" id="balance" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">Account #:<br>
       <input class="makerrs text" name="acctnum" id="acctnum" type="text" />
     </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Intrest Rate:<br>
    <input style="float:left" class="makerrs text" name="intrest" id="intrest" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left"></div>
    </div>
	
	<div id="adbutton" onClick="subEntry(\'loan\')">Add Loan</div>
';
}

///SUBMIT LOAN////

if($act == 'subloan'){
	$name = mysql_real_escape_string($_REQUEST['name']);
	$subacctloan = mysql_real_escape_string($_REQUEST['subacctloan']);
	$setdate = mysql_real_escape_string($_REQUEST['setdate']);
	$terms = mysql_real_escape_string($_REQUEST['terms']);
	$balance = mysql_real_escape_string($_REQUEST['balance']);
	$acctnum = mysql_real_escape_string($_REQUEST['acctnum']);
	$intrest = mysql_real_escape_string($_REQUEST['intrest']);
	
	mysql_query("INSERT INTO ledger_tabs SET fld1 = '$name', fld2 = '$terms', addressset = '$acctnum', fld5 = '$intrest', subacct = '$subacctloan', fld3 ='$setdate', fld4 ='$balance', type = 'loan', saasid = '".$_SESSION['saasid']."', active = 'true'")or die(mysql_error());
}


////GET LOANS////
if($act == 'getloans'){

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
	$query  = "SELECT customers.companyname, customers.cust_id, customers.zip, customers.state, customers.county, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.companyname LIKE '$serc%' AND customers.saasid = '".$_SESSION['saasid']."' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.zip LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.state LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.county LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.firstname LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND CONCAT(contacts.firstname, ' ', contacts.lastname)  LIKE '$serc%' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM ledger_tabs WHERE type = 'loan' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct = 'none' ORDER BY fld1 $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				
				$totSet2 = 0;
				$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND subacct != 'none' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		$flg = $tm["fld4"] * 1;
		
		$totSet2 += $tm["fld4"];
	}
	
	
	
	$mainBal = $totSet2 + $h["fld4"];
	
	$hl2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$h["glid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");
	$bounce2 = 0;
		while($tbone2 = mysql_fetch_array($hl2)){
			$bounce2 += $tbone2["payment"];
			
		}
	//echo $h["glid"];
		
				$outTot = number_format($mainBal - $bounce2,2);
				
			
	echo '<div class="infoheadlines">
<div class="headtext2" style="width: 110px;">'.$h["glid"].'</div>
<div class="headtext2" style="width: 443px;">'.$h["fld1"].'</div>
<div class="headtext2" style="width: 130px;">$'.$outTot.'</div>
<div class="headtext2" style="width: 85px; text-align: center;">
<div id="ico'.$h["glid"].'" class="epand_icon" title="expand/contract" onclick="expandFun(\''.$h["glid"].'\')"></div>
<!--<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="edGrp(\''.$h["glid"].'\')"></div>
<div class="delete_icon" title="Delete" onclick="delGrp(\''.$h["glid"].'\')"></div>-->
</div></div><div id="lines'.$h["glid"].'" style="padding:10px; display:none; border-left:solid thin #CCC; border-right:solid thin #CCC; border-bottom:solid thin #CCC;">';

$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width:134px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["fld1"].'</div>
		<div style="width:126px; height:22px; float:left">$'.$tm["fld4"].'</div>
		</div>';
			
	}




echo '</div>';
			}
	}
 $query   = "SELECT COUNT(fld1) AS numrows FROM ledger_tabs WHERE type = 'expense' AND active='true' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'loans\',\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="getLines(\'loans\',\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getLines(\'loans\',\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';



}



////GET ACCOUNTS RECEIVABLE////
if($act == 'getarlist'){

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
	$query  = "SELECT * FROM core_docs WHERE doc_type = 'invoice' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND status = 'won' AND company_name LIKE '$serc%' ORDER BY doc_id $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM core_docs WHERE doc_type = 'invoice' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND status = 'won' ORDER BY doc_id $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No A/R in system..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				
				$value = str_replace(',','',$h["value"]);
							
							$rto = mysql_query("SELECT * FROM invoice_payments WHERE inv_num = '".$h["doc_id"]."' AND saasid = '".$_SESSION['saasid']."'");
		$ars = 0;
			while($f=mysql_fetch_array($rto)){
				
				$ars += $f["amount"];
				
			}
		
		$deduct = $value-$ars;
		
		$rty=mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$h["company_id"]."'"));
	
	
				if($deduct > .01){
			
	echo '<div class="infoheadlines">
<div class="headtext2" style="width: 110px;">'.$h["doc_id"].'</div>
<div class="headtext2" style="width: 443px;">'.$rty["companyname"].'</div>
<div class="headtext2" style="width: 130px;">$'.$deduct.'</div>
<div class="headtext2" style="width: 85px; text-align: center;">
<!--<div id="ico'.$h["glid"].'" class="epand_icon" title="expand/contract" onclick="expandFun(\''.$h["glid"].'\')"></div>
<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="edGrp(\''.$h["glid"].'\')"></div>
<div class="delete_icon" title="Delete" onclick="delGrp(\''.$h["glid"].'\')"></div>-->
<a href="invoice.php?id='.$h["doc_id"].'">View Invoice</a>
</div></div><div id="lines'.$h["glid"].'" style="padding:10px; display:none; border-left:solid thin #CCC; border-right:solid thin #CCC; border-bottom:solid thin #CCC;">';

if($h["fld1"] != 'Vendors'){

$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["fld1"].'</div>
		<div style="width:126px; height:22px; float:left"></div>
		<div style="width:126px; height:22px; float:left"><a href="javascript:opnRuls(\''.$tm["glid"].'\')">View Details</a></div>
		</div>';
			
	}
}else{
	$yu = mysql_query("SELECT * FROM vendors WHERE saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["ven_name"].'</div>
		<div style="width:126px; height:22px; float:left"></div>
		<div style="width:126px; height:22px; float:left"><a href="javascript:opnRuls2(\''.$tm["ven_id"].'\')">View Details</a></div>
		</div>';
			
	}
}




echo '</div>';
			}
	}
	}
 $query   = "SELECT COUNT(doc_id) AS numrows FROM core_docs WHERE doc_type = 'invoice' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND status = 'won'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="getLines(\'arseve\',\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getLines(\'arseve\',\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';



}

/////GET INCOME LIST///
if($act == 'getincomelist'){

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
	$query  = "SELECT customers.companyname, customers.cust_id, customers.zip, customers.state, customers.county, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.companyname LIKE '$serc%' AND customers.saasid = '".$_SESSION['saasid']."' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.zip LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.state LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.county LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.firstname LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND CONCAT(contacts.firstname, ' ', contacts.lastname)  LIKE '$serc%' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM invoice_payments WHERE  saasid = '".$_SESSION['saasid']."' ORDER BY pay_id $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				$rty1=mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$h["inv_num"]."'"));
		
		$rty=mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$rty1["company_id"]."'"));
	
	
				
			
	echo '<div class="infoheadlines">
<div class="headtext2" style="width: 110px;">'.$h["inv_num"].'</div>
<div class="headtext2" style="width: 443px;">'.$rty["companyname"].'</div>
<div class="headtext2" style="width: 130px;">$'.$h["amount"].'</div>
<div class="headtext2" style="width: 85px; text-align: center;">
<!--<div id="ico'.$h["glid"].'" class="epand_icon" title="expand/contract" onclick="expandFun(\''.$h["glid"].'\')"></div>
<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="edGrp(\''.$h["glid"].'\')"></div>
<div class="delete_icon" title="Delete" onclick="delGrp(\''.$h["glid"].'\')"></div>-->
<a href="invoice.php?id='.$h["inv_num"].'">View Invoice</a>
</div></div><div id="lines'.$h["glid"].'" style="padding:10px; display:none; border-left:solid thin #CCC; border-right:solid thin #CCC; border-bottom:solid thin #CCC;">';

if($h["fld1"] != 'Vendors'){

$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["fld1"].'</div>
		<div style="width:126px; height:22px; float:left"></div>
		<div style="width:126px; height:22px; float:left"><a href="javascript:opnRuls(\''.$tm["glid"].'\')">View Details</a></div>
		</div>';
			
	}
}else{
	$yu = mysql_query("SELECT * FROM vendors WHERE saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["ven_name"].'</div>
		<div style="width:126px; height:22px; float:left"></div>
		<div style="width:126px; height:22px; float:left"><a href="javascript:opnRuls2(\''.$tm["ven_id"].'\')">View Details</a></div>
		</div>';
			
	}
}




echo '</div>';
			}
	}
	
 $query   = "SELECT COUNT(pay_id) AS numrows FROM invoice_payments WHERE saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'income\',\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="getLines(\'income\',\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getLines(\'income\',\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';



}



/////ADD BANK ACCOUNT/////

if($act == 'bankaccnt'){
echo '<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Name:<br>
    <input style="float:left" class="makerrs text" name="bankname" id="bankname" type="text">
    </div> 
	<div style="width:300px; height:40px; float:left">
   <!-- Sub Account:<br>
    
    <select class="makerrs" name="subacct" id="subacct">
    <option value="none">Select sub account if needed...</option>';
     
	 $br = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'bankacct' AND active = 'true' AND subacct = 'none' AND saasid = '".$_SESSION['saasid']."'");
	 	while($r = mysql_fetch_array($br)){
		echo '<option value="'.$r["glid"].'">'.$r["fld1"].'</option>';	
		}
	
    echo '</select>-->
    
    </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Phone:<br>
    <input style="float:left" class="makerrs text" name="phone" id="phone" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Address:<br>
    <input style="float:left" class="makerrs" name="address" id="address" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Address2:<br>
    <input style="float:left" class="makerrs text" name="adrress2" id="adrress2" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:200px; height:40px; float:left">
    State:<br>
    <select class="makerrs" name="state" id="state">
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
    
     <div style="width:200px; height:40px; float:left">
	 City:<br>
       <input style="float:left; width:176px;" class="makerrs text" name="city" id="city" type="text" value="">
     </div>
	 
	 <div style="width:200px; height:40px; float:left">
	 Zip:<br>
       <input style="float:left; width:84px;" class="makerrs text" name="zip" id="zip" type="text" value="">
     </div>
    </div>
	
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Bank Account#:<br>
    <input style="float:left" class="makerrs text" name="banknum" id="banknum" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Routing#:<br>
    <input style="float:left" class="makerrs text" name="routnum" id="routnum" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Starting Check#:<br>
    <input style="float:left" class="makerrs text" name="checknumstr" id="checknumstr" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	
	
 
	
	<div id="adbutton" onClick="subEntry(\'bankacct\')">Add Bank Account</div>';	
}

if($act == 'subbank'){
$bankname = mysql_real_escape_string($_REQUEST['bankname']);
$phone = mysql_real_escape_string($_REQUEST['phone']);
$address = mysql_real_escape_string($_REQUEST['address']);
$adrress2 = mysql_real_escape_string($_REQUEST['adrress2']);
$state = mysql_real_escape_string($_REQUEST['state']);
$city = mysql_real_escape_string($_REQUEST['city']);
$zip = mysql_real_escape_string($_REQUEST['zip']);
$banknum = mysql_real_escape_string($_REQUEST['banknum']);
$routnum = mysql_real_escape_string($_REQUEST['routnum']);
$checknumstr = mysql_real_escape_string($_REQUEST['checknumstr']);	

mysql_query("INSERT INTO ledger_tabs SET fld1 = '$bankname', subacct = 'none', fld3 ='$phone', addressset ='$address', fld5 ='$adrress2', fld6 = '$state', fld7='$city', fld8='$zip', fld9='$banknum', fld10='$routnum', fld11='$checknumstr', type = 'bank', saasid = '".$_SESSION['saasid']."', active = 'true'")or die(mysql_error());
}

if($act == 'editsubbank'){
$bankname = mysql_real_escape_string($_REQUEST['bankname']);
$phone = mysql_real_escape_string($_REQUEST['phone']);
$address = mysql_real_escape_string($_REQUEST['address']);
$adrress2 = mysql_real_escape_string($_REQUEST['adrress2']);
$state = mysql_real_escape_string($_REQUEST['state']);
$city = mysql_real_escape_string($_REQUEST['city']);
$zip = mysql_real_escape_string($_REQUEST['zip']);
$banknum = mysql_real_escape_string($_REQUEST['banknum']);
$routnum = mysql_real_escape_string($_REQUEST['routnum']);
$checknumstr = mysql_real_escape_string($_REQUEST['checknumstr']);	

mysql_query("UPDATE ledger_tabs SET fld1 = '$bankname', subacct = 'none', fld3 ='$phone', addressset ='$address', fld5 ='$adrress2', fld6 = '$state', fld7='$city', fld8='$zip', fld9='$banknum', fld10='$routnum', fld11='$checknumstr', type = 'bank' WHERE saasid = '".$_SESSION['saasid']."' AND glid = '".$_REQUEST['id']."'")or die(mysql_error());
}


/////EDIT BANK ACCOUNT/////

if($act == 'bankaccntedit'){
	
	$rtb = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));
	
echo '<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Name:<br>
    <input style="float:left" class="makerrs text" name="bankname" id="bankname" type="text" value="'.$rtb["fld1"].'">
    </div> 
	<div style="width:300px; height:40px; float:left">
   <!-- Sub Account:<br>
    
    <select class="makerrs" name="subacct" id="subacct">
    <option value="none">Select sub account if needed...</option>';
     
	 $br = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'bankacct' AND active = 'true' AND subacct = 'none' AND saasid = '".$_SESSION['saasid']."'");
	 	while($r = mysql_fetch_array($br)){
		echo '<option value="'.$r["glid"].'">'.$r["fld1"].'</option>';	
		}
	
    echo '</select>-->
    
    </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Phone:<br>
    <input style="float:left" class="makerrs text" name="phone" id="phone" type="text" value="'.$rtb["fld9"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Address:<br>
    <input style="float:left" class="makerrs" name="address" id="address" type="text" value="'.$rtb["addressset"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Address2:<br>
    <input style="float:left" class="makerrs text" name="adrress2" id="adrress2" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:200px; height:40px; float:left">
    State:<br>
    <select class="makerrs" name="state" id="state">
	<option value="'.$rtb["fld6"].'">'.$rtb["fld6"].'</option>
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
    
     <div style="width:200px; height:40px; float:left">
	 City:<br>
       <input style="float:left; width:176px;" class="makerrs text" name="city" id="city" type="text" value="'.$rtb["fld7"].'">
     </div>
	 
	 <div style="width:200px; height:40px; float:left">
	 Zip:<br>
       <input style="float:left; width:84px;" class="makerrs text" name="zip" id="zip" type="text" value="'.$rtb["fld8"].'">
     </div>
    </div>
	
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Bank Account#:<br>
    <input style="float:left" class="makerrs text" name="banknum" id="banknum" type="text" value="'.$rtb["fld9"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Routing#:<br>
    <input style="float:left" class="makerrs text" name="routnum" id="routnum" type="text" value="'.$rtb["fld10"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:15px">
    <div style="width:300px; height:40px; float:left">
    Starting Check#:<br>
    <input style="float:left" class="makerrs text" name="checknumstr" id="checknumstr" type="text" value="'.$rtb["fld11"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
       
     </div>
    </div>
	
	
	
 
	
	<div id="adbutton" onClick="subeditEntry(\''.$_REQUEST['id'].'\')">Edit Bank Account</div>';	
}



if($act == 'getbank'){

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
	$query  = "SELECT * FROM ledger_tabs WHERE type = 'bank' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct = 'none' AND fld1 LIKE '$serc%' ORDER BY fld1 $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM ledger_tabs WHERE type = 'bank' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct = 'none' ORDER BY fld1 $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				
				$totSet2 = 0;
				$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND subacct != 'none' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		$flg = $tm["fld4"] * 1;
		
		$totSet2 += $tm["fld4"]; $totSet2 = 0;
	}
	
	
	
	$mainBal = $totSet2 + $h["fld4"];
	
	$hl = mysql_query("SELECT * FROM invoice_payments WHERE bankset = '".$h["glid"]."' AND saasid = '".$_SESSION['saasid']."'");
	$bounce = 0;
		while($tbone = mysql_fetch_array($hl)){
			$bounce += $tbone["amount"];
			
		}
		
		$hl2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$h["glid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");
	$bounce2 = 0;
		while($tbone2 = mysql_fetch_array($hl2)){
			$bounce2 += $tbone2["deposit"];
			
		}
		
		$hl3 = mysql_query("SELECT * FROM transandpays WHERE paidby = '".$h["glid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");
	$bounce3 = 0;
		while($tbone3 = mysql_fetch_array($hl3)){
			$bounce3 += $tbone3["payment"];
			
		}
		
				$outTot = number_format($bounce + $bounce2 - $bounce3,2);
				
				$stipOut = str_replace(',','',$outTot);
				
			
	echo '<div class="infoheadlines">
<div class="headtext2" style="width: 110px;">'.$h["glid"].'</div>
<div class="headtext2" style="width: 443px;">'.$h["fld1"].'</div>
<div class="headtext2" style="width: 130px;">$'.$outTot.'</div>
<div class="headtext2" style="width: 85px; text-align: center;">
<!--<div id="ico'.$h["glid"].'" class="epand_icon" title="expand/contract" onclick="expandFun(\''.$h["glid"].'\')"></div>-->
<div class="view_on" title="View Details" onclick="opnbankRuls(\''.$h["glid"].'\')"></div>
<!--<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="edGrp(\''.$h["glid"].'\')"></div>
<div class="delete_icon" title="Delete" onclick="delGrp(\''.$h["glid"].'\')"></div>-->
</div></div><div id="lines'.$h["glid"].'" style="padding:10px; display:none; border-left:solid thin #CCC; border-right:solid thin #CCC; border-bottom:solid thin #CCC;">';

$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["fld1"].'</div>
		<div style="width:126px; height:22px; float:left">$'.$tm["fld4"].'</div>
		</div>';
			
	}




echo '</div>';
			}
	}
 $query   = "SELECT COUNT(fld1) AS numrows FROM ledger_tabs WHERE type = 'expense' AND active='true' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="getLines(\'bank\',\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getLines(\'bank\',\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';



}


////Add BANK INFO///
if($act == 'enterbankinfo'){
echo '
     <div class="infohead">
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Date</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC; ">Num/Type</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Name</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Memo</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">GL Account</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Payment</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Deposit</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Balance</div>
</div>

<div class="infoheadlines">
<div class="headtext2" style="width: 90px;"><input class="smlfnt" style="width:80px" name="bndate" id="bndate" type="text" value="'.date('m/d/Y').'"></div>
<div class="headtext2" style="width: 90px;"><input class="smlfnt" style="width:80px" name="bnnum" id="bnnum" type="text"></div>
<div class="headtext2" style="width: 120px;"><input class="smlfnt" style="width:110px" name="bnname" id="bnname" type="text"></div>
<div class="headtext2" style="width: 130px;"><input class="smlfnt" style="width:110px" name="bnmemo" id="bnmemo" type="text"></div>
<div class="headtext2" style="width: 120px;"><select class="smlfnt" style="width:110px" name="bngl" id="bngl" onChange="wazChng(this.value)"><option value="none">Select GL...</option>
<option value="none" disabled="disabled">-------EXPENSES--------</option>';
$y = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND type = 'expense' AND saasid = '".$_SESSION['saasid']."' ORDER BY fld1 ASC");
if(mysql_num_rows($y) > 0){
while($g = mysql_fetch_array($y)){
echo '<option value="'.$g["glid"].','.$g["type"].'">'.$g["fld1"].'</option>';	

}
}else{
echo '<option value="none">NO ENTRYS</option>';	
}

echo '<option value="none" disabled="disabled">-------LOANS--------</option>';
$y = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND type = 'loans' AND saasid = '".$_SESSION['saasid']."' ORDER BY fld1 ASC");
while($g = mysql_fetch_array($y)){
echo '<option value="'.$g["glid"].','.$g["type"].'">'.$g["fld1"].'</option>';	
}

echo '<option value="none" disabled="disabled">-------BANK ACCOUNTS--------</option>';
$y = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND type = 'bank' AND saasid = '".$_SESSION['saasid']."' ORDER BY fld1 ASC");
while($g = mysql_fetch_array($y)){
echo '<option value="'.$g["glid"].','.$g["type"].'">'.$g["fld1"].'</option>';	
}

$rt = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['setval']."' AND saasid = '".$_SESSION['saasid']."'"));


echo '</select></div>
<div class="headtext2" style="width: 95px;"><input class="smlfnt" style="width:80px" name="bnpay" id="bnpay" type="text" disabled="disabled"></div>
<div class="headtext2" style="width: 107px;"><input class="smlfnt" style="width:80px" name="bndep" id="bndep" type="text"></div>
<input name="whabank" id="whabank" type="hidden" value="'.$_REQUEST['setval'].'">
<div id="balancbank" class="headtext2" style="width: 90px;">$'.number_format($rt["fld4"],2).'</div>
</div>

<div style="height:30px"></div>

<div id="bnsubs" onClick="subBanksthn()">Save Entry</div>';	
}



/////EDIT LEDGER STUFF & BANK SUMBISSIONS////
if($act == 'editbankinfo'){
	
	$gr = mysql_query("SELECT * FROM transandpays WHERE pyid = '".$_REQUEST['id']."'");
	$rk = mysql_fetch_array($gr);
	
	
echo '
     <div class="infohead">
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Date</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Num/Type</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;">Name</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;">Memo</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;">GL Account</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Payment</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Deposit</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Balance</div>
</div>

<div class="infoheadlines">
<input name="editid" id="editid" type="hidden" value="'.$_REQUEST['id'].'" />
<div class="headtext2" style="width: 90px;"><input class="smlfnt" style="width:80px" name="bndate" id="bndate" type="text" value="'.$rk["date"].'"></div>
<div class="headtext2" style="width: 90px;"><input class="smlfnt" style="width:80px" name="bnnum" id="bnnum" type="text" value="'.$rk["numtype"].'"></div>
<div class="headtext2" style="width: 120px;"><input class="smlfnt" style="width:110px" name="bnname" id="bnname" type="text" value="'.$rk["name"].'"></div>
<div class="headtext2" style="width: 130px;"><input class="smlfnt" style="width:110px" name="bnmemo" id="bnmemo" type="text"></div>
<div class="headtext2" style="width: 120px;"><select class="smlfnt" style="width:110px" name="bngl" id="bngl"><option value="none">Select GL...</option>
<option value="none" disabled="disabled">-------EXPENSES--------</option>';
$y = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND type = 'expense' AND saasid = '".$_SESSION['saasid']."' ORDER BY fld1 ASC");
if(mysql_num_rows($y) > 0){
while($g = mysql_fetch_array($y)){
	if($rk["gl_act"] == $g["glid"]){
				
echo '<option value="'.$g["glid"].','.$g["type"].'" selected="selected">'.$g["fld1"].'</option>';	
	}else{
	echo '<option value="'.$g["glid"].','.$g["type"].'">'.$g["fld1"].'</option>';	
	}

}
}else{
echo '<option value="none">NO ENTRYS</option>';	
}

echo '<option value="none" disabled="disabled">-------LOANS--------</option>';
$y = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND type = 'loans' AND saasid = '".$_SESSION['saasid']."' ORDER BY fld1 ASC");
while($g = mysql_fetch_array($y)){
echo '<option value="'.$g["glid"].','.$g["type"].'">'.$g["fld1"].'</option>';	
}

echo '<option value="none" disabled="disabled">-------BANK ACCOUNTS--------</option>';
$y = mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND type = 'bank' AND saasid = '".$_SESSION['saasid']."' ORDER BY fld1 ASC");
while($g = mysql_fetch_array($y)){
echo '<option value="'.$g["glid"].','.$g["type"].'">'.$g["fld1"].'</option>';	
}

$rt = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$rk["paidby"]."' AND saasid = '".$_SESSION['saasid']."'"));


if($rk["paytype"] == 'deposit'){
	$depfl = $rk["deposit"];
	$depdei = '';
	$paydis = 'disabled="disabled"';
	$payfld = '';
	$paidsid = $rk["gl_act"];
}else{
	$depfl = '';
	$depdei = 'disabled="disabled"';
	$paydis = '';
	$payfld = $rk["payment"];
	$paidsid = $rk["paidby"];
	
}


echo '</select></div>
<div class="headtext2" style="width: 95px;"><input class="smlfnt" style="width:80px" name="bnpay" id="bnpay" type="text" '.$paydis.' value="'.$payfld.'"></div>
<div class="headtext2" style="width: 107px;"><input class="smlfnt" style="width:80px" name="bndep" id="bndep" type="text" '.$depdei.' value="'.$depfl.'"></div>
<input name="whabank" id="whabank" type="hidden" value="'.$rk["paidby"].'">
<div id="balancbank" class="headtext2" style="width: 90px;">$'.number_format($rt["fld4"],2).'</div>
</div>

<div style="height:30px"></div>

<div id="bnsubs" style="float:left;" onClick="editBanksthn(\''.$_REQUEST['id'].'\')">Save Entry</div> <div style="float:left; margin-left:15px" id="bnsubs2" onClick="delBankent(\''.$_REQUEST['id'].'\',\''.$paidsid.'\')">Delete Entry</div>';	
}



/////COMPLETE EDIT OF ENTRIES////
if($act == 'updatebankingthon'){
	
	$gr = mysql_query("SELECT * FROM transandpays WHERE pyid = '".$_REQUEST['id']."'");
	$rk = mysql_fetch_array($gr);
	
	$bndate = mysql_real_escape_string($_REQUEST['bndate']);
$bnnum = mysql_real_escape_string($_REQUEST['bnnum']);
$bnname = mysql_real_escape_string($_REQUEST['bnname']);
$bnmemo = mysql_real_escape_string($_REQUEST['bnmemo']);
$bngl = mysql_real_escape_string($_REQUEST['bngl']);
$bndep = mysql_real_escape_string($_REQUEST['bndep']);
$bnpay = mysql_real_escape_string($_REQUEST['bnpay']);
$whabank = mysql_real_escape_string($_REQUEST['whabank']);

////payment adjustments////
if($bnpay !=''){
if($bnpay == $rk["payment"]){

	$pullAmount = '';
}else{
	if($bnpay > $rk["payment"]){
		$pullAmount = $bnpay - $rk["payment"];
		
		$b = mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$whabank' AND saasid='".$_SESSION['saasid']."'");
	$x = mysql_fetch_array($b);
	
	$dedcu = $x["fld4"] - $pullAmount;
		
		mysql_query("UPDATE ledger_tabs SET fld4 = '$dedcu' WHERE glid = '$whabank' AND saasid='".$_SESSION['saasid']."'");
	}else{
		$pullAmount = $rk["payment"] - $bnpay;
		$b = mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$whabank' AND saasid='".$_SESSION['saasid']."'");
	$x = mysql_fetch_array($b);
	
	$givback = $x["fld4"] + $pullAmount;
	mysql_query("UPDATE ledger_tabs SET fld4 = '$givback' WHERE glid = '$whabank' AND saasid='".$_SESSION['saasid']."'");
	}
	
}
}
////DEPOSIT EDITS & ADJUSTMENTS////
if($bndep !=''){
	if($bndep == $rk["deposit"]){

	$pullAmount = '';
}else{
	if($bndep > $rk["deposit"]){
		$pullAmount = $bndep - $rk["deposit"];
		
		$b = mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$whabank' AND saasid='".$_SESSION['saasid']."'");
	$x = mysql_fetch_array($b);
	
	$dedcu = $x["fld4"] - $pullAmount;
		
		mysql_query("UPDATE ledger_tabs SET fld4 = '$dedcu' WHERE glid = '$whabank' AND saasid='".$_SESSION['saasid']."'");
	}else{
		$pullAmount = $rk["deposit"] - $bndep;
		$b = mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$whabank' AND saasid='".$_SESSION['saasid']."'");
	$x = mysql_fetch_array($b);
	
	$givback = $x["fld4"] + $pullAmount;
	mysql_query("UPDATE ledger_tabs SET fld4 = '$givback' WHERE glid = '$whabank' AND saasid='".$_SESSION['saasid']."'");
	}
	
	
	
}
	
}
if($bnpay !=''){
	echo 'going'.$bngl.$_REQUEST['id'].$whabank;
mysql_query("UPDATE transandpays SET date='$bndate', numtype='$bnnum', name='$bnname',	memo='$bnmemo', gl_act='$bngl', payment='$bnpay', deposit='$bndep' WHERE pyid = '".$_REQUEST['id']."'")or die(mysql_error());
}

if($bndep !=''){
mysql_query("UPDATE transandpays SET date='$bndate', numtype='$bnnum', name='$bnname',	memo='$bnmemo ', gl_act='$bngl', deposit='$bndep' WHERE pyid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");	
}
}


////DELTE ENTRIES////
if($act == 'delentryog'){
	$rt = mysql_fetch_array(mysql_query("SELECT * FROM transandpays WHERE pyid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));
		$jk = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['bankid']."' AND saasid = '".$_SESSION['saasid']."'"));
		
		if($rt["paytype"] != 'deposit'){
		$giveAmount = $jk["fld4"] + $rt["payment"];
		}else{
			$giveAmount = $jk["fld4"] - $rt["deposit"];
			//echo 'Is deposit'.'this is set amount'.$jk["fld4"].'this is bank id'.$_REQUEST['bankid'];
		}
		
		mysql_query("UPDATE ledger_tabs SET fld4 = '$giveAmount' WHERE glid = '".$_REQUEST['bankid']."' AND saasid = '".$_SESSION['saasid']."'");
		mysql_query("DELETE FROM transandpays WHERE pyid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
}



/////SUBMIT THE BANKING STUFF////
if($act == 'subbankingthon'){
$bndate = mysql_real_escape_string($_REQUEST['bndate']);
$bnnum = mysql_real_escape_string($_REQUEST['bnnum']);
$bnname = mysql_real_escape_string($_REQUEST['bnname']);
$bnmemo = mysql_real_escape_string($_REQUEST['bnmemo']);
$bngl = mysql_real_escape_string($_REQUEST['bngl']);
$bndep = mysql_real_escape_string($_REQUEST['bndep']);
$bnpay = mysql_real_escape_string($_REQUEST['bnpay']);
$whabank = mysql_real_escape_string($_REQUEST['whabank']);

if($bndep != ''){

$rt = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$whabank' AND saasid = '".$_SESSION['saasid']."'"));

	$adMoney = $rt["fld4"] + $bndep;
	
	mysql_query("UPDATE ledger_tabs SET fld4 = '$adMoney' WHERE glid = '$whabank' AND saasid = '".$_SESSION['saasid']."'");
	
	mysql_query("INSERT INTO transandpays SET date='$bndate', numtype='$bnnum', name='$bnname',	memo='$bnmemo ', gl_act='$whabank', payment='$bnpay', deposit='$bndep', paytype='deposit', ispay = 'true', saasid='".$_SESSION['saasid']."'");
}

if($bnpay != ''){

$rt = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$bngl' AND saasid = '".$_SESSION['saasid']."'"));
$rt2 = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$whabank' AND saasid = '".$_SESSION['saasid']."'"));

	$minMoney = $rt2["fld4"] - $bnpay;
	mysql_query("UPDATE ledger_tabs SET fld4 = '$minMoney' WHERE glid = '$whabank' AND saasid = '".$_SESSION['saasid']."'");
	//mysql_query("UPDATE ledger_tabs SET fld4 = '$adMoney' WHERE glid = '$bngl' AND saasid = '".$_SESSION['saasid']."'");
	mysql_query("INSERT INTO transandpays SET date='$bndate', numtype='$bnnum', name='$bnname',	memo='$bnmemo ', gl_act='$bngl', payment='$bnpay', deposit='$bndep', paidby='$whabank', paytype='dirbank', ispay = 'true', saasid='".$_SESSION['saasid']."'");
}
	
}

////GET BANK UPDATES/////
if($act == 'getallbanks'){
	
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
	$query  = "SELECT customers.companyname, customers.cust_id, customers.zip, customers.state, customers.county, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.companyname LIKE '$serc%' AND customers.saasid = '".$_SESSION['saasid']."' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.zip LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.state LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.county LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.firstname LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND CONCAT(contacts.firstname, ' ', contacts.lastname)  LIKE '$serc%' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM ledger_tabs WHERE type = 'bank' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct = 'none' ORDER BY fld1 $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				
				$totSet2 = 0;
				$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND subacct != 'none' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		$flg = $tm["fld4"] * 1;
		
		$totSet2 += $tm["fld4"];
	}
	
	
	
	$mainBal = $totSet2 + $h["fld4"];
	
	
	$hl = mysql_query("SELECT * FROM invoice_payments WHERE bankset = '".$h["glid"]."' AND saasid = '".$_SESSION['saasid']."'");
	$bounce = 0;
		while($tbone = mysql_fetch_array($hl)){
			$bounce += $tbone["amount"];
			
		}
		
		$hl2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$h["glid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");
	$bounce2 = 0;
		while($tbone2 = mysql_fetch_array($hl2)){
			$bounce2 += $tbone2["deposit"];
			
		}
		
		$hl3 = mysql_query("SELECT * FROM transandpays WHERE paidby = '".$h["glid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");
	$bounce3 = 0;
		while($tbone3 = mysql_fetch_array($hl3)){
			$bounce3 += $tbone3["payment"];
			
		}
		
				$outTot = number_format($bounce + $bounce2 - $bounce3,2);
				
				$stipOut = str_replace(',','',$outTot);
				
				mysql_query("UPDATE ledger_tabs SET fld4 = '$stipOut' WHERE subacct = 'none' AND type = 'bank' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
			
	echo '<div class="infoheadlines">
<div class="headtext2" style="width: 110px;">'.$h["glid"].'</div>
<div class="headtext2" style="width: 443px;">'.$h["fld1"].'</div>
<div class="headtext2" style="width: 130px;">$'.$outTot.'</div>
<div class="headtext2" style="width: 125px; text-align: center;">
<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="grabBankedit(\''.$h["glid"].'\')"></div>
<div class="view_on" title="View Details" onclick="opnbankRuls(\''.$h["glid"].'\')"></div>
<div class="clip_board" title="Add Details" onclick="runBanks(\''.$h["glid"].'\')"></div>
<div class="delete_icon" title="Delete" onclick="delbnk(\''.$h["glid"].'\')"></div>
</div></div><div id="lines'.$h["glid"].'" style="padding:10px; display:none; border-left:solid thin #CCC; border-right:solid thin #CCC; border-bottom:solid thin #CCC;">';

$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["fld1"].'</div>
		<div style="width:126px; height:22px; float:left">$'.$tm["fld4"].'</div>
		</div>';
			
	}




echo '</div>';
			}
	}
 $query   = "SELECT COUNT(fld1) AS numrows FROM ledger_tabs WHERE type = 'expense' AND active='true' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="grabBanks(\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="grabBanks(\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="grabBanks(\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';

	
}

///GET LEDGER DETAILS///
if($act == 'getledgdets'){
	$yu = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['glid']."' AND saasid='".$_SESSION['saasid']."'"));
	
	
	$rt = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$_REQUEST["glid"]."' AND status != '' AND saasid = '".$_SESSION['saasid']."'");

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$_REQUEST["glid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
	
	
echo '<div style="width:100%">
<strong>Details For:</strong><input name="gllnmm" id="gllnmm" type="text" value="'.$yu["fld1"].'"/><br /><br />

<div style="width:100%; height:25px; background-color:#FFF;">
<div style="width:100px; float:left; height:25px; padding-left:4px">Type</div>
<div style="width:100px; float:left; height:25px;">Date</div>
<div style="width:100px; float:left; height:25px;">Num</div>
<div style="width:140px; float:left; height:25px;">Name</div>
<div style="width:300px; float:left; height:25px;">Memo</div>
<div style="width:100px; float:left; height:25px;">Split</div>
<div style="width:100px; float:left; height:25px;">Amount</div>
</div>';
	
//////////PAGENATE///////////

///////start page stuff/////
		
		$rowsPerPage = 20;
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
$query  = "SELECT * FROM transandpays WHERE gl_act = '".$_REQUEST['glid']."' AND saasid = '".$_SESSION['saasid']."' ORDER BY gl_act $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:18px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{
$i=0;
			while($s = mysql_fetch_array($result)){
				
				if($i == 0){
			$color = '#EEE';
			$i=1;
		}else{
			$i=0;
			$color = '#FFF';
		}
	
		if($s["numtype"] == 'Submitted Bill' && $s["status"] == 'open'){
			$color = '#E1F9FF';
		}
		
		if($s["paytype"] == 'dirbank'){
			$typ = 'Bank Transfer';
		}
		
		if($s["paytype"] == 'check'){
			$typ = 'Check Paid';
		}
		
		if($s["paytype"] == 'deposit'){
			$typ = 'Deposit';
		}
		
		if($s["paytype"] == ''){
			$typ = 'Pending Bill';
		}
		
		if($s["paidby"] != ''){
		
		$rb = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$s["paidby"]."' AND saasid = '".$_SESSION['saasid']."'"));
		
			$banknm = $rb["fld1"];
		}else{
			$banknm = 'None';
		}
		
		if($s["payment"] != ''){
			$pay = $s["payment"];
		}else{
			$pay = $s["deposit"];
		}
		
		if($s["numtype"] == 'Submitted Bill'){
			$num = $s["ref_id"];
		}else{
			$num = $s["numtype"];
		}
		
			

echo '<div style="width:100%; height:21px; background-color:'.$color.'; font-size:11px; padding-top:4px;">
<div style="width:100px; float:left; height:25px; padding-left:4px">'.$typ.'</div>
<div style="width:100px; float:left; height:25px;">'.$s["date"].'</div>
<div style="width:100px; float:left; height:25px;">'.$num .'</div>
<div style="width:140px; float:left; height:25px;">'.$s["name"].'</div>
<div style="width:300px; float:left; height:25px;">'.$s["memo"].'</div>
<div style="width:100px; float:left; height:25px;">'.$banknm.'</div>
<div style="width:100px; float:left; height:25px;">$'.$pay.'</div>
</div>';



				
				
			}
	}
	
	echo '<div style="padding:5px; float:right; margin-right:60px;">Balance: $'.$owedAmount.'</div>';
	
 $query   = "SELECT COUNT(gl_act) AS numrows FROM transandpays WHERE gl_act = '".$_REQUEST['glid']."' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">'.$page.'</div>';
	}		
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';
echo '</div><div id="edtnam" style="float:left" onClick="changetheName(\''.$_REQUEST['glid'].'\')">Complete Edit of Name</div><!--<div id="delle" style="float:left; margin-left:25px">Delete</div>-->';
}



/////GET VENDOR DETAILS///
if($act == 'getledgdets2'){
	$yu = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['glid']."' AND saasid='".$_SESSION['saasid']."'"));
	
	
	$rt = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$_REQUEST["glid"]."' AND status != '' AND saasid = '".$_SESSION['saasid']."'");

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$_REQUEST["glid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
	
	
echo '<div style="width:100%">
<strong>Details For:</strong> '.$yu["fld1"].'<br /><br />

<div style="width:100%; height:25px; background-color:#FFF;">
<div style="width:100px; float:left; height:25px; padding-left:4px">Type</div>
<div style="width:100px; float:left; height:25px;">Date</div>
<div style="width:100px; float:left; height:25px;">Num</div>
<div style="width:140px; float:left; height:25px;">Name</div>
<div style="width:300px; float:left; height:25px;">Memo</div>
<div style="width:100px; float:left; height:25px;">Split</div>
<div style="width:100px; float:left; height:25px;">Amount</div>
</div>';
	
//////////PAGENATE///////////

///////start page stuff/////
		
		$rowsPerPage = 20;
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
$query  = "SELECT * FROM transandpays WHERE vendor = '".$_REQUEST['glid']."' AND saasid = '".$_SESSION['saasid']."' ORDER BY gl_act $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:18px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{
$i=0;
			while($s = mysql_fetch_array($result)){
				
				if($i == 0){
			$color = '#EEE';
			$i=1;
		}else{
			$i=0;
			$color = '#FFF';
		}
	
		if($s["numtype"] == 'Submitted Bill' && $s["status"] == 'open'){
			$color = '#E1F9FF';
		}
		
		if($s["paytype"] == 'dirbank'){
			$typ = 'Bank Transfer';
		}
		
		if($s["paytype"] == 'check'){
			$typ = 'Check Paid';
		}
		
		if($s["paytype"] == 'deposit'){
			$typ = 'Deposit';
		}
		
		if($s["paytype"] == ''){
			$typ = 'Pending Bill';
		}
		
		if($s["paidby"] != ''){
		
		$rb = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$s["paidby"]."' AND saasid = '".$_SESSION['saasid']."'"));
		
			$banknm = $rb["fld1"];
		}else{
			$banknm = 'None';
		}
		
		if($s["payment"] != ''){
			$pay = $s["payment"];
		}else{
			$pay = $s["deposit"];
		}
		
		if($s["numtype"] == 'Submitted Bill'){
			$num = $s["ref_id"];
		}else{
			$num = $s["numtype"];
		}
		
			

echo '<div style="width:100%; height:21px; background-color:'.$color.'; font-size:11px; padding-top:4px;">
<div style="width:100px; float:left; height:25px; padding-left:4px">'.$typ.'</div>
<div style="width:100px; float:left; height:25px;">'.$s["date"].'</div>
<div style="width:100px; float:left; height:25px;">'.$num .'</div>
<div style="width:140px; float:left; height:25px;">'.$s["name"].'</div>
<div style="width:300px; float:left; height:25px;">'.$s["memo"].'</div>
<div style="width:100px; float:left; height:25px;">'.$banknm.'</div>
<div style="width:100px; float:left; height:25px;">$'.$pay.'</div>
</div>';



				
				
			}
	}
	
	echo '<div style="padding:5px; float:right; margin-right:60px;">Balance: $'.$owedAmount.'</div>';
	
 $query   = "SELECT COUNT(gl_act) AS numrows FROM transandpays WHERE gl_act = '".$_REQUEST['glid']."' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">'.$page.'</div>';
	}		
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';
echo '</div>';
}


/////OPEN BANK VIEW////

if($act == 'getbankledge'){
	
	$yu = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['glid']."' AND saasid='".$_SESSION['saasid']."'"));
	
echo '<div style="width:100%">
<strong>Details For:</strong> '.$yu["fld1"].'<br /><br />

<div style="width:100%; height:25px; background-color:#FFF;">
<div style="width:100px; float:left; height:25px; padding-left:4px">Type</div>
<div style="width:100px; float:left; height:25px;">Date</div>
<div style="width:100px; float:left; height:25px;">Num</div>
<div style="width:140px; float:left; height:25px;">Name</div>
<div style="width:300px; float:left; height:25px;">Memo</div>
<div style="width:100px; float:left; height:25px;">Split</div>
<div style="width:100px; float:left; height:25px;">Amount</div>
</div>';
	
//////////PAGENATE///////////

///////start page stuff/////
		
		$rowsPerPage = 20;
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
	$dirs = 'DESC';
$query  = "SELECT * FROM transandpays WHERE paidby = '".$_REQUEST['glid']."' AND saasid = '".$_SESSION['saasid']."' OR gl_act = '".$_REQUEST['glid']."' AND paytype = 'deposit' AND saasid = '".$_SESSION['saasid']."' ORDER BY date $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:18px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{
$i=0;
			while($s = mysql_fetch_array($result)){
				
				if($i == 0){
			$color = '#EEE';
			$i=1;
		}else{
			$i=0;
			$color = '#FFF';
		}
		
		if($s["paytype"] == 'dirbank'){
			$typ = 'Bank Transfer';
		}
		
		if($s["paytype"] == 'check'){
			$typ = 'Check Paid';
		}
		
		if($s["paytype"] == 'deposit'){
			$typ = 'Deposit';
		}
		
		if($s["paidby"] != ''){
		
		$rb = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$s["paidby"]."' AND saasid = '".$_SESSION['saasid']."'"));
		
			$banknm = $rb["fld1"];
		}else{
			$banknm = 'None';
		}
		
		if($s["payment"] != ''){
			$pay = $s["payment"];
			$setPayee = $s["paidby"];
		}else{
			$pay = $s["deposit"];
			
			$setPayee = $s["gl_act"];
		}
		
			

echo '<div style="width:100%; height:25px; background-color:'.$color.'; font-size:11px">
<div style="width:100px; float:left; height:25px; padding-left:4px"><a href="javascript:editBaenty(\''.$s["pyid"].'\',\''.$setPayee.'\')">'.$typ.'</a></div>
<div style="width:100px; float:left; height:25px;">'.$s["date"].'</div>
<div style="width:100px; float:left; height:25px;">'.$s["numtype"].'</div>
<div style="width:140px; float:left; height:25px;">'.$s["name"].'</div>
<div style="width:300px; float:left; height:25px;">'.$s["memo"].'</div>
<div style="width:100px; float:left; height:25px;">'.$banknm.'</div>
<div style="width:100px; float:left; height:25px;">$'.$pay.'</div>
</div>';
				
				
			}
	}
	
 $query   = "SELECT COUNT(gl_act) AS numrows FROM transandpays WHERE paidby = '".$_REQUEST['glid']."' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">'.$page.'</div>';
	}		
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';
echo '</div>';



///start payments////
echo '<div id="paymentsadded" style="margin-top:25px">';

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
	$query  = "SELECT customers.companyname, customers.cust_id, customers.zip, customers.state, customers.county, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.companyname LIKE '$serc%' AND customers.saasid = '".$_SESSION['saasid']."' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.zip LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.state LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.county LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.firstname LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND CONCAT(contacts.firstname, ' ', contacts.lastname)  LIKE '$serc%' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM invoice_payments WHERE bankset = '".$_REQUEST['glid']."' AND saasid = '".$_SESSION['saasid']."' ORDER BY pay_id $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Invoice Payments</div>';
		
	}else{
		$i2 = 0;
		if($i2 == 0){
			$color = '#EEE';
			$i2=1;
		}else{
			$i2=0;
			$color = '#FFF';
		}

			while($h = mysql_fetch_array($result)){
				
			
		
		$deduct = $value-$ars;
		
		$rtb = mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$h["inv_num"]."' AND saasid = '".$_SESSION['saasid']."'"));
		
		$rty=mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$rtb["company_id"]."'"));
		
		echo '<div style="width:100%; height:25px; background-color:'.$color.'; font-size:11px">
<div style="width:100px; float:left; height:25px; padding-left:4px"><a href="javascript:editinPay(\''.$h["pay_id"].'\')">Invoice Payment</a></div>
<div style="width:100px; float:left; height:25px;">'.$h["date"].'</div>
<div style="width:100px; float:left; height:25px;">INV#: '.$h["inv_num"].'</div>
<div style="width:140px; float:left; height:25px;">'.$rty["companyname"].'</div>
<div style="width:300px; float:left; height:25px;">Check Payment</div>
<div style="width:100px; float:left; height:25px;">CHK#: '.$h["checknum"].'</div>
<div style="width:100px; float:left; height:25px;">$'.$h["amount"].'</div>
</div>';


if($h["fld1"] != 'Vendors'){

$yu = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$h["glid"]."' AND saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["fld1"].'</div>
		<div style="width:126px; height:22px; float:left"></div>
		<div style="width:126px; height:22px; float:left"><a href="javascript:opnRuls(\''.$tm["glid"].'\')">View Details</a></div>
		</div>';
			
	}
}else{
	$yu = mysql_query("SELECT * FROM vendors WHERE saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($tm = mysql_fetch_array($yu)){
		
		
		
		echo '<div style="width: 848px; height:22px;">
		<div style="width: 140px; height:22px; float:left"></div>
		<div style="width: 455px; height:22px; float:left">'.$tm["ven_name"].'</div>
		<div style="width:126px; height:22px; float:left"></div>
		<div style="width:126px; height:22px; float:left"><a href="javascript:opnRuls2(\''.$tm["ven_id"].'\')">View Details</a></div>
		</div>';
			
	}
}




echo '</div>';
			}
	}
 $query   = "SELECT COUNT(pay_id) AS numrows FROM invoice_payments WHERE bankset = '".$_REQUEST['glid']."' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="getLines(\'expense\',\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getLines(\'expense\',\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';



echo '</div>';
}

//////GET DIFF TYPES FOR VENDORS AND GL ACCOUNTS////
if($act == 'switchposts'){
	if($_REQUEST['switch'] == 'true'){
	echo '<div style="width:120px; height:40px; float:left">
   GL Account:
    </div>
    <div style="width:300px; height:40px; float:left">
    <select name="acctpost" id="acctpost" class="makerrswdrops">
    <option value="none">Select GL Account...</option>';
   
	$op = mysql_query("SELECT * FROM ledger_tabs WHERE saasid='".$_SESSION['saasid']."' AND active = 'true' AND type = 'expense'");
	while($ty = mysql_fetch_array($op)){
	echo '<option value="'.$ty["glid"].'">'.$ty["fld1"].'</option>';	
	}
	
	
	
    echo '</select>
  </div>';
	}else{
		
		
echo '<div style="width:120px; height:40px; float:left">
   Vendor:
    </div>
    <div style="width:300px; height:40px; float:left">
    <select name="acctpost" id="acctpost" class="makerrswdrops">
    <option value="none">Select Vendor...</option>';
   
	$op = mysql_query("SELECT * FROM vendors WHERE saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($ty = mysql_fetch_array($op)){
	echo '<option value="'.$ty["ven_id"].'">'.$ty["ven_name"].'</option>';	
	}
	
	
	
    echo '</select>
  </div>';
		
	}
}

/////GET NEW BILL FORM///

if($act == 'newbillform'){
echo '<div style="padding:0px 5px 5px; font-size:18px; font-weight:bold;">Add Bill</div>

<div id="formhols" style="padding:0px 5px 5px;">

	
	<div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Reference #:
    </div>
    <div style="width:300px; height:40px; float:left">
    <input style="float:left; width:100px" class="makerrsw" name="refnum" id="refnum" type="text" value="">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Creation Date:
    </div>
    <div style="width:300px; height:40px; float:left">
    <input style="float:left; width:100px" class="makerrsw" name="billdate" id="billdate" type="text" value="'. date('m/d/Y').'">
    </div>
    </div>
    
    <div id="typacctdrp" style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Vendor:
    </div>
    <div style="width:300px; height:40px; float:left">
    <select name="acctpost" id="acctpost" class="makerrsw">
    <option value="none">Select GL Account...</option>';
   
	$op = mysql_query("SELECT * FROM ledger_tabs WHERE saasid='".$_SESSION['saasid']."' AND active = 'true' AND type = 'expense' AND subacct !='none'");
	while($ty = mysql_fetch_array($op)){
	echo '<option value="'.$ty["glid"].'">'.$ty["fld1"].'</option>';	
	}
	
	
	
    echo '</select>
	
  </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Terms:
    </div>
    <div style="width:300px; height:40px; float:left">
    <select name="terms" id="terms" class="makerrsw">
    <option value="none" selected="selected">Select Term</option>
    <option value="Net 15">Net 15</option>
    <option value="Net 30">Net 30</option>
    <option value="Net 60">Net 60</option>
    
    </select>
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Due Date:
    </div>
    <div style="width:300px; height:40px; float:left">
    <input style="float:left" class="makerrsw" name="duedt" id="duedt" type="text">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Status:
    </div>
    <div style="width:300px; height:40px; float:left">
    <select class="makerrsw" name="status" id="status">
    <option value="none" selected="selected">Select Status...</option>
    <option value="open">Open</option>
    <option value="closed">Closed</option>
    </select>
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Amount Due:
    </div>
    <div style="width:300px; height:40px; float:left">
    <input style="float:left" class="makerrsw" name="amntdue" id="amntdue" type="text">
    </div>
    </div>
    
    
    <div id="subbdbil" style="float:right;" onClick="subNewbill()">Add Bill</div> 
<div style="float:right; margin-right:15px; padding-top:4px;"><a href="javascript:clsAddbill()">Cancel</a></div>


</div>';	
}

////EDIT DIRECT ADDED BILLS//////
if($act == 'editbillform'){
	
	
	
	$ro = mysql_fetch_array(mysql_query("SELECT * FROM transandpays WHERE pyid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));
	echo $_REQUEST['id'];
	if($ro["vendor"] != ''){
		$vencheck = 'checked="checked"';
		$glcheck = '';
	}else{
		$vencheck = '';
		$glcheck = 'checked="checked"';
	}
	
echo '<div style="padding:0px 5px 5px; font-size:18px; font-weight:bold;">Edit Bill</div>

<div id="formhols" style="padding:0px 5px 5px;">

<div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   GL Account ?:
    </div>
    <div style="width:300px; height:40px; float:left">
      
        <label>
          <input type="radio" name="isvend" value="true" id="isvend" '.$glcheck.' disabled="disabled">
          Yes</label>
        
        <label>
          <input type="radio" name="isvend" value="false" id="isvend" '.$vencheck.' disabled="disabled" >
          No</label>
        
    </div>
    </div>
	
	<div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Reference #:
    </div>
    <div style="width:300px; height:40px; float:left">
    <input style="float:left; width:100px" class="makerrsw" name="refnum" id="refnum" type="text" value="'.$ro["ref_id"].'">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Creation Date:
    </div>
    <div style="width:300px; height:40px; float:left">
    <input style="float:left; width:100px" class="makerrsw" name="billdate" id="billdate" type="text" value="'.$ro["date"].'">
    </div>
    </div>
    
    <div id="typacctdrp" style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Vendor:
    </div>
    <div style="width:300px; height:40px; float:left">';
	
	if($ro["vendor"] != ''){
	
    echo '<select name="acctpost" id="acctpost" class="makerrsw" disabled="disabled">
    <option value="none">Select Vendor...</option>';
  
	$op = mysql_query("SELECT * FROM vendors WHERE saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($ty = mysql_fetch_array($op)){
	echo '<option value="'.$ty["ven_id"].'">'.$ty["ven_name"].'</option>';	
	}
	
	}else{
		
		echo '<select name="acctpost" id="acctpost" class="makerrsw" disabled="disabled">
    <option value="none">Select GL Account...</option>';
  
	$op = mysql_query("SELECT * FROM ledger_tabs WHERE saasid='".$_SESSION['saasid']."' AND active = 'true' AND type = 'expense'");
	while($ty = mysql_fetch_array($op)){
		if($ro["gl_act"] == $ty["glid"]){
	echo '<option value="'.$ty["glid"].'" selected="selected">'.$ty["fld1"].'</option>';
		}else{
			echo '<option value="'.$ty["glid"].'">'.$ty["fld1"].'</option>';
		}
	}
		
	}
	
	
	
    echo'</select>
  </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Terms:
    </div>
    <div style="width:300px; height:40px; float:left">
    <select name="terms" id="terms" class="makerrsw">';
	
	if($ro["terms"] == 'Net 15'){$fif = 'selected="selected"';}else{$fif = '';}
	if($ro["terms"] == 'Net 30'){$thr = 'selected="selected"';}else{$thr = '';}
	if($ro["terms"] == 'Net 60'){$six = 'selected="selected"';}else{$six = '';}
	
    echo '<option value="none" selected="selected">Select Term</option>
    <option value="Net 15" '.$fif.'>Net 15</option>
    <option value="Net 30" '.$thr.'>Net 30</option>
    <option value="Net 60" '.$six.'>Net 60</option>
    
    </select>
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Due Date:
    </div>
    <div style="width:300px; height:40px; float:left">
    <input style="float:left" class="makerrsw" name="duedt" id="duedt" type="text" value="'.$ro["due_date"].'">
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Status:
    </div>
    <div style="width:300px; height:40px; float:left">
    <select class="makerrsw" name="status" id="status">';
	
	if($ro["status"] == 'open'){$opn = 'selected="selected"';}else{$opn = '';}
	if($ro["status"] == 'closed'){$cls = 'selected="selected"';}else{$cls = '';}
	
    echo '<option value="none">Select Status...</option>
    <option value="open" '.$opn.'>Open</option>
    <option value="closed" '.$cls.'>Closed</option>
    </select>
    </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
<div style="width:120px; height:40px; float:left">
   Amount Due:
    </div>
    <div style="width:300px; height:40px; float:left">
    <input style="float:left" class="makerrsw" name="amntdue" id="amntdue" type="text" value="'.$ro["payment"].'">
    </div>
    </div>
    
    
    <div id="subbdbil" style="float:right;" onClick="edsbill(\''.$_REQUEST['id'].'\')">Edit Bill</div> 
	<div id="subbdbi3" style="float:right; margin-right:10px" onClick="delbill(\''.$_REQUEST['id'].'\')">Delete Bill</div> 
<div style="float:right; margin-right:15px; padding-top:4px;"><a href="javascript:clsAddbill()">Cancel</a></div>


</div>';	
}

///COMPLETE NEW BILL ADD//
if($act == 'subnewbill'){
$refnum = mysql_real_escape_string($_REQUEST['refnum']);
$billdate = mysql_real_escape_string($_REQUEST['billdate']);
$terms = mysql_real_escape_string($_REQUEST['terms']);
$duedt = mysql_real_escape_string($_REQUEST['duedt']);
$status = mysql_real_escape_string($_REQUEST['status']);
$amntdue = mysql_real_escape_string($_REQUEST['amntdue']);
$acctpost = mysql_real_escape_string($_REQUEST['acctpost']);
$isvn = $_REQUEST['isvn'];

if($isvn == 'false'){
$gl = '';
$ven = $acctpost;
}else{
	$gl = $acctpost;
$ven = '';
}





mysql_query("INSERT INTO transandpays SET date = '$billdate', numtype = 'Submitted Bill', gl_act = '$gl',	payment = '$amntdue', ref_id = '$refnum', vendor = '$ven', terms = '$terms', due_date = '$duedt', status = '$status', saasid = '".$_SESSION['saasid']."'");
	
}


////GET ACTIVE BILLS////
if($act == 'activebills'){

		
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
	$query  = "SELECT customers.companyname, customers.cust_id, customers.zip, customers.state, customers.county, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.companyname LIKE '$serc%' AND customers.saasid = '".$_SESSION['saasid']."' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.zip LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.state LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.county LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.firstname LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND CONCAT(contacts.firstname, ' ', contacts.lastname)  LIKE '$serc%' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM transandpays WHERE numtype = 'Submitted Bill' AND status = 'open' AND saasid='".$_SESSION['saasid']."' ORDER BY date $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:25px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No expenses in system..</div>';
		
	}else{

			while($rgl = mysql_fetch_array($result)){
				
				
				
				if($rgl["vendor"] != ''){
				$diracct = $rgl["vendor"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$rgl["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["ven_name"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");
				
				

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}else{
				$diracct = $rgl["gl_act"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$rgl["gl_act"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["fld1"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

$bound .=$f["payment"];

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND direct = '".$rgl["pyid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
	
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}
			
			
			
		$dud = $rgl["payment"] - $totSet3;	
		
		if($dud < .01){
			
			mysql_query("UPDATE transandpays SET status = 'closed' WHERE pyid = '".$rgl["pyid"]."'");
			
		}else{
			
	
echo '<div class="infoheadlines">
<div class="headtext2" style="width: 175px;">'.$diracct.' - '.$name.'</div>
<div class="headtext2" style="width: 96px;"><a href="">'.$rgl["ref_id"].'</a></div>
<div class="headtext2" style="width: 90px;">$'.number_format($dud,2).'</div>
<div class="headtext2" style="width: 120px;"></div>
<div class="headtext2" style="width: 96px;">'.$rgl["terms"].'</div>
<div class="headtext2" style="width: 90px;">'.$rgl["due_date"].'</div>
<div class="headtext2" style="width: 97px;">'.$rgl["status"].'</div>
<div class="headtext2" style="width: 90px; text-align: center;">
<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="edBillout(\''.$rgl["pyid"].'\')"></div>
<div class="delete_icon" title="Delete" onclick="delbnk(\''.$rgl["pyid"].'\')"></div>
</div></div>';	
		}
			}
	}
	
 $query   = "SELECT COUNT(pyid) AS numrows FROM transandpays WHERE numtype = 'Submitted Bill' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'loans\',\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="getLines(\'loans\',\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getLines(\'loans\',\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';
}

/////GET AMOUNT ON ENTRY///
if($act == 'getamount'){
//getamount&id	

$rt = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$_REQUEST['id']."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$_REQUEST['id']."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

echo number_format($totSet2 - $totSet3,2);


}

//////PULL PAY BILL SECTION/////
if($act == 'billpaypan'){
echo '<div id="checksholder">

<div style="font-size:25px; font-weight:bold; width:100%; height:30px"><div style="float:left">Select bills to be paid.</div> <div style="padding:3px; float:right; font-size:12px"><label>Filter By: </label><select class="billsty" name="vendfil" id="vendfil"><option value="all">All Items / Vendors</option>';

$op = mysql_query("SELECT * FROM vendors WHERE saasid='".$_SESSION['saasid']."' AND active = 'true'");
	while($ty = mysql_fetch_array($op)){
	echo '<option value="'.$ty["ven_id"].'">'.$ty["ven_name"].'</option>';	
	}

echo'</select></div></div>
<div style="padding-top:15px; width:100%; height:30px">
<div style="float:left">
<div style="float:left; margin-right:8px">
    <label>
      <input class="billsty" type="radio" name="dateshow" value="allbills" id="dateshow" checked="checked" onClick="runBillsorter()"/>
      Show all bills</label>
  
    <label>
      <input class="billsty" type="radio" name="dateshow" value="seldate" id="dateshow" />
      Show bills due on or before: </label>
      </div>
      <input style="float:left" class="billsty" name="biduedt" id="biduedt" type="text" />
</div>
<!--<div style="padding:3px; float:right; font-size:12px; font-weight:bold"><label>Sort By: </label><select class="billsty" name=""></select></div>-->
</div>



</div>

<div id="viewbills" style="margin-top:20px;">
<div class="infohead" style="width:832px">
<div class="headtext" style="width:35px; border-right:solid thin #000;"><input name="allcheck" id="allcheck" type="checkbox" value="" onclick="chkAll(), checkCheck(1)"></div>
<div class="headtext" style="width:155px; border-right:solid thin #000; border-left:solid thin #CCC;">Due Date</div>
<div class="headtext" style="width: 290px; border-right:solid thin #000; border-left:solid thin #CCC;">Vendor / Account</div>
<div class="headtext" style="width:140px; border-right:solid thin #000; border-left:solid thin #CCC;">Amt. Due</div>
<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Amt. to Pay</div>
</div>
<input name="checkvals" id="checkvals" type="hidden" value="">
<div id="billlines" style="width:832px; height:260px; overflow-y:scroll; border:solid thin #F0F0F0;">';

$g = mysql_query("SELECT * FROM transandpays WHERE numtype = 'Submitted Bill' AND status = 'open' AND saasid='".$_SESSION['saasid']."'");
	while($rgl = mysql_fetch_array($g)){
		
		if($rgl["vendor"] != ''){
				$diracct = $rgl["vendor"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$rgl["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["ven_name"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");
				
				

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND direct = '".$rgl["pyid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}else{
				$diracct = $rgl["gl_act"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$rgl["gl_act"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["fld1"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND direct = '".$rgl["pyid"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}

$dud = number_format($rgl["payment"] - $totSet3,2);

echo '<div class="infoheadlines" style="width:815px">
<div class="headtext2" style="width:35px;"><input class="checkers" name="" type="checkbox" value="'.$rgl["pyid"].'" onclick="checkCheck()"></div>
<div class="headtext2" style="width:155px;">'.$rgl["due_date"].'</div>
<div class="headtext2" style="width:290px;">'.$name.'</div>
<div class="headtext2" style="width:140px;">$'.$dud.'</div>
<div class="headtext2" style="width:120px;">$ <input class="billsty" style="width:95px; background-color:#fff" name="payamnt'.$rgl["pyid"].'" id="payamnt'.$rgl["pyid"].'" type="text" value="'.$dud.'"></div>
</div>';

	}


echo'</div>

<!--<div style="padding:20px; text-align:right;">Total of bills: $100.00</div>-->

<div style="font-size:25px; font-weight:bold; margin-bottom:30px">Payment</div>

<div style="width:260px; padding:8px; float:left">
<div style="float:left">Date:</div>
<div style="float:left; padding-left:8px"><input class="billsty" style="width:104px; float:left" name="payddater" id="payddater" type="text" value="'.date('m/d/Y').'"></div>
</div>



<div style="width:310px; padding:8px; float:left">
<div style="float:left">Bank Account:</div>
<div style="float:left; padding-left:8px"><select class="billsty" name="selbank" id="selbank"><option value="none">Select Bank...</option>';
$br = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'bank' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'");
	 	while($r = mysql_fetch_array($br)){
		echo '<option value="'.$r["glid"].'">'.$r["fld1"].' - '.number_format($r["fld4"],2).'</option>';	
		}

echo'</select></div>
</div>



</div>

<div id="savbut" style="float:right; margin-top:40px" onClick="checkMypays()">Save and print</div>
    
    ';	
}


/////SORT BY DATE BILLING////

if($act == 'sorter'){
	if($_REQUEST['akspost'] == 'true'){
$g = mysql_query("SELECT * FROM transandpays WHERE numtype = 'Submitted Bill' AND status = 'open' AND saasid='".$_SESSION['saasid']."' AND due_date = '".$_REQUEST['askdate']."' OR numtype = 'Submitted Bill' AND status = 'open' AND saasid='".$_SESSION['saasid']."' AND due_date < '".$_REQUEST['askdate']."'") or die(mysql_error());
	while($rgl = mysql_fetch_array($g)){
		
		if($rgl["vendor"] != ''){
				$diracct = $rgl["vendor"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$rgl["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["ven_name"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");
				
				

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}else{
				$diracct = $rgl["gl_act"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$rgl["gl_act"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["fld1"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}


echo '<div class="infoheadlines" style="width:815px">
<div class="headtext2" style="width:35px;"><input class="checkers" name="" type="checkbox" value="'.$rgl["pyid"].'" onclick="checkCheck()"></div>
<div class="headtext2" style="width:155px;">'.$rgl["due_date"].'</div>
<div class="headtext2" style="width:290px;">'.$name.'</div>
<div class="headtext2" style="width:140px;">$'.$owedAmount.'</div>
<div class="headtext2" style="width:120px;">$ <input class="billsty" style="width:95px; background-color:#fff" name="payamnt'.$rgl["pyid"].'" id="payamnt'.$rgl["pyid"].'" type="text" value="'.$owedAmount.'"></div>
</div>';

	}
	}else{
	$g = mysql_query("SELECT * FROM transandpays WHERE numtype = 'Submitted Bill' AND status = 'open' AND saasid='".$_SESSION['saasid']."'");
	while($rgl = mysql_fetch_array($g)){
		
		if($rgl["vendor"] != ''){
				$diracct = $rgl["vendor"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$rgl["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["ven_name"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");
				
				

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}else{
				$diracct = $rgl["gl_act"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$rgl["gl_act"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["fld1"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}


echo '<div class="infoheadlines" style="width:815px">
<div class="headtext2" style="width:35px;"><input class="checkers" name="" type="checkbox" value="'.$rgl["pyid"].'" onclick="checkCheck()"></div>
<div class="headtext2" style="width:155px;">'.$rgl["due_date"].'</div>
<div class="headtext2" style="width:290px;">'.$name.'</div>
<div class="headtext2" style="width:140px;">$'.$owedAmount.'</div>
<div class="headtext2" style="width:120px;">$ <input class="billsty" style="width:95px; background-color:#fff" name="payamnt'.$rgl["pyid"].'" id="payamnt'.$rgl["pyid"].'" type="text" value="'.$owedAmount.'"></div>
</div>';

	}	
	}
}



/////MAKE CHECKS HAPPEN AND MARK THING WITH A PAYMENT/////
if($act == 'goandpay'){
	///300.00=25!,256.90=26!
	$g = $_REQUEST['thevals'];
	$nowRaw = str_replace(',', '', $g);
	
	$tags = explode('!', $nowRaw);
	
		$totSet2 = 0;
		foreach($tags as $key) {
$what = explode("=",$key);
	//echo $what[0].'<br>';
	
	$s = mysql_fetch_array(mysql_query("SELECT * FROM transandpays WHERE pyid = '".$what[1]."'"));
	
	$totSet2 += $what[0];	
	
		if($what[0] > $s["payment"]){
			$er.='true';
		}else{
		$er.='false';	
		}
	
	}
	
	if (strpos($er,'true') !== false) {
    echo 'One or more of your transactions has an amount greater than the total due.<br>Please correct and continue.';
}else{

	
	$gh = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['bankaccnt']."' AND saasid='".$_SESSION['saasid']."'"));
	
	if($totSet2 > $gh["fld4"]){
		 echo 'The selected bank account does not have enough funds to cover all payments applied.<br>Please provide account with more funds to continue or select an alternate account.';
	}else{
		foreach($tags as $key) {
$what = explode("=",$key);

$s = mysql_fetch_array(mysql_query("SELECT * FROM transandpays WHERE pyid = '".$what[1]."'"));
		
		$padAmn = number_format($what[0],2);
		
		if($s["vendor"] != ''){
			
			if($padAmn !=''){
				
				$ert = mysql_fetch_array(mysql_query("SELECT * FROM transandpays WHERE pyid = '".$what[1]."' AND saasid = '".$_SESSION['saasid']."'"));

mysql_query("INSERT INTO transandpays SET date = '".date('m/d/Y')."', numtype = 'CHECK', memo = 'Submited Payment' ,vendor = '".$ert["vendor"]."', payment = '$padAmn', direct = '".$what[1]."', paidby = '".$_REQUEST['bankaccnt']."', paytype = 'check', ispay = 'true', saasid = '".$_SESSION['saasid']."'");

$df=mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['bankaccnt']."' AND saasid='".$_SESSION['saasid']."'"));

$dedbank = $df["fld4"] - $padAmn;

mysql_query("UPDATE ledger_tabs SET fld4 = '$dedbank' WHERE glid = '".$_REQUEST['bankaccnt']."' AND saasid='".$_SESSION['saasid']."'");
			}

}else{
	if($padAmn !=''){
		
		$ert = mysql_fetch_array(mysql_query("SELECT * FROM transandpays WHERE pyid = '".$what[1]."' AND saasid = '".$_SESSION['saasid']."'"));
		
mysql_query("INSERT INTO transandpays SET date = '".date('m/d/Y')."', numtype = 'CHECK', memo = 'Submited Payment' ,gl_act = '".$ert["gl_act"]."', payment = '$padAmn', direct = '".$what[1]."', paidby = '".$_REQUEST['bankaccnt']."', paytype = 'check', ispay = 'true', saasid = '".$_SESSION['saasid']."'");
$df=mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$_REQUEST['bankaccnt']."' AND saasid='".$_SESSION['saasid']."'"));

$dedbank = $df["fld4"] - $padAmn;

mysql_query("UPDATE ledger_tabs SET fld4 = '$dedbank' WHERE glid = '".$_REQUEST['bankaccnt']."' AND saasid='".$_SESSION['saasid']."'");	
	}
}
}
		echo 'pass';
	}
}
	
}

////ENTER JOURNAL STUFF///
if($act == 'getjorform'){
echo '
<div style="padding:20px;">Select Date:<br><input style="float:left" name="jrndate" id="jrndate" type="text" value = "'.date('m/d/Y').'"/></div>
<div style="clear:both; height:30px;"></div>

<div class="infohead">
    <div class="headtext" style="width: 300px; border-right:solid thin #000; border-left:solid thin #CCC;">GL Account</div>
    <div class="headtext" style="width: 320px; border-right:solid thin #000; border-left:solid thin #CCC;">Memo</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Debit</div>
    
</div>

<div class="infoheadlines">
<div class="headtext2" style="width: 300px;"><select name="glselect" id="glselect"><option value="none">Select GL Account</option>';

$r=mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct != 'none' OR active = 'true' AND saasid = '".$_SESSION['saasid']."' AND type = 'bank' ORDER BY fld1 ASC");
	while($gh = mysql_fetch_array($r)){
	echo '<option value="'.$gh["glid"].'">'.$gh["fld1"].'</option>';	
	}
	
	$r=mysql_query("SELECT * FROM vendors WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' ORDER BY ven_id ASC");
	while($gh = mysql_fetch_array($r)){
	echo '<option value="vend-'.$gh["ven_id"].'">'.$gh["ven_name"].'</option>';	
	}echo '</select></div>';


echo '<div class="headtext2" style="width: 320px;"><input style="width: 290px; background-color:#FFF;" name="memo" id="memo" type="text"></div>
<div class="headtext2" style="width: 90px;"><input style="width:90px; background-color:#FFF;" name="amountded" id="amountded" type="text" onblur="runtoCred(this.value)"></div>
</div>

  <div class="infohead">
    <div class="headtext" style="width: 300px; border-right:solid thin #000; border-left:solid thin #CCC;">Memo</div>
    <div class="headtext" style="width: 428px; border-right:solid thin #000; border-left:solid thin #CCC;">GL Account</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Credit</div>
    
</div>

<div class="infoheadlines">
<div class="headtext2" style="width: 300px;"><select name="glselec2t" id="glselect2"><option value="none">Select GL Account</option>';

$r=mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct != 'none' OR active = 'true' AND saasid = '".$_SESSION['saasid']."' AND type = 'bank' ORDER BY fld1 ASC");
	while($gh = mysql_fetch_array($r)){
	echo '<option value="'.$gh["glid"].'">'.$gh["fld1"].'</option>';	
	}
	
	$r=mysql_query("SELECT * FROM vendors WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' ORDER BY ven_id ASC");
	while($gh = mysql_fetch_array($r)){
	echo '<option value="vend-'.$gh["ven_id"].'">'.$gh["ven_name"].'</option>';	
	}
	
	echo'</select></div>
<div class="headtext2" style="width: 428px;"><input style="width: 290px; background-color:#FFF;" name="memo2" id="memo2" type="text"></div>
<div class="headtext2" style="width: 90px;"><input style="width:90px; background-color:#FFF;" name="amountded2" id="amountded2" type="text"></div>
</div>
    
    
    <div style="height:40px; width:100%; margin-top:40px;">
    <div id="savejro" style="float:right" onClick="subJourn()">Save</div>
    <div style="float:right; margin-right: 15px; margin-top: 5px;"><a href="javascript:canjorn()">Cancel</a> | </div>
    </div>';	
}

///ENTER THE JORUNAL DETAILS////
//subjornal&memo='+memo+'&glselect='+glselect+'&amountded='+amountded+'&memo2='+memo2+'&glselect2='+glselect2+'&amountded2
if($act == 'subjornal'){
	$jrndate = mysql_real_escape_string($_REQUEST['jrndate']);
	$memo = mysql_real_escape_string($_REQUEST['memo']);
	$glselect = mysql_real_escape_string($_REQUEST['glselect']);
	$amountded = mysql_real_escape_string($_REQUEST['amountded']);
	$memo2 = mysql_real_escape_string($_REQUEST['memo2']);
	$glselect2 = mysql_real_escape_string($_REQUEST['glselect2']);
	$amountded2 = mysql_real_escape_string($_REQUEST['amountded2']);
	
	$br = explode("-",$glselect);
	$br2 = explode("-",$glselect2);
	
	if($br[0] == 'vend'){$vendor = $br[1]; $glselect = '';}else{$vendor = ''; $glselect = $glselect;}
	if($br2[0] == 'vend'){$vendor2 = $br2[1]; $glselect2 = '';}else{$vendor = ''; $glselect = $glselect;}
	
	echo $br[0].'<br>'.$br2[0];
	
	if($br[0] != 'vend'){
	$er = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$glselect'"))or die(mysql_error());
	}
	
	if($br2[0] != 'vend'){
	$yu = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$glselect2'"))or die(mysql_error());
	}
	
	if($br[0] != 'vend'){
	if($er["type"] == 'bank'){
		$ded = $er["fld4"] - $amountded;
		mysql_query("UPDATE ledger_tabs SET fld4 = '$ded' WHERE  glid = '$glselect'")or die(mysql_error());
		$paidid = $glselect;
	}else{
		$paidid = '';
	}
	}
	if($br[0] != 'vend'){
	if($yu["type"] == 'bank'){
		$add = $yu["fld4"] + $amountded2;
		mysql_query("UPDATE ledger_tabs SET fld4 = '$add' WHERE  glid = '$glselect2'")or die(mysql_error());
		$isdep = 'deposit';
	}else{
		$isdep = '';
	}
	}
	
	mysql_query("INSERT INTO journal_entry SET memo = '$memo', glacct = '$glselect', vendor = '$vendor', debit = '$amountded', memo2 = '$memo2', glacct2 = '$glselect2', vendor2 = '$vendor2', credit = '$amountded2', saasid = '".$_SESSION['saasid']."', dateset = '".$jrndate."'")or die(mysql_error());
	
	$rtp = mysql_fetch_array(mysql_query("SELECT * FROM journal_entry WHERE saasid = '".$_SESSION['saasid']."' ORDER BY jor_id ASC"));
	
	mysql_query("INSERT INTO transandpays SET date = '".$jrndate."', numtype = 'Journal Entry', memo = '$memo', gl_act = '$glselect', vendor = '$vendor',  payment = '$amountded', status = 'open', jorn_num = '".$rtp["jor_id"]."', saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
	
	
	mysql_query("INSERT INTO transandpays SET date = '".$jrndate."', numtype = 'Journal Entry', memo = '$memo2', gl_act = '$glselect2', vendor = '$vendor2', payment = '$amountded2', paidby = '$paidid', paytype = '$isdep', jorn_num = '".$rtp["jor_id"]."', ispay = 'true', saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
	
	
	
	echo 'good';
}



///EDIT THE JORUNAL DETAILS////
//subjornal&memo='+memo+'&glselect='+glselect+'&amountded='+amountded+'&memo2='+memo2+'&glselect2='+glselect2+'&amountded2
if($act == 'subjornaled'){
	$jrndate = mysql_real_escape_string($_REQUEST['jrndate']);
	$memo = mysql_real_escape_string($_REQUEST['memo']);
	$glselect = mysql_real_escape_string($_REQUEST['glselect']);
	$amountded = mysql_real_escape_string($_REQUEST['amountded']);
	$memo2 = mysql_real_escape_string($_REQUEST['memo2']);
	$glselect2 = mysql_real_escape_string($_REQUEST['glselect2']);
	$amountded2 = mysql_real_escape_string($_REQUEST['amountded2']);
	
	$rh = mysql_fetch_array(mysql_query("SELECT * FROM journal_entry WHERE jor_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));
	
	$br = explode("-",$glselect);
	$br2 = explode("-",$glselect2);
	
	if($br[0] == 'vend'){$vendor = $br[1]; $glselect = '';}else{$vendor = ''; $glselect = $glselect;}
	if($br2[0] == 'vend'){$vendor2 = $br2[1]; $glselect2 = '';}else{$vendor = ''; $glselect = $glselect;}
	
	echo $br[0].'<br>'.$br2[0];
	
	if($br[0] != 'vend'){
	$er = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$glselect'"))or die(mysql_error());
	}
	
	if($br2[0] != 'vend'){
	$yu = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$glselect2'"))or die(mysql_error());
	}
	
	if($br[0] != 'vend'){
	if($er["type"] == 'bank'){
		$ded = $er["fld4"] - $amountded;
		//mysql_query("UPDATE ledger_tabs SET fld4 = '$ded' WHERE  glid = '$glselect'")or die(mysql_error());
		$paidid = $glselect;
	}else{
		$paidid = '';
	}
	}
	if($br[0] != 'vend'){
	if($yu["type"] == 'bank'){
		$add = $yu["fld4"] + $amountded2;
		//mysql_query("UPDATE ledger_tabs SET fld4 = '$add' WHERE  glid = '$glselect2'")or die(mysql_error());
		$isdep = 'deposit';
	}else{
		$isdep = '';
	}
	}
	
	mysql_query("UPDATE journal_entry SET memo = '$memo', glacct = '$glselect', vendor = '$vendor', debit = '$amountded', memo2 = '$memo2', glacct2 = '$glselect2', vendor2 = '$vendor2', credit = '$amountded2', dateset = '".$jrndate."' WHERE saasid = '".$_SESSION['saasid']."' AND jor_id = '".$_REQUEST['id']."'")or die(mysql_error());
	
	
	mysql_query("UPDATE transandpays SET date = '".$jrndate."', numtype = 'Journal Entry', memo = '$memo', gl_act = '$glselect', vendor = '$vendor',  payment = '$amountded', status = 'open' WHERE jorn_num = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."' AND ispay = ''")or die(mysql_error());
	
	
	mysql_query("UPDATE transandpays SET date = '".$jrndate."', numtype = 'Journal Entry', memo = '$memo2', gl_act = '$glselect2', vendor = '$vendor2', payment = '$amountded2', paidby = '$paidid', paytype = '$isdep' WHERE jorn_num = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."' AND ispay = 'true'")or die(mysql_error());
	
	
	
	echo 'good';
}

if($act == 'deljourns'){
	
	mysql_query("DELETE  FROM transandpays WHERE jorn_num = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
	mysql_query("DELETE  FROM journal_entry WHERE jor_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
	
}

///get journ line list////
if($act == 'getjourns'){
	
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
	$query  = "SELECT customers.companyname, customers.cust_id, customers.zip, customers.state, customers.county, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.companyname LIKE '$serc%' AND customers.saasid = '".$_SESSION['saasid']."' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.zip LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.state LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.county LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.firstname LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND CONCAT(contacts.firstname, ' ', contacts.lastname)  LIKE '$serc%' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";
	
}else{
$query  = "SELECT * FROM journal_entry WHERE saasid='".$_SESSION['saasid']."' ORDER BY jor_id $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	
			while($rgl = mysql_fetch_array($result)){
				
				$ty=mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$rgl["glacct2"]."' AND saasid = '".$_SESSION['saasid']."'"));
				
				echo '<div class="infoheadlines">
<div class="headtext2" style="width: 110px;">07/18/2012</div>
<div class="headtext2" style="width: 107px;">'.$rgl["jor_id"].'</div>
<div class="headtext2" style="width: 605px;">'.$ty["fld1"].'</div>
<div class="headtext2" style="width: 70px; text-align: center;">
<div class="edit_icon" title="Edit" style="margin-right:6px;" onclick="edJrnen(\''.$rgl["jor_id"].'\')"></div>
<div class="delete_icon" title="Delete" onclick="delJrnent(\''.$rgl["jor_id"].'\')"></div>
</div></div>';	

			}
	
	
 $query   = "SELECT COUNT(jor_id) AS numrows FROM journal_entry WHERE saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="getLines(\'loans\',\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="getLines(\'loans\',\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="getLines(\'loans\',\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right; margin-top:10px">'.$first .  $next .$nav . $last.'</div>
<div style="clear:both"></div>
';

}


////EDIT THE ENTRYS FOR JOURNALS//////
if($act == 'editjorn'){
	$er = mysql_fetch_array(mysql_query("SELECT * FROM journal_entry WHERE jor_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'"));
	
echo '
<div style="padding:20px;">Select Date:<br><input style="float:left" name="jrndate" id="jrndate" type="text" value = "'.date('m/d/Y').'"/></div>
<div style="clear:both; height:30px;"></div>

<div class="infohead">
    <div class="headtext" style="width: 300px; border-right:solid thin #000; border-left:solid thin #CCC;">GL Account</div>
    <div class="headtext" style="width: 320px; border-right:solid thin #000; border-left:solid thin #CCC;">Memo</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Debit</div>
    
</div>

<div class="infoheadlines">
<div class="headtext2" style="width: 300px;"><select name="glselect" id="glselect"><option value="none">Select GL Account</option>';

$r=mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct != 'none' OR active = 'true' AND saasid = '".$_SESSION['saasid']."' AND type = 'bank' ORDER BY fld1 ASC");
	while($gh = mysql_fetch_array($r)){
		if($gh["glid"] == $er["glacct"]){
	echo '<option value="'.$gh["glid"].'" selected="selected">'.$gh["fld1"].'</option>';
		}else{
		echo '<option value="'.$gh["glid"].'">'.$gh["fld1"].'</option>';	
		}
	}
	
	echo '</select></div>';


echo '<div class="headtext2" style="width: 320px;"><input style="width: 290px; background-color:#FFF;" name="memo" id="memo" type="text" value="'.$er["memo"].'"></div>
<div class="headtext2" style="width: 90px;"><input style="width:90px; background-color:#FFF;" name="amountded" id="amountded" type="text" onblur="runtoCred(this.value)" value ="'.$er["debit"].'"></div>
</div>

  <div class="infohead">
    <div class="headtext" style="width: 300px; border-right:solid thin #000; border-left:solid thin #CCC;">Memo</div>
    <div class="headtext" style="width: 428px; border-right:solid thin #000; border-left:solid thin #CCC;">GL Account</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;">Credit</div>
    
</div>

<div class="infoheadlines">
<div class="headtext2" style="width: 300px;"><select name="glselec2t" id="glselect2"><option value="none">Select GL Account</option>';

$r=mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid = '".$_SESSION['saasid']."' AND subacct != 'none' OR active = 'true' AND saasid = '".$_SESSION['saasid']."' AND type = 'bank' ORDER BY fld1 ASC");
	while($gh = mysql_fetch_array($r)){
		if($er["glacct2"] == $gh["glid"]){
			echo '<option value="'.$gh["glid"].'" selected="selected">'.$gh["fld1"].'</option>';
		}else{
		echo '<option value="'.$gh["glid"].'">'.$gh["fld1"].'</option>';	
		}
	}
	
	
	
	echo'</select></div>
<div class="headtext2" style="width: 428px;"><input style="width: 290px; background-color:#FFF;" name="memo2" id="memo2" type="text"  value="'.$er["memo2"].'"></div>
<div class="headtext2" style="width: 90px;"><input style="width:90px; background-color:#FFF;" name="amountded2" id="amountded2" type="text" value="'.$er["credit"].'"></div>
</div>
    
    
    <div style="height:40px; width:100%; margin-top:40px;">
    <div id="savejro" style="float:right" onClick="edsJourn(\''.$_REQUEST['id'].'\')">Save</div>
    <div style="float:right; margin-right: 15px; margin-top: 5px;"><a href="javascript:canjorn()">Cancel</a> | </div>
    </div>';		
}


///GET NUMBER IN WORDS FOR SINGLE CHECK///
if($act == 'getnum'){
	include('num_converter.php');
	
	$exk = explode('.', $_REQUEST['amount']);
				
					$dollars = $exk[0];
					$cents = $exk[1];
					
						$dollarPres = convertNum($dollars).' and';
						$centsPres = convertNum($cents).'/100';
						
						$fullOutput = "$dollarPres $cents/100";
						
						$cnt = strlen($fullOutput);
						
						$extra = 88 - $cnt;

						$shove = "****************************************************************************************";
						$mount  = "this is $extra - $cnt";
						$finLine = substr($shove, 0, $extra);
						
							$outPut = "$fullOutput $finLine";
							
							echo $outPut;
	
}

/////INVOICE PAYMET REVISION///
if($act == 'grabform'){
	
		
		
		$rto = mysql_query("SELECT * FROM invoice_payments WHERE pay_id = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
		
			$f=mysql_fetch_array($rto);
			
		
		
echo '<div id="telem" style="margin-bottom:20px; font-size:17px">Post a Customer Payment</div>
    
    <div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Date:<br>
    <input style="float:left" class="makerrs" name="setdate" id="setdate" type="text" value="'.$f["date"].'">
    </div>
    
     <div style="width:300px; height:40px; float:left">
	 Select Bank for Funds:<br>
	 <select name="bankset" id="bankset" class="makerrs" ><option value="none" selected="selected">Select Bank...</option>';
	 $rt=mysql_query("SELECT * FROM ledger_tabs WHERE type = 'bank' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
	 	while($er = mysql_fetch_array($rt)){
			if($f["bankset"] == $er["glid"]){
		echo '<option value="'.$er["glid"].'" selected="selected">'.$er["fld1"].'</option>';
			}else{
			echo '<option value="'.$er["glid"].'">'.$er["fld1"].'</option>';	
			}
		}
	 
	 
	 
	 echo'</select>
     </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Check #:<br>
    <input style="float:left" class="makerrs" name="checknum" id="checknum" type="text" value="'.$f["checknum"].'">
    </div>
   
     <div style="width:300px; height:40px; float:left">Amount:<br>
       $<input class="makerrs" name="amountbn" id="amountbn" type="text" value="'.$f["amount"].'" />
     </div>
    </div>
    
    <div style="height:30px; margin-bottom:20px; border-bottom:solid thin #333;"></div>
    
    Notes:<br>
    <textarea style="width:600px; height:108px;" class="makerrs" name="notes" id="notes" cols="" rows="">'.$f["notes"].'</textarea><br>
    
    <div style="padding:20px;"><div style="float:left" name="subbuts" id="subbuts" onClick="subpayedit(\''.$_REQUEST['id'].'\')">Edit Payment</div> <div style="float:left; margin-left:20px; padding-top:5px">| <a href="javascript:canPay()">Cancel</a></div></div>';	
}


/////ADDS PAYMENTS TO INVOICE///
if($act == 'raddspays'){
	$invid = $_REQUEST['invid'];
	$setdate = mysql_real_escape_string($_REQUEST['setdate']);
	$checknum = mysql_real_escape_string($_REQUEST['checknum']);
	$amount = mysql_real_escape_string($_REQUEST['amount']);
	$notes = mysql_real_escape_string($_REQUEST['notes']);
	$bank = mysql_real_escape_string($_REQUEST['bank']);
	
	$rtog = mysql_fetch_array(mysql_query("SELECT * FROM invoice_payments WHERE pay_id = '$invid' AND saasid = '".$_SESSION['saasid']."'"));
	
	
	$yo = mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$rtog["inv_num"]."' AND saasid = '".$_SESSION['saasid']."'"));
	
		$value = str_replace(',','',$yo["value"]);
		
		$rto = mysql_query("SELECT * FROM invoice_payments WHERE pay_id = '$invid' AND saasid = '".$_SESSION['saasid']."'");
		$ars = 0;
			while($f=mysql_fetch_array($rto)){
				
				$ars += $f["amount"];
				
			}
			
			
		
		$deduct = $value-$ars;
		
	
		
		if($amount > $deduct){
			
			die('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Amount submitted for payment is larger than the amount needed for completion of invoice.</span>');
			
		}else{
		
	
	mysql_query("UPDATE invoice_payments SET date = '$setdate', checknum = '$checknum', amount = '$amount', notes = '$notes', bankset = '$bank' WHERE pay_id = '$invid'");
	echo 'good';
		}
}


////DELETE EXPENSE/////
//runchks
if($act == 'runchks'){
	$y = mysql_query("SELECT * FROM ledger_tabs WHERE subacct = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
	
		if(mysql_num_rows($y) > 0){
			echo 'There are currently sub accounts attached to this expense GL. Please remove them before continuing.';
		}else{
			mysql_query("UPDATE ledger_tabs SET active = 'false' WHERE glid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
			echo 'good';
		}
	
}

///CHANGE NAME OF GL///
//updatethename&gllnmm
if($act == 'updatethename'){
	mysql_query("UPDATE ledger_tabs SET fld1 = '".mysql_real_escape_string($_REQUEST['gllnmm'])."' WHERE glid = '".$_REQUEST['id']."' AND saasid = '".$_SESSION['saasid']."'");
	
}