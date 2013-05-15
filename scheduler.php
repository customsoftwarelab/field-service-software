<?php include('inc/header.php'); ?>
<script src="js/shed_actions.js" type="text/javascript"></script>
    <!--new contact dialog-->
    <div id="shedhold" title="Add Product/Service" style="display:none; padding-top:20px; font-family: 'Quantico', sans-serif;"></div>
    <!--new contact dialog-->
    <div id="exadd" title="New Appointment" style="display:none; padding-top:20px; font-family: 'Quantico', sans-serif;"></div>
    <!--alerts-->
    <div id="alerts" style="display:none; width:432px; font-family: 'Quantico', sans-serif;" title="Alert"></div>
    
    <div id="timer" style="position:fixed; padding:5px;"></div>
    <input name="setdtr" id="setdtr" type="hidden" value="<?php echo date('m/d/Y'); ?>">
<div style="clear:both"></div>
<!--begin content holder-->
<div style="font-family: 'Quantico', sans-serif; font-weight:normal; width:1010px; margin:auto; margin-top:30px"><strong>Unassigned Work Orders</strong> <span style="color:#999; padding-left:10px">To assign, drag to work order to technician below</span></div>
<div id="thesch" style="font-family: 'Quantico', sans-serif; margin-bottom:30px;"></div>
<!--end content holder-->

</body>
</html>