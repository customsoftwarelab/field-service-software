<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link type="text/css" href="css/dot-luv/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<style>
#highlight, .highlight {
    background: #2e9500;
	background-image:none;
}

.dayser{
	border:solid thin #ccc; 
	text-align:right; 
	background-color:#fff; 
	color:#0099CC; 
	font-weight:bold;
	cursor:pointer;
}

.dayser:hover{
	background-color:#FDF6D2;
	border:solid thin #FBCB09;
	color:#C77405;
}

.drts{
border:solid thin #ccc; 
	text-align:right; 
	background-color:#FDF6D2;
	border:solid thin #FBCB09;
	color:#333; 
	font-weight:bold;
	cursor:pointer;	
}

.prevmo{
	background-image:url(prev_mo.png);
	 background-repeat:no-repeat;
	 background-position:center;
	
}

.prevmo:hover{
	background-image:url(prev_moov.png);
	 background-repeat:no-repeat;
	 background-position:center;
	
}

.nextmo{
	background-image:url(nex_mo.png);
	 background-repeat:no-repeat;
	 background-position:center;
}

.nextmo:hover{
	background-image:url(nex_moov.png);
	 background-repeat:no-repeat;
	 background-position:center;
}
</style>
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
        
 
		<script type="text/javascript">
		function runThings(){
			
	$.ajax({
  url: 'getdates.php?action=getdates',
  success: function(data) {
    $("#holdcal").html(data)
  }
});
		}
		
		
		function runerMon(val){
			var year = $("#year").val();
			
		$.ajax({
  url: 'getdates.php?action=getdates&mon='+val+'&yr='+year,
  success: function(data) {
    $("#holdcal").html(data)
  }
});	
		}
		
		function runerYer(val){
			var month = $("#month").val();
			
		$.ajax({
  url: 'getdates.php?action=getdates&yr='+val+'&mon='+month,
  success: function(data) {
    $("#holdcal").html(data)
  }
});	
		}
		
		function migMo(val,val2){
			$.ajax({
  url: 'getdates.php?action=getdates&yr='+val2+'&mon='+val,
  success: function(data) {
    $("#holdcal").html(data)
  }
});	
		}
    </script>
	
</head>

<body>
<div id="holdcal" style="width:700px; height:500px;"></div>
<script>runThings();</script>
</body>
</html>