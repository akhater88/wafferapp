(function($){
 $.fn.clicker = function() {
	// var options = $.extend(defaults, options); 
   	//var opType = options.operation;
   	obj = this;
	 var methods = {
    init : function( options ) { 
      // THIS 
    },
    show : function() {
      $(obj).bind('click',function()
								   {
									alert('gg');   
								   });
    },
    hide : function() { 
    alert('hide');
    },
    update : function( content ) { 
      // !!! 
    }
  };

 };
})(jQuery);
