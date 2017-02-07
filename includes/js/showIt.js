(function($){
 $.fn.products = function(options) {
	var defaults = {
   		operation: 'delete',
   		location: 'http://www.softiletest.com/mymvc_test/',
   		slidUp: 'slidUp',
   		slideDown: 'slideDown'
    };
   var options = $.extend(defaults, options); 
   var opType = options.operation;
   obj = this; 
   $(obj).bind('click',function(){
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
				var ID = obj.attr('id');
				alert(ID);
				var Product_ID = options.slideDown+ID;
				alert(Product_ID);
				slideUp();
				slideDown_ID(Product_ID);
			}
		else
			{
				alert('None');
			}
	});
  	 function deleteItem()
   		{
			alert('Deleted');
		}
	function slideDown()
		{
			 $(options.slideDown).slideDown();
		}
	function slideDown_ID(Product_ID)
		{
			 $(Product_ID).slideDown();
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
