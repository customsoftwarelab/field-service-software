<?php
		
						$currentFile = $_SERVER["SCRIPT_NAME"];
   						 $parts = explode('/', $currentFile);
   							 $cur = $parts[count($parts) - 1];
							 
							 		$tb = explode(".",$cur);
											$page_name = str_replace("_", "", $tb[0]);
											
											$op = mysql_num_rows(mysql_query("SELECT * FROM access_monitor WHERE accessstart = '".date('m/d/Y - h:ia')."' AND page_view = '$cur'"));
											
												if($op == 1){
													
												}else{
											
											mysql_query("INSERT INTO access_monitor SET usrid = '".$_SESSION['usrid']."', accessstart = '".date('m/d/Y - h:ia')."', page_view = '$cur', saasid='".$_SESSION['saasid']."'")or die(mysql_error());
											
												}
												if($cur == 'customers.php'){
													
													$tg = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_SESSION['usrid']."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
													
													if($tg["usrtyp"] != 'admin' && $tg["att_grp"] == ''){
														header('Location:dashboard.php?error=nopers&pageset='.$cur.'');
													}else{
														
														if($tg["usrtyp"] == 'admin'){
															echo '<input name="accesselement" id="accesselement" type="hidden" value="true,true,true" />';
														}else{
															
															$ab = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$tg["att_grp"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
															echo '<input name="accesselement" id="accesselement" type="hidden" value="'.$ab["customer_access"].'" />';
															
															$read = explode(',',$ab["customer_access"]);
																if($read[0] == 'false'){
																	header('Location:dashboard.php?error=noread&pageset='.$cur.'');
																}else{
																	///DO NOTHING//
																}
															
														}
														
													}
													
													
													
													
													
													$customer_nav = 'act';
													$estimates_nav = '';
													$workorders_nav = '';
													$scheduler_nav = '';
													$invoice_nav = '';
													$purchase_nav = '';
													$accounting_nav = '';
													$admin_nav = '';
													
													$addButton = '<div class="addnew" onClick="addnew()"><img style="margin-left:10px; margin-top:3px; float:left" src="images/add_new.png" width="13" height="17" >
                <div style="float:left; margin-left:5px; margin-top:5px">New Customer</div>
                </div>';
													
													}
													
														if($cur == 'estimates.php'){
															
															
															$tg = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_SESSION['usrid']."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
													
													if($tg["usrtyp"] != 'admin' && $tg["att_grp"] == ''){
														header('Location:dashboard.php?error=nopers&pageset='.$cur.'');
													}else{
														
														if($tg["usrtyp"] == 'admin'){
															echo '<input name="accesselement" id="accesselement" type="hidden" value="true,true,true" />';
														}else{
															
															$ab = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$tg["att_grp"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
															echo '<input name="accesselement" id="accesselement" type="hidden" value="'.$ab["estimate_access"].'" />';
															
															$read = explode(',',$ab["estimate_access"]);
																if($read[0] == 'false'){
																	header('Location:dashboard.php?error=noread&pageset='.$cur.'');
																}else{
																	///DO NOTHING//
																}
															
														}
														
													}
															
														$customer_nav = '';
														$estimates_nav = 'act';
														$workorders_nav = '';
														$scheduler_nav = '';
														$invoice_nav = '';
														$purchase_nav = '';
														$accounting_nav = '';
														$admin_nav = '';
														
														$addButton = '<div class="addnew" onclick="getEstform()"><img style="margin-left:10px; margin-top:3px; float:left" src="images/add_new.png" width="13" height="17">
                <div style="float:left; margin-left:5px; margin-top:5px">New Estimate</div>
                </div>';
														}
														
														if($cur == 'work_orders.php'){
															
															
															$tg = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_SESSION['usrid']."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
													
													if($tg["usrtyp"] != 'admin' && $tg["att_grp"] == ''){
														header('Location:dashboard.php?error=nopers&pageset='.$cur.'');
													}else{
														
														if($tg["usrtyp"] == 'admin'){
															echo '<input name="accesselement" id="accesselement" type="hidden" value="true,true,true" />';
														}else{
															
															$ab = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$tg["att_grp"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
															echo '<input name="accesselement" id="accesselement" type="hidden" value="'.$ab["workorder_access"].'" />';
															
															$read = explode(',',$ab["workorder_access"]);
																if($read[0] == 'false'){
																	header('Location:dashboard.php?error=noread&pageset='.$cur.'');
																}else{
																	///DO NOTHING//
																}
															
														}
														
													}
															
															
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = 'act';
														$scheduler_nav = '';
														$invoice_nav = '';
														$purchase_nav = '';
														$accounting_nav = '';
														$admin_nav = '';
														
														$addButton = '<div class="addnew" onclick="getEstform()"><img style="margin-left:10px; margin-top:3px; float:left" src="images/add_new.png" width="13" height="17">
                <div style="float:left; margin-left:5px; margin-top:5px" >New Work Order</div>
                </div>';
														}
														
														if($cur == 'scheduler.php'){
															
															$tg = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_SESSION['usrid']."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
													
													if($tg["usrtyp"] != 'admin' && $tg["att_grp"] == ''){
														header('Location:dashboard.php?error=nopers&pageset='.$cur.'');
													}else{
														
														if($tg["usrtyp"] == 'admin'){
															echo '<input name="accesselement" id="accesselement" type="hidden" value="true,true,true" />';
														}else{
															
															$ab = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$tg["att_grp"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
															echo '<input name="accesselement" id="accesselement" type="hidden" value="'.$ab["scheduler_access"].'" />';
															
															$read = explode(',',$ab["scheduler_access"]);
																if($read[0] == 'false'){
																	header('Location:dashboard.php?error=noread&pageset='.$cur.'');
																}else{
																	///DO NOTHING//
																}
															
														}
														
													}
															
															
															
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = '';
														$scheduler_nav = 'act';
														$invoice_nav = '';
														$purchase_nav = '';
														$accounting_nav = '';
														$admin_nav = '';
														}
														
														if($cur == 'invoice.php'){
															
															$tg = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_SESSION['usrid']."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
													
													if($tg["usrtyp"] != 'admin' && $tg["att_grp"] == ''){
														header('Location:dashboard.php?error=nopers&pageset='.$cur.'');
													}else{
														
														if($tg["usrtyp"] == 'admin'){
															echo '<input name="accesselement" id="accesselement" type="hidden" value="true,true,true" />';
														}else{
															
															$ab = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$tg["att_grp"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
															echo '<input name="accesselement" id="accesselement" type="hidden" value="'.$ab["invoice_access"].'" />';
															
															$read = explode(',',$ab["invoice_access"]);
																if($read[0] == 'false'){
																	header('Location:dashboard.php?error=noread&pageset='.$cur.'');
																}else{
																	///DO NOTHING//
																}
															
														}
														
													}
															
															
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = '';
														$scheduler_nav = '';
														$invoice_nav = 'act';
														$purchase_nav = '';
														$accounting_nav = '';
														$admin_nav = '';
														
														$addButton = '<div class="addnew" onclick="getEstform()"><img style="margin-left:10px; margin-top:3px; float:left" src="images/add_new.png" width="13" height="17">
                <div style="float:left; margin-left:5px; margin-top:5px">New Invoice</div>
                </div>';
														}
														
														if($cur == 'purchase_orders.php'){
															
															$tg = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_SESSION['usrid']."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
													
													if($tg["usrtyp"] != 'admin' && $tg["att_grp"] == ''){
														header('Location:dashboard.php?error=nopers&pageset='.$cur.'');
													}else{
														
														if($tg["usrtyp"] == 'admin'){
															echo '<input name="accesselement" id="accesselement" type="hidden" value="true,true,true" />';
														}else{
															
															$ab = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$tg["att_grp"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
															echo '<input name="accesselement" id="accesselement" type="hidden" value="'.$ab["purchase_access"].'" />';
															
															$read = explode(',',$ab["purchase_access"]);
																if($read[0] == 'false'){
																	header('Location:dashboard.php?error=noread&pageset='.$cur.'');
																}else{
																	///DO NOTHING//
																}
															
														}
														
													}
															
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = '';
														$scheduler_nav = '';
														$invoice_nav = '';
														$purchase_nav = 'act';
														$accounting_nav = '';
														$admin_nav = '';
														
														$addButton = '<div class="addnew" onclick="getEstform()"><img style="margin-left:10px; margin-top:3px; float:left" src="images/add_new.png" width="13" height="17">
                <div style="float:left; margin-left:5px; margin-top:5px">New P / O</div>
                </div>';
														}
														
														if($cur == 'accounting.php'){
															
															$tg = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_SESSION['usrid']."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
													
													if($tg["usrtyp"] != 'admin' && $tg["att_grp"] == ''){
														header('Location:dashboard.php?error=nopers&pageset='.$cur.'');
													}else{
														
														if($tg["usrtyp"] == 'admin'){
															echo '<input name="accesselement" id="accesselement" type="hidden" value="true,true,true" />';
														}else{
															
															$ab = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$tg["att_grp"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
															echo '<input name="accesselement" id="accesselement" type="hidden" value="'.$ab["accounting_access"].'" />';
															
															$read = explode(',',$ab["accounting_access"]);
																if($read[0] == 'false'){
																	header('Location:dashboard.php?error=noread&pageset='.$cur.'');
																}else{
																	///DO NOTHING//
																}
															
														}
														
													}
															
															
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = '';
														$scheduler_nav = '';
														$invoice_nav = '';
														$purchase_nav = '';
														$accounting_nav = 'act';
														$admin_nav = '';
														}
														
														if($cur == 'admin.php'){
															
															$tg = mysql_fetch_array(mysql_query("SELECT * FROM core_users WHERE usr_id = '".$_SESSION['usrid']."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
													
													if($tg["usrtyp"] != 'admin' && $tg["att_grp"] == ''){
														header('Location:dashboard.php?error=nopers&pageset='.$cur.'');
													}else{
														
														if($tg["usrtyp"] == 'admin'){
															echo '<input name="accesselement" id="accesselement" type="hidden" value="true,true,true" />';
														}else{
															
															$ab = mysql_fetch_array(mysql_query("SELECT * FROM group_tab WHERE grp_id = '".$tg["att_grp"]."' AND saasid = '".$_SESSION['saasid']."'"))or die(mysql_error());
															echo '<input name="accesselement" id="accesselement" type="hidden" value="'.$ab["admin_access"].'" />';
															
															$read = explode(',',$ab["admin_access"]);
																if($read[0] == 'false'){
																	header('Location:dashboard.php?error=noread&pageset='.$cur.'');
																}else{
																	///DO NOTHING//
																}
															
														}
														
													}
															
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = '';
														$scheduler_nav = '';
														$invoice_nav = '';
														$purchase_nav = '';
														$accounting_nav = '';
														$admin_nav = 'act';
														}
		
									?>