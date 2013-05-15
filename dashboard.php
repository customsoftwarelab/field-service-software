<?php include('inc/header.php'); ?>

<script>

$(function (){
	getRevs();
	getWrkd();
	getInvc();
	getAr();
	getPo();
	getEst();
	getAmon();
	 getInvot();
});

function getRevs(){
		$.ajax({
  url: 'inc/revenue_widget.php?action=getcur',
  success: function(data) {
    $("#rev_hold").html(data);
  }
});
}

function getWrkd(){
		$.ajax({
  url: 'inc/workorder_widget.php?action=get',
  success: function(data) {
    $("#workorder_hold").html(data);
  }
});
	}
	
	
	function getInvc(){
		$.ajax({
  url: 'inc/invoice_widget.php?action=pullinvoicetrack',
  success: function(data) {
    $("#invoice_hold").html(data);
  }
});
	}
	
	
	function getAr(){
		$.ajax({
  url: 'inc/ap_widget.php?action=getsap',
  success: function(data) {
    $("#acct_hold").html(data);
  }
});
	}
	
	//getpos
	function getPo(){
		$.ajax({
  url: 'inc/po_widget.php?action=getpos',
  success: function(data) {
    $("#purchase_hold").html(data);

  }
});
	}
	
	//getest
	function getEst(){
		$.ajax({
  url: 'inc/estimate_widget.php?action=getest',
  success: function(data) {
    $("#estimates_hold").html(data);

  }
});
	}
		
		//getaccess
		function getAmon(){
		$.ajax({
  url: 'inc/audit_widget.php?action=gettree',
  success: function(data) {
    $("#audit_hold, #date_hold").html(data);

  }
});
	}
	
	function getInvot(){
		$.ajax({
  url: 'inc/inventory_widget.php?action=getivoss',
  success: function(data) {
    $("#lowinv_hold").html(data);

  }
});
	}
	

</script>

<!--widget holder-->
	<div id="widg_hold">
    
    	<!--revenue widget-->
        <div id="rev_box">
        <div style="text-indent:5px; padding-bottom:5px;">Revenue Comparison</div>
        <div id="rev_hold"></div>
        </div>
        <!--end revenue-->
        
        	<!--revenue widget-->
        <div id="workorder_box">
        <div style="text-indent:5px; padding-bottom:5px;">Work Order Summary</div>
        <div id="workorder_hold"></div>
        </div>
        <!--end revenue-->

	<!--revenue widget-->
	  <div id="invoice_box">
        <div style="text-indent:5px; padding-bottom:5px; position:relative">Invoice <img style="position:absolute; top: 4px; left: 66px;" src="images/ar_rit.gif" width="16" height="15"></div>
        <div id="invoice_hold">
        
        </div>
        </div>
        <!--end revenue-->
        
        <div style="clear:both; height:30px"></div>        
        
        
        <!--accounts widget-->
        <div id="acct_box">
        <div style="text-indent:5px; padding-bottom:5px;">Accounts Payable</div>
        <div id="acct_hold">
        
        
        </div></div>
        <!--end revenue-->
        
        	<!--purchase widget-->
        <div id="purchase_box">
        <div style="text-indent:5px; padding-bottom:5px;">Purchase Orders</div>
        <div id="purchase_hold">
        
        
        
        
        
        </div>
        </div>
        <!--end revenue-->

	<!--estimate widget-->
	  <div id="estimates_box">
        <div style="text-indent:5px; padding-bottom:5px; position:relative">Estimates</div>
        <div id="estimates_hold"></div>
        </div>
        <!--end revenue-->
        
        <div style="clear:both; height:30px"></div>        
        
        
        <!--accounts widget-->
        <div id="audit_box">
        <div style="text-indent:5px; padding-bottom:5px;">Audit Log</div>
        <div id="audit_hold"></div>
        </div>
        <!--end revenue-->
        
        	<!--purchase widget-->
        <div id="lowinv_box">
        <div style="text-indent:5px; padding-bottom:5px;">Low Inventory</div>
        <div id="lowinv_hold"></div>
        </div>
        <!--end revenue-->

	<!--estimate widget-->
	  <div id="date_box">
        <div style="text-indent:5px; padding-bottom:5px; position:relative">Date / Time User Module</div>
        <div id="date_hold"></div>
        </div>
        <!--end revenue-->
    
    
    
    
    
    
    
    
    
    
    </div>
<!--widget end-->

<div id="footer"></div>

</body>
</html>