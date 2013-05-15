////SETUP TABS///
$(function(){

		$( "#tabs" ).tabs();
		$( "#addper" ).button();
		$( "#addusr" ).button();
		$( "#addven" ).button();
		$( "#addprod" ).button();
		$( "#addprod2" ).button();
		$( "#addstax" ).button();
		$( "#addterm" ).button();
		
		$( "#goaudt" ).button({ icons: {
                primary: "ui-icon-search"
            },
            text: false
			
			});
		
		//goaudt
		
		getGrplist();
		getUser('1');
		getVendors('1');
		pullProds('1','DESC');
		pullAssts('1','DESC');
		getAudit('1');
		getTerms();
		
		$( "#datser,#datser2" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
		$(".makerrsdrops").uniform();

});

////ADD GROUP WINDOW////

function addGroup(){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=getformgrp',
  success: function(data) {
	 
$("#dio1").html(data);

$( "#dio1" ).dialog({
			width: 650,
			height: 420,
			resizable: false,
			modal: true,
			title: "Add New Group",
		});	
		
		$(".makerrs").uniform();
		
		$("#adgrpgh").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});



  }
});
	
}

///INSERT DATA///
function finAdd(){
	$("#confrmsucc").fadeIn('slow');
	var groupname = $("#groupname").val();
var cusread = $('#cusread').is(':checked');
var cuswrite = $('#cuswrite').is(':checked');
var cusdelete = $('#cusdelete').is(':checked');
var estiread = $('#estiread').is(':checked');
var estiwrite = $('#estiwrite').is(':checked');
var estidelete = $('#estidelete').is(':checked');
var wrkread = $('#wrkread').is(':checked');
var wrkwrite = $('#wrkwrite').is(':checked');
var wrkdelete = $('#wrkdelete').is(':checked');
var scedread = $('#scedread').is(':checked');
var scedwrite = $('#scedwrite').is(':checked');
var sceddelete = $('#sceddelete').is(':checked');
var invread = $('#invread').is(':checked');
var invwrite = $('#invwrite').is(':checked');
var invdelete = $('#invdelete').is(':checked');
var purread = $('#purread').is(':checked');
var purwrite = $('#purwrite').is(':checked');
var purdelete = $('#purdelete').is(':checked');
var acctread = $('#acctread').is(':checked');
var acctwrite = $('#acctwrite').is(':checked');
var accdelete = $('#accdelete').is(':checked');
var admread = $('#admread').is(':checked');
var admwrite = $('#admwrite').is(':checked');
var admdelete = $('#admdelete').is(':checked');



$.ajax({
  url: 'inc/admin_actions.php?action=subgroup&groupname='+groupname+'&cusread='+cusread+'&cuswrite='+cuswrite+'&cusdelete='+cusdelete+'&estiread='+estiread+'&estiwrite='+estiwrite+'&estidelete='+estidelete+'&wrkread='+wrkread+'&wrkwrite='+wrkwrite+'&wrkdelete='+wrkdelete+'&scedread='+scedread+'&scedwrite='+scedwrite+'&sceddelete='+sceddelete+'&invread='+invread+'&invwrite='+invwrite+'&invdelete='+invdelete+'&purread='+purread+'&purwrite='+purwrite+'&purdelete='+purdelete+'&acctread='+acctread+'&acctwrite='+acctwrite+'&accdelete='+accdelete+'&admread='+admread+'&admwrite='+admwrite+'&admdelete='+admdelete,
  success: function(data) {
	 
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
getGrplist();

  }
});
}

/////GET LIST VIEW////
function getGrplist(){
	$.ajax({
  url: 'inc/admin_actions.php?action=getlines',
  success: function(data) {
	 
$("#listholdgrp").html(data);


  }
});
}

////Edit GROUP WINDOW////

function editGroup(val){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=editgroup&id='+val,
  success: function(data) {
	 
$("#dio1").html(data);

$( "#dio1" ).dialog({
			width: 650,
			height: 420,
			resizable: false,
			modal: true,
			title: "Add New Group",
		});	
		
		$(".makerrs").uniform();
		
		$("#adgrpgh").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});



  }
});
	
}

///INSERT DATA///
function fingrpEdit(val){
	$("#confrmsucc").fadeIn('slow');
	var groupname = $("#groupname").val();
var cusread = $('#cusread').is(':checked');
var cuswrite = $('#cuswrite').is(':checked');
var cusdelete = $('#cusdelete').is(':checked');
var estiread = $('#estiread').is(':checked');
var estiwrite = $('#estiwrite').is(':checked');
var estidelete = $('#estidelete').is(':checked');
var wrkread = $('#wrkread').is(':checked');
var wrkwrite = $('#wrkwrite').is(':checked');
var wrkdelete = $('#wrkdelete').is(':checked');
var scedread = $('#scedread').is(':checked');
var scedwrite = $('#scedwrite').is(':checked');
var sceddelete = $('#sceddelete').is(':checked');
var invread = $('#invread').is(':checked');
var invwrite = $('#invwrite').is(':checked');
var invdelete = $('#invdelete').is(':checked');
var purread = $('#purread').is(':checked');
var purwrite = $('#purwrite').is(':checked');
var purdelete = $('#purdelete').is(':checked');
var acctread = $('#acctread').is(':checked');
var acctwrite = $('#acctwrite').is(':checked');
var accdelete = $('#accdelete').is(':checked');
var admread = $('#admread').is(':checked');
var admwrite = $('#admwrite').is(':checked');
var admdelete = $('#admdelete').is(':checked');



$.ajax({
  url: 'inc/admin_actions.php?action=finedigroup&groupname='+groupname+'&cusread='+cusread+'&cuswrite='+cuswrite+'&cusdelete='+cusdelete+'&estiread='+estiread+'&estiwrite='+estiwrite+'&estidelete='+estidelete+'&wrkread='+wrkread+'&wrkwrite='+wrkwrite+'&wrkdelete='+wrkdelete+'&scedread='+scedread+'&scedwrite='+scedwrite+'&sceddelete='+sceddelete+'&invread='+invread+'&invwrite='+invwrite+'&invdelete='+invdelete+'&purread='+purread+'&purwrite='+purwrite+'&purdelete='+purdelete+'&acctread='+acctread+'&acctwrite='+acctwrite+'&accdelete='+accdelete+'&admread='+admread+'&admwrite='+admwrite+'&admdelete='+admdelete+'&id='+val,
  success: function(data) {
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
getGrplist();

  }
});
}


/////GET USER LIST///
function getUser(val){
	$.ajax({
  url: 'inc/admin_actions.php?action=getusers&page='+val,
  success: function(data) {
	 
$("#userholder").html(data);


  }
});	
}

function getUserser(val){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=getusers&search=true&searchval='+val,
  success: function(data) {
	 
$("#userholder").html(data);


  }
});	
}

///DELETE GROUP///
function delGrp(val){
	
	$("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this group?</strong><br><span style="font-size:12px;"><br>All data associated with this profile will become inaccessible outside of IT support.</span>');
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
  url: 'inc/admin_actions.php?action=delgrp&id='+val,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
getGrplist();

  }
});
					
					
				}
			}
		});
	
}

////ADD NEW TAX////
function addnewTax(){
//addnewtax
$.ajax({
  url: 'inc/admin_actions.php?action=addnewtax',
  success: function(data) {
	  $( "#dio1" ).html(data);
	  $( "#dialog:ui-dialog" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New Tax",
		});	
		
		$(".makerrs").uniform();
		
		$("#adtax").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});



  }
});	
}

////ADD THE TAX////

function addTax(){

var tax_name = $("#tax_name").val();
var state = $("#state").val();
var percent = $("#percent").val();
var county = $("#county").val();

if(tax_name == ''){var er1 = 'Tax Name<br>';}else{var er1 = '';}
if(state == ''){var er2 = 'State<br>';}else{var er2 = '';}
if(percent == ''){var er3 = 'Tax Percent<br>';}else{var er3 = '';}
if(county == ''){var er4 = 'County<br>';}else{var er4 = '';}

if(er1 == '' && er2 == '' && er3 == '' && er4 == ''){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=settax&tax_name='+tax_name+'&state='+state+'&percent='+percent+'&county='+county,
  success: function(data) {
	  $( "#dio1" ).dialog( "close" );
	 getTax();
  }
});	
	
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	
}
	
}


////EDIT TAX////
function editsTax(val){
//addnewtax
$.ajax({
  url: 'inc/admin_actions.php?action=edittax&id='+val,
  success: function(data) {
	  $( "#dio1" ).html(data);
	  $( "#dialog:ui-dialog" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Edit Tax",
		});	
		
		$(".makerrs").uniform();
		
		$("#adtax").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});



  }
});	
}


////ADD THE TAX////

function finEdTax(val){
var tax_name = $("#tax_name").val();
var state = $("#state").val();
var percent = $("#percent").val();
var county = $("#county").val();

if(tax_name == ''){var er1 = 'Tax Name<br>';}else{var er1 = '';}
if(state == ''){var er2 = 'State<br>';}else{var er2 = '';}
if(percent == ''){var er3 = 'Tax Percent<br>';}else{var er3 = '';}
if(county == ''){var er4 = 'County<br>';}else{var er4 = '';}

if(er1 == '' && er2 == '' && er3 == '' && er4 == ''){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=editdtax&tax_name='+tax_name+'&state='+state+'&percent='+percent+'&county='+county+'&id='+val,
  success: function(data) {
	  $( "#dio1" ).dialog( "close" );
	 getTax();
  }
});	
	
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	
}
	
}

///DELETE TAX/////
function delTax(val){
$("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this tax?</strong><br><span style="font-size:12px;"><br>All estimates, workorders and invoices with this applied tax will lose their tax totals.</span>');
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
  url: 'inc/admin_actions.php?action=deltax&id='+val,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
getTax();

  }
});
					
					
				}
			}
		});	
}


////RECALL TAX LIST///
function getTax(){
$.ajax({
  url: 'inc/admin_actions.php?action=gettax',
  success: function(data) {
	 
$("#taxhold").html(data);


  }
});	
}


///OPEN LIGHT BOX////
function addUser(){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=getusrfrm',
  success: function(data) {
	 
$("#dio1").html(data);
$( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New User",
		});	
		
		$(".makerrs").uniform();
		
		$("#adusr").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


  }
});	
	
	

	
}

function finAddus(){
var fname = $("#fname").val();
var lname = $("#lname").val();
var email = $("#email").val();
var grpsel = $("#grpsel").val();
var address = $("#address").val();
var city = $("#city").val();
var state = $("#state").val();
var zip = $("#zip").val();
var usrtyp = $("#usrtyp").val();
var pass  = $("#pass").val();
var phone  = $("#phone").val();

var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  var runemail = pattern.test(email);

if(fname == ''){var er1 = 'First Name<br>';}else{var er1 = '';}
if(lname == ''){var er2 = 'Last Name<br>';}else{var er2 = '';}
if(email == '' || runemail == false){var er3 = 'Valid Email<br>';}else{var er3 = '';}
if(address == ''){var er4 = 'Address<br>';}else{var er4 = '';}
if(city == ''){var er5 = 'City<br>';}else{var er5 = '';}
if(state == 'none'){var er6 = 'Select State<br>';}else{var er6 = '';}
if(zip == ''|| zip.length < 5){var er7 = 'Valid Zip<br>';}else{var er7 = '';}
if(usrtyp == 'none'){var er8 = 'Select User Type<br>';}else{var er8 = '';}
if(pass == ''){var er9 = 'Enter a Password<br>';}else{var er9 = '';}

if(er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == '' && er7 == '' && er8 == '' && er9 == ''){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=addusr&fname='+fname+'&lname='+lname+'&email='+email+'&address='+address+'&city='+city+'&state='+state+'&zip='+zip+'&usrtyp='+usrtyp+'&pass='+pass+'&phone='+phone+'&grpsel='+grpsel,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
getUser();

  }
});
	
}else{
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4+' '+er5+' '+er6+' '+er7+' '+er8+' '+er9);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}

}

///EDIT USER////
function edUser(id){
	$.ajax({
  url: 'inc/admin_actions.php?action=getsinuser&id='+id,
  success: function(data) {
	 $("#dio1").html(data);

$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New User",
		});	
		
		$(".makerrs").uniform();
		
		$("#adusr").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


  }
});
}

function fineditus(val){
var fname = $("#fname").val();
var lname = $("#lname").val();
var email = $("#email").val();
var grpsel = $("#grpsel").val();
var address = $("#address").val();
var city = $("#city").val();
var state = $("#state").val();
var zip = $("#zip").val();
var usrtyp = $("#usrtyp").val();
var pass  = $("#pass").val();
var phone  = $("#phone").val();

var group = $('#aceschk').is(':checked'); 
var users = $('#aceschk1').is(':checked'); 
var vendors = $('#aceschk2').is(':checked'); 
var inventory = $('#aceschk3').is(':checked'); 
var auditlog = $('#aceschk4').is(':checked'); 
var reports = $('#aceschk5').is(':checked'); 
var tax = $('#aceschk6').is(':checked'); 



var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  var runemail = pattern.test(email);

if(fname == ''){var er1 = 'First Name<br>';}else{var er1 = '';}
if(lname == ''){var er2 = 'Last Name<br>';}else{var er2 = '';}
if(email == '' || runemail == false){var er3 = 'Valid Email<br>';}else{var er3 = '';}
if(address == ''){var er4 = 'Address<br>';}else{var er4 = '';}
if(city == ''){var er5 = 'City<br>';}else{var er5 = '';}
if(state == 'none'){var er6 = 'Select State<br>';}else{var er6 = '';}
if(zip == ''|| zip.length < 5){var er7 = 'Valid Zip<br>';}else{var er7 = '';}
if(usrtyp == 'none'){var er8 = 'Select User Type<br>';}else{var er8 = '';}
if(pass == ''){var er9 = 'Enter a Password<br>';}else{var er9 = '';}

if(er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == '' && er7 == '' && er8 == '' && er9 == ''){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=editusr&fname='+fname+'&lname='+lname+'&email='+email+'&address='+address+'&city='+city+'&state='+state+'&zip='+zip+'&usrtyp='+usrtyp+'&pass='+pass+'&phone='+phone+'&grpsel='+grpsel+'&id='+val+'&group='+group+'&users='+users+'&vendors='+vendors+'&inventory='+inventory+'&auditlog='+auditlog+'&reports='+reports+'&tax='+tax,
  success: function(data) {

	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
getUser();

  }
});
	
}else{
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4+' '+er5+' '+er6+' '+er7+' '+er8+' '+er9);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}

}

////DELETE USERS///
function delUser(val){
	
	$("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this user?</strong><br><span style="font-size:12px;"><br>All data associated with this profile will become inaccessible outside of IT support.</span>');
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
  url: 'inc/admin_actions.php?action=deluser&id='+val,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
getUser('1');

  }
});
					
					
				}
			}
		});
	
}


//////ADD VENDORS//////

function addVen(){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=getvendform',
  success: function(data) {
	 
$("#dio1").html(data);

$("#advens").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});

$( "#ven_coied,#ven_cowed" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
$( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New Vendor",
		});	
		
		$(".makerrs").uniform();
		
		$("#adusr").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


  }
});	
	
	

	
}

///SUBMIT TO DB///
function finaddVen(){
var gl_id = $("#gl_id").val();
var ven_name = $("#ven_name").val();
var ven_address = $("#ven_address").val();
var ven_address2 = $("#ven_address2").val();
var ven_city = $("#ven_city").val();
var ven_state = $("#ven_state").val();
var ven_zip = $("#ven_zip").val();
var ven_coied = $("#ven_coied").val();
var ven_cowed = $("#ven_cowed").val();
var vencon_fname = $("#vencon_fname").val();
var vencon_lname = $("#vencon_lname").val();
var vencon_email = $("#vencon_email").val();
var vencon_phone = $("#vencon_phone").val();
var vencon_fax = $("#vencon_fax").val();
var subacct = $("#subacct").val();
var vencon_phone2 = $("#vencon_phone2").val();
var ven_notes = $("#ven_notes").val();
var fed_num = $("#fed_num").val();
var selterm = $("#selterm").val();

var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  var runemail = pattern.test(vencon_email);

if(gl_id == ''){var er1 = '';}else{var er1 = '';}
if(ven_name == ''){var er2 = 'Vendor Name <br>';}else{var er2 = '';}
if(ven_address == ''){var er3 = 'Address<br>';}else{var er3 = '';}
if(ven_city == ''){var er4 = 'City<br>';}else{var er4 = '';}
if(ven_state == 'none'){var er5 = 'State<br>';}else{var er5 = '';}
if(ven_zip == '' || ven_zip.length < 5){var er6 = 'Valid Zip<br>';}else{var er6 = '';}
if(vencon_fname == ''){var er7 = 'Contact First Name<br>';}else{var er7 = '';}
if(vencon_lname == ''){var er8 = '';}else{var er8 = '';}
if(vencon_email == '' || runemail == false){var er9 = '';}else{var er9 = '';}
if(vencon_phone == ''){var er10 = '';}else{var er10 = '';}


if(er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == '' && er7 == '' && er8 == '' && er9 == '' && er10 == ''){

$.ajax({
  url: 'inc/admin_actions.php?action=finaddven&gl_id='+gl_id+'&ven_name='+ven_name+'&ven_address='+ven_address+'&ven_address2='+ven_address2+'&ven_city='+ven_city+'&ven_state='+ven_state+'&ven_zip='+ven_zip+'&ven_coied='+ven_coied+'&ven_cowed='+ven_cowed+'&vencon_fname='+vencon_fname+'&vencon_lname='+vencon_lname+'&vencon_email='+vencon_email+'&vencon_phone='+vencon_phone+'&vencon_fax='+vencon_fax+'&subacct='+subacct+'&vencon_phone2='+vencon_phone2+'&ven_notes='+ven_notes+'&fed_num='+fed_num+'&selterm='+selterm,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
	alert(data);
getVendors('1');

  }
});

}else{
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4+' '+er5+' '+er6+' '+er7+' '+er8+' '+er9+' '+er10);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}

	
}

///GET VENDOR LIST//

function getVendors(val){
	$.ajax({
  url: 'inc/admin_actions.php?action=getvendlist&page='+val,
  success: function(data) {
	  $("#vendorholder").html(data);

  }
});
}

function getVendors2(val){
	$.ajax({
  url: 'inc/admin_actions.php?action=getvendlist&search=true&searchval='+val,
  success: function(data) {
	  $("#vendorholder").html(data);

  }
});
}


///GET VENDOR EDIT FORM///

function edVend(val){
//getvendor	

$.ajax({
  url: 'inc/admin_actions.php?action=getvendor&id='+val,
  success: function(data) {
	 
$("#dio1").html(data);

$("#advens").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});

$( "#ven_coied,#ven_cowed" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
$( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Edit Vendor",
		});	
		
		$(".makerrs").uniform();
		
		$("#adusr").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


  }
});	
}

///SUBMIT VENDOR EDITS TO DB////

function fineditVen(val){
var gl_id = $("#gl_id").val();
var ven_name = $("#ven_name").val();
var ven_address = $("#ven_address").val();
var ven_address2 = $("#ven_address2").val();
var ven_city = $("#ven_city").val();
var ven_state = $("#ven_state").val();
var ven_zip = $("#ven_zip").val();
var ven_coied = $("#ven_coied").val();
var ven_cowed = $("#ven_cowed").val();
var vencon_fname = $("#vencon_fname").val();
var vencon_lname = $("#vencon_lname").val();
var vencon_email = $("#vencon_email").val();
var vencon_phone = $("#vencon_phone").val();
var vencon_fax = $("#vencon_fax").val();
var subacct = $("#subacct").val();
var vencon_phone2 = $("#vencon_phone2").val();
var ven_notes = $("#ven_notes").val();
var fed_num = $("#fed_num").val();
var selterm = $("#selterm").val();


var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  var runemail = pattern.test(vencon_email);

if(gl_id == ''){var er1 = 'Need GL #<br>';}else{var er1 = '';}
if(ven_name == ''){var er2 = 'Vendor Name <br>';}else{var er2 = '';}
if(ven_address == ''){var er3 = 'Address<br>';}else{var er3 = '';}
if(ven_city == ''){var er4 = 'City<br>';}else{var er4 = '';}
if(ven_state == 'none'){var er5 = 'State<br>';}else{var er5 = '';}
if(ven_zip == '' || ven_zip.length < 5){var er6 = 'Valid Zip<br>';}else{var er6 = '';}
if(vencon_fname == ''){var er7 = 'Contact First Name<br>';}else{var er7 = '';}
if(vencon_lname == ''){var er8 = 'Contact Last Name<br>';}else{var er8 = '';}
if(vencon_email == '' || runemail == false){var er9 = 'Valid Email<br>';}else{var er9 = '';}
if(vencon_phone == ''){var er10 = 'Phone<br>';}else{var er10 = '';}

if(er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == '' && er7 == '' && er8 == '' && er9 == '' && er10 == ''){

$.ajax({
  url: 'inc/admin_actions.php?action=fineditven&gl_id='+gl_id+'&ven_name='+ven_name+'&ven_address='+ven_address+'&ven_address2='+ven_address2+'&ven_city='+ven_city+'&ven_state='+ven_state+'&ven_zip='+ven_zip+'&ven_coied='+ven_coied+'&ven_cowed='+ven_cowed+'&vencon_fname='+vencon_fname+'&vencon_lname='+vencon_lname+'&vencon_email='+vencon_email+'&vencon_phone='+vencon_phone+'&vencon_fax='+vencon_fax+'&subacct='+subacct+'&id='+val+'&vencon_phone2='+vencon_phone2+'&ven_notes='+ven_notes+'&fed_num='+fed_num+'&selterm='+selterm,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
getVendors('1');

  }
});

}else{
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4+' '+er5+' '+er6+' '+er7+' '+er8+' '+er9+' '+er10);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}

	
}

////DELETE VENDOR///
function delVend(val){
	$("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this vendor?</strong><br><span style="font-size:12px;"><br>All data associated with this vendor will become inaccessible outside of IT support.</span>');
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
  url: 'inc/admin_actions.php?action=delvend&id='+val,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
getVendors('1');

  }
});
					
					
				}
			}
		});
	
}


//////GET ITEM ACTIONS///

function runtypitem(){
//selectyp
$.ajax({
  url: 'inc/admin_actions.php?action=selectyp',
  success: function(data) {
	  $("#dio1").html(data);
	  $( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Select Item Type",
		});	
		
		$(".makerrs").uniform();

  }
});	
}

function runItemtyp(val){
	if(val == 'product'){
		addProd();
	}
	
	if(val == 'service'){
	pullServic();	
	}
	
	if(val == 'part'){
	addParts();	
	}
}

function pullServic(){
//serviceform	
$.ajax({
  url: 'inc/admin_actions.php?action=serviceform',
  success: function(data) {
	  $("#dio1").html(data);
	  $( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Service Details",
		});	
		
		$(".makerrs").uniform();
		
		$("#adprods").button({
	 icons: {
                primary: "ui-icon-cart"
            },
			
			});

  }
});	
}

function pullServiced(val){
//serviceform	
$.ajax({
  url: 'inc/admin_actions.php?action=serviceformed&id='+val,
  success: function(data) {
	  $("#dio1").html(data);
	  $( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Service Details",
		});	
		
		$(".makerrs").uniform();
		
		$("#adprods").button({
	 icons: {
                primary: "ui-icon-cart"
            },
			
			});

  }
});	
}


function finprodAddserv(){

var item_name = $("#item_name").val();
var servprice = $("#servprice").val();
var proddesc = $("#proddesc").val();

if(item_name == '' ){var er1 = 'Service Name<br>';}else{var er1 = '';}
if(servprice == '' ){var er2 = 'Service Price<br>';}else{var er2 = '';}
if(proddesc == '' ){var er3 = 'Add description of service<br>';}else{var er3 = '';}

if(er1 == '' && er2 == '' && er3 == ''){
	$.ajax({
  url: 'inc/admin_actions.php?action=subservice&item_name='+item_name+'&servprice='+servprice+'&proddesc='+proddesc,
  success: function(data) {
	  $("#dio1").dialog( "close" );
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
pullProds('1','DESC');

  }
});
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	
}
}

function finprodEditserv(val){
var item_name = $("#item_name").val();
var servprice = $("#servprice").val();
var proddesc = $("#proddesc").val();

if(item_name == '' ){var er1 = 'Service Name<br>';}else{var er1 = '';}
if(servprice == '' ){var er2 = 'Service Price<br>';}else{var er2 = '';}
if(proddesc == '' ){var er3 = 'Add description of service<br>';}else{var er3 = '';}

if(er1 == '' && er2 == '' && er3 == ''){
	$.ajax({
  url: 'inc/admin_actions.php?action=subeditservice&item_name='+item_name+'&servprice='+servprice+'&proddesc='+proddesc+'&id='+val,
  success: function(data) {
	  $("#dio1").dialog( "close" );
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
pullProds('1','DESC');

  }
});
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	
}
}


//////////GET NEW PRODUCT / SERVICE FORM////////

///check all products/////
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
           allVals.push($(this).val()+'~'+$("#qty"+$(this).val()).val());
         });
		// alert(allVals);
         $('#checkvals').val(allVals)
      }


function addProd(){
	
	$.ajax({
 url: 'inc/admin_actions.php?action=getproductform',
 success: function(data) {
	 
$("#dio1").html(data);

$("#advens").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


		
			
$( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add Products / Services",
		});	
		
		$(".makerrs").uniform();
		
		$("#adprods").button({
	 icons: {
                primary: "ui-icon-cart"
            },
			
			});


  }
});	

}


/////ADD FIXED ASSET///

function addProd2d(){
	
	$.ajax({
 url: 'inc/admin_actions.php?action=getproductform2',
 success: function(data) {
	 
$("#dio1").html(data);

$("#advens").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


		
			
$( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add Asset",
		});	
		
		$(".makerrs").uniform();
		
		$("#adprods").button({
	 icons: {
                primary: "ui-icon-cart"
            },
			
			});


  }
});	

}

///OPEN PARTS BIN////

function openParts(){
	
	$.ajax({
 url: 'inc/admin_actions.php?action=partsbin',
 success: function(data) {
	 
$("#dio2").html(data);




		
			
$( "#dio2" ).dialog( "destroy" );
$( "#dio2" ).dialog({
			width: 650,
			resizable: false,
			modal: false,
			title: "Add Parts to product - Drag and drop",
		});	
	
		
		$( "#attachprod" ).sortable({
			revert: true,
			receive: function(event, ui) {
				
				var thid = $(ui.item).attr("id");
				var lastid = $("#lastid").val();
				
				 var qtyset = $("#qty"+thid).val();
				 $("#loaderfin").show();
				 $.ajax({
  url: 'inc/admin_actions.php?action=addpartsset&part='+thid+'&productid='+lastid+'&qty='+qtyset,
  success: function(data) {
    $("#loaderfin").hide();
		runBinset(lastid);
  }
});
				 
				 }
				 
				 
			
		});
		$( ".infoheadlines" ).draggable({
			 appendTo: "#attachprod",
			connectToSortable: "#attachprod",
			helper: "clone",
			revert: "invalid",
			 
			
		});
		$( "ul, li" ).disableSelection();


  }
});	
	
}

function runBinset(val){
$.ajax({
  url: 'inc/admin_actions.php?action=getadded&productid='+val,
  success: function(data) {
    $("#attachprod").html(data);

  }
});	
}

function delParts(val,val2){
	$.ajax({
  url: 'inc/admin_actions.php?action=delpart&part='+val,
  success: function(data) {
    runBinset(val2);
  }
});	
}

function runnerPartsearch(){
	//searchparts
	var serc = $("#serc").val();
	$.ajax({
  url: 'inc/admin_actions.php?action=searchparts&search='+serc,
  success: function(data) {
    $("#partsspitter").html(data);
	
	$( "#attachprod" ).sortable({
			revert: true,
			receive: function(event, ui) {
				
				var thid = $(ui.item).attr("id");
				var lastid = $("#lastid").val();
				
				 var qtyset = $("#qty"+thid).val();
				 $("#loaderfin").show();
				 $.ajax({
  url: 'inc/admin_actions.php?action=addpartsset&part='+thid+'&productid='+lastid+'&qty='+qtyset,
  success: function(data) {
    $("#loaderfin").hide();
		runBinset(lastid);
  }
});
				 
				 }
				 
				 
			
		});
		$( ".infoheadlines" ).draggable({
			 appendTo: "#attachprod",
			connectToSortable: "#attachprod",
			helper: "clone",
			revert: "invalid",
			 
			
		});
		$( "ul, li" ).disableSelection();
	
	
	

  }
});	
}

function finprodAdd(){
	
	 var allVals = [];
         $(".checkers:checked").each(function() {
           allVals.push($(this).val()+'~'+$("#qty"+$(this).val()).val());
         });
		// alert(allVals);
         $('#checkvals').val(allVals)
	
var item_name = $("#item_name").val();
var inventory = $("#inventory").val();
var attc_vend = $("#attc_vend").val();
var cost = $("#cost").val();
var price = $("#price").val();
var rent_price = $("#rent_price").val();
var checkvals = $("#checkvals").val();
var sku = $("#sku").val();
var proddesc = $("#proddesc").val();
var mins  = $("#mins").val();
var maxs = $("#maxs").val();



//alert(checkvals);

if(item_name == ''){var er1 = 'Item Name<br>';}else{var er1 = '';}
if(inventory == ''){var er2 = 'Inventory Qty <br>';}else{var er2 = '';}
if(cost == ''){var er3 = 'Cost<br>';}else{var er3 = '';}
if(price == ''){var er4 = 'Price<br>';}else{var er4 = '';}
if(sku == ''){var er5 = 'SKU #<br>';}else{var er5 = '';}
if(proddesc == ''){var er6 = 'Product Description<br>';}else{var er6 = '';}


if(er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == ''){


$.ajax({
  url: 'inc/admin_actions.php?action=enterprods&item_name='+item_name+'&inventory='+inventory+'&attc_vend='+attc_vend+'&cost='+cost+'&price='+price+'&rent_price='+rent_price+'&checkvals='+checkvals+'&sku='+sku+'&proddesc='+proddesc+'&mins='+mins+'&maxs='+maxs,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
pullProds('1','DESC');
  }
});

}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4+' '+er5+' '+er6);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}

}

function pullProds(val,val2){
//pullproducts
$.ajax({
  url: 'inc/admin_actions.php?action=pullproducts&page='+val+'&order='+val2,
  success: function(data) {
	  $("#productholder").html(data);

  }
});
	
}

function pullProdsser(val){
//pullproducts
$.ajax({
  url: 'inc/admin_actions.php?action=pullproducts&search=true&searchval='+val,
  success: function(data) {
	  $("#productholder").html(data);

  }
});
	
}

/////EDIT PRODUCT FORM///
function edProd(val){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=editproduct&id='+val,
  success: function(data) {
	 $("#dio1").html(data);

$("#advens").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


		
			
$( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add Products / Services",
		});	
		
		$(".makerrs").uniform();
		
		$("#adprods").button({
	 icons: {
                primary: "ui-icon-cart"
            },
			
			});
			
			$( "#attachprod" ).sortable({
			revert: true,
			receive: function(event, ui) {
				
				var thid = $(ui.item).attr("id");
				var lastid = $("#lastid").val();
				
				 var qtyset = $("#qty"+thid).val();
				 $("#loaderfin").show();
				 $.ajax({
  url: 'inc/admin_actions.php?action=addpartsset&part='+thid+'&productid='+lastid+'&qty='+qtyset,
  success: function(data) {
    $("#loaderfin").hide();
		runBinset(lastid);
  }
});
				 
				 }
				 
				 
			
		});
		$( ".infoheadlines" ).draggable({
			 appendTo: "#attachprod",
			connectToSortable: "#attachprod",
			helper: "clone",
			revert: "invalid",
			 
			
		});
		$( "ul, li" ).disableSelection();


  }
});
}

/////COMPLETE PRODUCT EDITS///
function finprodEdit(val){
	
var item_name = $("#item_name").val();
var inventory = $("#inventory").val();
var attc_vend = $("#attc_vend").val();
var cost = $("#cost").val();
var price = $("#price").val();
var rent_price = $("#rent_price").val();
var checkvals = $("#checkvals").val();
var sku = $("#sku").val();
var proddesc = $("#proddesc").val();
var mins  = $("#mins").val();
var maxs = $("#maxs").val();

if(item_name == ''){var er1 = 'Item Name<br>';}else{var er1 = '';}
if(inventory == ''){var er2 = 'Inventory Qty <br>';}else{var er2 = '';}
if(cost == ''){var er3 = 'Cost<br>';}else{var er3 = '';}
if(price == ''){var er4 = 'Price<br>';}else{var er4 = '';}
if(sku == ''){var er5 = 'SKU #<br>';}else{var er5 = '';}
if(proddesc == ''){var er6 = 'Product Description<br>';}else{var er6 = '';}


if(er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == ''){


$.ajax({
  url: 'inc/admin_actions.php?action=editprods&item_name='+item_name+'&inventory='+inventory+'&attc_vend='+attc_vend+'&cost='+cost+'&price='+price+'&rent_price='+rent_price+'&checkvals='+checkvals+'&sku='+sku+'&proddesc='+proddesc+'&mins='+mins+'&maxs='+maxs+'&id='+val,
  success: function(data) {
	  
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
pullProds('1','DESC');
  }
});

}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4+' '+er5+' '+er6);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}
	
}




function edProd2d(val){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=editproduct2ds&id='+val,
  success: function(data) {
	 $("#dio1").html(data);

$("#advens").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


		
			
$( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Edit Asset",
		});	
		
		$(".makerrs").uniform();
		
		$("#adprods").button({
	 icons: {
                primary: "ui-icon-cart"
            },
			
			});
			
			$( "#attachprod" ).sortable({
			revert: true,
			receive: function(event, ui) {
				
				var thid = $(ui.item).attr("id");
				var lastid = $("#lastid").val();
				
				 var qtyset = $("#qty"+thid).val();
				 $("#loaderfin").show();
				 $.ajax({
  url: 'inc/admin_actions.php?action=addpartsset&part='+thid+'&productid='+lastid+'&qty='+qtyset,
  success: function(data) {
    $("#loaderfin").hide();
		runBinset(lastid);
  }
});
				 
				 }
				 
				 
			
		});
		$( ".infoheadlines" ).draggable({
			 appendTo: "#attachprod",
			connectToSortable: "#attachprod",
			helper: "clone",
			revert: "invalid",
			 
			
		});
		$( "ul, li" ).disableSelection();


  }
});
}



/////UPDATE ASSET////

function finprodEditass(val){
	
var item_name = $("#item_name").val();
//var inventory = $("#inventory").val();
var attc_vend = $("#attc_vend").val();
var cost = $("#cost").val();
//var price = $("#price").val();
var rent_price = $("#rent_price").val();
var checkvals = $("#checkvals").val();
var sku = $("#sku").val();
var proddesc = $("#proddesc").val();
//var mins  = $("#mins").val();
///var maxs = $("#maxs").val();

if(item_name == ''){var er1 = 'Item Name<br>';}else{var er1 = '';}
//if(inventory == ''){var er2 = 'Inventory Qty <br>';}else{var er2 = '';}
if(cost == ''){var er3 = 'Cost<br>';}else{var er3 = '';}
//if(price == ''){var er4 = 'Price<br>';}else{var er4 = '';}
if(sku == ''){var er5 = 'SKU #<br>';}else{var er5 = '';}
if(proddesc == ''){var er6 = 'Product Description<br>';}else{var er6 = '';}


if(er1 == '' && er3 == '' && er5 == '' && er6 == ''){


$.ajax({
  url: 'inc/admin_actions.php?action=editprods2d&item_name='+item_name+'&attc_vend='+attc_vend+'&cost='+cost+'&rent_price='+rent_price+'&checkvals='+checkvals+'&sku='+sku+'&proddesc='+proddesc+'&id='+val,
  success: function(data) {
	  
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
pullProds('1','DESC');
  }
});

}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' ' +er3+' '+er5+' '+er6);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}
	
}



////DELETE PRODUCT///
function delProd(val){
	$("#alerts").html('<strong style="color:#1053A3;">Are you sure you wish to delete this product?</strong><br><span style="font-size:12px;"><br>All data associated with this product will become inaccessible outside of IT support.</span>');
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
  url: 'inc/admin_actions.php?action=remprod&id='+val,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
pullProds('1','DESC');

  }
});
					
					
				}
			}
		});
	
}


/////FIXED ASSETS////
function pullAssts(val,val2){
//pullproducts
$.ajax({
  url: 'inc/admin_actions.php?action=pullproductsdus&page='+val+'&order='+val2,
  success: function(data) {
	  $("#productholder2").html(data);

  }
});
	
}

function pullAssts2(val){
//pullproducts
$.ajax({
  url: 'inc/admin_actions.php?action=pullproductsdus&search=true&searchval='+val,
  success: function(data) {
	  $("#productholder2").html(data);

  }
});
	
}


function finprodAdd2du(){
	
	 var allVals = [];
         $(".checkers:checked").each(function() {
           allVals.push($(this).val()+'~'+$("#qty"+$(this).val()).val());
         });
		// alert(allVals);
         $('#checkvals').val(allVals)
	
var item_name = $("#item_name").val();
//var inventory = $("#inventory").val();
var attc_vend = $("#attc_vend").val();
var cost = $("#cost").val();
// price = $("#price").val();
var rent_price = $("#rent_price").val();
var checkvals = $("#checkvals").val();
var sku = $("#sku").val();
var proddesc = $("#proddesc").val();
//var mins  = $("#mins").val();
//var maxs = $("#maxs").val();



//alert(checkvals);

if(item_name == ''){var er1 = 'Item Name<br>';}else{var er1 = '';}
//if(inventory == ''){var er2 = 'Inventory Qty <br>';}else{var er2 = '';}
if(cost == ''){var er3 = 'Cost<br>';}else{var er3 = '';}
//if(price == ''){var er4 = 'Price<br>';}else{var er4 = '';}
if(sku == ''){var er5 = 'SKU #<br>';}else{var er5 = '';}
if(proddesc == ''){var er6 = 'Product Description<br>';}else{var er6 = '';}


if(er1 == '' && er3 == '' && er5 == '' && er6 == ''){


$.ajax({
  url: 'inc/admin_actions.php?action=enterprodsrent&item_name='+item_name+'&attc_vend='+attc_vend+'&cost='+cost+'&rent_price='+rent_price+'&checkvals='+checkvals+'&sku='+sku+'&proddesc='+proddesc,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
pullAssts('1','DESC');
  }
});

}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' ' +er3+' '+er5+' '+er6);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}

}


////ADD PARTS////
function addParts(){
	
	$.ajax({
 url: 'inc/admin_actions.php?action=getpartform',
 success: function(data) {
	 
$("#dio1").html(data);

$("#advens").button({
	 icons: {
                primary: "ui-icon-person"
            },
			
			});


		
			
$( "#dio1" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add Parts",
		});	
		
		$(".makerrs").uniform();
		
		$("#adprods").button({
	 icons: {
                primary: "ui-icon-cart"
            },
			
			});


  }
});	
	
	

	
}

///FINISH PRODUCT ADD////

function finpartAdd(){
var item_name = $("#item_name").val();
var inventory = $("#inventory").val();
var attc_vend = $("#attc_vend").val();
var cost = $("#cost").val();
var price = $("#price").val();
var rent_price = $("#rent_price").val();
var sku = $("#sku").val();
var proddesc = $("#proddesc").val();
var mins  = $("#mins").val();
var maxs = $("#maxs").val();

if(item_name == ''){var er1 = 'Item Name<br>';}else{var er1 = '';}
if(inventory == ''){var er2 = 'Inventory Qty <br>';}else{var er2 = '';}
if(cost == ''){var er3 = 'Cost<br>';}else{var er3 = '';}
if(price == ''){var er4 = 'Price<br>';}else{var er4 = '';}
if(sku == ''){var er5 = 'SKU #<br>';}else{var er5 = '';}
if(proddesc == ''){var er6 = 'Product Description<br>';}else{var er6 = '';}


if(er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == ''){


$.ajax({
  url: 'inc/admin_actions.php?action=enterpart&item_name='+item_name+'&inventory='+inventory+'&attc_vend='+attc_vend+'&cost='+cost+'&price='+price+'&rent_price='+rent_price+'&sku='+sku+'&proddesc='+proddesc+'&mins='+mins+'&maxs='+maxs,
  success: function(data) {
	 $("#confrmsucc").fadeIn('slow');
    setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
	$("#dio1").dialog( "close" );
pullProds('1','DESC');
  }
});

}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4+' '+er5+' '+er6);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
}

}

////PULL AUDIT///
function getAudit(val){
//pullaudit
var start = $("#datser").val();	
var end = $("#datser2").val();	
$.ajax({
  url: 'inc/admin_actions.php?action=pullaudit&start='+start+'&end='+end+'&page='+val,
  success: function(data) {
	  $("#auditholder").html(data);

  }
});
}

function checkReps(val){
if(val == 'revenue'){
	$("#revenue").show();
	$("#techreport").hide();
	
}
//techreport

if(val == 'workordtech'){
	$("#revenue").hide();
	$("#techreport").show();
	
}
}



function viewWrks(val){
	$.ajax({
  url: 'inc/admin_actions.php?action=getworksfor&tech='+val,
  success: function(data) {
	  
	   $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 630,
			resizable: false,
			modal: true,
			title: "View Workorders",
		});	
  

	}});
	
}



////ADD THE TERM////

////ADD NEW TAX////
function addnewTerm(){
//addnewtax
$.ajax({
  url: 'inc/admin_actions.php?action=addterms',
  success: function(data) {
	  $( "#dio1" ).html(data);
	  $( "#dialog:ui-dialog" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New Term",
		});	
		
		$(".makerrs").uniform();
		
		$("#adtermmy").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});



  }
});	
}

function addTermfin(){

var precent = $("#precent").val();
var days = $("#days").val();
var net = $("#net").val();

if(precent == ''){var er1 = 'Percent Needed<br>';}else{var er1 = '';}
if(days == ''){var er2 = 'Days<br>';}else{var er2 = '';}
if(net == ''){var er3 = 'Net<br>';}else{var er3 = '';}


if(er1 == '' && er2 == '' && er3 == ''){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=setterms&precent='+precent+'&days='+days+'&net='+net,
  success: function(data) {
	  $( "#dio1" ).dialog( "close" );
	 getTerms();
  }
});	
	
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	
}
	
}

function getTerms(){
	$.ajax({
  url: 'inc/admin_actions.php?action=getterms',
  success: function(data) {
	 
$("#holdterms").html(data);


  }
});	
}


function editTerm(val){
//addnewtax
$.ajax({
  url: 'inc/admin_actions.php?action=editterms&id='+val,
  success: function(data) {
	  $( "#dio1" ).html(data);
	  $( "#dialog:ui-dialog" ).dialog( "destroy" );
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Edit Term",
		});	
		
		$(".makerrs").uniform();
		
		$("#adtermmy").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});



  }
});	
}


function editTermfin(val){
	var precent = $("#precent").val();
var days = $("#days").val();
var net = $("#net").val();

if(precent == ''){var er1 = 'Percent Needed<br>';}else{var er1 = '';}
if(days == ''){var er2 = 'Days<br>';}else{var er2 = '';}
if(net == ''){var er3 = 'Net<br>';}else{var er3 = '';}


if(er1 == '' && er2 == '' && er3 == ''){
	
	$.ajax({
  url: 'inc/admin_actions.php?action=edittermss&precent='+precent+'&days='+days+'&net='+net+'&id='+val,
  success: function(data) {
	  $( "#dio1" ).dialog( "close" );
	 getTerms();
  }
});	
	
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+' ' +er3+' '+er4);
	$( "#alerts" ).dialog({
			width: 350,
			resizable: false,
			modal: true,
			title: "Notice",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	
}
}


///DELETE TERM///

function delTerm(val){
$.ajax({
  url: 'inc/admin_actions.php?action=delterm&id='+val,
  success: function(data) {
	 
	 getTerms();
  }
});		
}