<?php
session_start();


//==============================================================
//==============================================================
//==============================================================

include("MPDF53/mpdf.php");
include('inc/config.php');

$a = mysql_query("SELECT * FROM core_docs WHERE doc_id = '".$_REQUEST['docid']."' AND saasid='".$_SESSION['saasid']."'");
$b = mysql_fetch_array($a);

$c = mysql_query("SELECT * FROM customers WHERE cust_id = '".$b["company_id"]."' AND saasid = '".$_SESSION['saasid']."'");
$dd = mysql_fetch_array($c);

$e = mysql_query("SELECT * FROM locations WHERE locid = '".$b["location"]."' AND saasid = '".$_SESSION['saasid']."'");
$f = mysql_fetch_array($e);



$g = mysql_query("SELECT * FROM contacts WHERE cont_id = '".$b["contact_name"]."' AND saasid = '".$_SESSION['saasid']."'");
$h = mysql_fetch_array($g);


$html.= '<div style="padding-top:90px"><span style="font-weight:bold;">Location:</span> '.$f["address1"].' '.$f["city"].' '.$f["state"].', '.$f["zip"].'<br>
<span style="font-weight:bold;">Cost:</span> $'.$b["value"].'<br><span style="font-weight:bold;">Type:</span> '.$b["base_type"].'<br><br><span style="font-weight:bold;">Contact Info:</span><br> '.$h["firstname"].' '.$h["lastname"].' | '.$h["title"].'<br>em. '.$h["email"].'<br>ph. '.$h["phone"].'
</div>

<div style="height:20px; border-bottom:solid thin #999"></div>
<div style="margin-top:20px; background-color:#ccc; padding-left:10px; padding-top:5px; padding-bottom:5px; font-weight:bold">Products & Services</div>

<div style="width:677px; height:34px; font-weight:bold">
<div style="width:144px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">Item Code</div>
<div style="width:144px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">Description</div>
<div style="width:90px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">Quanity</div>
<div style="width:94px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">Price</div>
<div style="width:94px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">Tax</div>
<div style="width:94px; height:14px; float:right; padding-top:10px; padding-bottom:10px; text-align:right">Total</div>
</div>';


$a = mysql_query("SELECT * FROM doc_items WHERE doc_id='".$_REQUEST['docid']."' AND saasid='".$_SESSION['saasid']."'");
	$cnh = 0;
		while($bb = mysql_fetch_array($a)){
			
			if($bb["sku"] == ''){
			$sku = '-service-';	
			}else{
				$sku = $bb["sku"];
			}
			//31
			$desclen = strlen($bb["item_dec"]);
			if($desclen > 21){
				$cutdes = substr($bb["item_dec"], 0, 21).'...';
			}else{
				$cutdes = $bb["item_dec"];
			}
		
			$totalEac = $bb["item_price"] * $bb["quant"];
			
			
			//////tax part////
			
			$d = mysql_fetch_array(mysql_query("SELECT * FROM locations WHERE locid = '".$b["location"]."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
				//$html .= "this".$d["taxs"];
				
					$runTxa = explode(",",$d["taxs"]);
					$Tax = 0;
					
						foreach ($runTxa as $idat){
							
							//echo $idat.'<br>';
							$ops = mysql_fetch_array(mysql_query("SELECT * FROM tax_table WHERE tax_id = '$idat' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
					//echo $ops['percent'].'<br>'.$subTottax;
					$Tax += round( (($totalEac * $ops['percent']) / 100 ), 2);
						
					
						}
						
						//echo $Taxerset;
						
						if($bb["is_tax"] == 'true'){
						
						$totAll = number_format ($totalEac+$Tax,2);
						
						}else{
						$totAll = number_format ($totalEac,2);
						$Tax = '0.00';	
						}
			
			
			if($cnh == 1){
				$bc = '#fff';
				$cnh = 0;
			}else{
				$bc = '#EEEEEE';
				$cnh = 1;
			}
			
			
			$html .='<div style="width:677px; height:34px; font-weight:normal; font-size:12px; background-color:'.$bc.'">
<div style="width:144px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">'.$sku.'</div>
<div style="width:154px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">'.$cutdes.'</div>
<div style="width:90px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">'.$bb["quant"].'</div>
<div style="width:94px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">$'.$bb["item_price"].'</div>
<div style="width:94px; height:14px; float:left; padding-top:10px; padding-bottom:10px;">$'.$Tax.'</div>
<div style="width:94px; height:14px; float:right; padding-top:10px; padding-bottom:10px; text-align:right">$'.$totAll.'</div>
</div>';
		}
		
		//$cnh++;
		
		$html .='<div style="height:30px"></div>';
		
		
		$r = mysql_query("SELECT * FROM doc_items WHERE doc_id = '".$_REQUEST['docid']."'");
	
		
			
		
			$totSet = 0;
			$totSet2 = 0;
			
				while($o = mysql_fetch_array($r)){
					
					$grbTot = $o["item_price"] * $o["quant"];
					
					if($o["is_tax"] == 'true'){
					$totSet += $grbTot;
					}else{
					$totSet2 += $grbTot;	
					}
					
				}
				
				$subTottax=$totSet;
				$subTot=$totSet2;
				
				$cleanSub = $totSet + $totSet2;
				$cleanSubtru = number_format($totSet + $totSet2,2);
				
				$d = mysql_fetch_array(mysql_query("SELECT * FROM locations WHERE locid = '".$b['location']."' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
				
				
					$runTxa = explode(",",$d["taxs"]);
					$Tax = 0;
						foreach ($runTxa as $idat){
							
							//echo $idat.'<br>';
							$ops = mysql_fetch_array(mysql_query("SELECT * FROM tax_table WHERE tax_id = '$idat' AND saasid = '".$_SESSION['saasid']."' AND active = 'true'"));
					//echo $ops['percent'].'<br>'.$subTottax;
					$Tax = round( (($subTottax * $ops['percent']) / 100 ), 2);
					
					
					
					$runTax.='<div style="width:360px; height:31px; float:right; clear:both; border-bottom:solid thin #CCC;"><div style="width:210px; float:left">'.$ops['tax_name'].':</div> <div style="width:130px; float:left; text-align:right">$'.$Tax.'</div></div>';
					
						$taxcom += $Tax;
					
						}
				
				
				
				
				$afterMath = number_format($cleanSub+$taxcom, 2);
	
	
	
$html .= '<div style="width:360px; height:31px; float:right;"><div style="width:210px; float:left">Subtotal:</div> <div style="width:130px; float:left; text-align:right">$'.$cleanSubtru.'</div></div>

'.$runTax.'


<div style="width:360px; height:31px; float:right; clear:both"><div style="width:210px; float:left; font-weight:bold">Total:</div> <div style="width:130px; float:left; text-align:right">$'.$afterMath.'</div></div><input name="estiamount" id="estiamount" type="hidden" value="'.$afterMath.'" />';	

$html .='</div>

';

$rt = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$b["salesman"]."' AND saasid = '".$_SESSION['saasid']."'"));


$mpdf=new mPDF(); 
$mpdf->SetHTMLHeader('<div style="width:161px; height:64px; float:left; background-image:url(images/main_logo.gif)"></div><div style="float:left; text-align:right; font-size:11px">Invoice for: '.$dd["companyname"].'<br>Date Created: '.$b["issue_date"].'<br>Created By: '.$rt["fname"].' '.$rt["lname"].'</div>');
$mpdf->SetFooter('ACS Invoice | {PAGENO}');
$mpdf->WriteHTML($html);
$mpdf->Output();
//$mpdf->Output('filename.pdf','F');
exit;

//==============================================================
//==============================================================
//==============================================================


?>