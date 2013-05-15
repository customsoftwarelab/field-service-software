<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ACS User Admin</title>
<style>
.mang{
background: #2469b7; /* Old browsers */
background: -moz-linear-gradient(top,  #2469b7 1%, #0d549b 72%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,#2469b7), color-stop(72%,#0d549b)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #2469b7 1%,#0d549b 72%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #2469b7 1%,#0d549b 72%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #2469b7 1%,#0d549b 72%); /* IE10+ */
background: linear-gradient(top,  #2469b7 1%,#0d549b 72%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2469b7', endColorstr='#0d549b',GradientType=0 ); /* IE6-9 */


	
}

.shadow {
   -moz-box-shadow:    inset 0 0 10px #1e5691;
   -webkit-box-shadow: inset 0 0 10px #1e5691;
   box-shadow:         inset 0 0 10px #1e5691;
  
}

.button{
background: #5d9e64; /* Old browsers */
background: -moz-linear-gradient(top,  #2469b7 2%, #0e51a0 72%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(2%,#2469b7), color-stop(72%,#0e51a0)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #2469b7 2%,#0e51a0 72%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #2469b7 2%,#0e51a0 72%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #2469b7 2%,#0e51a0 72%); /* IE10+ */
background: linear-gradient(top,  #2469b7 2%,#0e51a0 72%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2469b7', endColorstr='#0e51a0',GradientType=0 ); /* IE6-9 */
 -moz-border-radius: 3px;
border-radius: 3px;
border:solid thin #0e51a0;
-webkit-box-shadow:0 0 4px #999; 
-moz-box-shadow: 0 0 4px #999; 
box-shadow:0 0 4px #999; 
}

.err_not{
background: #ffffff; /* Old browsers */
background: -moz-linear-gradient(top,  #ffffff 0%, #e2e2e2 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#e2e2e2)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 0%,#e2e2e2 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 0%,#e2e2e2 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 0%,#e2e2e2 100%); /* IE10+ */
background: linear-gradient(top,  #ffffff 0%,#e2e2e2 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e2e2e2',GradientType=0 ); /* IE6-9 */
 -moz-border-radius: 3px;
border-radius: 3px;	
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>

<script>
function logIn(){
	var username = $("#username").val();
	var adpass = $("#adpass").val();
	
		$.ajax({
  url: 'inc/core_user_functions.php?action=login&username='+username+'&adpass='+adpass,
  success: function(data) {
	 // alert(data);
  		if(data == 'bad'){
			$("#good").hide();
			$("#bad").fadeIn('slow');
		}else{
			//alert(data);
			$("#bad").hide();
			$("#good").fadeIn('slow');
			setTimeout('update()', 1000); 
		}
  }
});
	
}


function update(){
//alert('going');
window.location = 'dashboard.php';	
}
$(function(){
	$("#username").focus()
$('#adpass').bind('keypress', function(e) {
        if(e.keyCode==13){
               logIn();
        }
});
});
</script>
</head>

<body>

<div class="mang" style="position:fixed; width:100%; height:100%; top:0px; left:0px;"></div>
<div style="width:358px; height:332px; -moz-border-radius: 5px;
border-radius: 5px; border:solid thin #0f6fd3; position:absolute; left:50%; top:30%; margin-left:-179px; ">

<div id="bad" class="err_not" style="width:358px; height:40px; border: solid thin #B00; position:absolute; left: 0px; top: -57px;; display:none">

<div style="width:31px; height:33px; float:left; margin-top:5px; margin-left:8px;"><img src="images/er_bc.png" width="31" height="33" /></div>

<div style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#333; padding-top:13px; float:left; margin-left:20px">Login Incorrect. Please try again</div>

</div>


<!--good-->

<div id="good" class="err_not" style="width:358px; height:40px; border: solid thin #090; position:absolute; left: 0px; top: -57px; display:none">

<div style="width:31px; height:33px; float:left; margin-top:5px; margin-left:8px;"><img src="images/good_bc.png" width="31" height="33" /></div>

<div style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#333; padding-top:13px; float:left; margin-left:20px">Login Good. Please wait</div>

</div>




<div class="shadow" style="width:354px; height:85px; background-color:#0e51a0; -moz-border-radius-topright: 5px;
border-top-right-radius: 5px; -moz-border-radius-topleft: 5px;
border-top-left-radius: 5px; margin:auto; margin-top:1px; border-bottom:solid thin #1B3A5A;">
<div style="width:103px; height:67px; margin:auto; padding-top:5px;"><img src="images/lite_logo.png" width="103" height="67" /></div>
</div>

<div class="shadow" style="width:354px; height:240px; background-color:#106fd3; -moz-border-radius-bottomright: 5px;
border-bottom-right-radius: 5px; -moz-border-radius-bottomleft: 5px;
border-bottom-left-radius: 5px; margin:auto; border-top:solid thin #4690db ">

<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFF; font-weight:bold; margin-left:40px; margin-bottom:8px; margin-top:30px">Email:</div>

<div style="width:282px; height:32px; background-image:url(images/frm_bc.png); background-repeat:repeat-x;  -moz-border-radius: 5px;
border-radius: 5px; border:solid thin #0e51a0; margin-left:35px"><input style="width:282px; height:35px; background:none; border:none; outline:none; font-family:Georgia, 'Times New Roman', Times, serif; color:#999; font-style:italic; text-indent:15px;" placeholder="Enter your username" name="username" id="username" type="text" /></div>


<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFF; font-weight:bold; margin-left:40px; margin-bottom:8px; margin-top:25px">Password:</div>

<div style="width:282px; height:32px; background-image:url(images/frm_bc.png); background-repeat:repeat-x;  -moz-border-radius: 5px;
border-radius: 5px; border:solid thin #0e51a0; margin-left:35px"><input style="width:282px; height:35px; background:none; border:none; outline:none; font-family:Georgia, 'Times New Roman', Times, serif; color:#999; font-style:italic; text-indent:15px;" placeholder="Enter your password" name="adpass" id="adpass" type="password" /></div>

<div class="button" style="width:54px; height:23px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFF; text-align:center; font-weight:bold; text-shadow: 1px 1px #2F5132; padding-top:5px; margin-top:15px; margin-left:40px; cursor:pointer" onclick="logIn()">Log In</div>

</div>


</div>
</body>
</html>