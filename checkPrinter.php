<?php
error_reporting(0);
session_start();


//==============================================================
//==============================================================
//==============================================================

include("MPDF53/mpdf.php");
include('inc/config.php');
include('num_converter.php');
$g = $_REQUEST['thevals'];
	$nowRaw = str_replace(',', '', $g);
	
	$tags = explode('!', $nowRaw);
	
		$totSet2 = 0;
		foreach($tags as $key) {
$what = explode("=",$key);

$rgl = mysql_fetch_array(mysql_query("SELECT * FROM transandpays WHERE pyid = '".$what[1]."'"));





if($rgl["vendor"] != ''){
				$diracct = $rgl["vendor"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM vendors WHERE ven_id = '".$rgl["vendor"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["ven_name"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");
				
				

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}else{
				$diracct = $rgl["gl_act"];
				$p = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '".$rgl["gl_act"]."' AND saasid = '".$_SESSION['saasid']."'"));
				$name = $p["fld1"];
				
				
				$rt = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND status = 'open' AND saasid = '".$_SESSION['saasid']."'");

$totSet2 = 0;

//$totSet2 += $tm["fld4"];
while($f = mysql_fetch_array($rt)){
$totSet2 += $f["payment"];	

}

$rt2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND ispay = 'true' AND saasid = '".$_SESSION['saasid']."'");

$totSet3 = 0;

//$totSet2 += $tm["fld4"];
while($f2 = mysql_fetch_array($rt2)){
$totSet3 += $f2["payment"];	

}

$owedAmount =  number_format($totSet2 - $totSet3,2);
				
				
			}
			
			
			
			//convertNum(45);
			
			/////DO SOME STUFF TO GET THE SPELLING IN ENGLISH OF THE AMOUNT TO PROVIDE WRITTEN AMOUNT////
			
				$exk = explode('.', $what[0]);
				
					$dollars = $exk[0];
					$cents = $exk[1];
					
						$dollarPres = convertNum($dollars).' and';
						$centsPres = convertNum($cents).'/100';
						
						$fullOutput = "$dollarPres $cents/100";
						
						$cnt = strlen($fullOutput);
						
						$extra = 88 - $cnt;

						$shove = "****************************************************************************************";
						$mount  = "this is $extra - $cnt";
						$finLine = substr($shove, 0, $extra);
						
							$outPut = "$fullOutput $finLine";
						

if($rgl["payment"] != ''){

$html .='<table style="font-family:Arial, Helvetica, sans-serif; font-size:20px;" width="1025" border="0">
  <tr>
    <td width="1005" height="259" align="left" valign="top"><table width="100%" border="0">
      <tr>
        <td height="60">&nbsp;</td>
      </tr>
    </table>
      <table width="1019" border="0">
        <tr>
          <td width="1013" height="31" valign="top"><table width="1010" border="0">
            <tr>
              <td width="5%" height="25" align="left">&nbsp;</td>
              <td width="66%" align="left" valign="top">'.$name.'</td>
              <td width="29%" align="right" valign="top">'.$what[0].'</td>
            </tr>
          </table></td>
        </tr>
    </table>
      <table width="100%" border="0">
        <tr>
          <td height="59" valign="top"><table width="1011" border="0">
            <tr>
              <td width="1%" height="46" align="left">&nbsp;</td>
              <td width="95%" align="left">'.$outPut.'</td>
              <td width="4%" align="left">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
    </table>
      <table width="100%" border="0">
        <tr>
          <td height="129">';
		  
		  
		  if($p["addressset"] != ''){
          
          
          $html.='<table width="766" border="0">

            <tr>

              <td width="4%" height="36" align="left">&nbsp;</td>

              <td width="32%" align="left" style="font-size:15px; font-weight:normal">Vendor Name<br />'.$p["addressset"].'<br />'.$p["fld7"].' '.$p["fld6"].', '.$p["fld8"].'</td>

              <td width="31%" align="left">&nbsp;</td>

              <td width="33%" align="left">&nbsp;</td>

            </tr>

          </table>';
		  }
		  
		  
		  $html.='<table width="766" border="0">
            <tr>
              <td width="6%" height="36" align="left">&nbsp;</td>
              <td width="30%" align="left">Check Print</td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="1025" border="0">
  <tr>
    <td height="58">&nbsp;</td>
  </tr>
</table>
<table style="font-family:Arial, Helvetica, sans-serif; font-size:18px;" width="1025" border="0">
  <tr>
    <td width="1019" height="220" align="left" valign="top"><table width="100%" border="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0">
        <tr>
          <td height="34">'.$name.'</td>
          <td align="right">'.date('m/d/Y').'</td>
        </tr>
    </table>';
     if($rgl["vendor"] != ''){
		  $totSetA = 0;
		  $qa = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND numtype = 'Submitted Bill' AND status = 'open' AND saasid = '".$_SESSION['saasid']."' OR vendor = '".$rgl["vendor"]."' AND saasid = '".$_SESSION['saasid']."' AND ispay = 'true' LIMIT 7");
	  				while($ty = mysql_fetch_array($qa)){
					if($ty['ispay'] == 'true'){
							$payStuff = '-'.$ty["payment"];
							$totSetAB += $ty["payment"];
						}else{
							$payStuff = $ty["payment"];
							$totSetAB = '';
							$totSetA += $ty["payment"];
						}
						
      $html2.='<table style="font-size:14px" width="1015" border="0">
        <tr>
          <td width="48%">'.$ty["date"].' - '.$ty["numtype"].'</td>
          <td width="52%" align="right">$'.$payStuff.'</td>
        </tr>
      </table>';
	  
	  
	  $deduct = $totSetA - $totSetAB;
	  
	  
			}
	  }else{
		  
		  $totSetA = 0;
		   $totSetAB = 0;
		  $qa2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND numtype = 'Submitted Bill' AND status = 'open' AND saasid = '".$_SESSION['saasid']."' OR gl_act = '".$rgl["gl_act"]."' AND saasid = '".$_SESSION['saasid']."' AND ispay = 'true' LIMIT 6");
	  				while($ty2 = mysql_fetch_array($qa2)){
						if($ty2['ispay'] == 'true'){
							$payStuff = '-'.$ty2["payment"];
							$totSetAB += $ty2["payment"];
						}else{
							$payStuff = $ty2["payment"];
							$totSetAB = '';
							$totSetA += $ty2["payment"];
						}
						
      $html.='<table style="font-size:14px" width="1015" border="0">
        <tr>
          <td width="48%">'.$ty2["date"].' - '.$ty2["numtype"].'</td>
          <td width="52%" align="right">$'.$payStuff.'</td>
        </tr>
      </table>';
	  
	  
	  $deduct = $totSetA - $totSetAB;
	  
		  
	  }
	  }
	  $outNum = "This is :$totSetA  and This is :$totSetAB";
	  
	   ///$html.='<table style="font-size:14px" width="1015" border="0">
      //  <tr>
        //  <td width="48%">'.date('m/d/Y').' - Current Payment</td>
        //  <td width="52%" align="right">$-'.number_format($what[0],2).'</td>
       // </tr>
     // </table>';
	  
	  $html.='</td>
  </tr>
</table>
<table style="font-family:Arial, Helvetica, sans-serif; font-size:18px;" width="1025" border="0">
  <tr>
    <td height="38" align="right">$'.number_format($deduct,2).'</td>
  </tr>
</table>
<table width="1025" border="0">
  <tr>
    <td height="73">&nbsp;</td>
  </tr>
</table>
<table style="font-family:Arial, Helvetica, sans-serif; font-size:18px;" width="1025" border="0">
  <tr>
    <td width="1019" height="252" align="left" valign="top"><table width="100%" border="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0">
        <tr>
          <td height="34">'.$name.'</td>
          <td align="right">07/06/2012</td>
        </tr>
      </table>';
	  
	  if($rgl["vendor"] != ''){
		  $totSetA = 0;
		  $qa = mysql_query("SELECT * FROM transandpays WHERE vendor = '".$rgl["vendor"]."' AND numtype = 'Submitted Bill' AND status = 'open' AND saasid = '".$_SESSION['saasid']."' OR vendor = '".$rgl["vendor"]."' AND saasid = '".$_SESSION['saasid']."' AND ispay = 'true' LIMIT 7");
	  				while($ty = mysql_fetch_array($qa)){
					if($ty['ispay'] == 'true'){
							$payStuff = '-'.$ty["payment"];
							$totSetAB += $ty["payment"];
						}else{
							$payStuff = $ty["payment"];
							$totSetAB = '';
							$totSetA += $ty["payment"];
						}
						
      $html2.='<table style="font-size:14px" width="1015" border="0">
        <tr>
          <td width="48%">'.$ty["date"].' - '.$ty["numtype"].'</td>
          <td width="52%" align="right">$'.$payStuff.'</td>
        </tr>
      </table>';
	  
	  
	  $deduct = $totSetA - $totSetAB;
	  
	  
			}
	  }else{
		  
		  $totSetA = 0;
		   $totSetAB = 0;
		  $qa2 = mysql_query("SELECT * FROM transandpays WHERE gl_act = '".$rgl["gl_act"]."' AND numtype = 'Submitted Bill' AND status = 'open' AND saasid = '".$_SESSION['saasid']."' OR gl_act = '".$rgl["gl_act"]."' AND saasid = '".$_SESSION['saasid']."' AND ispay = 'true' LIMIT 6");
	  				while($ty2 = mysql_fetch_array($qa2)){
						if($ty2['ispay'] == 'true'){
							$payStuff = '-'.$ty2["payment"];
							$totSetAB += $ty2["payment"];
						}else{
							$payStuff = $ty2["payment"];
							$totSetAB = '';
							$totSetA += $ty2["payment"];
						}
						
      $html2.='<table style="font-size:14px" width="1015" border="0">
        <tr>
          <td width="48%">'.$ty2["date"].' - '.$ty2["numtype"].'</td>
          <td width="52%" align="right">$'.$payStuff.'</td>
        </tr>
      </table>';
	  
	  
	  $deduct = $totSetA - $totSetAB;
	  
		  
	  }
	  }
	  $outNum = "This is :$totSetA  and This is :$totSetAB";
	  
	   //$html.='<table style="font-size:14px" width="1015" border="0">
       //<tr>
         // <td width="48%">'.date('m/d/Y').' - Current Payment</td>
         // <td width="52%" align="right">$-'.number_format($what[0],2).'</td>
        //</tr>
      //</table>';
	  
	  $html.='</td>
  </tr>
</table>
<table style="font-family:Arial, Helvetica, sans-serif; font-size:18px;" width="1025" border="0">
  <tr>
    <td height="38" align="right">$'.number_format($deduct,2).'</td>
  </tr>
</table><pagebreak/>
';

		}
		}

$mpdf=new mPDF(); 
$mpdf->SetHTMLHeader('');
$mpdf->SetFooter('');
$mpdf->WriteHTML($html);
$mpdf->Output();
//$mpdf->Output('filename.pdf','F');
exit;

//==============================================================
//==============================================================
//==============================================================