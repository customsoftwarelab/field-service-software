<?php
date_default_timezone_set('America/Chicago');
include('config.php');
session_start();
error_reporting(0);
if(isset($_SESSION['acssess'])){
	$g = mysql_query("SELECT * FROM core_users WHERE sessid = '".$_SESSION['acssess']."'")or die(mysql_error());
		$p = mysql_fetch_array($g);
			$s = mysql_num_rows($g);
				if($s == '1'){
					$sysName = $p["fname"].' '.$p["lname"];
					}else{
						die(header('Location:index.php'));
							}
								}else{
									die(header('Location:index.php'));
										}
?>
<!DOCTYPE>
	<html><head>
		<title>ACS Business Software</title>
        
        <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>
        <script src="js/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="js/jquery.tipTip.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.8.20.custom.css" type="text/css" media="all" />
		<link rel="stylesheet" href="fonts/stylesheet.css" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="css/criti_style.css" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="css/uniform.default.css" type="text/css" charset="utf-8" />
        <link href='http://fonts.googleapis.com/css?family=Quantico' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="uploadify/uploadify.css" />
        <link rel="stylesheet" type="text/css" href="css/tipTip.css" />
		
        
        <script>
		
		function runClear(val){
			
			var check = $("#"+val).val();
				if(check == 'Search...'){
					$("#"+val).val('');
				}else{
					if(check == ''){
					$("#"+val).val('Search...');	
					}
					
				}
		}
		
		function logOut(){
			$.ajax({
  url: 'inc/core_user_functions.php?action=logout',
  success: function(data) {
	  window.location = 'index.php';

  }
});
		}
		
		function disabAll(){
			$(":input").attr("disabled", true);
		}
		
		</script>

    

		</head>

<body>

<div id="confrmsucc" style="width:100%; padding-top:20px; padding-bottom:20px; font-family: 'Quantico', sans-serif;; color:#333; background-color:#C1FFC1; text-align:center; font-weight:bolder; display:none;">Action performed successfully!</div>

<div id="confrmsucc2" style="width:100%; padding-top:20px; padding-bottom:20px; font-family: 'Quantico', sans-serif;; color:#333; background-color:#FF8C8C; text-align:center; font-weight:bolder; display:none;"></div>
<?php
if(isset($_REQUEST['error'])){
echo '<div id="errorlisting" style="width:100%; padding-top:20px; padding-bottom:20px; font-family: \'Quantico\', sans-serif; color:#333; background-color: #FF8C8C; text-align:center; font-weight:bolder;">Read Access Denied for: '.$_REQUEST['pageset'].'! Please contact your admin.</div>';
}
?>

<!--start header-->
	<div id="head_contain">
    	<div id="logo_holder"><a href="dashboard.php"><img src="images/csl_logo_white.png" width="161" height="64" border="0"></a></div>
        	<div id="acc_text">Welcome, <?php echo $sysName; ?> | <a href="javascript:logOut()">Logout</a>
            	<br>
                	<br>
                	
                    </div>
                    	</div>
        <!--nav-->
        
        				<?php include('link_handler.php'); ?>
                    	<div id="nav">
                        	<ul>
                           	<a href="customers.php"><li class="<?php echo $customer_nav; ?>">CUSTOMERS</li></a>
                             	<a href="estimates.php"><li class="<?php echo $estimates_nav; ?>">ESTIMATES</li></a>
                            		 <a href="work_orders.php"><li class="<?php echo $workorders_nav; ?>">WORK ORDERS</li></a>
                            			<a href="scheduler.php"> <li class="<?php echo $scheduler_nav; ?>">SCHEDULing</li></a>
                            		 <a href="invoice.php"><li class="<?php echo $invoice_nav; ?>">INVOICES</li></a>
                            	<a href="purchase_orders.php"> <li class="<?php echo $purchase_nav; ?>">PURCHASE ORDERS</li></a>
                           <a href="accounting.php">  <li class="<?php echo $accounting_nav; ?>">ACCOUNTING</li></a>
                            <a href="admin.php"> <li class="<?php echo $admin_nav; ?>">ADMIN</li></a>
                            	</ul>
                        
                        	</div>
                    	<!--end nav-->
            <div id="pag_box">
            <div id="loader" style="width:24px; height:24px; float:left; display:none; padding:15px"><img style="padding-top:9px" src="images/loader.gif" width="24" height="24"></div>
            <div style="clear:both"></div>
            	<div id="pag_text"><div style="float:left; padding-top:3px"><?php echo $page_name; ?></div>    
                <?php echo $addButton; ?>
           	  </div>
                
                	<div id="pag_extras" style="position:relative">
                    
                    	
                   	  
                    <?php include('search_inputs.php'); ?>
                    			
       		  </div>
                
                	</div>
        	<!--end header-->