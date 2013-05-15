$(function() {
	var setdtr = $("#setdtr").val();
		$.ajax({
  url: 'inc/sched_actions.php?action=getsched&getdate='+setdtr,
  success: function(data) {

 $("#thesch").html(data);
	  //setupDates();
	  passData();
  }
  });
	});
	
	
	function migDay(val){
			$("#setdtr").val(val);
			
		$.ajax({
  url: 'inc/sched_actions.php?action=getsched&getdate='+val,
  success: function(data) {

 $("#thesch").html(data);
	  //setupDates();
	  passData();
  }
  });
	}
	
	
	
	////DATE PICKER CUSTOM//////
	
	function opnCuscal(){
		$("#holdcal").slideDown('fast');
	}
	
	$(document).mouseup(function (e)
{
    var container = $("#holdcal");

    if (container.has(e.target).length === 0)
    {
        container.slideUp('fast');
    }
}); 

	
	
	function passData(){
	$.ajax({
  url: 'getdates.php?action=getdates',
  success: function(data) {
    $("#holdcal").html(data)
  }
});

setDrags();
		}
		
		
		function runerMon(val){
			var year = $("#year").val();
			
		$.ajax({
  url: 'getdates.php?action=getdates&mon='+val+'&yr='+year,
  success: function(data) {
    $("#holdcal").html(data)
  }
});	
		}
		
		function runerYer(val){
			var month = $("#month").val();
			
		$.ajax({
  url: 'getdates.php?action=getdates&yr='+val+'&mon='+month,
  success: function(data) {
    $("#holdcal").html(data)
  }
});	
		}
		
		function migMo(val,val2){
			$.ajax({
  url: 'getdates.php?action=getdates&yr='+val2+'&mon='+val,
  success: function(data) {
    $("#holdcal").html(data)
  }
});	
		}
	
	
	//////SETUP DRAGGABLE BLOCKS/////
	
	function setDrags(){
		
		$( ".drgbl" ).draggable({ revert: 'invalid', zIndex: 2700
		
		 });
		$( ".droppable" ).droppable({
			drop: function( event, ui ) {
				var newPosX = ui.offset.left - $(this).offset().left;
				
				
				if(newPosX < 49 ){var tim = '7:00am';}
				if(newPosX > 49 && newPosX < 98){var tim = '8:00am';}
				if(newPosX > 98 && newPosX < 147){var tim = '9:00am';}
				if(newPosX > 147 && newPosX < 196){var tim = '10:00am';}
				if(newPosX > 196 && newPosX < 245){var tim = '11:00am';}
				if(newPosX > 245 && newPosX < 294){var tim = '12:00pm';}
				if(newPosX > 294 && newPosX < 343){var tim = '1:00pm';}
				if(newPosX > 343 && newPosX < 392){var tim = '2:00pm';}
				if(newPosX > 392 && newPosX < 441){var tim = '3:00pm';}
				if(newPosX > 441 && newPosX < 490){var tim = '4:00pm';}
				if(newPosX > 490 && newPosX < 539){var tim = '5:00pm';}
				if(newPosX > 539 && newPosX < 588){var tim = '6:00pm';}
				if(newPosX > 588 && newPosX < 637){var tim = '7:00pm';}
				if(newPosX > 637 && newPosX < 686){var tim = '8:00pm';}
				if(newPosX > 686 && newPosX < 735){var tim = '9:00pm';}
				if(newPosX > 735 && newPosX < 784){var tim = '10:00pm';}
				if(newPosX > 784 && newPosX < 833){var tim = '11:00pm';}
				if(newPosX > 833 && newPosX < 882){var tim = '12:00pm';}
				
				
				
				//alert($(this).attr("id"));
				//alert(ui.draggable.attr('id'));
				
				var tech = $(this).attr("id");
				var workorder = ui.draggable.attr('id');
				
				
				/////check time functions and tech assignments
				
				$.ajax({
  url: 'inc/sched_actions.php?action=docheck&tech='+tech+'&workorder='+workorder+'&tim='+tim,
  success: function(data) {
$("#alerts").html(data);
				$( "#alerts" ).dialog({
					width: 432,
			resizable: false,
			modal: true,
			buttons: {
				No: function() {
					$( ".drgbl" ).draggable({ revert: 'invalid',
		
		 });
					$( this ).dialog( "close" );
					var setdtr = $("#setdtr").val();
					migDay(setdtr);
				},
				
				'Yes': function() {
					$( this ).dialog( "close" );
					var setdtr = $("#setdtr").val();
					$.ajax({
  url: 'inc/sched_actions.php?action=setworkorder&tech='+tech+'&workorder='+workorder+'&tim='+tim+'&pos='+newPosX+'&datet='+setdtr,
  success: function(data) {
	 // alert(data);
 migDay(setdtr);
	 
	  setTimeout(function(){ $("#confrmsucc").fadeOut('slow') }, 5000);
  }
  });
					
					
				}
			}
		});
  }
  });
				
				
				
				
				
				
				
			}
		});
		
	}