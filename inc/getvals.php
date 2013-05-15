<?php
$names = array();
if (isset($_POST) && !empty($_POST)) {
	$i = 0;
    foreach ($_POST as $key => $val) {
        //$key is the name you wanted, and $val is the value of that input
        $names[] = $key;
		//echo 'var '.$key.' = $("#'.$key.'").val();<br>';
		//echo ''.$key.'=\'+'.$key.'+\'&';
		//echo '$'.$key.'=$_REQUEST["'.$key.'"];<br>';
		echo '$'.$key.' = mysql_real_escape_string($_REQUEST[\''.$key.'\']);<br>';
		//echo ''.$key.' = \'$'.$key.'\', ';
		//echo 'if('.$key.' == \'\'){var er'.$i.' = \'Need '.$key.'\';}else{var er'.$i.' = \'\';}<br>';
		//echo 'er'.$i.' = \'\' && ';
		$i++;
    }
}
?>


<form action="getvals.php" method="post">
<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Name:<br><input class="makerrs" text" name="name" id="name" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left">
    Sub Account:<br>
    
    <select class="makerrs" name="subacctloan" id="subacctloan">
    <option value="none">Select sub account if needed...</option>';
    </select>
    
    </div>
    </div>
    
<div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Date:<br>
    <input style="float:left" class="makerrs text" name="setdate" id="setdate" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">Terms(months):<br>
       <input class="makerrs text" name="amount" id="amount" type="text" />
     </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Opening Balance:<br>
    <input style="float:left" class="makerrs text" name="balance" id="balance" type="text" value="">
    </div>
    
     <div style="width:300px; height:40px; float:left">Account #:<br>
       <input class="makerrs text" name="acctnum" id="acctnum" type="text" />
     </div>
    </div>
    
    <div style="width:603px; height:40px; margin-bottom:30px">
    <div style="width:300px; height:40px; float:left">
    Intrest Rate:<br>
    <input style="float:left" class="makerrs text" name="intrest" id="intrest" type="text">
    </div>
    
     <div style="width:300px; height:40px; float:left"></div>
    </div>
	
	<div id="adbutton" onClick="subEntry(\'loan\')">Add Loan</div>

<input name="" type="submit" />
</form>