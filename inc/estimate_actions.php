<?php

error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];


//////----------------------------------Begin Estimate Actions-----------------------------------------////////


///GET ESTIMATE LIST////
if($act == 'getlist'){
	
		$dir = $_REQUEST['direction'];
		
		if($dir == ''){
			$dirs = 'ASC';
			$ico = 'desc_arr';	
		}else{
			if($dir == 'ASC'){
			$dirs = 'DESC';	
			$ico = 'asc_arr';
			}else{
				$dirs = 'ASC';
				$ico = 'desc_arr';	
			}
			
		}
	
	
	
	///sub header output///
	echo '<div class="infohead">
	<div class="headtext" style="width: 40px; border-right:solid thin #000; ">ID</div>
	<div class="headtext" style="width: 160px; border-right:solid thin #000; cursor:pointer;border-left: solid thin #CCC;" onclick="sortEsti(\''.$dirs.'\',\''.$_REQUEST['page'].'\')">Customer Name <img src="images/'.$ico.'.png" width="9" height="9"></div>
    <div class="headtext" style="width: 140px; border-right:solid thin #000; border-left:solid thin #CCC;">Location</div>
    <div class="headtext" style="width: 80px; border-right:solid thin #000; border-left:solid thin #CCC;">Total Price</div>
    <div class="headtext" style="width: 99px; border-right:solid thin #000; border-left:solid thin #CCC;">Issue Date</div>
	<div class="headtext" style="width: 99px; border-right:solid thin #000; border-left:solid thin #CCC;">Follow Up</div>
	<div class="headtext" style="width: 80px; border-right:solid thin #000; border-left:solid thin #CCC;">Days Left</div>
	<div class="headtext" style="width: 70px; border-right:solid thin #000; border-left:solid thin #CCC;">Status</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>';


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
	
	$ghn = mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE companyname like '$serc%' AND saasid='".$_SESSION['saasid']."'"))or die(mysql_error());
	
	//echo 'set';
	$query  = "SELECT * FROM core_docs WHERE company_id = '".$ghn["cust_id"]."' AND doc_type = 'estimate' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND status != 'won' ORDER BY doc_id $dirs LIMIT $offset, $rowsPerPage";
	
	
}else{

$query  = "SELECT * FROM core_docs WHERE doc_type = 'estimate' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' AND status != 'won' ORDER BY doc_id $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:20px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Active Estimates..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				$y = mysql_fetch_array(mysql_query("SELECT * FROM locations WHERE locid = '".$h["location"]."' AND saasid='".$_SESSION['saasid']."'"));
				
					$sel = mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$h["company_id"]."'"));
				
					if(strlen($sel["company_name"]) > 20){$compnm = substr($sel["companyname"], 0, 18).'...';}else{$compnm = $sel["companyname"];}
						if(strlen($y["address1"]) > 18){$loc = substr($y["address1"], 0, 16).'...';}else{$loc = $y["address1"];}
						
							if($h["status"] == 'pending'){
								$seclass = 'infoheadlines';
							}
							
							if($h["status"] == 'lost'){
								$seclass = 'infoheadlines3';
							}
				
				echo '<div class="'.$seclass.'">
				
						<div class="headtext2" style="width: 40px;">'.$h["doc_id"].'</div>
   							 <div class="headtext2" style="width: 162px;">'.$compnm.'</div>
   								 <div class="headtext2" style="width: 141px;">'.$loc.'</div>
    						<div class="headtext2" style="width: 80px;">'.$h["value"].'</div>
                            <div class="headtext2" style="width: 100px;">'.$h["issue_date"].'</div>
                            <div class="headtext2" style="width: 101px;">'.$h["follow_up"].'</div>
                            <div class="headtext2" style="width: 82px;">'.$h["days_left"].'</div>
                            <div id="stater'.$h["doc_id"].'" class="headtext2" style="width: 77px;"><span onClick="runDrops(\''.$h["status"].'\',\''.$h["doc_id"].'\')">'.$h["status"].'</span></div>
   						 <div class="headtext2" style="width:95px; text-align:center">
                         <div class="pdf_icon" title="Download PDF" style="margin-left:6px; margin-right:6px;" onclick="window.open(\'genPDF.php?docid='.$h["doc_id"].'\')"></div>
   					 <div class="edit_icon" title="Edit" style="margin-right:6px;"  onclick="geteditEstform(\''.$h["doc_id"].'\')"=""></div>
    			<div class="delete_icon" title="Delete" onclick="delEsti(\''.$h["doc_id"].'\')"=""></div>
   			 </div>
		</div>';
			}
	}
 $query   = "SELECT COUNT(doc_id) AS numrows FROM core_docs WHERE active='true' AND saasid = '".$_SESSION['saasid']."' AND doc_type = 'estimate'";
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
		$nav .= '<div class="pagnull" onclick="recallEsti(\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="recallEsti(\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="recallEsti(\''.$maxPage.'\')">Last</div>';
} 
else
{
	$next = '&nbsp;'; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo '<div style="clear:both"></div>';
echo '<div style="padding-right:5px; padding-top:5px; float:right">'.$first .  $next .$nav . $last.'</div>';
}

////STATUS CHAGES IN DROP DOWN LIST////

if($act == 'getstatdrop'){
	if($_REQUEST['setval'] == 'Pending'){$p = 'selected="selected"';}else{$p = '';}
	if($_REQUEST['setval'] == 'Won'){$w = 'selected="selected"';}else{$w = '';}
	if($_REQUEST['setval'] == 'Lost'){$l = 'selected="selected"';}else{$l = '';}
	echo '<select id="trustat" name="trustat" onChange="runstsSet(\''.$_REQUEST['sentid'].'\',this.value)"><option '.$p.' value="Pending">Pending..</option><option '.$w.' value="won">Won</option><option '.$l.' value="lost">Lost</option></select>';
	
}



////PULL NEW ESTIMATE ADD FORM//////

if($act == 'getaddest'){
	
	
	$p = mysql_num_rows(mysql_query("SELECT * FROM core_docs WHERE rowstate = 'unused' AND doc_type = 'estimate' AND saasid = '".$_SESSION['saasid']."'"));
	if($p < 1){
	mysql_query("INSERT INTO core_docs SET rowstate = 'unused', doc_type = 'estimate', saasid = '".$_SESSION['saasid']."'");
		////get the created id//
			$p = mysql_query("SELECT * FROM core_docs WHERE rowstate = 'unused' AND doc_type = 'estimate' AND saasid = '".$_SESSION['saasid']."' ORDER BY doc_id DESC");
				$id = mysql_fetch_array($p);
					$docId = $id["doc_id"];
	}else{
		
		$p = mysql_query("SELECT * FROM core_docs WHERE rowstate = 'unused' AND doc_type = 'estimate' AND saasid = '".$_SESSION['saasid']."' ORDER BY doc_id DESC");
				$id = mysql_fetch_array($p);
					$docId = $id["doc_id"];
		
	}
	
	
	
echo '<!--top info plus status-->
<input name="docid" id="docid" type="hidden" value="'.$docId.'" />
<div style="font-size:25px; font-style:italic; font-weight:bold; padding-left:15px; height:80px">Estimate Details
<div style="float:right; margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px">
<span style="font-size:14px; padding-bottom:20px">Status</span>
<select style="width:134px;" class="make" id="status" name="status">
<option value="pending">Pending</option>
<option value="won">Won</option>
<option value="lost">Lost</option>
</select>
</div>

</div>

<div style="clear:both"></div>
<!--end-->

<div style="height:190px;">

<div style="width:400px; height:170px; float:left; padding-left:15px">

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Company</div>
<div style="padding-bottom:20px; float:left">
<select class="make" id="comp" name="comp" onchange="runCons(this.value), runLocs(this.value)"">
<option value="none" selected="selected">Select Company...</option>
';

$k=mysql_query("SELECT * FROM customers WHERE active = 'true' AND saasid='".$_SESSION['saasid']."' ORDER BY companyname ASC");

	while($a = mysql_fetch_array($k)){
		echo '<option value="'.$a["cust_id"].'">'.$a["companyname"].'</option>';
	}

echo '</select>
</div>
</div>

<div style="clear:both"></div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Salesman</div>
<div style="padding-bottom:20px; float:left">';


$n=mysql_query("SELECT * FROM core_users WHERE active = 'true' AND usrtyp = 'salesman' AND saasid='".$_SESSION['saasid']."' ORDER BY fname ASC");

if(mysql_num_rows($n) > 0 ){
echo '<select class="make" id="salesman" name="salesman"><option value="none" selected="selected">Select salesman...</option>';
	while($b = mysql_fetch_array($n)){
		echo '<option value="'.$b["usr_id"].'">'.$b["fname"].' '.$b["lname"].'</option>';
	}
}else{
	echo '<select disabled="disabled" class="make" id="comp" name="comp">';
	echo '<option value="none" selected="selected">No salesman in list...</option>';
}



echo '</select>
</div>
</div>

<div style="clear:both"></div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Valid Until</div>
<div style="padding-bottom:20px; float:left">
<input class="make" name="estdt" id="estdt" type="text">
</div>
</div>



</div>



<div style="width:400px; height:170px; float:left;">

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Contact</div>
<div id="estconssd" style="padding-bottom:20px; float:left">
<select class="make" id="estcont" name="estcont" disabled="disabled">
<option value="none">Select Company First...</option>
</select>
</div>
</div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Location</div>
<div id="estlocss" style="padding-bottom:20px; float:left">
<select class="make" id="estloc" name="estloc" disabled="disabled">
<option value="none">Select Company First...</option>
</select>
</div>
</div>







<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Type</div>
<div style="padding-bottom:20px; float:left">

    <label style="font-size:12px">
      <input class="make" type="radio" name="RadioGroup1" value="sales" id="RadioGroup1" onClick="changeRent(\'products\')">
      Sales</label>

    <label style="font-size:12px">
      <input class="make" type="radio" name="RadioGroup1" value="rent" id="RadioGroup1" onClick="changeRent(\'rental\')">
      Rent</label>

</div>
</div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">PO #</div>
<div id="estlocss" style="padding-bottom:20px; float:left">
<input class="make" name="pofld" id="pofld" type="text" />
</div>
</div>



</div>




</div>



<div style="padding:10px; margin-left:20px"><a href="javascript:openFilesset()">Attach File</a></div>
	
	  <div id="boundedfiles" style="width:977px; height:108px; overflow-y:scroll; background-color: #f2f0f1; margin-bottom:20px; margin-left:20px"></div>
	  
	  

<div style="height:3px; margin-left:15px; margin-right:15px; border-bottom:solid thin #999;"></div>

<div id="addcrt" style="margin-left: 40px; margin-top: 20px; margin-bottom: 20px;" onClick="addProdiserv()">Add Product / Services</div>

<!--product and service hold-->
<div style="margin-top:20px">
<div class="infohead" style="width:940px; margin:auto">
	<div class="headtext" style="width: 160px; border-right:solid thin #000; border-left: solid thin #CCC;">Item Code</div>
    <div class="headtext" style="width: 210px; border-right:solid thin #000; border-left:solid thin #CCC;">Description</div>
    <div class="headtext" style="width: 80px; border-right:solid thin #000; border-left:solid thin #CCC;">Quanity</div>
    <div class="headtext" style="width: 99px; border-right:solid thin #000; border-left:solid thin #CCC;">Price</div>
	<div class="headtext" style="width: 99px; border-right:solid thin #000; border-left:solid thin #CCC;">Tax</div>
	<div class="headtext" style="width: 80px; border-right:solid thin #000; border-left:solid thin #CCC;">Total</div>
    <div class="headtext" style="width:80px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<!--end-->



<div id="itmhold" style="width:936px; height:290px; overflow-y:scroll; margin:auto; border:solid thin #CCC;">



</div>






</div>

<div id="tothold" style="width:940px; height:150px; margin:auto; padding-top:15px;">
<input name="isact"  id="isact" type="hidden" value="new" />


</div>



<div style="width:940px; height:200px; margin:auto; padding-top:25px;">

<div style="width:452px; height:130px; float:left;">Payment Terms<br><textarea style="width:432px; height:102px; resize:none" name="payterms" id="payterms" cols="" rows=""></textarea></div>
<div style="width:452px; height:130px; float:left;">Notes<br><textarea style="width:432px; height:102px; resize:none" name="notes" id="notes" cols="" rows=""></textarea></div>


<div style="padding-top:20px; padding-bottom:20px; height:50px">

<div style="float:left; margin-top:30px; margin-bottom:30px" id="addsestbut" onclick="finEsti()">Save Estimate</div>

</div>


</div>';	
}

////GET CONTACT BASED ON COMPANY SELECTION////

if($act == 'getcons'){
	$d = mysql_query("SELECT * FROM contacts WHERE blong = '".$_REQUEST['compid']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
	echo '<input name="cliids" id="cliids" type="hidden" value="'.$_REQUEST['compid'].'" />';
	echo '<select class="maker" id="estcont" name="estcont"><option value="none">Contacts Available...</option>';
		while($t = mysql_fetch_array($d)){
		echo '<option value="'.$t["cont_id"].'">'.$t["firstname"].' '.$t["lastname"].'</option>';	
		}
		echo'</select>';
}

////GET LOCATIONS BASED ON CONTACT SELECTION////

if($act == 'getlocs'){
		$d = mysql_query("SELECT * FROM locations WHERE blong = '".$_REQUEST['compid']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
	echo '<select class="makerloc" id="estloc" name="estloc"><option value="none">Locations Available...</option>';
		while($t = mysql_fetch_array($d)){
		echo '<option value="'.$t["locid"].'">'.$t["address1"].' '.$t["city"].'</option>';	
		}
		echo'</select>';
}


/////PULL PRODUCT / SERVICE ADD FORM/////

if($act == 'getproservlist'){
	echo '<div style="width:353px; height:118px; float:left">
    
    <div style="font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Select Item</div>
<div id="taxcont" style="padding-bottom:20px; float:left">
<select class="makeitem" id="productservi" name="productservi" onchange="getitemPric(this.value)"><option value="none" selected="selected">Select a product or service...</option><option style="color:#2669B7;" disabled>------------Products----------</option>';

if($_REQUEST['type'] == 'sales'){
	$itmTy = 'product';
}else{
$itmTy = 'asset';	
}

$get = mysql_query("SELECT * FROM productservi WHERE active = 'true' AND item_typ = '$itmTy' AND saasid = '".$_SESSION['saasid']."'");

	while($f = mysql_fetch_array($get)){
		if($_REQUEST['type'] == 'sales'){
			$price = $f["price"];
		}else{
			$price = $f["rental"];
		}
		echo '<option value="'.$f["items_ids"].'?'.$price.'">'.$f["item_name"].'</option>';
	}
	
	echo '<option style="color:#2669B7;" disabled>------------Services----------</option>';
	
	$get = mysql_query("SELECT * FROM productservi WHERE active = 'true' AND item_typ = 'service' AND saasid = '".$_SESSION['saasid']."'");

	while($f = mysql_fetch_array($get)){
		echo '<option value="'.$f["items_ids"].'?'.$f["price"].'">'.$f["item_name"].'</option>';
	}

echo'</select>
</div>
</div>

<div style="font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Product Price</div>
<div id="taxcont" style="padding-bottom:20px; float:left">
<input style="width:75px" class="makeitem" name="proservprice" id="proservprice" type="text" value="0.00">
</div>
</div>

<div style="font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Quanity</div>
<div id="taxcont" style="padding-bottom:20px; float:left">
<input style="width:75px" class="makeitem" name="quant" id="quant" type="text">
</div>
</div>
    
    
    </div>
    
    <div style="width:218px; height:118px; float:left">
    
    <div style="font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; padding-right:3px; float:left; width:150px; text-align:right">Exclude Tax </div>
<div id="taxcont" style="padding-bottom:20px; float:left">
<input class="makeitem" name="extax" id="extax" type="checkbox" value="true">
</div>
</div>
    
</div>

<div id="truadd" style="float:right" onclick="addItm()">Add Item</div>';
}


/////ADD PRODUCTS & SERVICES AND DEDUCT FOR INVENTORY//////

if($act == 'additem'){
	$itemid = $_REQUEST['itemid'];
	$quant = $_REQUEST['quant'];
	$docid = $_REQUEST['docid'];
	$istax = $_REQUEST['istax'];
	$proservprice = $_REQUEST['proservprice'];
	
	$r = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '$itemid' AND saasid='".$_SESSION['saasid']."'"));
	
		$deductInv = $r["inventory"] - $quant;
		
			if($deductInv < 1 && $r["item_typ"] != 'service'){
				$status = 'Out of stock';
			}else{
				$status = 'In Stock';
			}
			
			if($r["item_typ"] == 'service'){
				$deductInv = '';
			}
		
			mysql_query("UPDATE productservi SET inventory = '$deductInv', status = '$status' WHERE items_ids = '$itemid' AND saasid='".$_SESSION['saasid']."'");
	
		
		
		mysql_query("INSERT INTO doc_items SET tru_id = '$itemid',	sku='".$r["sku"]."',	item_dec='".$r["decs"]."', item_name='".$r["item_name"]."', item_price='$proservprice', is_tax='$istax', quant='$quant', doc_id='$docid', saasid='".$_SESSION['saasid']."', itmtyp='".$r["item_typ"]."'");
		
		mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimates.php', action = 'Added Product - $itemid', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}


/////PULL ITEMS LIST////

if($act == 'getitmelist'){
	$a = mysql_query("SELECT * FROM doc_items WHERE doc_id='".$_REQUEST['doc_id']."' AND saasid='".$_SESSION['saasid']."'");
	
		while($b = mysql_fetch_array($a)){
			
			if($b["sku"] == ''){
			$sku = '-service-';	
			}else{
				$sku = $b["sku"];
			}
			//31
			$desclen = strlen($b["item_dec"]);
			if($desclen > 31){
				$cutdes = substr($b["item_dec"], 0, 31).'...';
			}else{
				$cutdes = $b["item_dec"];
			}
		
			$totalEac = $b["item_price"] * $b["quant"];
			
			
			//////tax part////
			
			$d = mysql_fetch_array(mysql_query("SELECT * FROM locations WHERE locid = '".$_REQUEST['locid']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
				
				
					$runTxa = explode(",",$d["taxs"]);
					$Tax = 0;
						foreach ($runTxa as $idat){
							
							//echo $idat.'<br>';
							$ops = mysql_fetch_array(mysql_query("SELECT * FROM tax_table WHERE tax_id = '$idat' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
					//echo $ops['percent'].'<br>'.$subTottax;
					$Tax += round( (($totalEac * $ops['percent']) / 100 ), 2);
						
					
						}
						
						//echo $Taxerset;
						
						if($b["is_tax"] == 'true'){
						
						$totAll = number_format ($totalEac+$Tax,2);
						
						}else{
						$totAll = number_format ($totalEac,2);
						$Tax = '0.00';	
						}
			
			
			
			echo '<div class="infoheadlines" style="position:reletive">
			<div id="ld'.$b["itm_id"].'" style="position:absolute; right:56px; top:19px; display:none"><img src="images/sml_load.gif" width="16" height="16" /></div>
						<div class="headtext2" style="width: 160px; border-right:solid thin #000;">'.$sku.'</div>
   							 <div class="headtext2" style="width: 210px; border-right:solid thin #000;">'.$cutdes.'</div>
   								 <div id="modqut'.$b["itm_id"].'" class="headtext2" style="width: 82px; border-right:solid thin #000;"><span onclick="upqut(\''.$b["itm_id"].'\')">'.$b["quant"].'</span></div>
    						<div class="headtext2" style="width: 100px; border-right:solid thin #000;">$'.$b["item_price"].'</div>
							<div class="headtext2" style="width: 100px; border-right:solid thin #000;">$'.$Tax.'</div>
								<div class="headtext2" style="width: 81px; border-right:solid thin #000;">$'.$totAll.'</div>
   						 <div class="headtext2" style="width: 70px; text-align:center">
   					 <div title="Update Item" class="save_icon" style="margin-left:25px" onclick="editItm(\''.$b["itm_id"].'\')"></div>
    			<div title="Delete Item" class="delete_icon" onclick="delItm(\''.$b["itm_id"].'\')"></div>
   			 </div>
		</div>';
		}
}


////GET PRICE TOTAL AND TAX AND STUFF////

if($act == 'grbmoney'){
	
	$r = mysql_query("SELECT * FROM doc_items WHERE doc_id = '".$_REQUEST['docid']."'");
	
		
			
		
			$totSet = 0;
			$totSet2 = 0;
			
				while($o = mysql_fetch_array($r)){
					
					$grbTot = $o["item_price"] * $o["quant"];
					
					if($o["is_tax"] == 'true'){
					$totSet += $grbTot;
					}else{
					$totSet2 += $grbTot;	
					}
					
				}
				
				$subTottax=$totSet;
				$subTot=$totSet2;
				
				$cleanSub = $totSet + $totSet2;
				$cleanSubtru = number_format($totSet + $totSet2,2);
				
				$d = mysql_fetch_array(mysql_query("SELECT * FROM locations WHERE locid = '".$_REQUEST['locid']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
				
				
					$runTxa = explode(",",$d["taxs"]);
					$Tax = 0;
						foreach ($runTxa as $idat){
							
							//echo $idat.'<br>';
							$ops = mysql_fetch_array(mysql_query("SELECT * FROM tax_table WHERE tax_id = '$idat' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
					//echo $ops['percent'].'<br>'.$subTottax;
					$Tax = round( (($subTottax * $ops['percent']) / 100 ), 2);
					
					
					
					$runTax.='<div style="width:360px; height:31px; float:right; clear:both; border-bottom:solid thin #CCC;"><div style="width:210px; float:left">'.$ops['tax_name'].':</div> <div style="width:130px; float:left; text-align:right">'.$Tax.'</div></div>';
					
						$taxcom += $Tax;
					
						}
				
				
				
				
				$afterMath = number_format($cleanSub+$taxcom, 2);
	
	$rtr = mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$_REQUEST['docid']."'"));
	
echo '<div style="width:360px; height:31px; float:right;"><div style="width:210px; float:left">Subtotal:</div> <div style="width:130px; float:left; text-align:right">$'.$cleanSubtru.'</div></div>

'.$runTax.'


<div style="width:360px; height:31px; float:right; clear:both"><div style="width:210px; float:left; font-weight:bold">Total:</div> <div style="width:130px; float:left; text-align:right">$'.$afterMath.'</div></div><input name="estiamount" id="estiamount" type="hidden" value="'.$afterMath.'" /><input name="isact"  id="isact" type="hidden" value="'.$rtr["rowstate"].'" />';	

mysql_query("UPDATE core_docs SET value = '$afterMath' WHERE doc_id = '".$_REQUEST['docid']."' AND saasid = '".$_SESSION['saasid']."'");

}





/////INSERT THE ESTIMATE INTO IT'S FINAL RESTING PLACE./////////

if($act == 'insertestimate'){
	$docid = $_REQUEST['docid'];
	$comp = mysql_real_escape_string($_REQUEST['comp']);
	$estcont = mysql_real_escape_string($_REQUEST['estcont']);
	$RadioGroup1 = $_REQUEST['RadioGroup1'];
	$salesman = mysql_real_escape_string($_REQUEST['salesman']);
	$payterms = mysql_real_escape_string($_REQUEST['payterms']);
	$notes = mysql_real_escape_string($_REQUEST['notes']);
	$estiamount = $_REQUEST['estiamount'];
	$status = $_REQUEST['status'];
	$locid = $_REQUEST['locid'];
	$estdt = $_REQUEST['estdt'];
	$pofld = $_REQUEST['pofld'];
	
	
	if($estdt != ''){
	$days = (strtotime($estdt) - strtotime(date("m/d/Y"))) / (60 * 60 * 24);
		$nexdate =  date('m/d/Y', strtotime($days));
	
	}else{
	$days = '0';
		$nexdate = 'Expired';	
	}
	
	
	if($salesman == 'undefined' || $salesman == 'none' ){
		//$j=mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id='".$_SESSION['usrid']."' AND saasid='".$_SESSION['saasid']."'"));
		$salesman = $_SESSION['usrid'];
	}else{
	
		$salesman = $salesman;
	}
	
	mysql_query("UPDATE core_docs SET company_id='$comp',	location='$locid',	value='$estiamount',	issue_date='".date('m/d/Y')."',	salesman='$salesman', valid_untill='$estdt', follow_up='$estdt', days_left='$days',	status='$status',	contact_name='$estcont', base_type='$RadioGroup1',	estprice='$estiamount',	payment_terms='$payterms',	notes='$notes',	created_by='$salesman',	doc_type='estimate', saasid='".$_SESSION['saasid']."',	active='true',	rowstate='used', sta_po = '$pofld' WHERE doc_id = '$docid'") or die(mysql_error());
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimates.php', action = 'Added Estimate - $docid', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
}



/////EDIT ESTIMATE/////

if($act == 'editest'){
	


$ro = mysql_query("SELECT * FROM core_docs WHERE doc_id	 = '".$_REQUEST['docid']."' AND saasid = '".$_SESSION['saasid']."'");
$q = mysql_fetch_array($ro);

mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimate_actions.php', action = 'Viewed Estimate - ".$_REQUEST['docid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
	
	
echo '<!--top info plus status-->
<input name="docid" id="docid" type="hidden" value="'.$_REQUEST['docid'].'" />
<input name="cliids" id="cliids" type="hidden" value="'.$q['company_id'].'" />
<div style="font-size:25px; font-style:italic; font-weight:bold; padding-left:15px; height:80px">Estimate Details
<div style="float:right; margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px">
<span style="font-size:14px; padding-bottom:20px">Status</span>
<select style="width:134px;" class="make" id="status" name="status">';

if($q['status'] == 'pending'){
	$pen = 'selected="selected"';
}
if($q['status'] == 'won'){
	$won = 'selected="selected"';
}

if($q['status'] == 'lost'){
	$los = 'selected="selected"';
}


echo '<option value="pending" '.$pen.'>Pending</option>
<option value="won" '.$won.'>Won</option>
<option value="lost" '.$los.'>Lost</option>
</select>
</div>

</div>

<div style="clear:both"></div>
<!--end-->

<div style="height:190px;">

<div style="width:400px; height:170px; float:left; padding-left:15px">

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Company</div>
<div style="padding-bottom:20px; float:left">';

$k=mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id  = '".$q["company_id"]."' AND saasid='".$_SESSION['saasid']."'"));

	
		echo $k["companyname"];
	

echo '
</div>
</div>

<div style="clear:both"></div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Salesman</div>
<div style="padding-bottom:20px; float:left">';


$n=mysql_query("SELECT * FROM core_users WHERE active = 'true'  AND saasid='".$_SESSION['saasid']."' ORDER BY fname ASC");

if(mysql_num_rows($n) > 0 ){
echo '<select class="make" id="salesman" name="salesman"><option value="none" selected="selected">Select salesman...</option>';

	while($b = mysql_fetch_array($n)){
		
		
		if($q["salesman"] == $b["usr_id"]){
			$sel = 'selected="selected"';
		}else{
			$sel ='';
		}
		
		if($b["usrtyp"] == 'salesman' || $b["usrtyp"] == 'admin'){
		echo '<option value="'.$b["usr_id"].'" '.$sel .'>'.$b["fname"].' '.$b["lname"].'</option>';
		}
	}
}else{
	echo '<select disabled="disabled" class="make" id="comp" name="comp">';
	echo '<option value="none" selected="selected">No salesman in list...</option>';
}



echo '</select>
</div>
</div>

<div style="clear:both"></div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Valid Until</div>
<div style="padding-bottom:20px; float:left">
<input class="make" name="estdt" id="estdt" type="text" value="'.$q["valid_untill"].'">
</div>
</div>



</div>



<div style="width:400px; height:170px; float:left;">

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Contact</div>
<div id="estconssd" style="padding-bottom:20px; float:left">
<select class="make" id="estcont" name="estcont">';

//contact_name
$d = mysql_query("SELECT * FROM contacts WHERE 	blong = '".$q["company_id"]."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
while($t = mysql_fetch_array($d)){
	
	if($q["contact_name"] == $t["cont_id"]){
		$seld = 'selected="selected"';
	}else{
		$seld = '';
	}
		echo '<option value="'.$t["cont_id"].'" '.$seld .'>'.$t["firstname"].' '.$t["lastname"].'</option>';	
		}

echo '</select>
</div>
</div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Location</div>
<div id="estlocss" style="padding-bottom:20px; float:left">';
$tb = mysql_num_rows($d);
$d = mysql_query("SELECT * FROM locations WHERE blong = '".$q['company_id']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
	echo '<select class="make" id="estloc" name="estloc">';
		while($t = mysql_fetch_array($d)){
			if($q["location"] == $t["locid"]){
			$locsel = 'selected="selected"';	
			}else{
				$locsel = '';
			}
		echo '<option value="'.$t["locid"].'" '.$locsel.'>'.$t["address1"].' '.$t["city"].'</option>';	
		}

echo'</select>
</div>
</div>







<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Type</div>
<div style="padding-bottom:20px; float:left">';

if($q["base_type"] == 'sales'){
	$sel = 'checked="checked"';
	$ren = '';
}else{
	$ren = 'checked="checked"';
	$sel = '';
}

    echo'<label style="font-size:12px">
      <input class="make" '.$sel.' type="radio" name="RadioGroup1" value="sales" id="RadioGroup1" disabled="disabled">
      Sales</label>

    <label style="font-size:12px">
      <input class="make" '.$ren.' type="radio" name="RadioGroup1" value="rent" id="RadioGroup1" disabled="disabled">
      Rent</label>

</div>
</div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">PO #</div>
<div id="estlocss" style="padding-bottom:20px; float:left">
<input class="make" name="pofld" id="pofld" type="text"  value="'.$q["sta_po"].'"/>
</div>
</div>



</div>






</div>
<div style="padding:10px; margin-left:20px"><a href="javascript:openFilesset()">Attach File</a></div>
	
	  <div id="boundedfiles" style="width:977px; height:108px; overflow-y:scroll; background-color: #f2f0f1; margin-bottom:20px; margin-left:20px"></div>
<div style="height:3px; margin-left:15px; margin-right:15px; border-bottom:solid thin #999;"></div>

<div id="addcrt" style="margin-left: 40px; margin-top: 20px; margin-bottom: 20px;" onClick="addProdiserv()">Add Product / Services</div>

<!--product and service hold-->
<div style="margin-top:20px">
<div class="infohead" style="width:940px; margin:auto">
	<div class="headtext" style="width: 160px; border-right:solid thin #000; border-left: solid thin #CCC;">Item Code</div>
    <div class="headtext" style="width: 210px; border-right:solid thin #000; border-left:solid thin #CCC;">Description</div>
    <div class="headtext" style="width: 80px; border-right:solid thin #000; border-left:solid thin #CCC;">Quanity</div>
    <div class="headtext" style="width: 99px; border-right:solid thin #000; border-left:solid thin #CCC;">Price</div>
	<div class="headtext" style="width: 99px; border-right:solid thin #000; border-left:solid thin #CCC;">Tax</div>
	<div class="headtext" style="width: 80px; border-right:solid thin #000; border-left:solid thin #CCC;">Total</div>
    <div class="headtext" style="width:80px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<!--end-->



<div id="itmhold" style="width:936px; height:290px; overflow-y:scroll; margin:auto; border:solid thin #CCC;">';


$a = mysql_query("SELECT * FROM doc_items WHERE doc_id='".$_REQUEST['docid']."' AND saasid='".$_SESSION['saasid']."'");
	
		while($b = mysql_fetch_array($a)){
			
			if($b["sku"] == ''){
			$sku = '-service-';	
			}else{
				$sku = $b["sku"];
			}
			//31
			$desclen = strlen($b["item_dec"]);
			if($desclen > 31){
				$cutdes = substr($b["item_dec"], 0, 31).'...';
			}else{
				$cutdes = $b["item_dec"];
			}
		
			$totalEac = $b["item_price"] * $b["quant"];
			
			
			//////tax part////
			
			$d = mysql_fetch_array(mysql_query("SELECT * FROM locations WHERE locid = '".$q["location"]."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
				
				
					$runTxa = explode(",",$d["taxs"]);
					$Tax = 0;
						foreach ($runTxa as $idat){
							
							//echo $idat.'<br>';
							$ops = mysql_fetch_array(mysql_query("SELECT * FROM tax_table WHERE tax_id = '$idat' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
					//echo $ops['percent'].'<br>'.$subTottax;
					$Tax += round( (($totalEac * $ops['percent']) / 100 ), 2);
						
					
						}
						
						//echo $Taxerset;
						
						if($b["is_tax"] == 'true'){
						
						$totAll = number_format ($totalEac+$Tax,2);
						
						}else{
						$totAll = number_format ($totalEac,2);
						$Tax = '0.00';	
						}
			
			
			
			echo '<div class="infoheadlines" style="position:relative">
			<div id="ld'.$b["itm_id"].'" style="position:absolute; right:56px; top:19px; display:none"><img src="images/sml_load.gif" width="16" height="16" /></div>
						<div class="headtext2" style="width: 160px; border-right:solid thin #000;">'.$sku.'</div>
   							 <div class="headtext2" style="width: 210px; border-right:solid thin #000;">'.$cutdes.'</div>
   								 <div id="modqut'.$b["itm_id"].'" class="headtext2" style="width: 82px; border-right:solid thin #000;"><span onclick="upqut(\''.$b["itm_id"].'\')">'.$b["quant"].'</span></div>
    						<div class="headtext2" style="width: 100px; border-right:solid thin #000;">$'.$b["item_price"].'</div>
							<div class="headtext2" style="width: 100px; border-right:solid thin #000;">$'.$Tax.'</div>
								<div class="headtext2" style="width: 81px; border-right:solid thin #000;">$'.$totAll.'</div>
   						 <div class="headtext2" style="width: 70px; text-align:center">
   					 <div title="Update Item" class="save_icon" style="margin-left:25px" onclick="editItm(\''.$b["itm_id"].'\')"></div>
    			<div title="Delete Item" class="delete_icon" onclick="delItm(\''.$b["itm_id"].'\')"></div>
   			 </div>
		</div>';
		}



echo '</div>






</div>

<div id="tothold" style="width:940px; height:150px; margin:auto; padding-top:15px;">';

$r = mysql_query("SELECT * FROM doc_items WHERE doc_id = '".$_REQUEST['docid']."'");
	
		
			
		
			$totSet = 0;
			$totSet2 = 0;
			
				while($o = mysql_fetch_array($r)){
					
					$grbTot = $o["item_price"] * $o["quant"];
					
					if($o["is_tax"] == 'true'){
					$totSet += $grbTot;
					}else{
					$totSet2 += $grbTot;	
					}
					
				}
				
				$subTottax=$totSet;
				$subTot=$totSet2;
				
				$cleanSub = $totSet + $totSet2;
				$cleanSubtru = number_format($totSet + $totSet2,2);
				
				$d = mysql_fetch_array(mysql_query("SELECT * FROM locations WHERE locid = '".$q["location"]."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
				
				
					$runTxa = explode(",",$d["taxs"]);
					$Tax = 0;
						foreach ($runTxa as $idat){
							
							//echo $idat.'<br>';
							$ops = mysql_fetch_array(mysql_query("SELECT * FROM tax_table WHERE tax_id = '$idat' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
					//echo $ops['percent'].'<br>'.$subTottax;
					$Tax = round( (($subTottax * $ops['percent']) / 100 ), 2);
					
					
					
					$runTax.='<div style="width:360px; height:31px; float:right; clear:both; border-bottom:solid thin #CCC;"><div style="width:210px; float:left">'.$ops['tax_name'].':</div> <div style="width:130px; float:left; text-align:right">'.$Tax.'</div></div>';
					
						$taxcom += $Tax;
					
						}
				
				
				
				
				$afterMath = number_format($cleanSub+$taxcom, 2);
	
	
	
echo '<div style="width:360px; height:31px; float:right;"><div style="width:210px; float:left">Subtotal:</div> <div style="width:130px; float:left; text-align:right">$'.$cleanSubtru.'</div></div>

'.$runTax.'


<div style="width:360px; height:31px; float:right; clear:both"><div style="width:210px; float:left; font-weight:bold">Total:</div> <div style="width:130px; float:left; text-align:right">$'.$afterMath.'</div></div><input name="estiamount" id="estiamount" type="hidden" value="'.$afterMath.'" />';	



echo '</div>



<div style="width:940px; height:200px; margin:auto; padding-top:25px;">

<div style="width:452px; height:130px; float:left;">Payment Terms<br><textarea style="width:432px; height:102px; resize:none" name="payterms" id="payterms" cols="" rows="">'.$q["payment_terms"].'</textarea></div>
<div style="width:452px; height:130px; float:left;">Notes<br><textarea style="width:432px; height:102px; resize:none" name="notes" id="notes" cols="" rows="">'.$q["notes"].'</textarea></div>


<div style="padding-top:20px; padding-bottom:20px; height:50px">

<div style="float:left; margin-top:30px; margin-bottom:30px" id="addsestbut" onclick="fineditEsti()">Save</div>

</div>


</div>';	
}



/////EDIT ESTIMATE IN IT'S FINAL RESTING PLACE./////////


if($act == 'editestimate'){
	$docid = $_REQUEST['docid'];
	$comp = mysql_real_escape_string($_REQUEST['comp']);
	$estcont = mysql_real_escape_string($_REQUEST['estcont']);
	$RadioGroup1 = $_REQUEST['RadioGroup1'];
	$salesman = mysql_real_escape_string($_REQUEST['salesman']);
	$payterms = mysql_real_escape_string($_REQUEST['payterms']);
	$notes = mysql_real_escape_string($_REQUEST['notes']);
	$estiamount = $_REQUEST['estiamount'];
	$status = $_REQUEST['status'];
	$locid = $_REQUEST['locid'];
	$estdt = $_REQUEST['estdt'];
	$pofld = $_REQUEST['pofld'];
	
	
	if($estdt != ''){
	$days = (strtotime($estdt) - strtotime(date("m/d/Y"))) / (60 * 60 * 24);
		
	
	}else{
	$days = '0';
			
	}
	
	
	if($salesman == 'undefined' || $salesman == 'none' ){
		//$j=mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id='".$_SESSION['usrid']."' AND saasid='".$_SESSION['saasid']."'"));
		$salesman = $_SESSION['usrid'];
	}else{
	
		$salesman = $salesman;
	}
	
	if($status == 'won'){
		$doctyp = 'workorder';
	}else{
		$doctyp = 'estimate';
	}
	
	mysql_query("UPDATE core_docs SET location='$locid', value='$estiamount', issue_date='".date('m/d/Y')."', salesman='$salesman',	valid_untill='$estdt', days_left='$days', follow_up='$estdt', status='$status',	contact_name='$estcont', base_type='$RadioGroup1',	estprice='$estiamount',	payment_terms='$payterms',	notes='$notes',	created_by='$salesman',	doc_type='$doctyp', saasid='".$_SESSION['saasid']."',	active='true',	rowstate='used', sta_po = '$pofld' WHERE doc_id = '$docid'");
	
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimates.php', action = 'Edit Estimate - $docid', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
}


//////DELETE ITEMS FROM LIST/////

if($act == 'delitem'){
	$pn = mysql_fetch_array(mysql_query("SELECT * FROM doc_items WHERE itm_id = '".$_REQUEST['itmid']."' AND saasid = '".$_SESSION['saasid']."'"));
		$ty = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$pn["tru_id"]."' AND saasid='".$_SESSION['saasid']."'"));
			
				$giveBack = $pn["quant"] + $ty["inventory"];
				
					mysql_query("UPDATE productservi SET inventory = '$giveBack' WHERE items_ids = '".$pn["tru_id"]."' AND saasid = '".$_SESSION['saasid']."'");
					
	mysql_query("DELETE FROM doc_items WHERE itm_id = '".$_REQUEST['itmid']."' AND saasid = '".$_SESSION['saasid']."'");
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimates.php', action = 'Removed Item - ".$_REQUEST['itmid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}


/////GET QUANITY FILED FOR UPDATE ON LIST VIEW////

if($act == 'pullqtfld'){
	
	$u = mysql_fetch_array(mysql_query("SELECT * FROM doc_items WHERE itm_id = '".$_REQUEST['itmid']."' AND saasid = '".$_SESSION['saasid']."'"));
	echo '<input style="width:57px;" name="updtqt'.$_REQUEST['itmid'].'" id="updtqt'.$_REQUEST['itmid'].'" type="text" value="'.$u["quant"].'" onblur="runflfCls('.$u["quant"].','.$_REQUEST['itmid'].')"/>';
}


/////FINISH UPDATE OF QUANITY/////

if($act == 'updtqty'){
	
	$pn = mysql_fetch_array(mysql_query("SELECT * FROM doc_items WHERE itm_id = '".$_REQUEST['itmid']."' AND saasid = '".$_SESSION['saasid']."'"));
		$ty = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$pn["tru_id"]."' AND saasid='".$_SESSION['saasid']."'"));
			
			if($_REQUEST['newvalue'] > $pn["quant"]){
					$adjustQua= $_REQUEST['newvalue'] - $pn["quant"];
						$realVal = $ty["inventory"] - $adjustQua;
				
			}else{
				$adjustQua=$pn["quant"] - $_REQUEST['newvalue'];
				$realVal = $ty["inventory"] + $adjustQua;
			}
				
					mysql_query("UPDATE productservi SET inventory = '$realVal' WHERE items_ids = '".$pn["tru_id"]."' AND saasid = '".$_SESSION['saasid']."'");
	mysql_query("UPDATE doc_items SET quant = '".$_REQUEST['newvalue']."' WHERE itm_id = '".$_REQUEST['itmid']."' AND saasid = '".$_SESSION['saasid']."'");
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimates.php', action = 'Updated Item - ".$_REQUEST['itmid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}


/////DELETE ESTIMATES/////

if($act == 'delesti'){
	
	
	
	$rt = mysql_query("SELECT * FROM doc_items WHERE doc_id = '".$_REQUEST['docid']."' AND saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
	
		while($s = mysql_fetch_array($rt)){
			
			$ty = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$s["tru_id"]."' AND saasid='".$_SESSION['saasid']."'"));
			
				if($ty["item_typ"] == 'product'){
				$giveBack = $s["quant"] + $ty["inventory"];
				
					mysql_query("UPDATE productservi SET inventory = '$giveBack' WHERE items_ids = '".$s["tru_id"]."' AND saasid = '".$_SESSION['saasid']."'");
			
			
			mysql_query("DELETE FROM doc_items WHERE doc_id = '".$s["doc_id"]."' AND saasid = '".$_SESSION['saasid']."'");
				}
			
		}
	
	mysql_query("DELETE FROM core_docs WHERE doc_id = '".$_REQUEST['docid']."'");
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimates.php', action = 'Deleted Estimate - ".$_REQUEST['docid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
}

///////CHANGE STATUS ON LINE ITEM/////
if($act == 'changelinestat'){
	
	if($_REQUEST['statu'] == 'pending' || $_REQUEST['statu'] == 'lost'){
	
	mysql_query("UPDATE core_docs SET status = '".$_REQUEST['statu']."' WHERE doc_id = '".$_REQUEST['docid']."'");
	}else{
		mysql_query("UPDATE core_docs SET status = '".$_REQUEST['statu']."', doc_type = 'workorder' WHERE doc_id = '".$_REQUEST['docid']."'");
	}
	
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimates.php', action = 'Updated Estimate - ".$_REQUEST['docid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}

//////IF USER HAS NOT SAVED THE ESTIMATE TRASH ITEMS & UPDATE INVETORY///

if($act == 'ramitems'){
 
	$rt = mysql_query("SELECT * FROM core_docs WHERE rowstate = 'unused' AND doc_type = 'estimate' AND saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
	
		while($s = mysql_fetch_array($rt)){
			
			$ty = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$s["tru_id"]."' AND saasid='".$_SESSION['saasid']."'"));
			
				$giveBack = $s["quant"] + $ty["inventory"];
				
					mysql_query("UPDATE productservi SET inventory = '$giveBack' WHERE items_ids = '".$s["tru_id"]."' AND saasid = '".$_SESSION['saasid']."'");
			
			
			mysql_query("DELETE FROM doc_items WHERE doc_id = '".$s["doc_id"]."' AND saasid = '".$_SESSION['saasid']."'");
			
		}
	
	
}

if($act == 'getuploads2'){
	$r = mysql_query("SELECT * FROM uploads WHERE cli_id = '".$_REQUEST['clid']."' AND mod_section = '".$_REQUEST['pagemod']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'") or die(mysql_error());
	
	echo '<div style="width:402px; height:193px; overflow-y:scroll">';
	
		while($e=mysql_fetch_array($r)){
			
			$q = explode('.',$e["filename"]);
				if($q[1] == 'jpg' || $q[1] == 'jpeg' || $q[1] == 'gif' || $q[1] == 'png'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -12px -144px; float:left"></div>';}
				if($q[1] == 'doc' || $q[1] == 'docx'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -13px -96px; float:left"></div>';}
				if($q[1] == 'pdf'){ $icon = '<div style="width:37px; height:28px; background-image: url(images/iconset.gif); background-position: -201px -96px; float:left"></div>';}
				if($q[1] == 'csv' || $q[1] == 'xlc'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px -95px; float:left"></div>';}
				if($q[1] == 'txt'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px 0px; float:left"></div>';}
				if($q[1] == 'zip'){ $icon = '<div style="width:38px; height:28px; background-image: url(images/iconset.gif); background-position: -135px 0px; float:left"></div>';}
				
				if(strlen($e["filename"]) > 17 ){
				$fileName = substr($e["filename"], 0, 17).'...';
				}else{
				$fileName = $e["filename"];	
				}
			
			
			
			echo '<div class="infoheadlines">
						<div class="headtext2" style="width:188px;">'.$fileName.'</div>
   								 <div class="headtext2" style="width:113px;"><a href="javascript:attcit(\''.$e["up_id"].'\')">'.$icon.' <span style="float:left">Attach</span> </a></div>
    						</div>';
		}
		
		echo '</div>';
	
}

if($act == 'goonatt'){
	mysql_query("INSERT INTO uploads SET mod_section = 'estimates',	cli_id = '".$_REQUEST['docid']."', filename = '".$_REQUEST['fileid']."', saasid = '".$_SESSION['saasid']."'");
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'estimates.php', action = 'Added File - ".$_REQUEST['fileid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}

///getthemnow&locid
if($act == 'getthemnow'){

$r = mysql_query("SELECT * FROM uploads WHERE  mod_section = 'estimates' AND cli_id = '".$_REQUEST['docid']."' AND saasid = '".$_SESSION['saasid']."'") or die(mysql_error());
	
	
	
		while($v=mysql_fetch_array($r)){
			
			$e = mysql_fetch_array(mysql_query("SELECT * FROM uploads WHERE up_id = '".$v["filename"]."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'")) or die(mysql_error());
			
			$q = explode('.',$e["filename"]);
				if($q[1] == 'jpg' || $q[1] == 'jpeg' || $q[1] == 'gif' || $q[1] == 'png'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -12px -144px; float:left"></div>';}
				if($q[1] == 'doc' || $q[1] == 'docx'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -13px -96px; float:left"></div>';}
				if($q[1] == 'pdf'){ $icon = '<div style="width:37px; height:28px; background-image: url(images/iconset.gif); background-position: -201px -96px; float:left"></div>';}
				if($q[1] == 'csv' || $q[1] == 'xlc'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px -95px; float:left"></div>';}
				if($q[1] == 'txt'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px 0px; float:left"></div>';}
				if($q[1] == 'zip'){ $icon = '<div style="width:38px; height:28px; background-image: url(images/iconset.gif); background-position: -135px 0px; float:left"></div>';}
				
				if(strlen($e["filename"]) > 17 ){
				$fileName = substr($e["filename"], 0, 17).'...';
				}else{
				$fileName = $e["filename"];	
				}
			
			
			
			echo '<div class="infoheadlines">
						<div class="headtext2" style="width:788px;">'.$fileName.'</div>
   								 <div class="headtext2" style="width:113px;"><a href="uploads/'.$e["filename"].'" target="_blank">'.$icon.' <span style="float:left">Download</span> </a></div>
    						</div>';
		}
		
		
}

?>