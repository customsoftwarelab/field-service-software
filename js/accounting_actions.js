$(function(){
$( "#tabs" ).tabs();
$( "#addledg" ).button();
$( "#adbill" ).button();
$( "#paybill" ).button();
$( "#addledgs" ).button();
$( "#addloans" ).button();
$( "#prichk" ).button();

//adbill

getLines('expense','1');
getLines('bank','1');
getLines('arseve','1');
getLines('loans','1');
getLines('income','1');
grabBanks('1');
pullBilllist('1');
getJourns('1');

$( "#chkdate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpickerb");

});

function openTypwin(){
$.ajax({
  url: 'inc/accounting_actions.php?action=gettypes',
  success: function(data) {
    $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New Entry",
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

function runLedgtype(val){
	
if(val == 'expense'){
	pullexForm();
	
}

if(val == 'bankinfo'){
	grabBank();
}
}


////PULL EXPENSE FORM////
function pullexForm(){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=addexpense',
  success: function(data) {
    $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New Expense",
		});	
		
		$(".makerrs").uniform();
		
		$("#adbutton").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});
			
			$( "#setdate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
  }
});	
	
}


/////PULL BANK FORM///

function grabBank(){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=bankaccnt',
  success: function(data) {
    $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New Account",
		});	
		
		$(".makerrs").uniform();
		
		$("#adbutton").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});
			
			$( "#setdate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
  }
});	
	///bankaccnt
}


/////PULL BANK FORM///

function grabBankedit(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=bankaccntedit&id='+val,
  success: function(data) {
    $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Edit Account",
		});	
		
		$(".makerrs").uniform();
		
		$("#adbutton").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});
			
			$( "#setdate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
  }
});	
	///bankaccnt
}


////GET LOAN FORM///


function grabLoan(){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=addloan',
  success: function(data) {
    $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New Loan",
		});	
		
		$(".makerrs").uniform();
		
		$("#adbutton").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});
			
			$( "#setdate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
  }
});	
	///bankaccnt
}




function subEntry(val){
if(val == 'expense'){
var name = $("#name").val();
var subacct = $("#subacct").val();
var setdate = $("#setdate").val();
var amount = $("#amount").val();
var glnum = $("#glnum").val();

if(name == ''){var er1 = 'Supply Name<br>';}else{var er1 = '';}

if(er1 == ''){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=subexpense&name='+name+'&subacct='+subacct+'&glnum='+glnum,
  success: function(data) {
	  
	  getLines('expense');
	  $("#dio1").dialog( "close" );
	 // alert(data);

  }
});
	
}else{
$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er1);
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


if(val == 'bankacct'){
	
var bankname = $("#bankname").val();
var phone = $("#phone").val();
var address = $("#address").val();
var adrress2 = $("#adrress2").val();
var state = $("#state").val();
var city = $("#city").val();
var zip = $("#zip").val();
var banknum = $("#banknum").val();
var routnum = $("#routnum").val();
var checknumstr = $("#checknumstr").val();
var glnum = $("#glnum").val();


if(bankname == ''){var er0 = 'Need bankname<br>';}else{var er0 = '';}

if(banknum == ''){var er7 = 'Need banknum<br>';}else{var er7 = '';}
if(routnum == ''){var er8 = 'Need routnum<br>';}else{var er8 = '';}
if(checknumstr == ''){var er9 = 'Need checknumstr<br>';}else{var er9 = '';}

if(er0 == '' && er7 == '' && er8 == '' && er9 == ''){
	
		$.ajax({
  url: 'inc/accounting_actions.php?action=subbank&bankname='+bankname+'&phone='+phone+'&address='+address+'&adrress2='+adrress2+'&state='+state+'&city='+city+'&zip='+zip+'&banknum='+banknum+'&routnum='+routnum+'&checknumstr='+checknumstr+'&glnum='+glnum,
  success: function(data) {
	  
	  getLines('bank');
	  $("#dio1").dialog( "close" );
	 // alert(data);

  }
});
	
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er0+' '+er7+' '+er8+' '+er9);
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

if(val == 'loan'){
	var name = $("#name").val();
	var subacctloan = $("#subacctloan").val();
	var setdate = $("#setdate").val();
	var terms = $("#terms").val();
	var balance = $("#balance").val();
	var acctnum = $("#acctnum").val();
	var intrest = $("#intrest").val();
	
	if(name == ''){var er1 = 'Name of loan';}else{var er1 = '';}
	if(subacctloan == 'none'){var plnacc = 'true';}else{var plnacc = 'false';}
	if(setdate == ''){var er2 = 'Start Date';}else{var er2 = '';}
	if(subacctloan != 'none' && balance == ''){var er3 = 'Enter balance';}else{var er3 = '';}
	
	
	if(er1 == '' && er2 == '' && er3 == ''){
	
		$.ajax({
  url: 'inc/accounting_actions.php?action=subloan&name='+name+'&subacctloan='+subacctloan+'&setdate='+setdate+'&terms='+terms+'&balance='+balance+'&acctnum='+acctnum+'&intrest='+intrest+'&issub='+plnacc,
  success: function(data) {
	  
	  getLines('loans','1');
	  $("#dio1").dialog( "close" );
	 // alert(data);

  }
});
	
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er1+' '+er2+' '+er3);
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



}


////EDIT BANK////
function subeditEntry(val){
var bankname = $("#bankname").val();
var phone = $("#phone").val();
var address = $("#address").val();
var adrress2 = $("#adrress2").val();
var state = $("#state").val();
var city = $("#city").val();
var zip = $("#zip").val();
var banknum = $("#banknum").val();
var routnum = $("#routnum").val();
var checknumstr = $("#checknumstr").val();
var glnum = $("#glnum").val();

alert(glnum);
if(bankname == ''){var er0 = 'Need bankname<br>';}else{var er0 = '';}

if(banknum == ''){var er7 = 'Need banknum<br>';}else{var er7 = '';}
if(routnum == ''){var er8 = 'Need routnum<br>';}else{var er8 = '';}
if(checknumstr == ''){var er9 = 'Need checknumstr<br>';}else{var er9 = '';}

if(er0 == '' && er7 == '' && er8 == '' && er9 == ''){
	
		$.ajax({
  url: 'inc/accounting_actions.php?action=editsubbank&bankname='+bankname+'&phone='+phone+'&address='+address+'&adrress2='+adrress2+'&state='+state+'&city='+city+'&zip='+zip+'&banknum='+banknum+'&routnum='+routnum+'&checknumstr='+checknumstr+'&glnum='+glnum+'&id='+val,
  success: function(data) {
	 // alert(data);
	  getLines('bank');
	  grabBanks('1');
	  $("#dio1").dialog( "close" );
	 // alert(data);

  }
});
	
}else{
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er0+' '+er7+' '+er8+' '+er9);
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

/////SEARCH DB////

function getLinesser(vals,vals2){
	//alert(vals+vals2);
	if(vals == 'expense'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getexpense&search=true&searchval='+vals2,
  success: function(data) {
    $("#expensehold").html(data);
  }
});
		
	}
	
	if(vals == 'bank'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getbank&search=true&searchval='+vals2,
  success: function(data) {
    $("#acclinehold").html(data);
  }
});
		
	}
	
	if(vals == 'arseve'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getarlist&search=true&searchval='+vals2,
  success: function(data) {
    $("#arhold").html(data);
  }
});
		
	}
	
	if(vals == 'income'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getincomelist&search=true&searchval='+vals2,
  success: function(data) {
    $("#incomehold").html(data);
  }
});
		
	}
	
}


///END SEARCH////


function getLines(vals,vals2){
	if(vals == 'expense'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getexpense&page='+vals2,
  success: function(data) {
    $("#expensehold").html(data);
  }
});
		
	}
	
	
	if(vals == 'bank'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getbank&page='+vals2,
  success: function(data) {
    $("#acclinehold").html(data);
  }
});
		
	}
	
	if(vals == 'arseve'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getarlist&page='+vals2,
  success: function(data) {
    $("#arhold").html(data);
  }
});
		
	}
	
	if(vals == 'income'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getincomelist&page='+vals2,
  success: function(data) {
    $("#incomehold").html(data);
  }
});
		
	}
	
	if(vals == 'loans'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=getloans&page='+vals2,
  success: function(data) {
    $("#loanshold").html(data);
	$("#loanshold2").html(data);
  }
});
		
	}
	
}



function expandFun(val){
	var checks = $("#lines"+val).is(":visible");
	
		if(checks == true){
			 $("#ico"+val).removeClass("epand_on");
                 $("#ico"+val).addClass("epand_icon");
			$("#lines"+val).slideUp('fast');
		}else{
			$("#ico"+val).removeClass("epand_icon");
                 $("#ico"+val).addClass("epand_on");
			$("#lines"+val).slideDown('fast');
		}
	
}

/////ADD BANKING STUFF////
function runBanks(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=enterbankinfo&setval='+val,
  success: function(data) {
    $('#dio1').html(data);
    
 
	
	
	
	$( "#dio1" ).dialog({
			width: 990,
			resizable: false,
			modal: true,
			title: "Banking Actions",
		});	
		
		$("#bnsubs").button({
	 icons: {
                primary: "ui-icon-pencil"
            },
		});
		
		$( "#bndate" ).datepicker({
			
				changeMonth: true,
			changeYear: true
		});
	
	 }
});
}

////MODERATE INPUT FILEDS FOR PAYMENTS & DEPOSITS///
function wazChng(val){
	var myA = val.split(',');
	
	if(myA[1] == 'expense'){
		$('#bndep:input').attr('disabled', true);	
$('#bnpay:input').removeAttr('disabled');
$("#bndep").val('');



$.ajax({
  url: 'inc/accounting_actions.php?action=getamount&id='+myA[0],
  success: function(data) {
    $('#bnpay').val(data);

  }
});

	}
	
	if(myA[1] == 'bank'){
		$('#bnpay:input').attr('disabled', true);	
$('#bndep:input').removeAttr('disabled');
$("#bnpay").val('');
		
	}
	

}

function subBanksthn(){
	
var bndate = $("#bndate").val();
var bnnum = $("#bnnum").val();
var bnname = $("#bnname").val();
var bnmemo = $("#bnmemo").val();
var bngl = $("#bngl").val();
var bndep = $("#bndep").val();
var bnpay = $("#bnpay").val();
var whabank = $("#whabank").val();	

var myA = bngl.split(',');

if(bndate == ''){var er1 = 'Need Date<br>';}else{var er1 = '';}
if(bnnum == ''){var er2 = 'Enter Type or number<br>';}else{var er2 = '';}
if(bnname == ''){var er3 = 'Name<br>';}else{var er3 = '';}

if(er1 == '' && er2 == '' && er3 == ''){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=subbankingthon&bndate='+bndate+'&bnnum='+bnnum+'&bnname='+bnname+'&bnmemo='+bnmemo+'&bngl='+myA[0]+'&bndep='+bndep+'&bnpay='+bnpay+'&whabank='+whabank,
  success: function(data) {
	  $("#dio1").dialog( "close" );
	  grabBanks('1');
  }
});
	
}else{
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er1+' '+er2+' '+er3);
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




////EDIT GL ENTRY///
function editBaenty(val){
//editbankinfo
$.ajax({
  url: 'inc/accounting_actions.php?action=editbankinfo&id='+val,
  success: function(data) {
     $('#dio1').html(data);
    
 
	
	
	
	$( "#dio1" ).dialog({
			width: 990,
			resizable: false,
			modal: true,
			title: "Banking Actions",
		});	
		
		$("#bnsubs,#bnsubs2").button({
	 icons: {
                primary: "ui-icon-pencil"
            },
		});
		
		$( "#bndate" ).datepicker({
			
				changeMonth: true,
			changeYear: true
		});
  }
});	
}



function editBanksthn(val){
	
	var bndate = $("#bndate").val();
var bnnum = $("#bnnum").val();
var bnname = $("#bnname").val();
var bnmemo = $("#bnmemo").val();
var bngl = $("#bngl").val();
var bndep = $("#bndep").val();
var bnpay = $("#bnpay").val();
var whabank = $("#whabank").val();	



var myA = bngl.split(',');

if(bndate == ''){var er1 = 'Need Date<br>';}else{var er1 = '';}
if(bnnum == ''){var er2 = 'Enter Type or number<br>';}else{var er2 = '';}
if(bnname == ''){var er3 = 'Name<br>';}else{var er3 = '';}

if(er1 == '' && er2 == '' && er3 == ''){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=updatebankingthon&bndate='+bndate+'&bnnum='+bnnum+'&bnname='+bnname+'&bnmemo='+bnmemo+'&bngl='+myA[0]+'&bndep='+bndep+'&bnpay='+bnpay+'&whabank='+whabank+'&id='+val,
  success: function(data) {
	  $("#dio1").dialog( "close" );
	  grabBanks('1');
  }
});
	
}else{
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please enter cata for the following fields.</span><br><br>'+er1+' '+er2+' '+er3);
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


function delBankent(val,val2){
	
	
	$("#alerts").html('<strong style="color:#1053A3;">Are you sure you want to remove this entry?</strong><br><span style="font-size:12px;">Removing entry will refund the funds if it is from a bank account.</span>');
	$( "#alerts" ).dialog("destroy");
		$( "#alerts" ).dialog({
			resizable: false,
			width: 443,
			resizable: false,
			modal: true,
			title: "Confirm Action",
			buttons: {
				"Remove": function() {
					$.ajax({
 				 url: 'inc/accounting_actions.php?action=delentryog&id='+val+'&bankid='+val2,
 					 success: function(data) {
						 $("#alerts").dialog( "close" );
						// alert(data);
   					$.ajax({
  url: 'inc/accounting_actions.php?action=getbankledge&glid='+val2,
  success: function(data) {
    $('#dio1').html(data);
	
  }
});	
  }
});
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	
}



////GET BANKS LISTS////
function grabBanks(page){

$.ajax({
  url: 'inc/accounting_actions.php?action=getallbanks&page='+page,
  success: function(data) {
    $('#bankholders').html(data);
  }
});	
}


///GETS MAIN LEDGER DETAILS//
function opnRuls(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=getledgdets&glid='+val,
  success: function(data) {
    $('#dio1').html(data);
	$("#edtnam").button();
	$("#delle").button();
	$( "#dio1" ).dialog({
			width: 990,
			resizable: false,
			modal: true,
			title: "View Ledger",
		});	
  }
});	
	
	
}

////GET VENDOR LIST
function opnRuls2(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=getledgdets2&glid='+val,
  success: function(data) {
    $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 990,
			resizable: false,
			modal: true,
			title: "View Ledger",
		});	
  }
});	
	
	
}

///OPENS LEDGER FOR SELECTED BANK ACCOUNT///
function opnbankRuls(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=getname&glid='+val,
  success: function(data0) {
  
			
	
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=getbankledge&glid='+val,
  success: function(data) {
    $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 990,
			resizable: false,
			modal: true,
			title: data0+" Ledger",
		});	
  }
});	
	}});
	
}

///ADD BILL///
function runaddBill(){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=newbillform',
  success: function(data) {
    $('#dio1').html(data);
	
	$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Add New Entry",
		});	
		
		$( "#billdate, #duedt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});	
		$(".ui-datepicker-trigger").addClass("fixdatpicker");
		$('.makerrsw').uniform();
		$( "#subbdbil" ).button();
	
  }
});
	

}


/////SWITCH PAYBILL DROPS////
function runbillDrops(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=switchposts&switch='+val,
  success: function(data) {
    $('#typacctdrp').html(data);
	$('.makerrswdrops').uniform();
  }
});
	
	
}

/////CLOSE DIALOG FOR NEW BILL//
function clsAddbill(){
$( "#dio1" ).dialog('close');	
}

function subNewbill(){
var isvend = $("#isvend").val();
var acctpost = $("#acctpost").val(); 
var refnum = $("#refnum").val();
var billdate = $("#billdate").val();
var terms = $("#terms").val();
var duedt = $("#duedt").val();
var status = $("#status").val();
var amntdue = $("#amntdue").val();
var glacctpost = $("#glacctpost").val();
var isvn = $("input[name='isvend']:checked").val();

//alert(acctpost);

if(refnum == ''){var er1 = 'Need Referance Number<br>';}else{var er1 = '';}
if(billdate == ''){var er2 = 'Need Bill Date<br>';}else{var er2 = '';}
if(duedt == ''){var er4 = 'Need Due Date<br>';}else{var er4 = '';}
if(status == 'none'){var er5 = 'Select Status<br>';}else{var er5 = '';}
if(amntdue == ''){var er6 = 'Amount Due<br>';}else{var er6 = '';}

if(er1 == '' && er2 == '' && er4 == '' && er5 == '' && er6 == ''){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=subnewbill&refnum='+refnum+'&billdate='+billdate+'&terms='+terms+'&duedt='+duedt+'&status='+status+'&amntdue='+amntdue+'&acctpost='+acctpost+'&glacctpost='+glacctpost,
  success: function(data) {
  $("#dio1").dialog( "close" );
  
  pullBilllist('1');
  }
});
	
}else{
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er1+' '+er2+' '+er4+' '+er5+' '+er6);
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


////GET ACTIVE BILL LISTS/////
function pullBilllist(val){
	$.ajax({
  url: 'inc/accounting_actions.php?action=activebills&page='+val,
  success: function(data) {
    $('#invcbillhold').html(data);
	$(function(){
$(".info_icon").tipTip();
});
  }
});
}

function delBill(val){
	
	$("#alerts").html('<strong style="color:#1053A3;">Notice</strong><br><span style="font-size:12px;">Are you sure you would like to delete this bill?</span>')
	
	$( "#alerts" ).dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Yes": function() {
					$( this ).dialog( "close" );
					$.ajax({
  url: 'inc/accounting_actions.php?action=deactivebills&bilid='+val,
  success: function(data) {
	 // alert('hi');
	  
	  pullBilllist('1');
  }});
					
					
				},
				"No": function() {
					$( this ).dialog( "close" );
				}
			}
		});
	
}

///EDIT BILL LIST///
function edBillout(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=editbillform&id='+val,
  success: function(data) {
  $("#dio1").html(data);
  
	
	$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Edit Bills",
		});
		$( "#billdate, #duedt" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});	
		$(".ui-datepicker-trigger").addClass("fixdatpicker");
		$('.makerrsw').uniform();
		$( "#subbdbil, #subbdbi3" ).button();
  }
});
	
	 
	
}

function edsbill(val){
//var isvend = $("#isvend").val();
//var acctpost = $("#acctpost").val(); 
var refnum = $("#refnum").val();
var billdate = $("#billdate").val();
///var terms = $("#terms").val();
var duedt = $("#duedt").val();
var status = $("#status").val();
var amntdue = $("#amntdue").val();
//var glacctpost = $("#glacctpost").val();
///var isvn = $("input[name='isvend']:checked").val();

if(refnum == ''){var er1 = 'Need Referance Number<br>';}else{var er1 = '';}
if(billdate == ''){var er2 = 'Need Bill Date<br>';}else{var er2 = '';}
if(duedt == ''){var er4 = 'Need Due Date<br>';}else{var er4 = '';}
if(status == 'none'){var er5 = 'Select Status<br>';}else{var er5 = '';}
if(amntdue == ''){var er6 = 'Amount Due<br>';}else{var er6 = '';}

if(er1 == '' && er2 == '' && er4 == '' && er5 == '' && er6 == ''){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=subnewbilled&refnum='+refnum+'&billdate='+billdate+'&duedt='+duedt+'&status='+status+'&amntdue='+amntdue+'&id='+val,
  success: function(data) {
	 
  $("#dio1").dialog( "close" );
  pullBilllist('1');
  }
});
	
}else{
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er1+' '+er2+' '+er4+' '+er5+' '+er6);
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

/////PAY WITH CHECK///

function payWithcheck(){
	
	//billpaypan
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=billpaypan',
  success: function(data) {
    $("#dio1").html(data);
  
	
	$( "#dio1" ).dialog({
			width: 871,
			resizable: false,
			modal: true,
			title: "Pay Bills",
		});	
		
		$( "#biduedt" ).datepicker({
			onSelect: function(dateText, inst) {runBillsorter(dateText)},
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true,
			
		});	
		$(".ui-datepicker-trigger").addClass("fixdatpicker");
		
		
		$( "#payddater" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});	
		$(".ui-datepicker-trigger").addClass("fixdatpicker");
		
		$('.billsty').uniform();
		$( "#savbut" ).button();
	}
});
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
         
         var getem = [];
		  var allVals = [];
         $(".checkers:checked").each(function() {
           allVals.push($(this).val());
		   //alert(allVals);
		   var amnt = $("#payamnt"+$(this).val()).val()+'='+$(this).val()+'!';
		   getem.push(amnt);
		  // alert(getem);
		   
         });
		// alert(allVals);
         $('#checkvals').val(getem)
      }
	  
	  function runBillsorter(val){
		  var whas = $("input[name='dateshow']:checked").val();
		  if(whas == 'seldate'){
		$.ajax({
  url: 'inc/accounting_actions.php?action=sorter&akspost=true&askdate='+val,
  success: function(data) {
    $('#billlines').html(data);
  }
});  
		  }else{
			  
			  $.ajax({
  url: 'inc/accounting_actions.php?action=sorter&akspost=false',
  success: function(data) {
    $('#billlines').html(data);
  }
});  
			  
		  }
	  }
	  
	  
	  ////RUN THE PAYMENTS ACCROSS THE VALIDATOR/////
	  
	  function checkMypays(){
		  
		  var payddater = $("#payddater").val();
		  var selbank = $("#selbank").val();
		  
		  var getem = [];
		  var allVals = [];
         $(".checkers:checked").each(function() {
           allVals.push($(this).val());
		   //alert(allVals);
		   var amnt = $("#payamnt"+$(this).val()).val()+'='+$(this).val()+'!';
		   getem.push(amnt);
		  // alert(getem);
		   
         });
		// alert(allVals);
         $('#checkvals').val(getem);
		 
		 var grabem = $('#checkvals').val();
		  
		  
		  if(selbank == 'none'){var er1 = 'Must Select Bank.<br>';}else{var er1 = '';}
		  if(payddater == ''){var er2 = 'Enter pay date.<br>';}else{var er2 = '';}
		  if(grabem == ''){var er3 = 'Select at least one bill to be paid.<br>';}else{var er3 = '';}
		  
		  if(er1 == '' && er2 == '' && er3 == ''){
			
		    $.ajax({
  url: 'inc/accounting_actions.php?action=goandpay&thevals='+grabem+'&bankaccnt='+selbank,
  success: function(data) {
    if(data == 'pass'){
		window.open('checkPrinter.php?thevals='+grabem);
		$("#dio1").dialog('close');
		pullBilllist('1');
	}else{
		  $("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">'+data);
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
}); 
		  }else{
			  
			  $("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er1+' '+er2+''+er3);
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
	  
	  
	  ////OPEN JOURNAL ENTRY FORM//
	  function opntruLedg(){
		  
		  $.ajax({
  url: 'inc/accounting_actions.php?action=getjorform',
  success: function(data) {
	  $( "#dio1" ).html(data);
	   $( "#dio1" ).dialog({
			width: 990,
			resizable: false,
			modal: true,
			title: "Journal Entry",
		});	
		
		$("#amountded, #glselect, #memo, #amountded2, #glselect2, #memo2, #jrndate").uniform();
		
		$( "#savejro" ).button();
		
		
		$( "#jrndate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});	
		$(".ui-datepicker-trigger").addClass("fixdatpicker");
    
  }
});
		  
}

function runtoCred(val){
	$("#amountded2").val(val);
	//$.uniform.update("#amountded2");
}

///SUBMIT JOURNAL ENTRY///
function subJourn(){
	var jrndate = $("#jrndate").val();
	var memo = $("#memo").val();
	var glselect = $("#glselect").val();
	var amountded = $("#amountded").val();
	
	var memo2 = $("#memo2").val();
	var glselect2 = $("#glselect2").val();
	var amountded2 = $("#amountded2").val();
	if(jrndate == ''){var er0 = 'Need Date';}else{var er0 = '';}
	if(glselect == 'none'){var er1 = 'Please select GL account for debit.<br>';}else{var er1 = '';}
	if(glselect2 == 'none'){var er2 = 'Please select GL account for credit.<br>';}else{var er2 = '';}
	
	
	
	if(glselect == glselect2){
		var er3 = 'Cannot select same GL for debit and credit.<br>';
	}else{
		var er3 = '';
	}
	
	
	if(amountded == ''){var er4 = 'Provide amount for debit.<br>';}else{var er4 = '';}
	if(amountded2 == ''){var er5 = 'Provide amount for credit.<br>';}else{var er5 = '';}
	
	if(amountded != amountded2){
		var er6 = '<div style="border-bottom:solid thin #CCC; height: 35px; margin-top:10px; margin-bottom:10px;"></div>The transaction is not in balance. Please make sure the total amount in the debit column equals the total amount in the credit column.';
	}else{
		var er6 = '';
	}
	
	if(er0 == '' && er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == ''){
		
			var memo = $("#memo").val();
	var glselect = $("#glselect").val();
	var amountded = $("#amountded").val();
	
	var memo2 = $("#memo2").val();
	var glselect2 = $("#glselect2").val();
	var amountded2 = $("#amountded2").val();
		
		$.ajax({
  url: 'inc/accounting_actions.php?action=subjornal&jrndate='+jrndate+'&memo='+memo+'&glselect='+glselect+'&amountded='+amountded+'&memo2='+memo2+'&glselect2='+glselect2+'&amountded2='+amountded2,
  success: function(data) {
	  alert(data);
   getJourns('1');
   $( "#dio1" ).dialog('close');
  }
});
		
	}else{
		
		$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er0+' '+er1+' '+er2+''+er3+' '+er4+' '+er5+' '+er6);
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


function runtoCred(val){
	$("#amountded2").val(val);
	//$.uniform.update("#amountded2");
}

///SUBMIT JOURNAL ENTRY///
function edsJourn(val){
	var jrndate = $("#jrndate").val();
	var memo = $("#memo").val();
	var glselect = $("#glselect").val();
	var amountded = $("#amountded").val();
	
	var memo2 = $("#memo2").val();
	var glselect2 = $("#glselect2").val();
	var amountded2 = $("#amountded2").val();
	if(jrndate == ''){var er0 = 'Need Date';}else{var er0 = '';}
	if(glselect == 'none'){var er1 = 'Please select GL account for debit.<br>';}else{var er1 = '';}
	if(glselect2 == 'none'){var er2 = 'Please select GL account for credit.<br>';}else{var er2 = '';}
	
	
	
	if(glselect == glselect2){
		var er3 = 'Cannot select same GL for debit and credit.<br>';
	}else{
		var er3 = '';
	}
	
	
	if(amountded == ''){var er4 = 'Provide amount for debit.<br>';}else{var er4 = '';}
	if(amountded2 == ''){var er5 = 'Provide amount for credit.<br>';}else{var er5 = '';}
	
	if(amountded != amountded2){
		var er6 = '<div style="border-bottom:solid thin #CCC; height: 35px; margin-top:10px; margin-bottom:10px;"></div>The transaction is not in balance. Please make sure the total amount in the debit column equals the total amount in the credit column.';
	}else{
		var er6 = '';
	}
	
	if(er0 == '' && er1 == '' && er2 == '' && er3 == '' && er4 == '' && er5 == '' && er6 == ''){
		
			var memo = $("#memo").val();
	var glselect = $("#glselect").val();
	var amountded = $("#amountded").val();
	
	var memo2 = $("#memo2").val();
	var glselect2 = $("#glselect2").val();
	var amountded2 = $("#amountded2").val();
		
		$.ajax({
  url: 'inc/accounting_actions.php?action=subjornaled&jrndate='+jrndate+'&memo='+memo+'&glselect='+glselect+'&amountded='+amountded+'&memo2='+memo2+'&glselect2='+glselect2+'&amountded2='+amountded2+'&id='+val,
  success: function(data) {
	  alert(data);
   getJourns('1');
   $( "#dio1" ).dialog('close');
  }
});
		
	}else{
		
		$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er0+' '+er1+' '+er2+''+er3+' '+er4+' '+er5+' '+er6);
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

function delJrnent(val){
	
	$( "#alerts" ).dialog( "destroy" );
	$("#alerts").html('<strong style="color:#1053A3;">Are you sure you want to remove this entry?</strong><br><span style="font-size:12px;">Removing entry will refund the origin of the funds.</span>');
	
		$( "#alerts" ).dialog({
			resizable: false,
			width:443,
			modal: true,
			title: "Confirm Action",
			buttons: {
				"Remove": function() {
					$.ajax({
  url: 'inc/accounting_actions.php?action=deljourns&id='+val,
  success: function(data) {
   getJourns('1');
   $( "#alerts" ).dialog('close');
	//alert(data);
  }
});
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		
}


///PULL JOURNAL LIST///
function getJourns(val){
	
$.ajax({
  url: 'inc/accounting_actions.php?action=getjourns&page='+val,
  success: function(data) {
    $('#journholders').html(data);
	//alert(data);
  }
});	
}

function canjorn(){
	$( "#dio1" ).dialog('close');
}

function edJrnen(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=editjorn&id='+val,
  success: function(data) {
	  $( "#dio1" ).html(data);
	   $( "#dio1" ).dialog({
			width: 990,
			resizable: false,
			modal: true,
			title: "Journal Entry",
		});	
		
		$("#amountded, #glselect, #memo, #amountded2, #glselect2, #memo2, #jrndate").uniform();
		
		$( "#savejro" ).button();
		
		
		$( "#jrndate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});	
		$(".ui-datepicker-trigger").addClass("fixdatpicker");
    
  }
});
	
}



function runTextnum(val){
	
	$.ajax({
  url: 'inc/accounting_actions.php?action=getnum&amount='+val,
  success: function(data) {
    $('#numtext').html(data);
  }
});	
}

function subsinCheck(){
	var chkdate = $("#chkdate").val();
	var glsel = $("#glsel").val();
	var amount = $("#amount").val();
	var memo = $("#memo").val();
	var bankacct = $("#bankacct").val();
	var glseltrue = $("#glseltrue").val();
	
	if(chkdate == ''){var er1 = 'Need Date<br>'; }else{var er1 = ''; }
	if(glsel == 'none'){var er2 = 'Select GL Account<br>'; }else{var er2 = ''; }
	if(amount == '' || amount == '0.00'){var er3 = 'Enter Amount<br>'; }else{var er3 = ''; }
	if(bankacct == 'none'){var er4 = 'Select Bank<br>'; }else{var er4 = ''; }
	
	if(er1 == '' && er2 == '' && er3 == '' && er4 == ''){
		
		window.open('checkPrinter2.php?date='+chkdate+'&glacct='+glsel+'&amount='+amount+'&memo='+memo+'&bankacct='+bankacct+'&glseltrue='+glseltrue);
	}else{
		
		$("#alerts").html('<strong style="color:#FFCC00;">An error has occurred!</strong><br><span style="font-size:12px;">Please make sure the following fields have values.</span><br><br>'+er1+' '+er2+''+er3+' '+er4);
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

function editinPay(val){
	///grabform
	$.ajax({
  url: 'inc/accounting_actions.php?action=grabform&id='+val,
  success: function(data) {
	$( "#dio1" ).html(data); 
	$("#telem").html('Making payment for Invoice: '+val);
$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Post a payment",
		});	
		
		
		$("#subbuts").button();
		$(".makerrs").uniform();
		
		$( "#setdate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker"); 
  }
  });
}

function subpayedit(val){
	var setdate = $("#setdate").val();
var checknum = $("#checknum").val();
var amount = $("#amountbn").val();
var bankset = $("#bankset").val();
var notes = $("#notes").val();


if(setdate == '' ){var er1 = 'Select Date<br>';}else{var er1 = '';}
if(checknum == '' ){var er2 = 'Check Number<br>';}else{var er2 = '';}
if(amount == '' ){var er3 = 'Amount to pay<br>';}else{var er3 = '';}
if(bankset == 'none' ){var er4 = 'Select a Bank<br>';}else{var er4 = '';}

if(er1 == '' && er2 == '' && er3 == '' && er4 == ''){
 $.ajax({
  url: 'inc/accounting_actions.php?action=raddspays&setdate='+setdate+'&checknum='+checknum+'&amount='+amount+'&notes='+notes+'&bank='+bankset+'&invid='+val,
  success: function(data) {
	  if(data == 'good'){
		  //recallEstis();
	  $( "#dio1" ).dialog( "close" );
	  }else{
		  
		  $("#alerts").html(data);
			
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
	
	$("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">Please complete the following fields to continue.</span><br><br>'+er1+' '+er2+' '+er3+' '+er4);
			
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


////EDIT OF EXPENSES///
function edExpe(val){
	$.ajax({
  url: 'inc/accounting_actions.php?action=editxpense&id='+val,
  success: function(data) {
    $('#dio1').html(data);
	$( "#dio1" ).dialog({
			width: 650,
			resizable: false,
			modal: true,
			title: "Edit Expense",
		});	
		
		$(".makerrs").uniform();
		
		$("#adbutton").button({
	 icons: {
                primary: "ui-icon-contact"
            },
			
			});
			
			$( "#setdate" ).datepicker({
				showOn: "button",
					buttonImage: "images/date_ico.png",
				buttonImageOnly: true,
				changeMonth: true,
			changeYear: true
		});
		
			$(".ui-datepicker-trigger").addClass("fixdatpicker");
  }
});	
	
}

function finExedit(val){
	var name = $("#name").val();
	var glnum = $("#glnum").val();
	$.ajax({
  url: 'inc/accounting_actions.php?action=updatreexp&name='+name+'&glnum='+glnum+'&id='+val,
  success: function(data) {
 getLines('expense','1');
 $( "#dio1" ).dialog('close');
  }
  });	
  
}

function delExpe(val){
	$.ajax({
  url: 'inc/accounting_actions.php?action=runchks&id='+val,
  success: function(data) {
	  if(data == 'good'){
		 getLines('expense','1'); 
	  }else{
		  
		  $("#alerts").html('<strong style="color:#1053A3;">An error has occurred!</strong><br><span style="font-size:12px;">'+data+'</span>');
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
  });
}

function changetheName(val){
	var gllnmm = $("#gllnmm").val();
	$.ajax({
  url: 'inc/accounting_actions.php?action=updatethename&gllnmm='+gllnmm+'&id='+val,
  success: function(data) {
 $("#confrmsucc").fadeIn('slow');
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
  }
  });
}

function getLinesinner(id,page){
	$.ajax({
  url: 'inc/accounting_actions.php?action=getledgdets&glid='+id+'&page='+page,
  success: function(data) {
	  
	  $("#contin").html(data);
	  $("#edtnam").button();
	$("#delle").button();
   
	 }	});	
 
}

//possersvends serVends(
////AUTO SEARCH VENDORS/////
function serVends(val){
	$.ajax({
  url: 'inc/accounting_actions.php?action=possersvends&serval='+val,
  success: function(data) {
	  if(data != ''){
	
	 $("#vendrops").html(data);
   $("#vendrops").show();
	  }
	}	});	
	
	
	
}

///SET VENDOR////

function setVendf(valz,valz2){
	//id="glsel"
	$("#glsel").val(valz);
	$("#glselo").val(valz2);
	$("#vendrops").html('');
	$("#vendrops").hide();
	getAddress(valz)
	
}

function getAddress(val){
	$.ajax({
  url: 'inc/accounting_actions.php?action=getaddress&glid='+val,
  success: function(data) {
	  
	  $("#addresshold").html(data);
	
	 }	});	
}