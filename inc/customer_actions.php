<?php
error_reporting(0);
session_start();
include('config.php');
$act = $_REQUEST['action'];


//////----------------------------------Begin Customer Actions-----------------------------------------////////

///GET CUSTOMER LIST////
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
	<div class="headtext" style="width:190px; border-right:solid thin #000; cursor:pointer;" onClick="sortCli(\''.$dirs.'\',\''.$_REQUEST['page'].'\')">Company Name <img src="images/'.$ico.'.png" width="9" height="9"></div>
    <div class="headtext" style="width:170px; border-right:solid thin #000; border-left:solid thin #CCC;">Contact Person</div>
    <div class="headtext" style="width:133px; border-right:solid thin #000; border-left:solid thin #CCC;">Phone Number</div>
    <div class="headtext" style="width:224px; border-right:solid thin #000; border-left:solid thin #CCC;">Email Address</div>
	<div class="headtext" style="width:94px; border-right:solid thin #000; border-left:solid thin #CCC;">Balance</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Actions</div>
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

$query  = "SELECT customers.companyname, customers.cust_id, customers.saasid, contacts.firstname, contacts.lastname, contacts.phone, contacts.email FROM customers, contacts WHERE customers.active = 'true' AND customers.cust_id = contacts.blong AND contacts.isprime = 'true' AND customers.saasid = '".$_SESSION['saasid']."' ORDER BY customers.companyname $dirs LIMIT $offset, $rowsPerPage";

}

$result = mysql_query($query)  or die(mysql_error());

	if(mysql_num_rows($result) < 1 ){
		
		echo '<div style="font-family: \'Quantico\', sans-serif; font-size:20px; color:#1053A3; font-style:italic; padding-left:15px; padding-top:15px;">No Active Customers..</div>';
		
	}else{

			while($h = mysql_fetch_array($result)){
				
				
				$bv = mysql_query("SELECT * FROM invoice_payments WHERE saasid = '".$_SESSION['saasid']."'");
														$invpay = 0;
														$totPaty = 0;
															while($d=mysql_fetch_array($bv)){
																
															$f=mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$d["inv_num"]."'"));
															
																if($f["company_id"] == $h["cust_id"]){
														
														
							
							$totPaty = str_replace(',','',$f["value"]);
							
							$invpay += $d["amount"];
								
							}	
							
							$cal = "$".number_format($totPaty - $invpay,2);
							
							
															}
				
				
				
				
				echo '<div class="infoheadlines">
						<div class="headtext2" style="width:190px;">'.$h["companyname"].'</div>
   							 <div class="headtext2" style="width:170px;">'.$h["firstname"].' '.$h["lastname"].'</div>
   								 <div class="headtext2" style="width:133px;">'.$h["phone"].'</div>
    						<div class="headtext2" style="width:224px;">'.$h["email"].'</div>
							<div class="headtext2" style="width:94px;">'.$cal.'</div>
   						 <div class="headtext2" style="width:90px; text-align:center">
   					 <div class="edit_icon" style="margin-left:25px" onClick="editCli(\''.$h["cust_id"].'\')"></div>
    			<div class="delete_icon" onClick="delCust(\''.$h["cust_id"].'\')"></div>
   			 </div>
		</div>';
			}
	}
 $query   = "SELECT COUNT(cust_id) AS numrows FROM customers WHERE active='true' AND saasid = '".$_SESSION['saasid']."'";
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
		$nav .= '<div class="pagnull" onclick="recallCust(\''.$page.'\')">'.$page.'</div>';
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
	$next = '<div class="pagnull" onclick="recallCust(\''.$page.'\')">Next</div></a>';
	
	//$last = " <a href=\"$self?page=$maxPage\">Last</a> ";
	
	$last = '<div class="pagnull" onclick="recallCust(\''.$maxPage.'\')">Last</div>';
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


////GIVE FORM AFTER ADDING ID TO DB////
if($act == 'givecustomerform'){
	
	
	$p = mysql_num_rows(mysql_query("SELECT * FROM customers WHERE rowstate = 'unused' AND saasid = '".$_SESSION['saasid']."'"));
	if($p < 1){
	mysql_query("INSERT INTO customers SET rowstate = 'unused', saasid = '".$_SESSION['saasid']."'");
		////get the created id//
			$p = mysql_query("SELECT * FROM customers WHERE rowstate = 'unused' AND saasid = '".$_SESSION['saasid']."' ORDER BY cust_id DESC");
				$id = mysql_fetch_array($p);
					$custId = $id["cust_id"];
	}else{
		
		$p = mysql_query("SELECT * FROM customers WHERE rowstate = 'unused' AND saasid = '".$_SESSION['saasid']."' ORDER BY cust_id DESC");
				$id = mysql_fetch_array($p);
					$custId = $id["cust_id"];
		
	}
	
	$tabs .= '<div id="tabs" style="display:block; font-family: \'Quantico\', sans-serif;">
	<ul>
		<li><a href="#tabs-1">Profile</a></li>
		<li><a href="#tabs-2">Locations</a></li>
		<li><a href="#tabs-3">Contacts</a></li>
		
	</ul>';
	
	$tabs .= '<div id="tabs-1">
   <!--license info-->
   <input name="runner" id="runner" type="hidden" value="new" />
	<input name="cliid" id="cliid" type="hidden" value="'.$custId.'">
		<div style="width:990px; height:39px; border-bottom:solid thin #666;">
        <div style="width:223px; height:39px; float:left">
        	<div style="float:left; margin-right:5px; padding-top:5px"><strong style="font-size:10px">Resale License #</strong></div> 
            	<div style="float:left"><input class="neat" style="width:98px;" name="resalelic" id="resalelic" type="text"></div>
                </div>
                
                <div style="width:315px; height:39px; float:left; margin-left:30px">
        	<div style="float:left; margin-right:5px; padding-top:5px"><strong style="font-size:10px">Resale Certificate Exp. Date</strong></div> 
            	<div style="float:left"><input class="neat" style="width:98px;" name="resaledt" id="resaledt" type="text"></div>
                </div>
                
                <div style="width:344px; height:39px; float:left; margin-left:30px">
        	<div style="float:left; margin-right:5px; padding-top:5px"><strong style="font-size:10px">Certificate of Insurance Exp. Date</strong></div> 
            	<div style="float:left"><input class="neat" style="width:98px;" name="insexdt" id="insexdt" type="text"></div>
                </div>
        </div>
	
    
    
    <!--license info end-->
        
        <!--profile info-->
    <div style="width:990px; height:39px; border-bottom:solid thin #999; padding-top:15px">
    
    <div style="width:823px; height:39px; float:left">
        	<div style="float:left; margin-right:100px; padding-top:5px"><strong>Company</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="company" id="company" type="text"></div>
				
				<div style="float:left; margin-right:20px; margin-left:20px; padding-top:5px"><strong>Sales Person: </strong></div> 
            	<div style="float:left">';
				$tabs .='<select class="neat" name="salespers" id="salespers"><option value="none" selected="selected">Select Sales Person...</option>';
				$rth = mysql_query("SELECT * FROM core_users WHERE usrtyp = 'salesman' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'");
				while($d=mysql_fetch_array($rth)){
				$tabs .='<option value="'.$d["usr_id"].'">'.$d["fname"].' '.$d["lname"].'</option>';	
				}
				$tabs .= '</select>';
				$tabs.='</div>
                </div>
				
				
				
				
    
    </div>
    
    <div style="width:990px; height:220px; border-bottom:solid thin #999; padding-top:10px">
    
    <div style="width:723px; height:39px;">
    <div style="margin-right:100px; padding-top:5px; font-size:20px; font-style:italic;"><strong>Address</strong></div></div>
    
    <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Address 1</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="address1" id="address1" type="text"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Address 2</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="address2" id="address2" type="text"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>City</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="city" id="city" type="text"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>State</strong></div> 
            	<div style="float:left"><select class="neat" id="state" name="state">
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
</select></div>
                </div>
                
                
                 <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>County</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="county" id="county" type="text"></div>
                </div>
                
                
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Zip</strong></div> 
            	<div style="float:left"><input class="neat" style="width:90px" name="zip" id="zip" type="text"></div>
                </div>
                
                
                
                
                
                
                
                
                
    	</div>
        
        
        <!--billing-->
        <div style="width:990px; height:auto; overflow:auto; border-bottom:solid thin #999; padding-top:10px; padding-bottom:20px">
    
    <div style="width:723px; height:39px;">
    <div style="margin-right:100px; padding-top:5px; font-size:20px; font-style:italic;"><strong>Billing Address</strong> 
      </div></div>
    
     <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong></strong></div> 
            	<div style="float:left"><input class="neat" type="checkbox" name="issame" id="issame" onClick="sameBill()">
    <span style="font-size:11px; font-style:normal;">Same as main address</span></div>
                </div>
    <div id="billadrd">
    <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Address 1</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="billaddress1" id="billaddress1" type="text"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Address 2</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="billaddress2" id="billaddress2" type="text"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>City</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="billcity" id="billcity" type="text"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>State</strong></div> 
            	<div style="float:left"><select class="neat" id="billstate" name="billstate">
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
</select></div>
                </div>
                
                
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Zip</strong></div> 
            	<div style="float:left"><input class="neat" style="width:90px" name="billzip" id="billzip" type="text"></div>
                </div>
                
                
                </div>
                
                
                
                
                
                
                
                
                
    	</div>
        
        <!--end billing-->
        
        
        <!--notes-->
        <div style="width:990px; height:150px; border-bottom:solid thin #999; padding-top:10px">
        <div style="width:723px; height:110px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Notes</strong></div> 
            	<div style="float:left"><textarea style="width:422px; height:101px; resize:none;" class="neat" name="notes" id="notes" cols="" rows=""></textarea></div>
                </div>
				
				 <div style="width:723px; height:110px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Billing Terms</strong></div> 
            	<div style="float:left"><select name="billterms" id="billterms">
				<option value="none">Select Term...</option>
				<option value="30">30 Days</option>
				<option value="60">60 Days</option>
				<option value="90">90 Days</option>
				<option value="120">120 Days</option>
				</select></div>
                </div>
                <!--notes end-->
                
                
        </div>
        </div>';
				
				
				/////////////////LOCATION TAB////////
				
				
				$tabs .= '<div id="tabs-2">
							<div style="padding:5px;"><div class="buttons3" onClick="addLocation()">New Location</div></div>
    							 <div class="infohead">
									<div class="headtext" style="width:235px; border-right:solid thin #000;">Address</div>
    									<div class="headtext" style="width:155px; border-right:solid thin #000; border-left:solid thin #CCC;">City</div>
    										<div class="headtext" style="width:60px; border-right:solid thin #000; border-left:solid thin #CCC;">State</div>
   												 <div class="headtext" style="width:90px; border-right:solid thin #000; border-left:solid thin #CCC;">Zip</div>
    												<div class="headtext" style="width:130px; border-right:solid thin #000; border-left:solid thin #CCC;">County</div>
   														 <div class="headtext" style="width:90px; border-left:solid thin #CCC;">Tax Codes</div>
   															 <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Actions</div>
														</div>';
														
													///////LOCATION LINES ITEMS////
													$tabs .='<div id="newlochold"></div>';
												$tabs .= '</div>';
												
												
					///////////////CONTACTS INFO////////////
					
						$tabs .= '<div id="tabs-3">';
						
						
						
						$tabs .= '
							<div style="padding:5px;"><div class="buttons3" onClick="addContact()">New Contact</div></div>
    							 <div class="infohead">
									<div class="headtext" style="width:155px; border-right:solid thin #000;">First Name</div>
    									<div class="headtext" style="width:155px; border-right:solid thin #000; border-left:solid thin #CCC;">Last Name</div>
    										<div class="headtext" style="width:95px; border-right:solid thin #000; border-left:solid thin #CCC;">Title</div>
   												 <div class="headtext" style="width:133px; border-right:solid thin #000; border-left:solid thin #CCC;">Phone</div>
    												<div class="headtext" style="width:244px; border-right:solid thin #000; border-left:solid thin #CCC;">Email</div>
   														<div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Actions</div>
														</div>';
														
														$tabs .='<div id="contacthold"></div>';
														
						
						
						
								$tabs .='</div>
								<div style="width:983px; height:29px; margin-top:35px; margin-bottom:20px">
    
            	
                <div class="buttons2" style="float:right" onClick="recallCust()">Cancel Add</div>
                <div class="buttons" style="float:right; margin-right:15px" onClick="runForm()">Save Customer</div>
                </div>
								';
								
								
								//////WE DO NOT NEED ESTIMATES AND INVOICE SECTION ON ADD///////
								
								echo $tabs;
}


////GET NEW CONTACT FORM////
if($act == 'contactadd'){
echo '<div style="text-align:right; margin-bottom:20px"><input class="neat2"  name="primcon" id="primcon" type="checkbox" value="">Primary Contact</div>
    <div style="width:330px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px">First Name:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="confname" id="confname" type="text" tabindex="1"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px">Title:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="contitle" id="contitle" type="text" tabindex="3"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px">Phone:</div>
    <div style="width:199px; height:26px; float: left; "><input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="conph1" id="conph1" type="text" tabindex="5" onKeyUp="runThr(\'conph1\')"> <input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="conph2" id="conph2" type="text" tabindex="6" onKeyUp="runThr(\'conph2\')"> <input style="width:50px;" maxlength="4" class="neat2" name="conph3" id="conph3" type="text" tabindex="7">
	<input style="width:30px; margin-left:2px" class="neat2" name="conph4" id="conph4" type="text" tabindex="8" value="ext" onclick="this.value=\'\'">
	</div>
	<div style="clear:both"></div>
	<div style="width:131px; height:26px; float: left; padding-top:5px">Cell Phone:</div>
    <div style="width:185px; height:26px; float: left; "><input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="cellph1" id="cellph1" type="text" tabindex="5" onKeyUp="runThr23(\'cellph1\')"> <input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="cellph2" id="cellph2" type="text" tabindex="6" onKeyUp="runThr23(\'cellph2\')"> <input style="width:50px;" maxlength="4" class="neat2" name="cellph3" id="cellph3" type="text" tabindex="7">
	</div>
	
	
    </div>
    
    <div style="width:285px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Last Name:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="conlname" id="conlname" type="text" tabindex="2"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Email:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="conemail" id="conemail" type="text" tabindex="4"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Fax:</div>
    <div style="width:145px; height:26px; float: left; "><input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="confx1" id="confx1" type="text" tabindex="8" onKeyUp="runThr(\'confx1\')"> <input style="width:30px; margin-right:2px" maxlength="3" class="neat2" name="confx2" id="confx2" type="text" tabindex="9" onKeyUp="runThr(\'confx2\')"> <input style="width:40px;" maxlength="4" class="neat2" name="confx3" id="confx3" type="text" tabindex="10"></div>
    </div>
    
    <div style="clear:both"></div>
    
    <div style="padding:20px; text-align:right; margin-top:35px">
    <div id="contactbutton2" style="float:right; margin-left:20px" onClick="canconAd()">Cancel Add</div>
    <div id="contactbutton" style="float:right;" onClick="addContac()">Add Contact</div>
    
    </div>
    ';	
}



////GET NEW LOCATION FORM////
if($act == 'locationadd'){
echo '
<div style="width:285px;">
    <div style="width:131px; height:26px; float: left; padding-top:5px">Location Name:</div>
	<div style="width:131px; height:26px; float: left; "><input class="neat3" name="locname" id="locname" type="text" /></div>
	</div>
	 <div style="clear:both"></div>
<div style="width:285px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px">Address 1:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" name="locaddress1" id="locaddress1" type="text" tabindex="1"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px">Address 2:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" name="locaddress2" id="locaddress2" type="text" tabindex="2"></div>
    <div style="clear:both"></div>
	
	<div style="width:131px; height:26px; float: left; padding-top:5px">City:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" name="locacity" id="locacity" type="text" tabindex="3"></div>
	
	
	
    
    </div>
    
    <div style="width:285px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">State:</div>
    <div style="width:131px; height:26px; float: left; "><select class="neat3" id="locstate" name="locstate" tabindex="4">
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
</select></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Zip:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" style="width:90px" name="loczip" id="loczip" type="text" tabindex="5"></div>
    <div style="clear:both"></div>
	<div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">County:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" name="loccounty" id="loccounty" type="text" tabindex="6"></div>
	
    
    </div>
    
    <div style="clear:both"></div>
	
	<span style="font-size:20px; font-style:italic;">Tax Codes</span>
	
	<div class="infohead" style="width:605px">
									<div class="headtext" style="width:35px; border-right:solid thin #000;"><input name="allcheck" id="allcheck" type="checkbox" value="" onClick="chkAll(), checkCheck(1)"></div>
    									<div class="headtext" style="width:155px; border-right:solid thin #000; border-left:solid thin #CCC;">Name</div>
    										<div class="headtext" style="width:60px; border-right:solid thin #000; border-left:solid thin #CCC;">State</div>
   												 <div class="headtext" style="width:140px; border-right:solid thin #000; border-left:solid thin #CCC;">County</div>
    												<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Percent</div>
   														
														</div>
														
													
														<input name="checkvals" id="checkvals" type="hidden" value="">
	
	<div id="taxs" style="width:603px; height:143px; overflow-y:scroll; border:solid thin #999">';
	
			$f = mysql_query("SELECT * FROM tax_table WHERE active  = 'true' AND saasid = '".$_SESSION['saasid']."'");
			
				while($g = mysql_fetch_array($f)){
					echo '<div class="infoheadlines">
<div class="headtext2" style="width:35px;"><input class="checkers" name="" type="checkbox" value="'.$g["tax_id"].'" onClick="checkCheck()"></div>
<div class="headtext2" style="width:159px;">'.$g["tax_name"].'</div>
<div class="headtext2" style="width:60px;">'.$g["state"].'</div>
<div class="headtext2" style="width:140px;">'.$g["county"].'</div>
<div class="headtext2" style="width:110px;">'.$g["percent"].'</div>
</div>';
				}
	
echo '</div>
	</div>
    
    <div style="padding:20px; text-align:right; margin-top:35px">
    <div id="contactbutton3" style="float:right; margin-left:20px" onClick="canLoc()">Cancel Add</div>
    <div id="contactbutton4" style="float:right;" onClick="entLocs()">Add Location</div>
    
    </div>
    ';	
}


//////ADD LOCATION/////

if($act == 'pushlocation'){
	$cliid = $_REQUEST['cliid'];
$locname = mysql_real_escape_string($_REQUEST['locname']);
$locaddress1 = mysql_real_escape_string($_REQUEST['locaddress1']);
$locaddress2 = mysql_real_escape_string($_REQUEST['locaddress2']);
$locacity = mysql_real_escape_string($_REQUEST['locacity']);
$locstate = mysql_real_escape_string($_REQUEST['locstate']);
$loczip = mysql_real_escape_string($_REQUEST['loczip']);
$loccounty = mysql_real_escape_string($_REQUEST['loccounty']);
$zips = mysql_real_escape_string($_REQUEST['zips']);

mysql_query("INSERT INTO locations SET locname = '$locname', blong = '$cliid', address1 = '$locaddress1', address2 = '$locaddress2', city = '$locacity', state='$locstate', zip = '$loczip', county = '$loccounty', taxs = '$zips', active = 'true', saasid = '".$_SESSION['saasid']."'");

mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Added Location', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}

////GET LOCATION LIST///

if($act == 'getlocations'){
	
	$u = mysql_query("SELECT * FROM locations WHERE blong = '".$_REQUEST['cliid']."' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'");
		while($d = mysql_fetch_array($u)){
			
				$taxs = $d["taxs"];
				
					$tx = explode(',',$taxs);
						$getFirst = $tx[0];
						
							if($getFirst != ''){
							$p = mysql_fetch_array(mysql_query("SELECT * FROM tax_table WHERE tax_id = '$getFirst' AND saasid = '".$_SESSION['saasid']."'"));	
							}
			
		echo '<div class="infoheadlines">
		<div class="headtext2" style="width:205px;">'.$d["locname"].'</div>
			<div class="headtext2" style="width:155px;">'.$d["address1"].'</div>
				<div class="headtext2" style="width:105px;">'.$d["city"].'</div>
					<div class="headtext2" style="width:60px;">'.$d["state"].'</div>
						<div class="headtext2" style="width:90px;">'.$d["zip"].'</div>
							<div class="headtext2" style="width:130px;">'.$d["county"].'</div>
						<!--<div class="headtext2" style="width:90px;">'.$p["percent"].'%</div>-->
					<div class="headtext2" style="width:90px; text-align:center">
				<div class="edit_icon" style="margin-left:25px" onClick="editLocation(\''.$d["locid"].'\')"></div>
			<div class="delete_icon" onClick="delLoc(\''.$d["locid"].'\')"></div>
		</div>
	</div>';	
}
}
if($act == 'checkcontacts'){
$newid = $_REQUEST['newid'];
	$t = mysql_num_rows(mysql_query("SELECT * FROM contacts WHERE blong = '$newid' AND isprime = 'true' AND saasid = '".$_SESSION['saasid']."'"));
		if($t > 0 ){
			echo 'true';	
		}else{
		echo '<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">You must add a primary contact in order to complete customer profile.</span>';	
		}
}



////INSERT NEW CUSTOMER////

if($act == 'insertcustomer'){
	$cliid = mysql_real_escape_string($_REQUEST['cliid']);
	$resalelic = mysql_real_escape_string($_REQUEST['resalelic']);
	$resaledt = mysql_real_escape_string($_REQUEST['resaledt']);
	$insexdt = mysql_real_escape_string($_REQUEST['insexdt']);
	$company = mysql_real_escape_string($_REQUEST['company']);
	$address1 = mysql_real_escape_string($_REQUEST['address1']);
	$address2 = mysql_real_escape_string($_REQUEST['address2']);
	$city = mysql_real_escape_string($_REQUEST['city']);
	$state = mysql_real_escape_string($_REQUEST['state']);
	$county = mysql_real_escape_string($_REQUEST['county']);
	$zip = mysql_real_escape_string($_REQUEST['zip']);
	$billaddress1 = mysql_real_escape_string($_REQUEST['billaddress1']);
	$billaddress2 = mysql_real_escape_string($_REQUEST['billaddress2']);
	$billcity = mysql_real_escape_string($_REQUEST['billcity']);
	$billstate = mysql_real_escape_string($_REQUEST['billstate']);
	$billzip = mysql_real_escape_string($_REQUEST['billzip']);
	$billterms = mysql_real_escape_string($_REQUEST['billterms']);
	$notes = mysql_real_escape_string($_REQUEST['notes']);
	$salespers = mysql_real_escape_string($_REQUEST['salespers']);
	$ism = $_REQUEST['ism'];
	
		mysql_query("UPDATE customers SET resalelicense='$resalelic', resalecertex='$resaledt', certiofins='$insexdt', companyname='$company', salescont='$salespers', address1='$address1', address2='$address2', city='$city', state='$state', county='$county', zip='$zip', billaddress1='$billaddress1', billaddress2='$billaddress2', billcity='$billcity', billstate='$billstate', billzip='$billzip', bill_term = '$billterms', notes='$notes', active='true', rowstate='used', issamebill='$ism', saasid='".$_SESSION['saasid']."' WHERE cust_id = '$cliid'")or die(mysql_error());
		
		mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Edit Customer', saasid='".$_SESSION['saasid']."'")or die(mysql_error()); 
}


////INSERT CONTACT////

if($act == 'addcontact'){
	

	
	$blong = $_REQUEST['blong'];
	$firstname = mysql_real_escape_string($_REQUEST['firstname']);
	$lastname = mysql_real_escape_string($_REQUEST['lastname']);
	$title = mysql_real_escape_string($_REQUEST['title']);
	$email = mysql_real_escape_string($_REQUEST['email']);
	$phone = mysql_real_escape_string($_REQUEST['phone']);
	$cell = mysql_real_escape_string($_REQUEST['cell']);
	$fax = mysql_real_escape_string($_REQUEST['fax']);
	$prime = $_REQUEST['prime'];
	
		mysql_query("INSERT INTO contacts SET blong='$blong', firstname='$firstname', lastname='$lastname', title='$title', email='$email', phone='$phone', cell='$cell', fax='$fax', active='true', isprime='$prime', saasid='".$_SESSION['saasid']."'");
		
		mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Added Contact', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}

////GET CONTACTS////

if($act == 'getcontacts'){
	
	$r = mysql_query("SELECT * FROM contacts WHERE blong = '".$_REQUEST['cliid']."' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'");
	
		while($t = mysql_fetch_array($r)){
			
				if($t["isprime"] == 'true'){
					
					$class = 'infoheadlines2';
				}else{
				$class = 'infoheadlines';	
				}
			
			echo'<div class="'.$class.'">
						<div class="headtext2" style="width:162px;">'.$t["firstname"].'</div>
   							 <div class="headtext2" style="width:155px;">'.$t["lastname"].'</div>
   								 <div class="headtext2" style="width:97px;">'.$t["title"].'</div>
    						<div class="headtext2" style="width:135px;">'.$t["phone"].'</div>
							<div class="headtext2" style="width:244px;">'.$t["email"].'</div>
   						 <div class="headtext2" style="width:80px; text-align:center">
   					 <div class="edit_icon" style="margin-left:25px" onClick="editContact(\''.$t["cont_id"].'\')"></div>
    			<div class="delete_icon" onClick="delCon(\''.$t["cont_id"].'\')"></div>
   			 </div>
		</div>';	
			
		}
	

}



//////----------------------------------Begin Customer Edits-----------------------------------------////////


////GET ENTIRE CUSTOMER TABS////

if($act == 'getcustomerinfo'){
			$custId = $_REQUEST['cliid'];
		$e = mysql_fetch_array(mysql_query("SELECT * FROM customers WHERE cust_id = '$custId' AND saasid = '".$_SESSION['saasid']."'"));
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Viewed Customer - $custId', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
	
	$tabs .= '<div id="tabs" style="display:block; font-family: \'Quantico\', sans-serif;">
	<ul>
		<li><a href="#tabs-1">Profile</a></li>
		<li><a href="#tabs-2">Locations</a></li>
		<li><a href="#tabs-3">Contacts</a></li>
		<li><a href="#tabs-4">Transactions</a></li>
		<li><a href="#tabs-5">Files</a></li>
	</ul>';
	
	$tabs .= '<div id="tabs-1">
   <!--license info-->
	<input name="cliid" id="cliid" type="hidden" value="'.$custId.'">
		<div style="width:990px; height:39px; border-bottom:solid thin #666;">
        <div style="width:223px; height:39px; float:left">
        	<div style="float:left; margin-right:5px; padding-top:5px"><strong style="font-size:10px">Resale License #</strong></div> 
            	<div style="float:left"><input class="neat" style="width:98px;" name="resalelic" id="resalelic" type="text" value="'.$e["resalelicense"].'"></div>
                </div>
                
                <div style="width:315px; height:39px; float:left; margin-left:30px">
        	<div style="float:left; margin-right:5px; padding-top:5px"><strong style="font-size:10px">Resale Certificate Exp. Date</strong></div> 
            	<div style="float:left"><input class="neat" style="width:98px;" name="resaledt" id="resaledt" type="text" value="'.$e["resalecertex"].'"></div>
                </div>
                
                <div style="width:344px; height:39px; float:left; margin-left:30px">
        	<div style="float:left; margin-right:5px; padding-top:5px"><strong style="font-size:10px">Certificate of Insurance Exp. Date</strong></div> 
            	<div style="float:left"><input class="neat" style="width:98px;" name="insexdt" id="insexdt" type="text" value="'.$e["certiofins"].'"></div>
                </div>
        </div>
	
    
    
    <!--license info end-->
        
        <!--profile info-->
    <div style="width:990px; height:39px; border-bottom:solid thin #999; padding-top:15px">
    
    <div style="width:823px; height:39px; float:left">
        	<div style="float:left; margin-right:100px; padding-top:5px"><strong>Company</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="company" id="company" type="text" value="'.$e["companyname"].'"></div>
				
				<div style="float:left; margin-right:20px; margin-left:20px; padding-top:5px"><strong>Sales Person: </strong></div> 
            	<div style="float:left">';
				$tabs .='<select class="neat" name="salespers" id="salespers"><option value="none" >Select Sales Person...</option>';
				$rth = mysql_query("SELECT * FROM core_users WHERE usrtyp = 'salesman' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'");
				while($d=mysql_fetch_array($rth)){
					if($e["salescont"] == $d["usr_id"]){
						$tabs .='<option value="'.$d["usr_id"].'" selected="selected">'.$d["fname"].' '.$d["lname"].'</option>';
					}else{
				$tabs .='<option value="'.$d["usr_id"].'">'.$d["fname"].' '.$d["lname"].'</option>';
					}
				}
				$tabs .= '</select>';
				
				$tabs .= '</div>
                </div>
    
    </div>
    
    <div style="width:990px; height:220px; border-bottom:solid thin #999; padding-top:10px">
    
    <div style="width:723px; height:39px;">
    <div style="margin-right:100px; padding-top:5px; font-size:20px; font-style:italic;"><strong>Address</strong></div></div>
    
    <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Address 1</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="address1" id="address1" type="text" value="'.$e["address1"].'"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Address 2</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="address2" id="address2" type="text" value="'.$e["address2"].'"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>City</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="city" id="city" type="text" value="'.$e["city"].'"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>State</strong></div> 
            	<div style="float:left"><select class="neat" id="state" name="state">
				<option value="'.$e["state"].'" selected="selected">'.$e["state"].'</option>
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
</select></div>
                </div>
                
                
                 <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>County</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="county" id="county" type="text" value="'.$e["county"].'"></div>
                </div>
                
                
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Zip</strong></div> 
            	<div style="float:left"><input class="neat" style="width:90px" name="zip" id="zip" type="text" value="'.$e["zip"].'"></div>
                </div>
                
                
                
                
                
                
                
                
                
    	</div>
        
        
        <!--billing-->
        <div style="width:990px; height:auto; overflow:auto; border-bottom:solid thin #999; padding-top:10px; padding-bottom:20px">
    
    <div style="width:723px; height:39px;">
    <div style="margin-right:100px; padding-top:5px; font-size:20px; font-style:italic;"><strong>Billing Address</strong> 
      </div></div>
    
     <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong></strong></div>';
	
	if($e["issamebill"] == 'true'){
		$check = 'checked="checked"';
		$bilshow = 'none';
	}else{
		$check = '';
		$bilshow = 'block';
	}
	
            	$tabs .='<div style="float:left"><input class="neat" type="checkbox" name="issame" id="issame" '.$check.' onClick="sameBill()">
    <span style="font-size:11px; font-style:normal;">Same as main address</span></div>
                </div>
    <div id="billadrd" style="display:'.$bilshow.'">
    <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Address 1</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="billaddress1" id="billaddress1" type="text" value="'.$e["billaddress1"].'"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Address 2</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="billaddress2" id="billaddress2" type="text" value="'.$e["billaddress1"].'"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>City</strong></div> 
            	<div style="float:left"><input class="neat" style="width:230px" name="billcity" id="billcity" type="text" value="'.$e["billcity"].'"></div>
                </div>
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>State</strong></div> 
            	<div style="float:left"><select class="neat" id="billstate" name="billstate">
				<option value="'.$e["billstate"].'">'.$e["billstate"].'</option>
				
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
</select></div>
                </div>
                
                
                
                <div style="width:723px; height:29px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Zip</strong></div> 
            	<div style="float:left"><input class="neat" style="width:90px" name="billzip" id="billzip" type="text" value="'.$e["billzip"].'"></div>
                </div>
                
                
                </div>
                
                
                
                
                
                
                
                
                
    	</div>
        
        <!--end billing-->
        
        
        <!--notes-->
        <div style="width:990px; height:150px; border-bottom:solid thin #999; padding-top:10px">
        <div style="width:723px; height:110px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Notes</strong></div> 
            	<div style="float:left"><textarea style="width:422px; height:101px; resize:none;" class="neat" name="notes" id="notes" cols="" rows="">'.$e["notes"].'</textarea></div>
				 </div>
				
				 <div style="width:723px; height:110px;">
    <div style="float:left; width:161px; padding-top:5px"><strong>Billing Terms</strong></div> 
            	<div style="float:left"><select name="billterms" id="billterms">
				<option value="none">Select Term...</option>';
				if($e["bill_term"] == '30'){$sel1 = 'selected="selected"';}else{$sel1 = '';}
				if($e["bill_term"] == '60'){$sel2 = 'selected="selected"';}else{$sel2 = '';}
				if($e["bill_term"] == '70'){$sel3 = 'selected="selected"';}else{$sel3 = '';}
				if($e["bill_term"] == '120'){$sel4 = 'selected="selected"';}else{$sel4 = '';}
				
				$tabs.='<option value="30" '.$sel1.'>30 Days</option>
				<option value="60" '.$sel2.'>60 Days</option>
				<option value="90" '.$sel3.'>90 Days</option>
				<option value="120" '.$sel4.'>120 Days</option>
				</select></div>
               
				
				
                </div>
				
				
                <!--notes end-->
                
                
        </div>
        </div>';
				
				
				/////////////////LOCATION TAB////////
				
				
				$tabs .= '<div id="tabs-2">
							<div style="padding:5px;"><div class="buttons3" onClick="addLocation()">New Location</div></div>
    							 <div class="infohead">
								 <div class="headtext" style="width: 205px; border-right:solid thin #000;">Location Name</div>
									<div class="headtext" style="width: 155px; border-right:solid thin #000; border-left:solid thin #CCC;">Address</div>
    									<div class="headtext" style="width: 105px; border-right:solid thin #000; border-left:solid thin #CCC;">City</div>
    										<div class="headtext" style="width:60px; border-right:solid thin #000; border-left:solid thin #CCC;">State</div>
   												 <div class="headtext" style="width:90px; border-right:solid thin #000; border-left:solid thin #CCC;">Zip</div>
    												<div class="headtext" style="width:130px; border-right:solid thin #000; border-left:solid thin #CCC;">County</div>
   														 <!--<div class="headtext" style="width:90px; border-left:solid thin #CCC;">Tax Codes</div>-->
   															 <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Actions</div>
														</div>';
														
													///////LOCATION LINES ITEMS////
													$tabs .='<div id="newlochold">';
													
													
													$tabs .= '</div>';
												$tabs .= '</div>';
												
												
					///////////////CONTACTS INFO////////////
					
						$tabs .= '<div id="tabs-3">';
						
						
						
						$tabs .= '
							<div style="padding:5px;"><div class="buttons3" onClick="addContact()">New Contact</div></div>
    							 <div class="infohead">
									<div class="headtext" style="width:155px; border-right:solid thin #000;">First Name</div>
    									<div class="headtext" style="width:155px; border-right:solid thin #000; border-left:solid thin #CCC;">Last Name</div>
    										<div class="headtext" style="width:95px; border-right:solid thin #000; border-left:solid thin #CCC;">Title</div>
   												 <div class="headtext" style="width:133px; border-right:solid thin #000; border-left:solid thin #CCC;">Phone</div>
    												<div class="headtext" style="width:244px; border-right:solid thin #000; border-left:solid thin #CCC;">Email</div>
   														<div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Actions</div>
														</div>';
														
														$tabs .='<div id="contacthold">';
														
														$tabs .='</div></div>';
														
						
						
						
								
								
								
								$tabs .='<div id="tabs-4">
								
									<div class="infohead">
									<div class="headtext" style="width:155px; border-right:solid thin #000;">Date</div>
    									<div class="headtext" style="width: 355px; border-right:solid thin #000; border-left:solid thin #CCC;">Type</div>
    										<div class="headtext" style="width: 165px; border-right:solid thin #000; border-left:solid thin #CCC;">Ref #</div>
   												 <div class="headtext" style="width:133px;  border-left:solid thin #CCC;">Amount</div>
														</div>';
														
														$bv = mysql_query("SELECT * FROM invoice_payments WHERE saasid = '".$_SESSION['saasid']."'");
														$invpay = 0;
														$totPaty = 0;
															while($d=mysql_fetch_array($bv)){
																
															$f=mysql_fetch_array(mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$d["inv_num"]."'"));
															
																if($f["company_id"] == $custId){
														
														$tabs .='<div class="infoheadlines">
						<div class="headtext2" style="width:155px;">'.$d["date"].'</div>
   							 <div class="headtext2" style="width:355px;">Payment</div>
   								 <div class="headtext2" style="width:165px;">'.$d["inv_num"].'</div>
    						<div class="headtext2" style="width:133px;">$'.$d["amount"].'</div></div>';
							
							$totPaty = str_replace(',','',$f["value"]);
							
							$invpay += $d["amount"];
								
							}	
							
							$cal = $totPaty - $invpay;
							
							
															}
															$tabs .= '<div style="padding:25px; text-align:right;"><strong>Balance:</strong> $'.number_format($cal,2).'</div>';
								
								$tabs .='</div>';
								
								
								$tabs .='<div id="tabs-5">';
								
								$tabs .='<input type="file" name="file_upload" id="file_upload" />
								<input name="ourcli" id="ourcli" type="hidden" value="'.$custId.'" />';
								
								$tabs .='<div class="infohead">
									<div class="headtext" style="width:255px; border-right:solid thin #000;">File Name</div>
    									<div class="headtext" style="width: 355px; border-right:solid thin #000; border-left:solid thin #CCC;">Date Uploaded</div>
    										
   												 <div class="headtext" style="width:223px;  border-left:solid thin #CCC;">Action</div>
														</div>';
														
														
														$tabs .='<div id="holduploads"></div>';
								
								
								
								$tabs .='</div>';
								
								
								
								
								$tabs .='<div style="width:983px; height:29px; margin-top:35px; margin-bottom:20px">
    
            	
                <div class="buttons2" style="float:right" onClick="recallCust()">Cancel Edit</div>
                <div class="buttons" style="float:right; margin-right:15px" onClick="runForm()">Save Customer</div>
                </div>
								';
								
								
								//////WE DO NOT NEED ESTIMATES AND INVOICE SECTION ON ADD///////
								
								echo $tabs;
	
	
}

///DELETE CUSTOMER PROFILES////
if($act == 'deletecust'){
	
	mysql_query("UPDATE customers SET active = 'false' WHERE cust_id = '".$_REQUEST['cliid']."' AND saasid = '".$_SESSION['saasid']."'")or die(mysql_error());
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Deleted Customer - ".$_REQUEST['cliid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}



////EDIT LOCATION FORM///

if($act == 'editlocs'){
	
	
	echo '<div style="text-align:right; margin-bottom:20px"><input class="neat2"  name="primcon" id="primcon" type="checkbox" value="">Primary Contact</div>
    <div style="width:285px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px">First Name:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="confname" id="confname" type="text" tabindex="1"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px">Title:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="contitle" id="contitle" type="text" tabindex="3"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px">Phone:</div>
    <div style="width:145px; height:26px; float: left; "><input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="conph1" id="conph1" type="text" tabindex="5" onKeyUp="runThr(\'conph1\')"> <input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="conph2" id="conph2" type="text" tabindex="6" onKeyUp="runThr(\'conph2\')"> <input style="width:50px;" maxlength="4" class="neat2" name="conph3" id="conph3" type="text" tabindex="7"></div>
    </div>
    
    <div style="width:285px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Last Name:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="conlname" id="conlname" type="text" tabindex="2"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Email:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="conemail" id="conemail" type="text" tabindex="4"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Fax:</div>
    <div style="width:145px; height:26px; float: left; "><input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="confx1" id="confx1" type="text" tabindex="8" onKeyUp="runThr(\'confx1\')"> <input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="confx2" id="confx2" type="text" tabindex="9" onKeyUp="runThr(\'confx2\')"> <input style="width:50px;" maxlength="4" class="neat2" name="confx3" id="confx3" type="text" tabindex="10"></div>
    </div>
    
    <div style="clear:both"></div>
    
    <div style="padding:20px; text-align:right; margin-top:35px">
    <div id="contactbutton2" style="float:right; margin-left:20px" onClick="canconAdd()">Cancel Edit</div>
    <div id="contactbutton" style="float:right;" onClick="addContac()">Add Contact</div>
    
    </div>
    ';	
}



////GET NEW LOCATION FORM////
if($act == 'locationedit'){
	
	$r = mysql_fetch_array(mysql_query("SELECT * FROM locations WHERE locid = '".$_REQUEST['locid']."' AND saasid = '".$_SESSION['saasid']."'"));
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Viewed Location - ".$_REQUEST['locid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
	
echo '<input name="locationid" id="locationid" type="hidden" value="'.$_REQUEST['locid'].'" />
<div style="width:285px;">
    <div style="width:131px; height:26px; float: left; padding-top:5px">Location Name:</div>
	<div style="width:131px; height:26px; float: left; "><input class="neat3" name="locname" id="locname" type="text" value="'.$r["locname"].'"/></div>
	</div>
	 <div style="clear:both"></div>
<div style="width:285px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px">Address 1:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" name="locaddress1" id="locaddress1" type="text" tabindex="1" value="'.$r["address1"].'"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px">Address 2:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" name="locaddress2" id="locaddress2" type="text" tabindex="2" value="'.$r["address2"].'"></div>
    <div style="clear:both"></div>
	
	<div style="width:131px; height:26px; float: left; padding-top:5px">City:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" name="locacity" id="locacity" type="text" tabindex="3" value="'.$r["city"].'"></div>
	
	
	
    
    </div>
    
    <div style="width:285px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">State:</div>
    <div style="width:131px; height:26px; float: left; "><select class="neat3" id="locstate" name="locstate" tabindex="4">
	<option value="'.$r["state"].'" selected="selected">'.$r["state"].'</option>
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
</select></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Zip:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" style="width:90px" name="loczip" id="loczip" type="text" tabindex="5" value="'.$r["zip"].'"></div>
    <div style="clear:both"></div>
	<div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">County:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat3" name="loccounty" id="loccounty" type="text" tabindex="6" value="'.$r["county"].'"></div>
	
    
    </div>
    
    <div style="clear:both"></div>
	
	<div style="padding:10px;"><a href="javascript:openFilesset()">Attach File</a></div>
	
	  <div id="boundedfiles" style="width:597px; height:108px; overflow-y:scroll; background-color: #f2f0f1; margin-bottom:20px"></div>
	
	
	<span style="font-size:20px; font-style:italic;">Tax Codes</span>
	
	<div class="infohead" style="width:605px">
									<div class="headtext" style="width:35px; border-right:solid thin #000;"><input name="allcheck" id="allcheck" type="checkbox" value="" onClick="chkAll(), checkCheck(1)"></div>
    									<div class="headtext" style="width:155px; border-right:solid thin #000; border-left:solid thin #CCC;">Name</div>
    										<div class="headtext" style="width:60px; border-right:solid thin #000; border-left:solid thin #CCC;">State</div>
   												 <div class="headtext" style="width:140px; border-right:solid thin #000; border-left:solid thin #CCC;">County</div>
    												<div class="headtext" style="width:120px; border-left:solid thin #CCC;">Percent</div>
   														
														</div>
														
													
														<input name="checkvals" id="checkvals" type="hidden" value="'.$r["taxs"].'">
	
	<div id="taxs" style="width:603px; height:143px; overflow-y:scroll; border:solid thin #999">';
	
	
	
	
	
	
	
	
	
			$f = mysql_query("SELECT * FROM tax_table WHERE active  = 'true' AND saasid = '".$_SESSION['saasid']."'");
			
				while($g = mysql_fetch_array($f)){
					
					
					$ext = explode(",",$r["taxs"]);
					
					if (in_array($g["tax_id"], $ext)) {
  						$check = 'checked="checked"';
							}else{
							$check = '';	
							}
					
					
					
					echo '<div class="infoheadlines">
<div class="headtext2" style="width:35px;"><input class="checkers" name="" type="checkbox" value="'.$g["tax_id"].'" '.$check.' onClick="checkCheck()"></div>
<div class="headtext2" style="width:159px;">'.$g["tax_name"].'</div>
<div class="headtext2" style="width:60px;">'.$g["state"].'</div>
<div class="headtext2" style="width:140px;">'.$g["county"].'</div>
<div class="headtext2" style="width:110px;">'.$g["percent"].'</div>
</div>';
		}
				
	
echo '</div>
	</div>
    
    <div style="padding:20px; text-align:right; margin-top:35px">
    <div id="contactbutton3" style="float:right; margin-left:20px" onClick="canLoc()">Cancel Edit</div>
    <div id="contactbutton4" style="float:right;" onClick="edLocs(\''.$_REQUEST['locid'].'\')">Edit Location</div>
    
    </div>';
}



////EDIT LOCATION////

if($act == 'editlocation'){
	$locid = $_REQUEST['locid'];
	$locname = mysql_real_escape_string($_REQUEST['locname']);
$locaddress1 = mysql_real_escape_string($_REQUEST['locaddress1']);
$locaddress2 = mysql_real_escape_string($_REQUEST['locaddress2']);
$locacity = mysql_real_escape_string($_REQUEST['locacity']);
$locstate = mysql_real_escape_string($_REQUEST['locstate']);
$loczip = mysql_real_escape_string($_REQUEST['loczip']);
$loccounty = mysql_real_escape_string($_REQUEST['loccounty']);
$zips = mysql_real_escape_string($_REQUEST['zips']);

mysql_query("UPDATE locations SET locname = '$locname', address1 = '$locaddress1', address2 = '$locaddress2', city = '$locacity', state='$locstate', zip = '$loczip', county = '$loccounty', taxs = '$zips' WHERE locid='$locid' AND saasid = '".$_SESSION['saasid']."'");

mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Edit Location - $locid', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}



/////EDIT CONTACT FORM/////

if($act == 'editcontact'){
	
	
	$u = mysql_fetch_array(mysql_query("SELECT * FROM contacts WHERE cont_id = '".$_REQUEST['contactid']."' AND saasid = '".$_SESSION['saasid']."'"));
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Viewed Contact - ".$_REQUEST['contactid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
			if($u["isprime"] == 'true'){
				$check = 'checked="checked"';
			}else{
				$check = '';
			}
	
echo '<div style="text-align:right; margin-bottom:20px"><input class="neat2"  name="primcon" id="primcon" type="checkbox" value="" '.$check.'>Primary Contact</div>
    <div style="width:350px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px">First Name:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="confname" id="confname" type="text" tabindex="1" value="'.$u["firstname"].'"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px">Title:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="contitle" id="contitle" type="text" tabindex="3" value="'.$u["title"].'"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px">Phone:</div>';
	
	$ty = explode(".",$u["phone"]);
	$tycell = explode(".",$u["cell"]);
	
    echo '<div style="width:209px; height:26px; float: left; "><input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="conph1" id="conph1" type="text" tabindex="5" value="'.$ty[0].'" onKeyUp="runThr(\'conph1\')"> <input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="conph2" id="conph2" type="text" tabindex="6" value="'.$ty[1].'" onKeyUp="runThr(\'conph2\')"> <input style="width:50px;" maxlength="4" class="neat2" name="conph3" id="conph3" type="text" value="'.$ty[2].'" tabindex="7">
	<input style="width:40px; margin-left:2px" class="neat2" name="conph4" id="conph4" type="text" tabindex="8" value="'.$ty[3].'" onclick="this.value=\'\'">
	
	</div>
	<div style="clear:both"></div>
	<div style="width:131px; height:26px; float: left; padding-top:5px">Cell Phone:</div>
    <div style="width:185px; height:26px; float: left; "><input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="cellph1" id="cellph1" type="text" tabindex="5" onKeyUp="runThr23(\'cellph1\')" value="'.$tycell[0].'"> <input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="cellph2" id="cellph2" type="text" tabindex="6" onKeyUp="runThr23(\'cellph2\')" value="'.$tycell[1].'"> <input style="width:50px;" maxlength="4" class="neat2" name="cellph3" id="cellph3" type="text" tabindex="7" value="'.$tycell[2].'">
	</div>
	</div>
  
    
    <div style="width:285px; float:left">
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Last Name:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="conlname" id="conlname" type="text" tabindex="2" value="'.$u["lastname"].'"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Email:</div>
    <div style="width:131px; height:26px; float: left; "><input class="neat2" name="conemail" id="conemail" type="text" tabindex="4" value="'.$u["email"].'"></div>
    <div style="clear:both"></div>
    <div style="width:131px; height:26px; float: left; padding-top:5px; text-align:right">Fax:</div>';
	
	$ty2 = explode(".",$u["fax"]);
	
    echo '<div style="width:150px; height:26px; float: left; "><input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="confx1" id="confx1" type="text" tabindex="8" value="'.$ty2[0].'" onKeyUp="runThr(\'confx1\')"> <input style="width:40px; margin-right:2px" maxlength="3" class="neat2" name="confx2" id="confx2" type="text" tabindex="9" value="'.$ty2[1].'" onKeyUp="runThr(\'confx2\')"> <input style="width:40px;" maxlength="4" class="neat2" name="confx3" id="confx3" type="text" tabindex="10" value="'.$ty2[2].'"></div>
    </div>
    
    <div style="clear:both"></div>
    
    <div style="padding:20px; text-align:right; margin-top:35px">
    <div id="contactbutton2" style="float:right; margin-left:20px" onClick="canconAd()">Cancel Edit</div>
    <div id="contactbutton" style="float:right;" onClick="editContac(\''.$u["cont_id"].'\')">Edit Contact</div>
    
    </div>
    ';		
}


if($act == 'editcontact2'){
	

	
	$conid = $_REQUEST['conid'];
	$firstname = mysql_real_escape_string($_REQUEST['firstname']);
	$lastname = mysql_real_escape_string($_REQUEST['lastname']);
	$title = mysql_real_escape_string($_REQUEST['title']);
	$email = mysql_real_escape_string($_REQUEST['email']);
	$phone = mysql_real_escape_string($_REQUEST['phone']);
	$cell = mysql_real_escape_string($_REQUEST['cell']);
	$fax = mysql_real_escape_string($_REQUEST['fax']);
	$prime = $_REQUEST['prime'];
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Edit Contact - $conid', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
		if($prime != 'true'){
			
			$t = mysql_fetch_array(mysql_query("SELECT * FROM contacts WHERE cont_id = '$conid' AND saasid = '".$_SESSION['saasid']."'"));
			
				$op = mysql_query("SELECT * FROM contacts WHERE blong = '".$t["blong"]."' AND isprime = 'true' AND cont_id != '$conid' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'");
				
					$gets = mysql_num_rows($op);
					
						if($gets > 0){
							mysql_query("UPDATE contacts SET  firstname='$firstname', lastname='$lastname', title='$title', email='$email', phone='$phone', cell='$cell', fax='$fax', isprime='$prime' WHERE cont_id = '$conid' AND saasid = '".$_SESSION['saasid']."'") or die(mysql_error());
							echo 'good';	
						}else{
						echo 'primeerror';	
						}
				
					
			
		}else{
	
		mysql_query("UPDATE contacts SET  firstname='$firstname', lastname='$lastname', title='$title', email='$email', phone='$phone', cell='$cell', fax='$fax', isprime='$prime' WHERE cont_id = '$conid' AND saasid = '".$_SESSION['saasid']."'");
		echo 'good';
		}
	
}

if($act == 'deleteloc'){
	mysql_query("UPDATE locations SET active = 'false' WHERE locid = '".$_REQUEST['locid']."' AND saasid = '".$_SESSION['saasid']."'");
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Deleted Location - ".$_REQUEST['locid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
}


///deletecon&conid

if($act == 'deletecon'){
	
	
	$t = mysql_fetch_array(mysql_query("SELECT * FROM contacts WHERE cont_id = '".$_REQUEST['conid']."' AND saasid = '".$_SESSION['saasid']."'"));
			
				$op = mysql_query("SELECT * FROM contacts WHERE blong = '".$t["blong"]."' AND isprime = 'true' AND cont_id != '".$_REQUEST['conid']."' AND active = 'true' AND saasid = '".$_SESSION['saasid']."'");
				
					$gets = mysql_num_rows($op);
					
						if($gets > 0){
							mysql_query("UPDATE contacts SET active = 'false' WHERE cont_id = '".$_REQUEST['conid']."' AND saasid = '".$_SESSION['saasid']."'");
							mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Deleted Contact - ".$_REQUEST['conid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
							echo 'good';	
						}else{
						echo 'primeerror';	
						}
					
}


///PULL UPLOADS///
//getuploads&clid='+userid+'&pagemod
if($act == 'getuploads'){
	$r = mysql_query("SELECT * FROM uploads WHERE cli_id = '".$_REQUEST['clid']."' AND mod_section = '".$_REQUEST['pagemod']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'") or die(mysql_error());
	
		while($e=mysql_fetch_array($r)){
			
			$q = end(explode('.',$e["filename"]));
			
			
			
			
				if($q == 'jpg' || $q == 'jpeg' || $q == 'gif' || $q == 'png'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -12px -144px; float:left"></div>';}
				if($q == 'doc'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -13px -96px; float:left"></div>';}
				if($q == 'docx'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -13px -96px; float:left"></div>';}
				if($q == 'pdf'){ $icon = '<div style="width:37px; height:28px; background-image: url(images/iconset.gif); background-position: -201px -96px; float:left"></div>';}
				if($q == 'csv'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px -95px; float:left"></div>';}
				if($q == 'xls'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px -95px; float:left"></div>';}
				if($q == 'txt'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px 0px; float:left"></div>';}
				if($q == 'zip'){ $icon = '<div style="width:38px; height:28px; background-image: url(images/iconset.gif); background-position: -135px 0px; float:left"></div>';}
				
				if(strlen($e["filename"]) > 31 ){
				$fileName = substr($e["filename"], 0, 27).'...';
				}else{
				$fileName = $e["filename"];	
				}
			
			echo '<div class="infoheadlines">
						<div class="headtext2" style="width:258px;">'.$fileName.'</div>
   							 <div class="headtext2" style="width:355px;">'.$e["dateups"].'</div>
   								 <div class="headtext2" style="width:223px;"><a href="uploads/'.$e["filename"].'" target="_blank">'.$icon.' <span style="float:left">Download</span> </a> | <a href="javascript:delFiles(\''.$e["up_id"].'\')">Delete</a></div>
    						</div>';
		}
	
}

if($act == 'getuploads2'){
	$r = mysql_query("SELECT * FROM uploads WHERE cli_id = '".$_REQUEST['clid']."' AND mod_section = '".$_REQUEST['pagemod']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'") or die(mysql_error());
	
	echo '<div style="width:402px; height:193px; overflow-y:scroll">';
	
		while($e=mysql_fetch_array($r)){
			
			$q = end(explode('.',$e["filename"]));
				if($q == 'jpg' || $q == 'jpeg' || $q == 'gif' || $q == 'png'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -12px -144px; float:left"></div>';}
				if($q == 'doc'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -13px -96px; float:left"></div>';}
				if($q == 'docx'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -13px -96px; float:left"></div>';}
				if($q == 'pdf'){ $icon = '<div style="width:37px; height:28px; background-image: url(images/iconset.gif); background-position: -201px -96px; float:left"></div>';}
				if($q == 'csv'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px -95px; float:left"></div>';}
				if($q == 'xls'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px -95px; float:left"></div>';}
				if($q == 'txt'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px 0px; float:left"></div>';}
				if($q == 'zip'){ $icon = '<div style="width:38px; height:28px; background-image: url(images/iconset.gif); background-position: -135px 0px; float:left"></div>';}
				
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

//goonatt&fileid='+val+'&locid
if($act == 'goonatt'){
	mysql_query("INSERT INTO uploads SET mod_section = 'location',	cli_id = '".$_REQUEST['locid']."', filename = '".$_REQUEST['fileid']."', saasid = '".$_SESSION['saasid']."'");
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Added File - ".$_REQUEST['fileid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
	
}

///getthemnow&locid
if($act == 'getthemnow'){

$r = mysql_query("SELECT * FROM uploads WHERE  mod_section = 'location' AND cli_id = '".$_REQUEST['locid']."' AND saasid = '".$_SESSION['saasid']."'") or die(mysql_error());
	
	
	
		while($v=mysql_fetch_array($r)){
			
			$e = mysql_fetch_array(mysql_query("SELECT * FROM uploads WHERE up_id = '".$v["filename"]."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'")) or die(mysql_error());
			
			$q = end(explode('.',$e["filename"]));
		
				if($q == 'jpg' || $q == 'jpeg' || $q == 'gif' || $q == 'png'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -12px -144px; float:left"></div>';}
				if($q == 'doc'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -13px -96px; float:left"></div>';}
				if($q == 'docx'){ $icon = '<div style="width:24px; height:28px; background-image: url(images/iconset.gif); background-position: -13px -96px; float:left"></div>';}
				if($q == 'pdf'){ $icon = '<div style="width:37px; height:28px; background-image: url(images/iconset.gif); background-position: -201px -96px; float:left"></div>';}
				if($q == 'csv'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px -95px; float:left"></div>';}
				if($q == 'xls'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px -95px; float:left"></div>';}
				if($q == 'txt'){ $icon = '<div style="width:27px; height:28px; background-image: url(images/iconset.gif); background-position: -76px 0px; float:left"></div>';}
				if($q == 'zip'){ $icon = '<div style="width:38px; height:28px; background-image: url(images/iconset.gif); background-position: -135px 0px; float:left"></div>';}
				
				if(strlen($e["filename"]) > 17 ){
				$fileName = substr($e["filename"], 0, 17).'...';
				}else{
				$fileName = $e["filename"];	
				}
			
			
			
			echo '<div class="infoheadlines">
						<div class="headtext2" style="width:188px;">'.$fileName.'</div>
   								 <div class="headtext2" style="width:113px;"><a href="uploads/'.$e["filename"].'" target="_blank">'.$icon.' <span style="float:left">Download</span> </a></div>
    						</div>';
		}
		
		
}

///deletefile&fileid
if($act == 'deletefile'){
	mysql_query("DELETE FROM uploads WHERE up_id = '".$_REQUEST['fileid']."' AND saasid = '".$_SESSION['saasid']."'");
	mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = 'customers.php', action = 'Deleted File - ".$_REQUEST['fileid']."', saasid='".$_SESSION['saasid']."'")or die(mysql_error());

}
?>