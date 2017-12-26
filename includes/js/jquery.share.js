// JavaScript Document
/**
 * jQuery Share Plugin
 *
 * This jQuery plugin has been tested in the following browsers:
 * - IE 7/8
 * - Firefox 3.5
 * - Opera 9.64
 * - Safari 4.0
 * - Chrome 2.0
 *
 * Required jQuery Libraries:
 * jquery.js         (v1.4.1)
 * jquery-ui.js      (v1.7.2)
 * jquery.cookie.js
 *
 */

// alias
window.jq = window.jQuery;

jq.fn.share = function(options){
	return jq.Share.getInstance(jq(this), options);
};

jq.Share = (function()  {
	// static private methods
	var FULL_BAR_WIDTH = 150;
	var STATIC_ICON_WH = 16;
	var REP_TITLE = "{title}";
	var REP_LINK = "{link}";
	var REP_DESC = "{desc}";

	/********************************************************************
	 * Javascript share method
	 * Facebook
	 * Reference - Facebook Content Share Parner:
	 * http://www.facebook.com/share_partners.php
	 * http://0123456789.tw/?p=909
	 * 
	 * Twitter, Plurk
	 * Reference - http://0123456789.tw/?p=909
	 * 
	 * Delicious
	 * Reference - http://delicious.com/help/savebuttons
	 ********************************************************************/
	var setting = {
		facebook: {url:"http://www.facebook.com/sharer.php?t="+REP_TITLE+"&u="+REP_LINK,
			tooltip:"facebook", openwindow:{width:626, height:436} },
		twitter: {url:"http://twitter.com/home/?status="+REP_TITLE+"     "+REP_LINK+"     "+REP_DESC,
			tooltip:"twitter", openwindow:{width:800, height:320} },
		plurk: {url:"http://www.plurk.com/?qualifier=shares&status="+REP_LINK+" ("+REP_TITLE+")     "+REP_DESC,
			tooltip:"plurk", openwindow:{width:1000, height:570} },
		delicious: {url:"http://delicious.com/save?v=5&noui&jump=close&title="+REP_TITLE+"&url="+REP_LINK+"&notes="+REP_DESC,
			tooltip:"delicious", openwindow:{width:550, height:550} },
		friendfeed: {url:"https://friendfeed.com/?title="+REP_TITLE+"&url="+REP_LINK,
			tooltip:"friendfeed", openwindow:{width:800, height:320} },
		myspace: {url:"http://www.myspace.com/index.cfm?fuseaction=postto&l=2&t="+REP_TITLE+"&u="+REP_LINK+"&c="+REP_DESC,
			tooltip:"myspace", openwindow:{width:800, height:500} },
	};

	function log(msg) {
		if(window.console != null) {
			console.log(msg);
		}
	}

	function generateShareUrl(type, title, link, desc) {
		var targetUrl = setting[type].url;
		return replaceUrl(targetUrl, title, link, desc);
	}

	function replaceUrl(targetUrl, title, link, desc) {
		if( targetUrl.indexOf(REP_TITLE) >= 0 ) {
			if( title != null ) {
				targetUrl = targetUrl.replace(REP_TITLE, encodeURIComponent(title));
			} else {
				targetUrl = targetUrl.replace(REP_TITLE, "");
			}
		}
		if( targetUrl.indexOf(REP_LINK) >= 0 ) {
			if( link != null ) {
				targetUrl = targetUrl.replace(REP_LINK, encodeURIComponent(link));
			} else {
				targetUrl = targetUrl.replace(REP_LINK, "");
			}
		}
		if( targetUrl.indexOf(REP_DESC) >= 0 ) {
			if( desc != null ) {
				targetUrl = targetUrl.replace(REP_DESC, encodeURIComponent(desc));
			} else {
				targetUrl = targetUrl.replace(REP_DESC, "");
			}
		}
		return targetUrl;
	}

	function openShareWindow(targetUrl, type) {
		var width = setting[type].openwindow.width;
		var height = setting[type].openwindow.height;
		window.open(targetUrl,"_blank","toolbar=0,status=0,width="+width+",height="+height);
	}

	function constructor(caller, options) {
		var shareIndex = 0;
		
		// instance private methods
		function initialize() {
			if( caller.children(".share_bar").get(0) == null ) {
				options = jq.extend({
					title: "",
					link: "",
					desc: ""
				}, options);

				// generate share id and save options
				var shareId = "share_bar_" + (shareIndex++);

				// build html
				caller.show();
				caller.append("<div id='"+shareId+"' class='share_bar ui-corner-all'></div>");
				var container = caller.children("div.share_bar");
				addShareButton(container, shareId);
			}
		}

		function addShareButton(container) {
			for( var key in setting ) {
				container.append("<div name='"+key+"' class='share_icon icon_"+key+"'></div>");
			}

			//container.children(".share_icon:last").css("marginRight", 0);
			container.children(".share_icon").each(function() {
				var btn = jq(this);
				// bind click event
				btn.click(function() {
					onShare(jq(this));
				});
			});
		}

		function onShare(btn) {
			var type = btn.attr("name");
			var title = options.title;
			var link = options.link;
			var desc = options.desc;
			shareUrl = generateShareUrl(type, title, link, desc);
			openShareWindow(shareUrl, type);
		}
		
		return { // instance public methods
			initialize: initialize
		};
	} // constructor end

	return { // static public methods
		getInstance: function(caller, options)	{
			instance = constructor(caller, options);
			instance.initialize();
			return instance;
		}
	}
})();