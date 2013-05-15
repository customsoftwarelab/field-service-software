 <?php
					 
					 ////This switches the search on if page needs it/////
					 
					 $currentFile = $_SERVER["SCRIPT_NAME"];
   						 $parts = explode('/', $currentFile);
   							 $cur = $parts[count($parts) - 1];
							 
							 if($cur == 'estimates.php' || $cur == 'customers.php' || $cur == 'work_orders.php'){
								 
								 	/////----important-----Sets the search name and id///
										$tb = explode(".",$cur);
											$input_name = $tb[0];
					 
					 echo '<div class="search" style="position:absolute; right:0px">
                     <input style="background:none; border:none; outline:none; width:110px; height:36px; margin-left:10px; font-style:italic; color:#999;" name="'.$input_name.'" id="'.$input_name.'" type="text" value="Search..." onClick="runClear(\''.$input_name.'\')" onBlur="runClear(\''.$input_name.'\')">
<div class="search_button" style="position:absolute; left: 128px; top: 0px; text-align:center; cursor:pointer;" onClick="searchOver(\''.$input_name.'\', this.value)"><img style="margin-top:6px;" src="images/ser_glss.png" width="19" height="20"></div>
                            		</div>';
							 }
					 ?>