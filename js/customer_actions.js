$(function() {
		
		///////GET CUSTOMER LIST ON LOAD//////
		$.ajax({
  url: 'inc/customer_actions.php?action=getlist',
  success: function(data) {
    $('#cust_content').html(data);
	
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
	
	
window.onbeforeunload = function() { 
if($("#runner").val() == 'new'){
    return "You have not saved this profile yet!";
  }
}
	
	
	
	
	///////RECALL CUSTOMER LIST///////
	
	function recallCust(val){
		//alert(val);
		$("#loader").show();
		$("#pag_text").html('<div style="float:left; padding-top:3px">customers</div> <div class="addnew" onclick="addnew()"><img style="margin-left:10px; margin-top:3px; float:left" src="images/add_new.png" width="13" height="17" ><div style="float:left; margin-left:5px; margin-top:5px">New Customer</div></div>');
		
		$.ajax({
  url: 'inc/customer_actions.php?action=getlist&page='+val,
  success: function(data) {
	  $("#loader").hide();
    $('#cust_content').html(data);
	
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
		
	}
	
	
	/////GET NEW CUSTOMER FORM AND SETUP TABS AND FROM STYLES//////
	
	function addnew(){
		$("#loader").show();
		
		$("#pag_text").html('customers > <span style="font-size:20px">Add new</span>');
		
	$.ajax({
  url: 'inc/customer_actions.php?action=givecustomerform',
  success: function(data) {
    $('#cust_content').html(data);
	$('#tabs').tabs();
	 $(".buttons3").button({});
	 $(".neat, #billterms").uniform();
	
			$( "#resaledt,#insexdt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
			
				$(".buttons").button({
            icons: {
                primary: "ui-icon-disk"
            },});
			
			$(".buttons2").button({
            icons: {
                primary: "ui-icon-cancel"
            },});
			$("#loader").hide();	

  }
  
});
		
	}
	
	
	///////GET CONTACT FORM AND SHOW//////
	
	
	function addContact(){
		$("#loader").show();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=contactadd',
  success: function(data) {
	  $("#loader").hide();
    $('#contactadd').html(data);

  $(".neat2").uniform();

	$( "#contactadd" ).dialog({
			width: 670,
			resizable: false,
			modal: true
		});	
		
		$("#contactbutton").button({
            icons: {
                primary: "ui-icon-person"
            },});
			$("#contactbutton2").button({
            icons: {
                primary: "ui-icon-cancel"
            },});
			
				}});
	}
	
	
	//////ADD / EDIT CUSTOMER////
	
	
	function runForm(){
		
var cliid = $("#cliid").val();
var resalelic = $("#resalelic").val();
var resaledt = $("#resaledt").val();
var insexdt = $("#insexdt").val();
var company = $("#company").val();
var address1 = $("#address1").val();
var address2 = $("#address2").val();
var city = $("#city").val();
var state = $("#state").val();
var county = $("#county").val();
var zip = $("#zip").val();
var billaddress1 = $("#billaddress1").val();
var billaddress2 = $("#billaddress2").val();
var billcity = $("#billcity").val();
var billstate = $("#billstate").val();
var billzip = $("#billzip").val();
var billterms = $("#billterms").val();
var notes = $("#notes").val();
var salespers = $("#salespers").val();

//do validation//

	if(company == ''){var er1 = 'Company Name<br>';}else{var er1 = '';}
	if(address1 == ''){var er2 = 'Address<br>';}else{var er2 = '';}
	if(city == ''){var er3 = 'City<br>';}else{var er3 = '';}
	if(state == 'none'){var er4 = 'Select State<br>';}else{var er4 = '';}
	if(zip == '' || zip.length < 5){var er5 = 'Valid Zip Code<br>';}else{var er5 = '';}
	
		///billing validations////
		var wha = $('#issame').attr('checked');
			if(wha != 'checked'){
	if(billaddress1 == ''){var er6 = 'Billing Address<br>';}else{var er6 = '';}
	if(billcity == ''){var er7 = 'Billing City<br>';}else{var er7 = '';}
	if(billstate == 'none'){var er8 = 'Select Billing State<br>';}else{var er8 = '';}
	if(billzip == '' || zip.length < 5){var er9 = 'Valid Billing Zip Code<br>';}else{var er9 = '';}
	var ism = 'false';
			}else{
			var er6 = '';
			var er7 = '';
			var er8 = '';
			var er9 = '';
			var ism = 'true';	
			}
			
			if(er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == '' && er7 == '' && er8 == '' && er9 == ''){
			
$("#loader").show();
		/////DO CHECK FOR CONTACTS////
		$.ajax({
  url: 'inc/customer_actions.php?action=checkcontacts&newid='+cliid,
  success: function(data) {
    if(data == 'true'){
		$.ajax({
  url: 'inc/customer_actions.php?action=insertcustomer&cliid='+cliid+'&resalelic='+resalelic+'&resaledt='+resaledt+'&insexdt='+insexdt+'&company='+company+'&address1='+address1+'&address2='+address2+'&city='+city+'&state='+state+'&zip='+zip+'&county='+county+'&billaddress1='+billaddress1+'&billaddress2='+billaddress2+'&billcity='+billcity+'&billstate='+billstate+'&billzip='+billzip+'&billterms='+billterms+'&notes='+notes+'&ism='+ism+'&salespers='+salespers,
  success: function(data) {
	  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	  //alert(data);
   recallCust();

  }
});
		
	}else{
		$("#loader").hide();
	////NEED CONTACT////
		$("#alerts").html(data);
		$('#tabs').tabs('select','tabs-3');
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
});
			}else{
				$("#loader").hide();
				$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' '+er3+' '+er4+' '+er5+' '+er6+' '+er7+' '+er8+' '+er9);
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
	
	/////CHECK IF BILLING IS SAME AS REG ADDRESS/////
	
	function sameBill(){
	var wha = $('#issame').attr('checked');
		if(wha == 'checked'){
			$("#billadrd").hide();
		}else{
			$("#billadrd").show();
		}
	
	}
	
	
	//////AUTO TABBING FOR PHONE FIELDS/////
	
	function runThr(val){
		if(val == 'conph1' && $("#"+val).val().length == 3){$("#conph2").focus();}
			if(val == 'conph2' && $("#"+val).val().length == 3){$("#conph3").focus();}	
		if(val == 'confx1' && $("#"+val).val().length == 3){$("#confx2").focus();}
			if(val == 'confx2' && $("#"+val).val().length == 3){$("#confx3").focus();}	
	}
	
	function runThr23(val){
		if(val == 'cellph1' && $("#"+val).val().length == 3){$("#cellph2").focus();}
			if(val == 'cellph2' && $("#"+val).val().length == 3){$("#cellph3").focus();}	
	}
	
	
	//////ADD CONTACTS//////
	
	function addContac(){
		
		var cliid = $("#cliid").val();
	var confname = $("#confname").val();
	var contitle = $("#contitle").val();
	var conph1 = $("#conph1").val();
	var conph2 = $("#conph2").val();
	var conph3 = $("#conph3").val();
	var conph4 = $("#conph4").val();
	var cellph1 = $("#cellph1").val();
	var cellph2 = $("#cellph2").val();
	var cellph3 = $("#cellph3").val();
	var conlname = $("#conlname").val();
	var conemail = $("#conemail").val();
	var confx1 = $("#confx1").val();
	var confx2 = $("#confx2").val();
	var confx3 = $("#confx3").val();
	
	var primcon = $('#primcon').attr('checked');
		if(primcon == 'checked'){
			var prime = 'true';
		}else{
			var prime = 'false';
		}
	
	
	
		var confullphone = ''+conph1+'.'+conph2+'.'+conph3+'.'+conph4;
		var confullfax = ''+confx1+'.'+confx2+'.'+confx3;
		var concellfull = ''+cellph1+'.'+cellph2+'.'+cellph3;
		
			if(confname == ''){var coner1 = 'First Name<br>'; }else{var coner1 = '';}
			if(conlname == ''){var coner1a = 'Last Name<br>'; }else{var coner1a = '';}
			if(contitle == ''){var coner2 = 'Title<br>'; }else{var coner2 = '';}
			if(confullphone.length < 12){var coner3 = 'Valid Phone Number<br>'; }else{var coner3 = '';}
			if(conemail == ''){var coner4 = 'Email Address<br>'; }else{var coner4 = '';}
			
			if(coner4 == ''){
			 var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
      var emailAddress = conemail;
      var valid = emailRegex.test(emailAddress);
      if (!valid) {
        var coner4 = 'Invalid Email Provide<br>';
       
      } else{
         var coner4 = '';
    }	
			}
			
			
			if(coner1 == '' && coner1a == '' && coner2 == '' && coner3 == '' && coner4 == ''){
			$("#loader").show();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=addcontact&blong='+cliid+'&firstname='+confname+'&lastname='+conlname+'&title='+contitle+'&email='+conemail+'&phone='+confullphone+'&cell='+concellfull+'&fax='+confullfax+'&prime='+prime,
  success: function(data) {
	  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	  $("#contactadd").dialog( "close" );
    pullContacts();

  }
});
			}else{
				$("#loader").hide();
				$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+coner1+' '+coner1a+' '+coner2+' '+coner3+' '+coner4);
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
	
	///////GET CONTACTS///////
	
	function pullContacts(){
		$("#loader").show();
		
		var cliid = $("#cliid").val();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=getcontacts&cliid='+cliid,
  success: function(data) {
	  $("#loader").hide();
   $("#contacthold").html(data);
   
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
	
	
	//////GET LOCATION ADD FORM//////
	
	function addLocation(){
		$("#loader").show();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=locationadd',
  success: function(data) {
	  $("#loader").hide();
    $('#locationadd').html(data);

  $(".neat3").uniform();

	$( "#locationadd" ).dialog({
			width: 650,
			resizable: false,
			modal: true
		});	
		
		$("#contactbutton4").button({
            icons: {
                primary: "ui-icon-disk"
            },});
			$("#contactbutton3").button({
            icons: {
                primary: "ui-icon-cancel"
            },});
			
				}});
	}
	
	function chkAll(){
		var taccheck = $('#allcheck').attr('checked');
		if(taccheck == 'checked'){
	$(".checkers").attr('checked','checked');
		}else{
		$(".checkers").attr('checked', false);	
		}
	}
	
	 
	 
	 function checkCheck(val) {
		// alert(val);
		 if(val == undefined){
			$("#allcheck").attr('checked', false); 
		 }else{
			 
		 }
         
         var allVals = [];
         $(".checkers:checked").each(function() {
           allVals.push($(this).val());
         });
		// alert(allVals);
         $('#checkvals').val(allVals)
      }
	  
	  function entLocs(){
		  var locname = $("#locname").val();
		  var cliid = $("#cliid").val();
	var locaddress1 = $("#locaddress1").val();
	var locaddress2 = $("#locaddress2").val();
	var locacity = $("#locacity").val();
	var locstate = $("#locstate").val();
	var loczip = $("#loczip").val();
	var loccounty = $("#loccounty").val();
	var checkvals = $("#checkvals").val();
	
	if(locaddress1 == ''){var locer1 = 'Address<br>';}else{var locer1 = '';}
	if(locacity == ''){var locer2 = 'City<br>';}else{var locer2 = '';}
	if(locstate == 'none'){var locer3 = 'State';}else{var locer3 = '';}
	if(loczip == '' || loczip.length < 5 || loczip.length > 5){var locer4 = 'Valid Zip<br>';}else{var locer4 = '';}
	if(loccounty == ''){var locer5 = 'County<br>';}else{var locer5 = '';}
	
	if(locer1 == '' && locer2 == '' && locer3 == '' && locer4 == '' && locer5 == '' ){
		$("#loader").show();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=pushlocation&locname='+locname+'&locaddress1='+locaddress1+'&locacity='+locacity+'&locstate='+locstate+'&loczip='+loczip+'&loccounty='+loccounty+'&zips='+checkvals+'&cliid='+cliid,
  success: function(data) {
	  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	  $("#locationadd").dialog( "close" );
   getLocas();

  }
});
		
		
	}else{
		$("#loader").hide();
		
		$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+locer1+' '+locer2+' '+locer3+' '+locer4+' '+locer5);
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
	  
	  
	  /////GET LOCATIONS/////
	  
	  
	  function getLocas(){
		  $("#loader").show();
		  var cliid = $("#cliid").val();
		  $.ajax({
  url: 'inc/customer_actions.php?action=getlocations&cliid='+cliid,
  success: function(data) {
	  $("#loader").hide();
    $('#newlochold').html(data);
	
	var accesselement = $("#accesselement").val();
		var spl = accesselement.split(',');
			var writedoc = spl[1];
			var deletedoc = spl[2];
			
			if(deletedoc == 'false'){
					//alert(deletedoc);
					$(".delete_icon").removeAttr('onclick');
				}else{
					
				}
			

  }
});
		  //newlochold
	  }
	  
	  
	  
	  
	  ////------------------------START THE EDIT FUNCTIONS------------------------////
	  
	  /////GET NEW CUSTOMER FORM AND SETUP TABS AND FROM STYLES//////
	
	function editCli(val){
		
		///premissions///
		var accesselement = $("#accesselement").val();
		var spl = accesselement.split(',');
			var writedoc = spl[1];
			var deletedoc = spl[2];
		
		$("#loader").show();
		
		$("#pag_text").html('customers > <span style="font-size:20px">Edit Customer</span>');
		
	$.ajax({
  url: 'inc/customer_actions.php?action=getcustomerinfo&cliid='+val,
  success: function(data) {
	  $("#loader").hide();
    $('#cust_content').html(data);
	$('#tabs').tabs();
	
	 $(".buttons3").button({});
	 $(".neat,#billterms").uniform();
	
			$( "#resaledt,#insexdt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
			
				$(".buttons").button({
            icons: {
                primary: "ui-icon-disk"
            },});
			
			$(".buttons2").button({
            icons: {
                primary: "ui-icon-cancel"
            },});
			
			//alert(writedoc);
			getLocas();
			pullContacts();
			pullUploads();
			
			var accesselement = $("#accesselement").val();
		var spl = accesselement.split(',');
			var writedoc = spl[1];
			var deletedoc = spl[2];
			
			if(writedoc == 'true'){
				
			}else{
				$(":input").attr("disabled", true);
				$(".buttons3,.buttons").button({ disabled: true });
				$(".buttons3,.buttons").removeAttr('onclick');
				$("#confrmsucc2").html('This section has read access only');
				$("#confrmsucc2").show();
				
				if(deletedoc == 'false'){
					
					$(".delete_icon").removeAttr('onclick');
				}else{
					
				}
			}
			
			var userid = $("#ourcli").val();
			
			
		 $('#file_upload').uploadify({
        'swf'      : 'uploadify/uploadify.swf',
        'uploader' : 'uploadify/uploadify.php?attaid='+userid+'&attachmod=customer',
		'auto'		: true,
		'onUploadSuccess' : function(file, data, response) {
           // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
		   pullUploads();
        }
        // Put your options here
    });		

  }
});
		
	}
	  
	  
	  
	  function delCust(val){
		  $("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this record?</strong><br><span style="font-size:12px;"><br>All data associated with this profile will become inaccessible outside of IT support.</span>');
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
					proceedDel(val);
					
					
				}
			}
		});
		  
	  }
	  
	  function proceedDel(val){
		  $("#loader").show();
		  //alert(val);
		$.ajax({
  url: 'inc/customer_actions.php?action=deletecust&cliid='+val,
  success: function(data) {
	   
	  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	 // alert(data);
 recallCust();
  }
});  
	  }
	  
	  
	  //////GET EDIT LOCATION FORM//////
	
	function editLocation(val){
		$("#loader").show();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=locationedit&locid='+val,
  success: function(data) {
	  $("#loader").hide();
    $('#locationadd').html(data);

  $(".neat3").uniform();

	$( "#locationadd" ).dialog({
			width: 650,
			resizable: false,
			modal: true
		});	
		
		$("#contactbutton4").button({
            icons: {
                primary: "ui-icon-disk"
            },});
			$("#contactbutton3").button({
            icons: {
                primary: "ui-icon-cancel"
            },});
			
			var accesselement = $("#accesselement").val();
		var spl = accesselement.split(',');
			var writedoc = spl[1];
			var deletedoc = spl[2];
			
			if(writedoc == 'true'){
				
			}else{
				$(":input").attr("disabled", true);
				$("#contactbutton4").button({ disabled: true });
				$("#contactbutton4").removeAttr('onclick');
				
				if(deletedoc == 'false'){
					//alert(deletedoc);
					$(".delete_icon").removeAttr('onclick');
				}else{
					
				}
			}

			grbmyFiles();
			
				}});
	}
	  
	  
	  

	  
	  ////EDIT LOCATION////
	  
	  function edLocs(val){
		  var locname = $("#locname").val();
		  var cliid = $("#cliid").val();
	var locaddress1 = $("#locaddress1").val();
	var locaddress2 = $("#locaddress2").val();
	var locacity = $("#locacity").val();
	var locstate = $("#locstate").val();
	var loczip = $("#loczip").val();
	var loccounty = $("#loccounty").val();
	var checkvals = $("#checkvals").val();
	
	if(locaddress1 == ''){var locer1 = 'Address<br>';}else{var locer1 = '';}
	if(locacity == ''){var locer2 = 'City<br>';}else{var locer2 = '';}
	if(locstate == 'none'){var locer3 = 'State';}else{var locer3 = '';}
	if(loczip == '' || loczip.length < 5 || loczip.length > 5){var locer4 = 'Valid Zip<br>';}else{var locer4 = '';}
	if(loccounty == ''){var locer5 = 'County<br>';}else{var locer5 = '';}
	
	if(locer1 == '' && locer2 == '' && locer3 == '' && locer4 == '' && locer5 == '' ){
		$("#loader").show();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=editlocation&locname='+locname+'&locaddress1='+locaddress1+'&locacity='+locacity+'&locstate='+locstate+'&loczip='+loczip+'&loccounty='+loccounty+'&zips='+checkvals+'&locid='+val,
  success: function(data) {
	  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	  $("#locationadd").dialog( "close" );
   getLocas();

  }
});
		
		
	}else{
		$("#loader").hide();
		
		$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+locer1+' '+locer2+' '+locer3+' '+locer4+' '+locer5);
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
	  
	  /////EDIT CONTACTS/////
	  
	  function editContact(val){
		$("#loader").show();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=editcontact&contactid='+val,
  success: function(data) {
	  $("#loader").hide();
    $('#contactadd').html(data);

  $(".neat2").uniform();

	$( "#contactadd" ).dialog({
			width: 670,
			resizable: false,
			modal: true
		});	
		
		$("#contactbutton").button({
            icons: {
                primary: "ui-icon-person"
            },});
			$("#contactbutton2").button({
            icons: {
                primary: "ui-icon-cancel"
            },});
			
			var accesselement = $("#accesselement").val();
		var spl = accesselement.split(',');
			var writedoc = spl[1];
			var deletedoc = spl[2];
			
			if(writedoc == 'true'){
				
			}else{
				$(":input").attr("disabled", true);
				$("#contactbutton").button({ disabled: true });
				$("#contactbutton").removeAttr('onclick');
				
				
				if(deletedoc == 'false'){
				
					$(".delete_icon").removeAttr('onclick');
				}else{
					
				}
			}

			
				}});
	}
	
	
	
	//////PUSH CONTACT EDITS/////
	
	function editContac(val){
		//alert(val);
		var cliid = $("#cliid").val();
	var confname = $("#confname").val();
	var contitle = $("#contitle").val();
	var conph1 = $("#conph1").val();
	var conph2 = $("#conph2").val();
	var conph3 = $("#conph3").val();
	var conph4 = $("#conph4").val();
	var cellph1 = $("#cellph1").val();
	var cellph2 = $("#cellph2").val();
	var cellph3 = $("#cellph3").val();
	var conlname = $("#conlname").val();
	var conemail = $("#conemail").val();
	var confx1 = $("#confx1").val();
	var confx2 = $("#confx2").val();
	var confx3 = $("#confx3").val();
	
	var primcon = $('#primcon').attr('checked');
		if(primcon == 'checked'){
			var prime = 'true';
		}else{
			var prime = 'false';
		}
	
	
	
		var confullphone = ''+conph1+'.'+conph2+'.'+conph3+'.'+conph4;
		var confullfax = ''+confx1+'.'+confx2+'.'+confx3;
		var concellfull = ''+cellph1+'.'+cellph2+'.'+cellph3;
		
			if(confname == ''){var coner1 = 'First Name<br>'; }else{var coner1 = '';}
			if(conlname == ''){var coner1a = 'Last Name<br>'; }else{var coner1a = '';}
			if(contitle == ''){var coner2 = 'Title<br>'; }else{var coner2 = '';}
			if(confullphone.length < 12){var coner3 = 'Valid Phone Number<br>'; }else{var coner3 = '';}
			if(conemail == ''){var coner4 = 'Email Address<br>'; }else{var coner4 = '';}
			
			if(coner4 == ''){
			 var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
      var emailAddress = conemail;
      var valid = emailRegex.test(emailAddress);
      if (!valid) {
        var coner4 = 'Invalid Email Provide<br>';
       
      } else{
         var coner4 = '';
    }	
			}
			
			
			if(coner1 == '' && coner1a == '' && coner2 == '' && coner3 == '' && coner4 == ''){
			$("#loader").show();
		
		$.ajax({
  url: 'inc/customer_actions.php?action=editcontact2&conid='+val+'&firstname='+confname+'&lastname='+conlname+'&title='+contitle+'&email='+conemail+'&phone='+confullphone+'&cell='+concellfull+'&fax='+confullfax+'&prime='+prime,
  success: function(data) {
	  
	  if(data == 'good'){
	  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	  $("#contactadd").dialog( "close" );
    pullContacts();
	  }else{
		 $("#loader").hide();
				$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">You must have at least one primary contact attached to a customer profile.</span>'); 
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
});
			}else{
				$("#loader").hide();
				$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+coner1+' '+coner1a+' '+coner2+' '+coner3+' '+coner4);
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
	
	function delLoc(val){
		
		 $("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this record?</strong><br><span style="font-size:12px;"><br>All data associated with this location will become inaccessible outside of IT support.</span>');
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
					proceedDelloc(val);
					
					
				}
			}
		});
		
	}
	
	function proceedDelloc(val){
		
		$.ajax({
  url: 'inc/customer_actions.php?action=deleteloc&locid='+val,
  success: function(data) {
	   
	  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	 // alert(data);
 getLocas();
  }
});  
		
	}
	
	function delCon(val){
		
		 $("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this record?</strong><br><span style="font-size:12px;"><br>All data associated with this contact will become inaccessible outside of IT support.</span>');
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
					proceedDelcon(val);
					
					
				}
			}
		});
		
		
	}
	
	function proceedDelcon(val){
		
		$.ajax({
  url: 'inc/customer_actions.php?action=deletecon&conid='+val,
  success: function(data) {
	  
	  if(data == 'good'){
	   
	  $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	 // alert(data);
pullContacts();
	  }else{
		 $("#loader").hide();
				$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">This contact appears to be your only primary contact. Please denote another contact in your list as a primary contact or create another contact with primary title before deletion</span>'); 
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
});  
		
	}
	
	
	////SORT CUSTOMER LIST//
	
	function sortCli(val,val2){
		
		//alert(val);
		$("#loader").show();
		$("#pag_text").html('<div style="float:left; padding-top:3px">customers</div> <div class="addnew" onclick="addnew()"><img style="margin-left:10px; margin-top:3px; float:left" src="images/add_new.png" width="13" height="17" ><div style="float:left; margin-left:5px; margin-top:5px">New Customer</div></div>');
		
		$.ajax({
  url: 'inc/customer_actions.php?action=getlist&direction='+val+'&page='+val2,
  success: function(data) {
	  $("#loader").hide();
    $('#cust_content').html(data);

  }
});
	}
	
	/////THIS CLOSES THE CONTACT & LOCATION ADD DIALOGS/////
	
	function canLoc(){
		
	$("#locationadd").dialog( "close" );	
	}
	
	function canconAd(){
		$("#contactadd").dialog( "close" );
	}
	
	
	function searchOver(val){
		
		var values = $("#"+val).val();
		$.ajax({
  url: 'inc/customer_actions.php?action=getlist&search=true&searchval='+values,
  success: function(data) {
	  $("#loader").hide();
    $('#cust_content').html(data);
	
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
	
	
	/////PULL UPLOADS////
	
	function pullUploads(){
		var userid = $("#ourcli").val();
	$.ajax({
  url: 'inc/customer_actions.php?action=getuploads&clid='+userid+'&pagemod=customer',
  success: function(data) {	
	$("#holduploads").html(data);

	
  }
	});
	}
	
	
	////ATTACH FILES////
	function openFilesset(){
		var userid = $("#ourcli").val();
		$.ajax({
  url: 'inc/customer_actions.php?action=getuploads2&clid='+userid+'&pagemod=customer',
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
		var locid = $("#locationid").val();
		$.ajax({
  url: 'inc/customer_actions.php?action=goonatt&fileid='+val+'&locid='+locid,
  success: function(data) {
	  
	  grbmyFiles();
	  
  }
		});
	}
	
	function grbmyFiles(){
		var locid = $("#locationid").val();
		$.ajax({
  url: 'inc/customer_actions.php?action=getthemnow&locid='+locid,
  success: function(data) {
	  
	  $("#attdoc").dialog( "close" );
	  $("#boundedfiles").html(data);
	  
  }});
	}
	
	function delFiles(val){
		$.ajax({
  url: 'inc/customer_actions.php?action=deletefile&fileid='+val,
  success: function(data) {
	  
	  pullUploads();
	  
  }});
	}