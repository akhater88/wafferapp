(function($){
 $.fn.productOps = function(options) {
	var defaults = {
   		operation: 'delete',
   		url: 'http://www.softiletest.com/mymvc_test/',
		value: 0,
   		slidUp: 'slidUp',
   		slideDown: 'slideDown'
    };
   var options = $.extend(defaults, options); 
   var opType = options.operation;
   obj = this; 
  // $(obj).bind('click',function(){
		if(opType == 'delete')
			{
				deleteItem();
			}
		else if(opType == 'display')
			{
				slideUp();
				slideDown();
			}
		else if(opType == 'display id')
			{
				slideUp();
				slideDown();
			}
		else if(opType == 'ajax')
			{
				slideUp();
				initiateAjax();
			}
		else
			{
				alert('None');
			}
	//});
  	 function deleteItem()
   		{
			alert('Deleted');
		}
	function slideDown()
		{
			 $(options.slideDown).slideDown();
		}
	function initiateAjax()
		{
			var CID = options.value;
			var url = options.url;
			$.post(url,{CID:CID},function(data){
				$('.Display').html(data).delay(300);
				slideDown();
				});
		}
	function slideUp()
		{
			var Classes = new Array();
			Classes = options.slidUp.split(',');
			$.each(Classes, function(index,value){
			   $(value).slideUp();
			 });
		}
 };
})(jQuery);
