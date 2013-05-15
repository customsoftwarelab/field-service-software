<?php include('inc/header.php'); ?>
<link href="collapse/demo/demo.css" rel="stylesheet">

<script src="collapse/src/jquery.cookie.js"></script>
<script src="js/accounting_actions.js" type="text/javascript"></script>

    <!--new  dialog-->
    <div id="dio1" style="display:none; padding-top:20px; font-family: 'Quantico', sans-serif;"></div>
    <!--new  dialog2-->
    <div id="dio2" style="display:none; padding-top:20px; font-family: 'Quantico', sans-serif;"></div>
    <!--alerts-->
    <div id="alerts" style="display:none; font-family: 'Quantico', sans-serif;" title="Alert"></div>
    
<div style="clear:both"></div>
<!--begin content holder-->
<div id="admin_tabhold" style="font-family: 'Quantico', sans-serif; margin-bottom:30px;">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">General Ledger</a></li>
		<li><a href="#tabs-2">Bank Accounts</a></li>
        <li><a href="#tabs-3">Journal Entries</a></li>
        <li><a href="#tabs-4">Loans / Credit Cards</a></li>
        <li><a href="#tabs-5">Write / Print Checks</a></li>
        <li><a href="#tabs-6">Accounts Payable</a></li>
	</ul>
	<div id="tabs-1">
    
    <div id="addledg" style="float:left" onClick="openTypwin()">New Account</div><br><br>
    
    <div style="margin-top:30px"></div>
    <!--acct rec-->
    
    <!--search-->
    <div>
    <div style="font-size:18px; font-weight:bold; color:#333; margin:0px 10px 10px; float:left">Accounts Receivable</div> <div style="width:172px; height:20px; border:solid thin #CCC; float:right; -moz-border-radius: 5px;
border-radius: 5px; background-image:url(images/search_ico.png); background-repeat:no-repeat; background-position:right;"><input style="outline:none; border: none; background:none; width:142px; height:20px; text-indent:4px; font-size:11px; font-style:italic; color:#999" name="" type="text" placeholder="Search A/R" onKeyUp="getLinesser('arseve',this.value)"></div>
    </div>
    <!--search end-->
    
    <div style="clear:both;"></div>
   <div class="infohead">
    <div class="headtext" style="width: 110px; border-right:solid thin #000; border-left:solid thin #CCC;">Invoice #</div>
    <div class="headtext" style="width: 437px; border-right:solid thin #000; border-left:solid thin #CCC; ">Customer Name</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Balance</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<!--ledger hold-->
<div id="arhold"></div>



<!--end acct rec-->

<div style="margin-top:30px"></div>

<!--acct rec-->
    <!--search-->
    <div>
    <div style="font-size:18px; font-weight:bold; color:#333; margin:0px 10px 10px; float:left">Income</div> <!--<div style="width:172px; height:20px; border:solid thin #CCC; float:right; -moz-border-radius: 5px;
border-radius: 5px; background-image:url(images/search_ico.png); background-repeat:no-repeat; background-position:right;"><input style="outline:none; border: none; background:none; width:142px; height:20px; text-indent:4px; font-size:11px; font-style:italic; color:#999" name="" type="text" placeholder="Search Income"></div>-->
    </div><div style="clear:both"></div>
    <!--search end-->
    
    
    
   <div class="infohead">
	
    <div class="headtext" style="width: 110px; border-right:solid thin #000; border-left:solid thin #CCC;">Invoice #</div>
    <div class="headtext" style="width: 437px; border-right:solid thin #000; border-left:solid thin #CCC; ">Customer Name</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Payment</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<!--ledger hold-->
<div id="incomehold"></div>
<!--end-->




<div style="margin-top:30px"></div>

<!--acct rec-->
    <!--search-->
    <div>
    <div style="font-size:18px; font-weight:bold; color:#333; margin:0px 10px 10px; float:left">Expense</div> <div style="width:172px; height:20px; border:solid thin #CCC; float:right; -moz-border-radius: 5px;
border-radius: 5px; background-image:url(images/search_ico.png); background-repeat:no-repeat; background-position:right;"><input style="outline:none; border: none; background:none; width:142px; height:20px; text-indent:4px; font-size:11px; font-style:italic; color:#999" name="" type="text" placeholder="Search Expense" onKeyUp="getLinesser('expense',this.value)"></div>
    </div><div style="clear:both"></div>
    <!--search end-->
    
    
    
   <div class="infohead">
    <div class="headtext" style="width: 110px; border-right:solid thin #000; border-left:solid thin #CCC;">GL #</div>
    <div class="headtext" style="width: 437px; border-left:solid thin #CCC; ">Account Name</div>
    <div class="headtext" style="width: 120px;"></div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<!--ledger hold-->
<div id="expensehold">


</div>
<!--end-->





<div style="margin-top:30px"></div>

<!--acct rec-->
    <!--search-->
    <div>
    <div style="font-size:18px; font-weight:bold; color:#333; margin:0px 10px 10px; float:left">Loans / Credit Cards</div> <div style="width:172px; height:20px; border:solid thin #CCC; float:right; -moz-border-radius: 5px;
border-radius: 5px; background-image:url(images/search_ico.png); background-repeat:no-repeat; background-position:right;"><input style="outline:none; border: none; background:none; width:142px; height:20px; text-indent:4px; font-size:11px; font-style:italic; color:#999" name="" type="text" placeholder="Search Loans"></div>
    </div><div style="clear:both"></div>
    <!--search end-->
    
    
    
   <div class="infohead">
    <div class="headtext" style="width: 110px; border-right:solid thin #000; border-left:solid thin #CCC;">GL #</div>
    <div class="headtext" style="width: 437px; border-right:solid thin #000; border-left:solid thin #CCC; ">Acccount Name</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Balance</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<!--ledger hold-->
<div id="loanshold2">
</div>
<!--end-->




<div style="margin-top:30px"></div>

<!--acct rec-->
    <!--search-->
    <div>
    <div style="font-size:18px; font-weight:bold; color:#333; margin:0px 10px 10px; float:left">Bank Accounts</div> <div style="width:172px; height:20px; border:solid thin #CCC; float:right; -moz-border-radius: 5px;
border-radius: 5px; background-image:url(images/search_ico.png); background-repeat:no-repeat; background-position:right;"><input style="outline:none; border: none; background:none; width:142px; height:20px; text-indent:4px; font-size:11px; font-style:italic; color:#999" name="" type="text" placeholder="Search Account" onKeyUp="getLinesser('bank',this.value)"></div>
    </div><div style="clear:both"></div>
    <!--search end-->
    
    
    
   <div class="infohead">
    <div class="headtext" style="width: 110px; border-right:solid thin #000; border-left:solid thin #CCC;">GL #</div>
    <div class="headtext" style="width: 437px; border-right:solid thin #000; border-left:solid thin #CCC; ">Bank Name</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Balance</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<!--ledger hold-->
<div id="acclinehold"></div>
<!--end-->
    
</div>

    
	<div id="tabs-2">
    
    <div style="height:40px;"></div>
    
    <div class="infohead">
    <div class="headtext" style="width: 110px; border-right:solid thin #000; border-left:solid thin #CCC;">GL #</div>
    <div class="headtext" style="width: 437px; border-right:solid thin #000; border-left:solid thin #CCC; ">Bank Name</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Balance</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>
<div id="bankholders"></div>
    
    

	
	</div>
    
	<div id="tabs-3">
    <div id="addledgs" style="float:left" onClick="opntruLedg()">New Journal Entry</div><br><br>
    <div style="height:30px"></div>
    
    <div class="infohead">
    <div class="headtext" style="width: 110px; border-right:solid thin #000; border-left:solid thin #CCC;">Date</div>
    <div class="headtext" style="width: 107px; border-right:solid thin #000; border-left:solid thin #CCC; ">Journal #</div>
    <div class="headtext" style="width: 580px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Account</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>

<div id="journholders">

</div>
    
	</div>
    
    <div id="tabs-4">
    
    <div id="addloans" style="float:left" onClick="grabLoan()">New Entry</div><br><br>
    <div style="height:30px"></div>
    
   <div class="infohead">
    <div class="headtext" style="width: 110px; border-right:solid thin #000; border-left:solid thin #CCC;">GL#</div>
    <div class="headtext" style="width: 437px; border-right:solid thin #000; border-left:solid thin #CCC; ">Name</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Balance</div>
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>

<div id="loanshold"></div>
  
    
		
	</div>
    
    <div id="tabs-5">
    
    <div style="padding:15px; float:right; margin-right:20px; margin-top:20px"> Select Bank: <select style="width:120px" name="bankacct" id="bankacct"><option selected="selected" value="none">Select Bank...</option>
    <?php
	$a = mysql_query("SELECT * FROM ledger_tabs WHERE type = 'bank' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
		while($b = mysql_fetch_array($a)){
			echo '<option value="'.$b["glid"].'">'.$b["fld1"].'</option>';
		}
	
    ?>
    </select></div>
    <div style="clear:both"></div>
    
    <div style="width:971px; height:348px; border:solid thin #333; font-weight:bold">
    <div style="padding:3px; float:right; margin-right:20px; margin-top:20px"> Date: <input style="width:99px" name="chkdate" id="chkdate" type="text" value="<?php echo date('m/d/Y'); ?>"></div>
    <div style="clear:both;height: 30px;"></div>
    <div style="padding:3px;  margin-left:20px; margin-top:20px; float:left; position:relative;"> Pay to order of: <!--<select style="width:552px" name="glsel"  id="glsel">
    <option selected="selected" value="none">Select GL Account...</option>
    <?php
	$a = mysql_query("SELECT * FROM ledger_tabs WHERE type != 'bank' AND subacct != 'none' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
		while($b = mysql_fetch_array($a)){
			echo '<option value="'.$b["glid"].'">'.$b["fld1"].'</option>';
		}
	
    ?>
    </select>--><input style="width:552px" name="glselo" id="glselo" type="text" onKeyUp="serVends(this.value)">
    <input name="glsel" id="glsel" type="hidden" value="">
    <div id="vendrops" style="width: 550px; height:193px; overflow-y:scroll; position:absolute; background-color:#fff; border:solid thin #999;left: 105px; display:none">
    
    
    
    </div>
    </div>
    <div style="padding:3px;  margin-top:20px; float:right; margin-right:20px;"> $ <input style="width:99px" name="amount" id="amount" type="text" value="0.00" onBlur="runTextnum(this.value)"></div>
    <div style="clear:both;height: 40px;"></div>
   <div style="padding-left:3px; float:right; padding-top:15px;margin-right: 25px; margin-top:50px;">Dollars</div> <div id="numtext" style="width:834px; height:35px; float:left; border-bottom:solid thin #333;margin-left: 35px; margin-top:40px;"></div> 
    <div style="clear:both;height: 40px; position:relative">
    <div id="addresshold" style="position:absolute; padding:3px; font-size:11px; top: -95px; left: 23px;"></div>
    
    </div>
    <div style="padding:3px;  margin-left:20px; margin-top:20px; float:left"> Memo: <input style="width:852px" name="memo" id="memo" type="text"></div>
    
    
    
    </div>
    
    <div style="padding:20px;">
    
     <select style="width:552px" name="glseltrue"  id="glseltrue">
    <option selected="selected" value="none">Select GL Account...</option>
    <?php
	$a = mysql_query("SELECT * FROM ledger_tabs WHERE type != 'bank' AND is_vend != 'true' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'");
		while($b = mysql_fetch_array($a)){
			echo '<option value="'.$b["glid"].'">'.$b["fld1"].'</option>';
		}
	
    ?>
    </select>
    
    </div>
    <div style="clear:both;height: 40px;"></div>
    <div id="prichk" style="margin:10px; float:right" onClick="subsinCheck()">Print Check</div>
    <div style="clear:both;height: 40px;"></div>
    
		
	</div>
 
    
    <div id="tabs-6">
    
    <div id="adbill" style="float:left; margin-right:15px" onClick="runaddBill()">Add Bill</div>
    <div id="paybill" style="float:left" onClick="payWithcheck()">Pay Bills</div>
    <div style="clear:both; margin-bottom:30px; height:10px"></div>
    
    <div class="infohead">
    <div class="headtext" style="width: 170px; border-right:solid thin #000; border-left:solid thin #CCC;">Vendor / GL</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC; ">Invoice / ID</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Billed Amt</div>
    <div class="headtext" style="width: 120px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Discounted Amt</div>
    <div class="headtext" style="width: 176px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Terms</div>
    <div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Due Date</div>
    <!--<div class="headtext" style="width: 90px; border-right:solid thin #000; border-left:solid thin #CCC;  ">Status</div>-->
    <div class="headtext" style="width:90px; border-left:solid thin #CCC; text-align:center">Action</div>
</div>

<div id="invcbillhold"></div>
		
	</div>
</div>


</div>
<!--end content holder-->

</body>
</html>