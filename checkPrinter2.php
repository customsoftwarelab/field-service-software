<?php
error_reporting(0);
session_start();


//==============================================================
//==============================================================
//=============================================================

include("MPDF53/mpdf.php");
include('inc/config.php');
include('num_converter.php');

$chkdate = mysql_real_escape_string($_REQUEST['date']);
$glsel = mysql_real_escape_string($_REQUEST['glacct']);
$amount = mysql_real_escape_string($_REQUEST['amount']);
$memo = mysql_real_escape_string($_REQUEST['memo']);
$bankacct = mysql_real_escape_string($_REQUEST['bankacct']);
$glseltrue = mysql_real_escape_string($_REQUEST['glseltrue']); 

$amount = number_format($amount,2);

	$amount2 = str_replace(',','',$amount);

$a = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$bankacct'"));

	mysql_query("INSERT INTO transandpays SET date = '$chkdate', numtype = 'CHECK', memo = '$memo', gl_act = '$glsel', payment = '$amount2', paidby = '$bankacct', paytype = 'check', ispay = 'true', saasid = '".$_SESSION['saasid']."', gl_refatt = '$glseltrue'");
	
	
	$b = mysql_fetch_array(mysql_query("SELECT * FROM ledger_tabs WHERE glid = '$glsel'"));
	
	$exk = explode('.', $_REQUEST['amount']);
				
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
							
							
	
	
	
$html = '<table style="font-family:Arial, Helvetica, sans-serif; font-size:20px;" width="1025" border="0">

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

              <td width="66%" align="left" valign="top">'.$b["fld1"].'</td>

              <td width="29%" align="right" valign="top">'.$amount.'</td>

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

          <td height="129" valign="top">';
          
          
          
          if($b["addressset"] != ''){
          
          
          $html.='<table width="766" border="0">

            <tr>

              <td width="4%" height="36" align="left">&nbsp;</td>

              <td width="32%" align="left" style="font-size:15px; font-weight:normal">Vendor Name<br />'.$b["addressset"].'<br />'.$b["fld7"].' '.$b["fld6"].', '.$b["fld8"].'</td>

              <td width="31%" align="left">&nbsp;</td>

              <td width="33%" align="left">&nbsp;</td>

            </tr>

          </table>';
		  }
		  
           $html.='<table width="766" border="0">
            <tr>
              <td width="4%" height="50" align="left">&nbsp;</td>
              <td width="96%" align="left">'.$memo.'</td>
             
              
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

          <td height="34"></td>

          <td align="right">'.$chkdate.'</td>

        </tr>

    </table></td>

  </tr>

</table>

<table style="font-family:Arial, Helvetica, sans-serif; font-size:18px;" width="1025" border="0">

  <tr>

    <td height="38" align="right">$'.$amount.'</td>

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

          <td height="34"></td>

          <td align="right">'.$chkdate.'</td>

        </tr>

      </table></td>

  </tr>

</table>

<table style="font-family:Arial, Helvetica, sans-serif; font-size:18px;" width="1025" border="0">

  <tr>

    <td height="38" align="right">'.$amount.'</td>

  </tr>

</table>';

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