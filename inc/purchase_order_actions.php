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
	<div class="headtext" style="width: 160px; border-right:solid thin #000; cursor:pointer;border-left: solid thin #CCC;" onclick="sortEsti(\''.$dirs.'\',\''.$_REQUEST['page'].'\')">Vendor <img src="images/'.$ico.'.png" width="9" height="9"></div>
    <div class="headtext" style="width: 140px; border-right:solid thin #000; border-left:solid thin #CCC;">Customer Name</div>
    <div class="headtext" style="width: 80px; border-right:solid thin #000; border-left:solid thin #CCC;">Invoice</div>
    <div class="headtext" style="width: 99px; border-right:solid thin #000; border-left:solid thin #CCC;">PO Type</div>
	<div class="headtext" style="width: 80px; border-right:solid thin #000; border-left:solid thin #CCC;">Due</div>
	<div class="headtext" style="width: 70px; border-right:solid thin #000; border-left:solid thin #CCC;">Total</div>
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
	//echo 'set';
	$query  = "SELECT customers.companyname, customers.cust_id, customers.zip, customers.state, customers.county, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.companyname LIKE '$serc%' AND customers.saasid = '".$_SESSION['saasid']."' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.zip LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.state LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND customers.county LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.firstname LIKE '$serc%' OR customers.active = 'true' AND customers.cust_id = contacts.blong AND CONCAT(contacts.firstname, ' ', contacts.lastname)  LIKE '$serc%' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";
	
}else{

$query  = "SELECT * FROM core_docs WHERE doc_type = 'po' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' ORDER BY doc_id $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:20px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Active Purchase Orders..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				$rty = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$h["company_id"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
				
				$rtov = mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE clipo = '".$h["doc_id"]."' AND saasid = '".$_SESSION['saasid']."'"));
				
				if($rtov["clipo"] == ''){
				$custName = 'Not Applied';
				$inv = 'None';	
				}else{
					
					$rto = mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$rtov["doc_id"]."' AND saasid = '".$_SESSION['saasid']."'"));
					
					//company_id
					
					$bvn = mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '".$rto["company_id"]."' AND saasid = '".$_SESSION['saasid']."'"));
					
				$custName = $bvn["companyname"];
				$inv = 'None';	
				}
				
				echo '<div class="infoheadlines">
				
						<div class="headtext2" style="width: 40px;">'.$h["doc_id"].'</div>
   							 <div class="headtext2" style="width: 162px;">'.$rty["fld1"].'</div>
   								 <div class="headtext2" style="width: 141px;">'.$custName.'</div>
    						<div class="headtext2" style="width: 80px;">'.$rtov["doc_id"].'</div>
                            <div class="headtext2" style="width: 100px;">'.$h["base_type"].'</div>
                            <div class="headtext2" style="width: 90px;">'.$h["follow_up"].'</div>
                            <div class="headtext2" style="width: 70px;">'.$h["value"].'</div>
                            <div id="stater'.$h["doc_id"].'" class="headtext2" style="width: 77px;"><span onClick="runDrops(\''.$h["status"].'\',\''.$h["doc_id"].'\')">'.$h["status"].'</span></div>
   						 <div class="headtext2" style="width:95px; text-align:center">
                         <div class="pdf_icon" title="Download PDF" style="margin-left:6px; margin-right:6px;" onclick="window.open(\'genPDFpo.php?docid='.$h["doc_id"].'\')"></div>
   					 <div class="edit_icon" title="Edit" style="margin-right:6px;"  onclick="geteditEstform(\''.$h["doc_id"].'\')"=""></div>
    			<div class="delete_icon" title="Delete" onclick="delEsti(\''.$h["doc_id"].'\')"=""></div>
   			 </div>
		</div>';
			}
	}
 $query   = "SELECT COUNT(doc_id) AS numrows FROM core_docs WHERE active='true' AND saasid = '".$_SESSION['saasid']."' AND doc_type = 'po'";
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
	if($_REQUEST['setval'] == 'pending'){$p = 'selected="selected"';}else{$p = '';}
	if($_REQUEST['setval'] == 'won'){$w = 'selected="selected"';}else{$w = '';}
	if($_REQUEST['setval'] == 'lost'){$l = 'selected="selected"';}else{$l = '';}
	echo '<select id="trustat" name="trustat" onChange="runstsSet(\''.$_REQUEST['sentid'].'\',this.value)"><option '.$p.' value="pending">Pending..</option><option '.$w.' value="won">Won</option><option '.$l.' value="lost">Lost</option></select>';
	
}



////PULL NEW ESTIMATE ADD FORM//////

if($act == 'getaddest'){
	
	
	$p = mysql_num_rows(mysql_query("SELECT * FROM core_docs WHERE rowstate = 'unused' AND doc_type = 'po' AND saasid = '".$_SESSION['saasid']."'"));
	if($p < 1){
	mysql_query("INSERT INTO core_docs SET rowstate = 'unused', doc_type = 'po', saasid = '".$_SESSION['saasid']."'");
		////get the created id//
			$p = mysql_query("SELECT * FROM core_docs WHERE rowstate = 'unused' AND doc_type = 'po' AND saasid = '".$_SESSION['saasid']."' ORDER BY doc_id DESC");
				$id = mysql_fetch_array($p);
					$docId = $id["doc_id"];
	}else{
		
		$p = mysql_query("SELECT * FROM core_docs WHERE rowstate = 'unused' AND doc_type = 'po' AND saasid = '".$_SESSION['saasid']."' ORDER BY doc_id DESC");
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
<option value="open">Open</option>
<option value="closed">Closed</option>
</select>
</div>

</div>

<div style="clear:both"></div>
<!--end-->

<div style="height:190px;">

<div style="width:400px; height:170px; float:left; padding-left:15px">

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Vendor</div>
<div style="padding-bottom:20px; float:left">
<select class="make" id="comp" name="comp">
<option value="none" selected="selected">Select Vendor...</option>
';

$k=mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid='".$_SESSION['saasid']."' AND is_vend = 'true' ORDER BY fld1 ASC");

	while($a = mysql_fetch_array($k)){
		echo '<option value="'.$a["glid"].'">'.$a["fld1"].'</option>';
	}

echo '</select>
</div>
</div>

<div style="clear:both"></div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">PO Type</div>
<div style="padding-bottom:20px; float:left">
<select class="make" id="type" name="type"><option value="none" selected="selected">Select Type...</option>
<option value="rental">Rental</option>
<option value="inventory">Inventory</option>
<option value="purchase">Purchase</option>
</select>
</div>
</div>

<div style="clear:both"></div>

<!--<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Valid Untill</div>
<div style="padding-bottom:20px; float:left">
<input class="make" name="estdt" id="estdt" type="text">
</div>
</div>-->



</div>



<div style="width:400px; height:170px; float:left;">

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Creation Date</div>
<div id="estconssd" style="padding-bottom:20px; float:left">
<input class="make" name="credate" id="credate" type="text" />
</div>
</div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Due Date</div>
<div id="estlocss" style="padding-bottom:20px; float:left">
<input class="make" name="duedate" id="duedate" type="text" />
</div>
</div>







<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<!--<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Invoice</div>
<div style="padding-bottom:20px; float:left">
<a href="">View Invoice</a>

</div>-->
</div>



</div>




</div>

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

<!--<div style="width:452px; height:130px; float:left;">Payment Terms<br><textarea style="width:432px; height:102px; resize:none" name="payterms" id="payterms" cols="" rows=""></textarea></div>-->
<div style="width:948px; height:130px; float:left;">Notes<br><textarea style="width:948px; height:102px; resize:none" name="notes" id="notes" cols="" rows=""></textarea></div>


<div style="padding-top:20px; padding-bottom:20px; height:50px">

<div style="float:left; margin-top:30px; margin-bottom:30px" id="addsestbut" onclick="finEsti()">Save PO</div>

</div>


</div>';	
}

////GET CONTACT BASED ON COMPANY SELECTION////

if($act == 'getcons'){
	$d = mysql_query("SELECT * FROM contacts WHERE blong = '".$_REQUEST['compid']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
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

$get = mysql_query("SELECT * FROM productservi WHERE active = 'true' AND item_typ = 'product' AND saasid = '".$_SESSION['saasid']."'");

	while($f = mysql_fetch_array($get)){
		echo '<option value="'.$f["items_ids"].'?'.$f["price"].'">'.$f["item_name"].'</option>';
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
	$type = mysql_real_escape_string($_REQUEST['type']);
	$credate = mysql_real_escape_string($_REQUEST['credate']);
	$duedate = mysql_real_escape_string($_REQUEST['duedate']);
	$status = mysql_real_escape_string($_REQUEST['status']);
	$notes = mysql_real_escape_string($_REQUEST['notes']);
	$estiamount = $_REQUEST['estiamount'];
	
	
	//if($estdt != ''){
	//$days = (strtotime($estdt) - strtotime(date("m/d/Y"))) / (60 * 60 * 24);
	//	$nexdate =  date('m/d/Y', strtotime($days));
	
	//}else{
	//$days = '0';
	//	$nexdate = 'Expired';	
	//}
	

	
	mysql_query("UPDATE core_docs SET company_id='$comp',	value='$estiamount',	issue_date='$credate',	salesman='$salesman',	valid_untill='$duedate', follow_up='$duedate', status='$status', estprice='$estiamount', notes='$notes',		base_type = '$type', saasid='".$_SESSION['saasid']."',	active='true',	rowstate='used' WHERE doc_id = '$docid'");
}



/////EDIT ESTIMATE/////

if($act == 'editest'){
	


$ro = mysql_query("SELECT * FROM core_docs WHERE doc_id	 = '".$_REQUEST['docid']."' AND saasid = '".$_SESSION['saasid']."'");
$q = mysql_fetch_array($ro);
	
	
	
echo '<!--top info plus status-->
<input name="docid" id="docid" type="hidden" value="'.$_REQUEST['docid'].'" />
<div style="font-size:25px; font-style:italic; font-weight:bold; padding-left:15px; height:80px">Estimate Details
<div style="float:right; margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px">
<span style="font-size:14px; padding-bottom:20px">Status</span>
<select style="width:134px;" class="make" id="status" name="status">';

if($q["status"] == 'pending'){$penSel = 'selected="selected"';}else{$penSel = '';}
if($q["status"] == 'open'){$opnSel = 'selected="selected"';}else{$opnSel = '';}
if($q["status"] == 'closed'){$cloSel = 'selected="selected"';}else{$cloSel = '';}

echo'<option value="pending" '.$penSel.'>Pending</option>
<option value="open" '.$opnSel.'>Open</option>
<option value="closed" '.$cloSel.'>Closed</option>
</select>
</div>

</div>

<div style="clear:both"></div>
<!--end-->

<div style="height:190px;">

<div style="width:400px; height:170px; float:left; padding-left:15px">

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Vendor</div>
<div style="padding-bottom:20px; float:left">
<select class="make" id="comp" name="comp">
<option value="none" selected="selected">Select Vendor...</option>
';

$k=mysql_query("SELECT * FROM ledger_tabs WHERE active = 'true' AND saasid='".$_SESSION['saasid']."' AND is_vend = 'true' ORDER BY fld1 ASC");

	while($a = mysql_fetch_array($k)){
		if($q["company_id"] == $a["glid"]){
		echo '<option value="'.$a["glid"].'" selected="selected">'.$a["fld1"].'</option>';
		}else{
		echo '<option value="'.$a["glid"].'">'.$a["fld1"].'</option>';	
		}
	}

echo '</select>
</div>
</div>

<div style="clear:both"></div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">PO Type</div>
<div style="padding-bottom:20px; float:left">
<select class="make" id="type" name="type">';

if($q["base_type"] == 'rental'){$renSel = 'selected="selected"';}else{$renSel = '';}
if($q["base_type"] == 'inventory'){$invSel = 'selected="selected"';}else{$invSel = '';}
if($q["base_type"] == 'purchase'){$purSel = 'selected="selected"';}else{$purSel = '';}

echo'
<option value="rental" '.$renSel.'>Rental</option>
<option value="inventory" '.$invSel.'>Inventory</option>
<option value="purchase" '.$purSel.'>Purchase</option>
</select>
</div>
</div>

<div style="clear:both"></div>

<!--<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Valid Untill</div>
<div style="padding-bottom:20px; float:left">
<input class="make" name="estdt" id="estdt" type="text">
</div>
</div>-->



</div>



<div style="width:400px; height:170px; float:left;">

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Creation Date</div>
<div id="estconssd" style="padding-bottom:20px; float:left">
<input class="make" name="credate" id="credate" type="text" value="'.$q["issue_date"].'"/>
</div>
</div>

<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Due Date</div>
<div id="estlocss" style="padding-bottom:20px; float:left">
<input class="make" name="duedate" id="duedate" type="text" value="'.$q["follow_up"].'"/>
</div>
</div>







<div style="margin-top:5px; margin-right:8px; font-style:normal; padding-bottom:8px; height:35px;">
<!--<div style="font-size:14px; padding-bottom:20px; float:left; width:150px">Invoice</div>
<div style="padding-bottom:20px; float:left">
<a href="">View Invoice</a>

</div>-->
</div>



</div>




</div>

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

<!--<div style="width:452px; height:130px; float:left;">Payment Terms<br><textarea style="width:432px; height:102px; resize:none" name="payterms" id="payterms" cols="" rows=""></textarea></div>-->
<div style="width:948px; height:130px; float:left;">Notes<br><textarea style="width:948px; height:102px; resize:none" name="notes" id="notes" cols="" rows="">'.$q["notes"].'</textarea></div>




<div style="padding-top:20px; padding-bottom:20px; height:50px">

<div style="float:left; margin-top:30px; margin-bottom:30px" id="addsestbut" onclick="fineditEsti()">Edit PO</div>

</div>


</div>';	
}



/////EDIT ESTIMATE IN IT'S FINAL RESTING PLACE./////////


if($act == 'editestimate'){
	$docid = $_REQUEST['docid'];
	$comp = mysql_real_escape_string($_REQUEST['comp']);
	$type = mysql_real_escape_string($_REQUEST['type']);
	$credate = mysql_real_escape_string($_REQUEST['credate']);
	$duedate = mysql_real_escape_string($_REQUEST['duedate']);
	$status = mysql_real_escape_string($_REQUEST['status']);
	$notes = mysql_real_escape_string($_REQUEST['notes']);
	$estiamount = $_REQUEST['estiamount'];
	
	

	
	mysql_query("UPDATE core_docs SET company_id='$comp', value='$estiamount', issue_date='$credate', valid_untill='$duedate', follow_up='$duedate', status='$status', estprice='$estiamount', notes='$notes',	base_type = '$type' WHERE doc_id = '$docid' AND saasid='".$_SESSION['saasid']."'");
}


//////DELETE ITEMS FROM LIST/////

if($act == 'delitem'){
	$pn = mysql_fetch_array(mysql_query("SELECT * FROM doc_items WHERE itm_id = '".$_REQUEST['itmid']."' AND saasid = '".$_SESSION['saasid']."'"));
		$ty = mysql_fetch_array(mysql_query("SELECT * FROM productservi WHERE items_ids = '".$pn["tru_id"]."' AND saasid='".$_SESSION['saasid']."'"));
			
				$giveBack = $pn["quant"] + $ty["inventory"];
				
					mysql_query("UPDATE productservi SET inventory = '$giveBack' WHERE items_ids = '".$pn["tru_id"]."' AND saasid = '".$_SESSION['saasid']."'");
					
	mysql_query("DELETE FROM doc_items WHERE itm_id = '".$_REQUEST['itmid']."' AND saasid = '".$_SESSION['saasid']."'");
	
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
}

///////CHANGE STATUS ON LINE ITEM/////
if($act == 'changelinestat'){
	
	if($_REQUEST['statu'] == 'pending' || $_REQUEST['statu'] == 'lost'){
	
	mysql_query("UPDATE core_docs SET status = '".$_REQUEST['statu']."' WHERE doc_id = '".$_REQUEST['docid']."'");
	}else{
		mysql_query("UPDATE core_docs SET status = '".$_REQUEST['statu']."', doc_type = 'workorder' WHERE doc_id = '".$_REQUEST['docid']."'");
	}
	
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

?>