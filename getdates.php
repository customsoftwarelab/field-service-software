<?php
error_reporting(0);
include('inc/config.php');
session_start();
$act = $_REQUEST['action'];


if($act == 'getdates'){
//This gets today's date 

 $date =time () ;
 
 

 //This puts the day, month, and year in seperate variables 

 $day = date('d') ;
 
if($_REQUEST['mon'] == ''){
$month = date('m') ; 
}else{
$month = $_REQUEST['mon']; 
}

if($_REQUEST['yr'] == ''){
$year = date('Y') ;	
}else{
$year = $_REQUEST['yr'];
}
 
// $day = '29';


 //$month = '07';
 //$year = '2014';



 //Here we generate the first day of the month 

 $first_day = mktime(0,0,0,$month, 1, $year) ; 



 //This gets us the month name 

 $title = date('M', $first_day) ;
 $monnum = date('m', $first_day) ;
 
 
$curr_month = $month;
$monthf = array (1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
$select = "<select style=\"font-size:11px; width:63px; height:22px;\" name=\"month\" id=\"month\" onChange=\"runerMon(this.value)\">";
foreach ($monthf as $key => $val) {
	if(strlen($key)< 2){
			$key = "0$key";
	}else{
		$key = $key;
	}
    $select .= "<option value=\"".$key."\"";
    if ($key == $curr_month) {
        $select .= "selected=\"selected\">".$val."</option>";
    } else {
        $select .= ">".$val."</option>";
    }
}
$select .= "</select>";

////YEAR SEL/////
$yersel.= "<select style=\"font-size:11px; width:63px; height:22px;\" name=\"year\" id=\"year\" onChange=\"runerYer(this.value)\">";

$plusYer = date('Y') + 15;
$plusMin = date('Y') - 10;

for($i=$plusMin; $i<$plusYer; $i++)
{
	if($i==$year){
		
		$yersel.= "<option selected=\"selected\" value=\"".$i."\">".$i."</option>";
	}else{
		$yersel.="<option value=\"".$i."\">".$i."</option>";
	}
  
}
 
 $yersel.='</select>';

 
 //Here we find out what day of the week the first day of the month falls on 
 $day_of_week = date('D', $first_day) ; 



 //Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero

 switch($day_of_week){ 

 case "Sun": $blank = 0; break; 

 case "Mon": $blank = 1; break; 

 case "Tue": $blank = 2; break; 

 case "Wed": $blank = 3; break; 

 case "Thu": $blank = 4; break; 

 case "Fri": $blank = 5; break; 

 case "Sat": $blank = 6; break; 

 }



 //We then determine how many days are in the current month

 $days_in_month = cal_days_in_month(0, $month, $year) ;
 
 
 //Here we start building the table heads 

 echo "<table id=\"dattab\" style=\"font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif; font-size:10px; color:#333; background-color:#eeeeee\" border=0 width=190>";

 echo "<tr><th colspan=7> <div style=\"width:190px; padding:3px; background-color:#0066CC; color:#fff; -moz-border-radius: 5px; border-radius: 5px; position:reletive\">";
 
 ////GET NEXT MONTH///
 
 $nextMo = $monnum + 1;
 
if($monnum == 12){
	$nextMo = 1;
}
if($monnum == 12){
$nextYer = $year + 1;
}else{
$nextYer = $year;	
}


///GET PREV MONTH////


 
if($monnum == 1){
	$prevMo = 12;
}else{
$prevMo = $monnum - 1;	
}

if($monnum == 1){
$prvYer = $year - 1;
}else{
$prvYer = $year;	
}

if(strlen($nextMo) < 2){
$nextMo = "0".$nextMo;	
}else{
$nextMo = $nextMo;	
}

if(strlen($prevMo) < 2){
$prevMo = "0".$prevMo;	
}else{
$prevMo = $prevMo;	
}
 
 echo"<div class=\"prevmo\" style=\"width:20px; height:19px; position:absolute; left: 10px; top:11px; cursor:pointer\" onClick=\"migMo('$prevMo','$prvYer')\"></div>
 <div class=\"nextmo\" style=\"width:20px; height:19px; position:absolute; left: 178px; top:11px; cursor:pointer\" onClick=\"migMo('$nextMo','$nextYer')\"digit></div>
 
 ".$select."
 ".$yersel."";

 echo "<tr><td style=\"text-align:center; font-weight:bold\" width=42 >Su</td><td style=\"text-align:center; font-weight:bold\" width=42>Mo</td><td style=\"text-align:center; font-weight:bold\" 
width=42>Tu</td><td style=\"text-align:center; font-weight:bold\" width=42>We</td><td style=\"text-align:center; font-weight:bold\" width=42>Th</td><td style=\"text-align:center; font-weight:bold\"
width=42>Fr</td><td style=\"text-align:center; font-weight:bold\" width=42>Sa</td></tr>";



 //This counts the days in the week, up to 7

 $day_count = 1;



 echo "<tr>";

 //first we take care of those blank days

 while ( $blank > 0 ) 

 { 

 echo "<td></td>"; 

 $blank = $blank-1; 

 $day_count++;

 } 
 
 //sets the first day of the month to 1 

 $day_num = 1;



 //count up the days, untill we've done all of them in the month

 while ( $day_num <= $days_in_month ) 

 { 
 
 if($day_num == date('d')){
	$setCl = 'drts'; 
 }else{
	$setCl = 'dayser'; 
 }
 
 if(strlen($day_num)< 2){
	$adZer = '0'; 
 }else{
	$adZer = ''; 
 }
 
 $fullDat = "$month/$adZer$day_num/$year";
 
 
 $rt = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'workorder' AND saasid = '".$_SESSION['saasid']."' AND sched_stat = '' AND servicedate = '$fullDat'")or die(mysql_error());
 if(mysql_num_rows($rt) > 0){
	 $setCl = 'drtsogh';
 }else{
	$setCl = $setCl; 
 }
 
 $rt = mysql_query("SELECT * FROM core_docs WHERE doc_type = 'workorder' AND saasid = '".$_SESSION['saasid']."' AND sched_stat = 'set' AND servicedate = '$fullDat' OR doc_type = 'invoice' AND saasid = '".$_SESSION['saasid']."' AND sched_stat = 'set' AND servicedate = '$fullDat'")or die(mysql_error());
 if(mysql_num_rows($rt) > 0){
	 $setCl = 'activebl';
 }else{
	$setCl = $setCl; 
 }

 echo "<td class=\"$setCl\" onclick=\"migDay('$month/$adZer$day_num/$year')\"> $day_num </td>"; 

 $day_num++; 

 $day_count++;



 //Make sure we start a new row every week

 if ($day_count > 7)

 {

 echo "</tr><tr>";

 $day_count = 1;

 }

 } 
 
 
 //Finaly we finish out the table with some blank details if needed

 while ( $day_count >1 && $day_count <=7 ) 

 { 

 echo "<td> </td>"; 

 $day_count++; 

 } 
}


?>