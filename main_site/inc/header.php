<?php
date_default_timezone_set('America/Chicago');
error_reporting(0);

?>
<!DOCTYPE>
	<html><head>
		<title>ACS Project Managment</title>
        
        <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>
        <script src="js/jquery.uniform.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.8.20.custom.css" type="text/css" media="all" />
		<link rel="stylesheet" href="fonts/stylesheet.css" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="css/criti_main_style.css" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="css/uniform.default.css" type="text/css" charset="utf-8" />
        <link href='http://fonts.googleapis.com/css?family=Quantico' rel='stylesheet' type='text/css'>
		
        
        <script>
	
		
		</script>

    

		</head>

<body>

<div id="confrmsucc" style="width:100%; padding-top:20px; padding-bottom:20px; font-family: 'Quantico', sans-serif;; color:#333; background-color:#C1FFC1; text-align:center; font-weight:bolder; display:none;">Action performed successfully!</div>
<!--start header-->
	<div id="head_contain">
    	<div id="logo_holder"><a href="dashboard.php"><img src="images/frnt_logo.png" width="145" height="76" border="0"></a></div>
        	<div id="acc_text">
                	
       		  <span style="font-weight:bold;"> 855-MY-TRASH<img style="margin-top:10px; margin-left:10px" src="images/phn_ico.png" width="22" height="22"></span><br>
                    <a style="color:#F5F5F5" href="mailto:action@acscompaction.com">action@acscompaction.com</a> <img style="margin-top:10px; margin-left:10px" src="images/mail_ico.png" width="24" height="18"></div>
                    	</div>
        <!--nav-->
        
        				<?php include('link_handler.php'); ?>
                    	<div id="nav">
                        	<ul>
                           	<a style="color:#fff" href="customers.php"><li class="<?php echo $home_nav; ?>">HOME</li></a>
                             	<a href="estimates.php"><li class="<?php echo $estimates_nav; ?>">NEW EQUIPMENT<img style="margin-left:3px" src="images/drp_arr.png" width="12" height="12"></li>
                             	</a>
                            		 <a href="work_orders.php"><li class="<?php echo $workorders_nav; ?>">USED EQUIPMENT</li></a>
                                     
                                     <a href="scheduler.php" class="<?php echo $scheduler_nav; ?>"> <li>EQUIPMENT SERVICE</li></a>
                            			<a href="scheduler.php" class="<?php echo $scheduler_nav; ?>"> <li>RENTAL PROGRAMS</li></a>
                            		 <a href="invoice.php"><li class="<?php echo $invoice_nav; ?>">BUY PARTS</li></a>
                            	<a href="purchase_orders.php"> <li class="<?php echo $purchase_nav; ?>">CONTACT</li></a>
                          
                            	</ul>
                        
   	</div>
                    	<!--end nav-->
            <div style="height:10px; width:1016px; margin:auto;"></div>
        	<!--end header-->