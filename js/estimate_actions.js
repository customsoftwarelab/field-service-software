$(function() {
		
		///////GET ESTIMATE LIST ON LOAD//////
		$.ajax({
  url: 'inc/estimate_actions.php?action=getlist',
  success: function(data) {
    $('#esti_content').html(data);
	$(".make").uniform();
	
	$( "#estdt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
		$(".ui-datepicker-trigger").addClass("fixdatpicker2");
		
		var accesselement = $("#accesselement").val();
		var spl = accesselement.split(',');
			var writedoc = spl[1];
			var deletedoc = spl[2];
			
				
				if(deletedoc == 'false'){
					
					$(".delete_icon").removeAttr('onclick');
					$(".addnew").removeAttr('onclick');
				}else{
					
				}
			

  }
});

});
/////RECALL ESTIMATE LISTS///////


function recallEstis(){
	$.ajax({
  url: 'inc/estimate_actions.php?action=getlist',
  success: function(data) {
    $('#esti_content').html(data);
	$(".make").uniform();
	
	$( "#estdt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
		$(".ui-datepicker-trigger").addClass("fixdatpicker2");

  }
	});
}



function searchOver(val){
		
		var values = $("#"+val).val();
		
		$.ajax({
  url: 'inc/estimate_actions.php?action=getlist&search=true&searchval='+values,
  success: function(data) {
	  $("#loader").hide();
    $('#esti_content').html(data);
	
	$(".make").uniform();
	
	$( "#estdt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
		$(".ui-datepicker-trigger").addClass("fixdatpicker2");
	
	var accesselement = $("#accesselement").val();
		var spl = accesselement.split(',');
			var writedoc = spl[1];
			var deletedoc = spl[2];
			
			if(deletedoc == 'false'){
					
					$(".delete_icon").removeAttr('onclick');
				}else{
					
				}

  }
});
	}


			
	
	
	/////CHANGES STATUS////
	
	function  runDrops(val,val2){
	$.ajax({
  url: 'inc/estimate_actions.php?action=getstatdrop&setval='+val+'&sentid='+val2,
  success: function(data) {
	 
    $('#stater'+val2).html(data);


  }
});
	}
	
	
	///////PULL PRODUCT & SERVICES ADD FORM////
	
	
	function addProdiserv(){
		
		var comp = $("#comp").val();
		var estcont = $("#estcont").val();
		var estloc = $("#estloc").val();
		var settax = $("#settax").val();
		var estdt = $("#estdt").val();
		var status = $("#status").val();
		var RadioGroup1 = $("input:radio[name='RadioGroup1']:checked").val();
		

		
		if(comp != 'none'){er1 = '';}else{er1 = 'Company<br>';}
		if(estcont != 'none'){er2 = '';}else{er2 = 'Contact<br>';}
		if(estloc != 'none'){er3 = '';}else{er3 = 'Location<br>';}
		if(RadioGroup1 != undefined){er5 = '';}else{er5 = 'Type<br>';}
		
		
		if(er1 == '' && er2 == '' && er3 == '' && er5 == ''){
		$.ajax({
  url: 'inc/estimate_actions.php?action=getproservlist&type='+RadioGroup1,
  success: function(data) {
    $('#estiadd').html(data);
	
	$( "#estiadd" ).dialog({
			width: 650,
			height: 230,
			resizable: false,
			modal: true
		});		
	
	$(".makeitem").uniform();
	
	$("#truadd").button({
	 icons: {
                primary: "ui-icon-cart"
            },
			
			});
	

  }
});

		}else{
			
			$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue. </span><br><br>'+er1+' '+er2+' '+er3+' '+er5);
			
			$( "#alerts" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
			
		}
		
		
		
	}
	
	/////PULL NEW ESTIMATE ADD FORM////
	
	
	
	function getEstform(){
		$.ajax({
  url: 'inc/estimate_actions.php?action=getaddest',
  success: function(data) {
    $('#esti_content').html(data);
	
	$(".make").uniform();
	
	$( "#estdt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
		$(".ui-datepicker-trigger").addClass("fixdatpicker2");
		
		$("#addcrt, #truadd").button({
			//disabled: true,
	 icons: {
                primary: "ui-icon-cart",
				
				
            },
			
			
			});
			
				
				$("#addsestbut").button({
			//disabled: true,
	 icons: {
                primary: "ui-icon-disk",
				
				
            },
			
			
			});

  }
});
		
	}
	
	
	/////SWITCHS CONTACT DROP DOWN VIA AJAX YAY!!!/////
	
	function runCons(val){
		
		//getcons
		
		$.ajax({
  url: 'inc/estimate_actions.php?action=getcons&compid='+val,
  success: function(data) {
    $('#estconssd').html(data);
	
	$(".maker").uniform();


  }
});
		
	}
	
	
	//////SWITCHES LOCATION DROP DOWN///////
	
	function runLocs(val){
		//alert(val);
		$.ajax({
  url: 'inc/estimate_actions.php?action=getlocs&compid='+val,
  success: function(data) {
    $('#estlocss').html(data);
	
	$(".makerloc").uniform();


  }
  });
	}
	
	
	//////GET TAXES DROP DOWN/////
	
	function getTaxs(val){
		
		$.ajax({
  url: 'inc/estimate_actions.php?action=gettaxs&compid='+val,
  success: function(data) {
    $('#taxcont').html(data);
	
	$(".makertax").uniform();


  }
  });
	}
	
	////SUPPLY PRICE TO AMOUNT FIELD////
	
	function getitemPric(val){
		
			 var arrs = val.split('?');
			 	var price = arrs[1];
				$("#proservprice").val(price);
		
	}
	
	
	/////ADD PRODUCTS TO DB/////
	function addItm(){
	var productservi = $("#productservi").val();
		var proservprice = $("#proservprice").val();
		var quant = $("#quant").val();
		var docid = $("#docid").val();
		
			var arrs = productservi.split('?');
			 	var producuid = arrs[0];
				var tax = $('#extax').attr('checked');
					if(tax == 'checked'){
					var tax = 'false';	
					}else{
						var tax = 'true';
					}
		
		$.ajax({
  url: 'inc/estimate_actions.php?action=additem&itemid='+producuid+'&quant='+quant+'&docid='+docid+'&istax='+tax+'&proservprice='+proservprice,
  success: function(data) {
  $("#estiadd").dialog( "close" );
	getItemlist();
  }
  });	
	}
	
	function getItemlist(){
		var doc_id = $("#docid").val();
		var estloc = $("#estloc").val();
		$.ajax({
  url: 'inc/estimate_actions.php?action=getitmelist&doc_id='+doc_id+'&locid='+estloc,
  success: function(data) {
   $("#itmhold").html(data);
	}
  });	
	goTotal();	
	}
	
	/////GET ALL THE TOTALS////
	
	function goTotal(){
		var doc_id = $("#docid").val();
		var estloc = $("#estloc").val();
	$.ajax({
  url: 'inc/estimate_actions.php?action=grbmoney&docid='+doc_id+'&locid='+estloc,
  success: function(data) {
  $("#tothold").html(data);
  }
  });		
	}
	
	
	////SAVE ESTIMATE////
	
	function finEsti(){
		var doc_id = $("#docid").val();
	var comp = $("#comp").val();
		var estcont = $("#estcont").val();
		var estloc = $("#estloc").val();
		var estdt = $("#estdt").val();
		var status = $("#status").val();
		var RadioGroup1 = $("input:radio[name='RadioGroup1']:checked").val();
		var salesman = $("#salesman").val();
		var payterms = $("#payterms").val();
		var notes = $("#notes").val();
		var estiamount = $("#estiamount").val();
		var pofld = $("#pofld").val();
		
	
		
		if(comp != 'none'){er1 = '';}else{er1 = 'Company<br>';}
		if(estcont != 'none'){er2 = '';}else{er2 = 'Contact<br>';}
		if(estloc != 'none'){er3 = '';}else{er3 = 'Location<br>';}
		if(RadioGroup1 != undefined){er5 = '';}else{er5 = 'Type<br>';}	
		
		if(er1 == '' && er2 == '' && er3 == '' && er5 == ''){
			
			$.ajax({
  url: 'inc/estimate_actions.php?action=insertestimate&docid='+doc_id+'&comp='+comp+'&estcont='+estcont+'&RadioGroup1='+RadioGroup1+'&salesman='+salesman+'&payterms='+payterms+'&notes='+notes+'&estiamount='+estiamount+'&status='+status+'&locid='+estloc+'&estdt='+estdt+'&pofld='+pofld,
  success: function(data) {
	  
  recallEstis();
  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
  }
  });
			
		}else{
			
			$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue. <br>Also Note, If you have changed the location already set in place the tax rates will be changed depending upon which taxes are set on the newly selected location.</span><br><br>'+er1+' '+er2+' '+er3+' '+er5);
			
			$( "#alerts" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
			
		}
	}
	
	
	/////PULL EDIT ESTIMATE FORM////
	
	
	
	function geteditEstform(val){
		$.ajax({
  url: 'inc/estimate_actions.php?action=editest&docid='+val,
  success: function(data) {
    $('#esti_content').html(data);
	
	$(".make").uniform();
	
	$( "#estdt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
		$(".ui-datepicker-trigger").addClass("fixdatpicker2");
		
		$("#addcrt, #truadd").button({
			//disabled: true,
	 icons: {
                primary: "ui-icon-cart",
				
				
            },
			
			
			});
			
				
				$("#addsestbut").button({
			//disabled: true,
	 icons: {
                primary: "ui-icon-disk",
				
				
            },
			
			
			});
			
			
			var accesselement = $("#accesselement").val();
		var spl = accesselement.split(',');
			var writedoc = spl[1];
			var deletedoc = spl[2];
			
			if(writedoc == 'true'){
				
			}else{
				$(":input").attr("disabled", true);
				$("#addcrt, #truadd, #addsestbut").button({ disabled: true });
				$("#addcrt, #truadd, #addsestbut").removeAttr('onclick');
				$("#confrmsucc2").html('This section has read access only');
				$("#confrmsucc2").show();
				
				if(deletedoc == 'false'){
					
					$(".delete_icon").removeAttr('onclick');
				}else{
					
				}
			}
			

  }
});
		grbmyFiles(val);
	}
	
	
	
	////COMPLETE EDIT OF ESTIMATE////
	
	function fineditEsti(){
		var doc_id = $("#docid").val();
	var comp = $("#comp").val();
		var estcont = $("#estcont").val();
		var estloc = $("#estloc").val();
		var estdt = $("#estdt").val();
		var status = $("#status").val();
		var RadioGroup1 = $("input:radio[name='RadioGroup1']:checked").val();
		var salesman = $("#salesman").val();
		var payterms = $("#payterms").val();
		var notes = $("#notes").val();
		var estiamount = $("#estiamount").val();
		var pofld = $("#pofld").val();
		
	
		
		if(comp != 'none'){er1 = '';}else{er1 = 'Company<br>';}
		if(estcont != 'none'){er2 = '';}else{er2 = 'Contact<br>';}
		if(estloc != 'none'){er3 = '';}else{er3 = 'Location<br>';}
		if(RadioGroup1 != undefined){er5 = '';}else{er5 = 'Type<br>';}	
		
		if(er1 == '' && er2 == '' && er3 == '' && er5 == ''){
			
			$.ajax({
  url: 'inc/estimate_actions.php?action=editestimate&docid='+doc_id+'&estcont='+estcont+'&RadioGroup1='+RadioGroup1+'&salesman='+salesman+'&payterms='+payterms+'&notes='+notes+'&estiamount='+estiamount+'&status='+status+'&locid='+estloc+'&estdt='+estdt+'&pofld='+pofld,
  success: function(data) {
  recallEstis();
  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
  }
  });
			
		}else{
			
			$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue. <br>Also Note, If you have changed the location already set in place the tax rates will be changed depending upon which taxes are set on the newly selected location.</span><br><br>'+er1+' '+er2+' '+er3+' '+er5);
			
			$( "#alerts" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
			
		}
	}
	
	
	/////DELETE LINE ITEMS////
	
	function delItm(val){
		
		
		 $("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this item?</strong><br>');
				$( "#alerts" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				No: function() {
					$( this ).dialog( "close" );
				},
				
				'Yes': function() {
					$( this ).dialog( "close" );
					
					$.ajax({
  url: 'inc/estimate_actions.php?action=delitem&itmid='+val,
  success: function(data) {
 getItemlist();
 $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
  }
  });
					
					
				}
			}
		});
		
		
		
	}
	
	
	/////PULL FIELD FOR QUANITY UPDATE//////
	
	function upqut(val){
		$.ajax({
  url: 'inc/estimate_actions.php?action=pullqtfld&itmid='+val,
  success: function(data) {
 $("#modqut"+val).html(data);
 $("#updtqt"+val).focus();
  }
  });
		
	}
	
	////ON FLY EDIT FOR QUANITYS///////
	function editItm(val){
		$("#ld"+val).show();
		var newqut = $("#updtqt"+val).val();
		if(newqut != undefined){
			
		$.ajax({
  url: 'inc/estimate_actions.php?action=updtqty&itmid='+val+'&newvalue='+newqut,
  success: function(data) {
getItemlist();
$("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
  }
  });
		}else{
			$("#ld"+val).hide();
			$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">You must updated the quanity before you complete edit.');
			
			$( "#alerts" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
			
		}
	}
	
	////RECYCLE FIELD IF NOTHING IS ENTERED/////
	function runflfCls(val,val2){
		var newqut = $("#updtqt"+val2).val();
		//alert(val+' '+newqut);
		if(val == newqut){
		$("#modqut"+val2).html('<span onclick="upqut('+val2+')">'+val+'</span>');
		}
	}
	
	
	/////DELETE ESTIMATE//////
	
	function delEsti(val){
  
   $("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this estimate?</strong><br>');
				$( "#alerts" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				No: function() {
					$( this ).dialog( "close" );
				},
				
				'Yes': function() {
					$( this ).dialog( "close" );
					
						$.ajax({
  url: 'inc/estimate_actions.php?action=delesti&docid='+val,
  success: function(data) {
recallEstis();
$("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
  }
  });
					
					
				}
			}
		});
	}
	
	
	/////CHANGE STATUS ON LIST VIEW////
	
	function runstsSet(val,val2){
	 $("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to change this status on esitmate ID '+val+'?</strong><br>');
				$( "#alerts" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				No: function() {
					$( this ).dialog( "close" );
				},
				
				'Yes': function() {
					$( this ).dialog( "close" );
					
						$.ajax({
  url: 'inc/estimate_actions.php?action=changelinestat&docid='+val+'&statu='+val2,
  success: function(data) {
recallEstis();
$("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
  }
  });
					
					
				}
			}
		});	
	}
	
	
	/////CHECK STATUS BEFORE YOU LET THEM LEAVE////
	
	window.onbeforeunload = function() { 
if($("#isact").val() == 'new'){
    return "You have not saved this estimate yet!";
  }
}


/////CLEAN ITEMS OUT FROM UNSAVED ESTIMATES////

$(function() {

   $.ajax({
  url: 'inc/estimate_actions.php?action=ramitems',
  success: function(data) {
  }
  });
  
});

function openFilesset(){
		var userid = $("#cliids").val();
		//alert(userid);
		$.ajax({
  url: 'inc/estimate_actions.php?action=getuploads2&clid='+userid+'&pagemod=customer',
  success: function(data) {
	  
	  $("#attdoc").html(data);
		
		$( "#attdoc" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				'Cancel': function() {
					$( this ).dialog( "close" );
					proceedDelcon(val);
					
					
				}
			}
		});
  }
		});
		
	}
	
	function attcit(val){
		var docid = $("#docid").val();
		$.ajax({
  url: 'inc/estimate_actions.php?action=goonatt&fileid='+val+'&docid='+docid,
  success: function(data) {
	  
	  grbmyFiles();
	  
  }
		});
	}
	
	function grbmyFiles(val){
		if(val == undefined){
		var docid = $("#docid").val();
		}else{
		var docid = val;
		}
		$.ajax({
  url: 'inc/estimate_actions.php?action=getthemnow&docid='+docid,
  success: function(data) {
	  
	  $("#attdoc").dialog( "close" );
	  $("#boundedfiles").html(data);
	  
  }});
	}
	
	function changeRent(val){
		
		if(val == 'rental'){
	
	$("#addcrt").button( "destroy" );
	$("#addcrt").html('Add Rental Item');
	$("#addcrt").button({
			//disabled: true,
	 icons: {
                primary: "ui-icon-cart",
				
				
            },
			
			
			});	
		}else{
			$("#addcrt").button( "destroy" );
	$("#addcrt").html('Add Product / Services');
	$("#addcrt").button({
			//disabled: true,
	 icons: {
                primary: "ui-icon-cart",
				
				
            },
			
			
			});	
		}
	}

