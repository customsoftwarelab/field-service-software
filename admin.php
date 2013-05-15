<?php include('inc/header.php'); ?>
<script src="js/admin_actions.js" type="text/javascript"></script>
    <!--new  dialog-->
    <div id="dio1" style="display:none; padding-top:20px; font-family: 'Quantico', sans-serif;"></div>
    <!--new  dialog2-->
    <div id="dio2" style="display:none; padding-top:20px; font-family: 'Quantico', sans-serif; background-color:#FEF8CB"></div>
    <!--alerts-->
    <div id="alerts" style="display:none; width:432px; font-family: 'Quantico', sans-serif;" title="Alert"></div>
    
<div style="clear:both"></div>
<!--begin content holder-->
<div id="admin_tabhold" style="font-family: 'Quantico', sans-serif; margin-bottom:30px;">

<?php
$gn = mysql_query("SELECT * FROM core_users WHERE sessid = '".$_SESSION['acssess']."'")or die(mysql_error());
		$pn = mysql_fetch_array($gn);

?>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Group Permissions</a></li>
		<li><a href="#tabs-2">Users</a></li>
		<li><a href="#tabs-3">Vendors</a></li>
        <li><a href="#tabs-4">Inventory</a></li>
        <li><a href="#tabs-5">Fixed Assets</a></li>
        <li><a href="#tabs-6">Audit Log</a></li>
        <li><a href="#tabs-7">Reports</a></li>
        <li><a href="#tabs-8">Tax Manager</a></li>
        <li><a href="#tabs-9">Terms Manager</a></li>
	</ul>
	<div id="tabs-1">
    
    <?php if($pn["groups"] == 'true'){ ?>
    
    <div style="height:40px">
    <div id="addper" style="float:left" onClick="addGroup()">New Group</div>
    </div>
		
        <div class="infohead">
	<div class="headtext" style="width: 850px; border-right:solid thin #000; ">Group Name</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<!--group hold-->
<div id="listholdgrp">









</div>
<!--end group hold-->
	<?php }else{
		echo '<div style="padding:5px; font-style:italic; font-size:18px;"><strong style="color:#999;">Notice!</strong><br><span style="color:#FC0">You do not have Authorized Access to this Area. Contact your Administrator</span></div>';
	}
	?>
</div>
    
	<div id="tabs-2">
      <?php if($pn["users"] == 'true'){ ?>
    <div style="height:40px">
    <div id="addusr" style="float:left" onClick="addUser()">New User</div>
    <div style="padding:5px; float:right;"><input class="makerrsdrops" name="usrser" id="usrser" type="text" > <input class="makerrsdrops" name="" type="button" value="Search" onClick="getUserser(usrser.value)"></div>
    </div>
    
    <div class="infohead">
	<div class="headtext" style="width: 220px; border-right:solid thin #000; ">Name</div>
	<div class="headtext" style="width: 370px; border-right:solid thin #000; border-left: solid thin #CCC;">Email</div>
    <div class="headtext" style="width: 220px; border-right:solid thin #000; border-left:solid thin #CCC;">Group</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>

<!--user hold-->
<div id="userholder"></div>

<!--end user hold-->

<?php }else{
		echo '<div style="padding:5px; font-style:italic; font-size:18px;"><strong style="color:#999;">Notice!</strong><br><span style="color:#FC0">You do not have Authorized Access to this Area. Contact your Administrator</span></div>';
	}
	?>

	
	</div>
    
	<div id="tabs-3">
    <?php if($pn["vendor"] == 'true'){ ?>
    <div style="height:40px">
    <div id="addven" style="float:left" onClick="addVen()">New Vendor</div>
    <div style="padding:5px; float:right;"><input class="makerrsdrops" name="venser" id="venser" type="text"> <input class="makerrsdrops" name="" type="button" value="Search" onClick="getVendors2(venser.value)"></div>
    </div>
    
    <div class="infohead">
	<div class="headtext" style="width: 210px; border-right:solid thin #000; ">Vendor</div>
	<div class="headtext" style="width: 220px; border-right:solid thin #000; border-left: solid thin #CCC;">Contact</div>
    <div class="headtext" style="width: 220px; border-right:solid thin #000; border-left:solid thin #CCC;">Email</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;">Phone</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>

<!--vendor hold-->
<div id="vendorholder"></div>

<!--end vendor hold-->

<?php }else{
		echo '<div style="padding:5px; font-style:italic; font-size:18px;"><strong style="color:#999;">Notice!</strong><br><span style="color:#FC0">You do not have Authorized Access to this Area. Contact your Administrator</span></div>';
	}
	?>
		
	</div>
    
    <div id="tabs-4">
       <?php if($pn["inventory"] == 'true'){ ?>
    <div style="height:40px">
    <div id="addprod" style="float:left" onClick="runtypitem()">Create New</div>
    <div style="padding:5px; float:right;"><input class="makerrsdrops" name="prosersd" id="prosersd" type="text"> <input class="makerrsdrops" name="" type="button" value="Search" onClick="pullProdsser(prosersd.value)"></div>
    
    </div>
    

    

    

<!--product hold-->
<div id="productholder"></div>

<!--end product hold-->

<?php }else{
		echo '<div style="padding:5px; font-style:italic; font-size:18px;"><strong style="color:#999;">Notice!</strong><br><span style="color:#FC0">You do not have Authorized Access to this Area. Contact your Administrator</span></div>';
	}
	?>
		
	</div>
    
    
    <div id="tabs-5">
       <?php if($pn["inventory"] == 'true'){ ?>
    <div style="height:40px">
    <div id="addprod2" style="float:left" onClick="addProd2d()">Create New</div>
    <div style="padding:5px; float:right;"><input class="makerrsdrops" name="proser" id="proser" type="text"> <input class="makerrsdrops" name="" type="button" value="Search" onClick="pullAssts2(proser.value)"></div>
    
    </div>
    

    

    

<!--product hold-->
<div id="productholder2"></div>

<!--end product hold-->

<?php }else{
		echo '<div style="padding:5px; font-style:italic; font-size:18px;"><strong style="color:#999;">Notice!</strong><br><span style="color:#FC0">You do not have Authorized Access to this Area. Contact your Administrator</span></div>';
	}
	?>
		
	</div>
    
    <div id="tabs-6">
    
    <?php if($pn["auditlog"] == 'true'){ ?>
    
    <div style="width:603px; height:40px; margin-bottom:10px">
    <div style="width:120px; height:40px; float:left">
    
    From:<br><input style="width:90px; float:left" class="makerrs" name="datser" id="datser" type="text" value="">
    </div>
    <div style="width:120px; height:40px; float:left">
    To:<br><input style="width:90px; float:left" class="makerrs" name="datser2" id="datser2" type="text" value="">
    </div>
    
     <div style="width:120px; height:40px; float:left">
    <div id="goaudt" style="width:20px; height:20px; margin-top:18px" onClick="getAudit('1')">Search</div>
    </div>
    </div>
    
    <div class="infohead">
	<div class="headtext" style="width: 200px; border-right:solid thin #000; ">Date</div>
    <div class="headtext" style="width: 130px; border-left:solid thin #CCC; ">User</div>
    <div class="headtext" style="width: 200px; border-left:solid thin #CCC; ">Page</div>
    <div class="headtext" style="width: 200px; border-left:solid thin #CCC; ">Action</div>
</div>

<div id="auditholder"></div>

<?php }else{
		echo '<div style="padding:5px; font-style:italic; font-size:18px;"><strong style="color:#999;">Notice!</strong><br><span style="color:#FC0">You do not have Authorized Access to this Area. Contact your Administrator</span></div>';
	}
	?>
		
	</div>
   
    
    <div id="tabs-7">
    <?php if($pn["auditlog"] == 'true'){ ?>
    <div style="padding:15px; background-color:#EFEFEF;">
    <strong>Run Report:</strong><br>
    <select class="makerrsdrops" name="rntyp" onChange="checkReps(this.value)">
    <option value="none">Select report to run...</option>
    <option value="revenue">Revenu Report</option>
    <option value="workordtech">Work order per tech</option>
    <option value="staff">Staff Productivity</option>
    </select>
    </div>
    
    <div id="revenue" style="display:none">
    <div class="infohead">
	<div class="headtext" style="width: 200px; border-right:solid thin #000; ">Month</div>
    <div class="headtext" style="width: 230px; border-left:solid thin #CCC; ">Year</div>
    <div class="headtext" style="width: 400px; border-left:solid thin #CCC; ">Amount</div>
</div>

<?php
$r = mysql_query("SELECT * FROM revenue_out WHERE saasid = '".$_SESSION['saasid']."'");
	while($b = mysql_fetch_array($r)){
		
	$monthName = date("F", mktime(0, 0, 0, $b["month"], 10));

echo '<div class="infoheadlines">
<div class="headtext2" style="width: 205px;">'.$monthName.'</div>
<div class="headtext2" style="width: 230px;">'.$b["year"].'</div>
<div class="headtext2" style="width: 400px;">$'.$b["amount"].'</div>
</div>';
}
?>
    
    </div>
		
    
    <div style="display:none" id="techreport">
   <div class="infohead">
	<div class="headtext" style="width: 100px; border-right:solid thin #000; ">ID</div>
    <div class="headtext" style="width: 230px; border-left:solid thin #CCC; ">Tech</div>
    <div class="headtext" style="width: 140px; border-left:solid thin #CCC; ">Completed WO's</div>
    <div class="headtext" style="width: 400px; border-left:solid thin #CCC; ">View Work Orders</div>
</div>

<?php
$r = mysql_query("SELECT * FROM core_users WHERE saasid = '".$_SESSION['saasid']."' AND active = 'true' AND usrtyp = 'tech'");
	while($bz = mysql_fetch_array($r)){
		
		$e = mysql_query("SELECT * FROM core_docs WHERE assignedtech = '".$bz["usr_id"]."' AND active = 'true'");
			$count = mysql_num_rows($e);
	//$monthName = date("F", mktime(0, 0, 0, $b["month"], 10));
	
	if($count != 0){
		$link = '<a href="javascript:viewWrks(\''.$bz["usr_id"].'\')">View Work Orders for Technician</a>';
	}else{
		$link = '<span style="color:#D70000">No Completed Work Orders.</span>';
	}

echo '<div class="infoheadlines">
<div class="headtext2" style="width: 100px;">'.$bz["usr_id"].'</div>
<div class="headtext2" style="width: 230px;">'.$bz["fname"].' '.$bz["fname"].'</div>
<div class="headtext2" style="width: 140px;">'.$count.'</div>
<div class="headtext2" style="width: 400px;">'.$link.'</div>
</div>';
}
?>
    </div>
    
    <?php }else{
		echo '<div style="padding:5px; font-style:italic; font-size:18px;"><strong style="color:#999;">Notice!</strong><br><span style="color:#FC0">You do not have Authorized Access to this Area. Contact your Administrator</span></div>';
	}
	?>
    
    </div>
    
    <div id="tabs-8">
    
     <?php if($pn["tax"] == 'true'){ ?>
    
    <div id="addstax" style="margin-bottom:30px" onClick="addnewTax();">Add Tax</div>
    
    <div class="infohead">
	<div class="headtext" style="width: 210px; border-right:solid thin #000; ">Tax Name</div>
	<div class="headtext" style="width: 220px; border-right:solid thin #000; border-left: solid thin #CCC;">State</div>
    <div class="headtext" style="width: 220px; border-right:solid thin #000; border-left:solid thin #CCC;">County</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;">Tax Percent</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>

<div id="taxhold"> 

<?php
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
?>

</div>
		
	
    <?php }else{
		echo '<div style="padding:5px; font-style:italic; font-size:18px;"><strong style="color:#999;">Notice!</strong><br><span style="color:#FC0">You do not have Authorized Access to this Area. Contact your Administrator</span></div>';
	}
	?>
</div>


<div id="tabs-9">

<div id="addterm" onClick="addnewTerm()">Add New Term</div>
<div style="height:15px"></div>

<div class="infohead">
	<div class="headtext" style="width: 100px; border-right:solid thin #000; ">Term %</div>
    <div class="headtext" style="width: 130px; border-left:solid thin #CCC; ">Days</div>
    <div class="headtext" style="width: 470px; border-left:solid thin #CCC; ">Net</div>
    <div class="headtext" style="width: 200px; border-left:solid thin #CCC; ">Actions</div>
</div>


<div id="holdterms"></div>



</div>
</div>

</div>
<!--end content holder-->

</body>
</html>