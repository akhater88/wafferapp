$(document).ready(function() { 
$.Show_Menu = function(MyDiv1,MyDiv2,MyDiv3) {
$('div.Order_Buttons').fadeOut('slow');
$('div#'+MyDiv1).fadeIn('slow');
$('div#'+MyDiv2).fadeIn('slow');
$('div#'+MyDiv3).fadeIn('slow');
};

$.Show_Div = function(Class,ID) {
$('div.'+Class).slideUp('slow');
$('div#'+ID).slideDown('slow');
};

});  