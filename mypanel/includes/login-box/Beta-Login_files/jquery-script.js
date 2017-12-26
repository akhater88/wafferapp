$(document).ready(function(){

	$("#login").Bounce(70);
	
	$("#footbar").slideDown("slow");
	
	$("input").focus(function(){ 
		$(this).parent().addClass("active");
	});
	$("input").blur(function(){ 
		$(this).parent().removeClass();
	});
	
	
	$('#login form').submit(function(e){
		e.preventDefault();
		
		var username = $("#username input").attr('value');
		var password = $("#password input").attr('value');
		
		$.ajax({
			type: "POST",
			url: 'test.php?name='+username+'&pw='+password+'',
			success: function(result) {
				if(result == "false") {
					$("#ajax_load").animate({opacity: 1.0}, 500).fadeOut(500);
					$("#messages").append('<div id="ajax_error">Anmeldung war nicht erfolgreich!</div>');
					$("#login").Shake(4);
				}
				else {
					$("#ajax_load").fadeOut(200);
					$("#messages").append('<div id="ajax_accept">Erfolgreich, sende an System...</div>');
					$("#ajax_accept").hide().show("slow",function(){ 
						setTimeout(function(){$("#login").slideUp(500);},500);
						setTimeout(function(){$('#login form')[0].submit();},1200);
					});
				}
			}
		})
	});
	
	$(".button")
			.ajaxStart(function(){
				$("#messages div").remove();
				$("#messages").append('<div id="ajax_load">Überprüfe Daten...</div>');
			});			
});
