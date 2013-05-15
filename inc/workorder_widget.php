<?php
session_start();
include('config.php');
//////REVENUE WIDGET START///////
$act = $_REQUEST['action'];

if($act == 'get'){
	
	///unsched///
	$d = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'workorder' AND sched_stat = '' AND active = 'true' AND saasid = '".$_SESSION['saasid']."' LIMIT 14");
		$r = mysql_num_rows($d);
		if($r !=0){
		$unswide = 20 * $r;
		}else{
		$unswide = 10;	
		}
		///overdue//
		$e = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'workorder' AND active = 'true' AND duedate < '".date('m/d/Y')."' AND status !='complete' AND saasid = '".$_SESSION['saasid']."'  LIMIT 14");
			$f = mysql_num_rows($e);
		if($f !=0){
		$ovwide = 20 * $f;
		}else{
		$ovwide = 10;	
		}
		
		///unassigned//
		$g = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'workorder' AND active = 'true' AND assignedtech = '' AND saasid = '".$_SESSION['saasid']."'  LIMIT 14");
			$h = mysql_num_rows($g);
		if($h !=0){
		$unaswide = 20 * $h;
		}else{
		$unaswide = 10;	
		}
		
		///in progress//
		$i = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'workorder' AND active = 'true' AND sched_stat = 'set' AND status !='complete' AND saasid = '".$_SESSION['saasid']."'  LIMIT 14");
			$j = mysql_num_rows($i);
		if($j !=0){
		$inprowide = 20 * $j;
		}else{
		$inprowide = 10;	
		}
		///in progress//
		$k = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'workorder' AND active = 'true' AND status ='cancelled' AND saasid = '".$_SESSION['saasid']."'  LIMIT 14");
			$l = mysql_num_rows($k);
			
		if($l !=0){
		$canwide = 20 * $l;
		}else{
		$canwide = 10;	
		}

echo '<div style="padding:5px">
        
        <!--start line-->
        <div style="width:398px; height:38px;">
        <div style="width:116px; height:30px; padding-top:13px; float:left; font-size:14px; font-weight:normal;">Unscheduled</div>
        <div style="width:280px; height:38px; -moz-border-radius: 3px; border-radius: 3px; float:left; margin-top:3px; background-color:#CCCCCC; -moz-box-shadow:inset 0 1px 0 #000000; -webkit-box-shadow:inset 0 1px 0 #000000; box-shadow:inset 0 1px 0 #000000; position:relative;">
		
		<div style="position:absolute; left:50%; top:10px; color:#B9B9B9">'.$r.'</div>
        
        <div class="green_bars" style="width:'.$unswide.'px"><span style="padding-left:15px; z-index:300">'.$r.'</span></div>
        
        </div>
        </div>
        <!--end-->
        
        <!--start line-->
        <div style="width:398px; height:38px; margin-top:15px">
        <div style="width:116px; height:30px; padding-top:13px; float:left; font-size:14px; font-weight:normal;">Overdue</div>
        <div style="width:280px; height:38px; -moz-border-radius: 3px; border-radius: 3px; float:left; margin-top:3px; background-color:#CCCCCC; -moz-box-shadow:inset 0 1px 0 #000000; -webkit-box-shadow:inset 0 1px 0 #000000; box-shadow:inset 0 1px 0 #000000; position:relative;">
        <div style="position:absolute; left:50%; top:10px; color:#B9B9B9">'.$f.'</div>
        <div class="green_bars" style="width:'.$ovwide.'px"><span style="padding-left:15px; z-index:300">'.$f.'</span></div>
        
        </div>
        </div>
        <!--end-->
        
        <!--start line-->
        <div style="width:398px; height:38px; margin-top:15px">
        <div style="width:116px; height:30px; padding-top:13px; float:left; font-size:14px; font-weight:normal;">Unassigned</div>
        <div style="width:280px; height:38px; -moz-border-radius: 3px; border-radius: 3px; float:left; margin-top:3px; background-color:#CCCCCC; -moz-box-shadow:inset 0 1px 0 #000000; -webkit-box-shadow:inset 0 1px 0 #000000; box-shadow:inset 0 1px 0 #000000; position:relative;">
        <div style="position:absolute; left:50%; top:10px; color:#B9B9B9">'.$h.'</div>
        <div class="green_bars" style="width:'.$unaswide.'px"><span style="padding-left:15px; z-index:300">'.$h.'</span></div>
        
        </div>
        </div>
        <!--end-->
        
        <!--start line-->
        <div style="width:398px; height:38px; margin-top:15px">
        <div style="width:116px; height:30px; padding-top:13px; float:left; font-size:14px; font-weight:normal;">In Progress</div>
        <div style="width:280px; height:38px; -moz-border-radius: 3px; border-radius: 3px; float:left; margin-top:3px; background-color:#CCCCCC; -moz-box-shadow:inset 0 1px 0 #000000; -webkit-box-shadow:inset 0 1px 0 #000000; box-shadow:inset 0 1px 0 #000000; position:relative;">
        <div style="position:absolute; left:50%; top:10px; color:#B9B9B9">'.$j.'</div>
        <div class="green_bars" style="width:'.$inprowide.'px"><span style="padding-left:15px; z-index:300">'.$j.'</span></div>
        
        </div>
        </div>
        <!--end-->
        
        <!--start line-->
        <div style="width:398px; height:38px; margin-top:15px">
        <div style="width:116px; height:30px; padding-top:13px; float:left; font-size:14px; font-weight:normal;">Cancelled</div>
        <div style="width:280px; height:38px; -moz-border-radius: 3px; border-radius: 3px; float:left; margin-top:3px; background-color:#CCCCCC; -moz-box-shadow:inset 0 1px 0 #000000; -webkit-box-shadow:inset 0 1px 0 #000000; box-shadow:inset 0 1px 0 #000000; position:relative;">
        <div style="position:absolute; left:50%; top:10px; color:#B9B9B9">'.$l.'</div>
        <div class="red_bars" style="width:'.$canwide.'px"><span style="padding-left:15px; z-index:300">'.$l.'</span></div>
        
        </div>
        </div>
        <!--end-->
        
       
        
        
        </div>';
}
?>