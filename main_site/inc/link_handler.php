<?php
		
						$currentFile = $_SERVER["SCRIPT_NAME"];
   						 $parts = explode('/', $currentFile);
   							 $cur = $parts[count($parts) - 1];
							
												if($cur == 'index.php'){
													$home_nav = 'act';
													$estimates_nav = '';
													$workorders_nav = '';
													$scheduler_nav = '';
													$invoice_nav = '';
													$purchase_nav = '';
													$accounting_nav = '';
													$admin_nav = '';
													
													$pagetitle = '';
													
													}
													
														if($cur == 'estimates.php'){
														$customer_nav = '';
														$estimates_nav = 'act';
														$workorders_nav = '';
														$scheduler_nav = '';
														$invoice_nav = '';
														$purchase_nav = '';
														$accounting_nav = '';
														$admin_nav = '';
														
														$addButton = '<div class="addnew"><img style="margin-left:10px; margin-top:3px; float:left" src="images/add_new.png" width="13" height="17">
                <div style="float:left; margin-left:5px; margin-top:5px">New Estimate</div>
                </div>';
														}
														
														if($cur == 'work_orders.php'){
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = 'act';
														$scheduler_nav = '';
														$invoice_nav = '';
														$purchase_nav = '';
														$accounting_nav = '';
														$admin_nav = '';
														}
														
														if($cur == 'scheduler.php'){
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
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = '';
														$scheduler_nav = '';
														$invoice_nav = 'act';
														$purchase_nav = '';
														$accounting_nav = '';
														$admin_nav = '';
														}
														
														if($cur == 'purchase_orders.php'){
														$customer_nav = '';
														$estimates_nav = '';
														$workorders_nav = '';
														$scheduler_nav = '';
														$invoice_nav = '';
														$purchase_nav = 'act';
														$accounting_nav = '';
														$admin_nav = '';
														}
														
														if($cur == 'accounting.php'){
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