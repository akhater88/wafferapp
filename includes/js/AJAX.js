// JavaScript Document
// holds an instance of XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();
// creates an XMLHttpRequest instance
function createXmlHttpRequestObject()
{
// will store the reference to the XMLHttpRequest object
var xmlHttp;
// this should work for all browsers except IE6 and older
try
{
// try to create XMLHttpRequest object
xmlHttp = new XMLHttpRequest(); 
}
catch(e)
{
// assume IE6 or older
var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
"MSXML2.XMLHTTP.5.0",
"MSXML2.XMLHTTP.4.0",
"MSXML2.XMLHTTP.3.0",
"MSXML2.XMLHTTP",
"Microsoft.XMLHTTP");
// try every prog id until one works
for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++)
{
try
{
// try to create XMLHttpRequest object
xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
}
catch (e) {}
}
}
// return the created object or display an error message
if (!xmlHttp)
alert("Error creating the XMLHttpRequest object.");
else
return xmlHttp;
} 

function Display_Drop_Down(SpanID,DropDown,Page)
{
	
	IDToDisplay = SpanID;
	var Name1 = document.getElementById(DropDown);
	var CID = Name1.options[Name1.selectedIndex].value;
	var sid = Math.floor(Math.random()*10000);
			// only continue if xmlHttp isn't void
			if (xmlHttp) 
			{
			// try to connect to the server
			try
			{
			// initiate reading the async.txt file from the server
			xmlHttp.open("GET", "index2.php?p="+Page+"&sid="+sid+"&CID="+CID, true);
			xmlHttp.onreadystatechange = handleInvoiceDisplay;
			xmlHttp.send(null);
			
			}
			// display the error in case of failure
			catch (e)
			{
			alert("Can't connect to server:\n" + e.toString());
			}
			}
}

function Display_Par(SpanID,Par,DropDown,Page)
{
	
	IDToDisplay = SpanID; 
	var Value = document.getElementById(Par).value;
	Value = encodeURI(Value);
	var Name1 = document.getElementById(DropDown);
	var Target_2 = Name1.options[Name1.selectedIndex].value;
	var sid = Math.floor(Math.random()*10000);
			// only continue if xmlHttp isn't void
			if (xmlHttp) 
			{
			// try to connect to the server
			try
			{
			var Page = Page+'Target/'+Value+'/Target_2/'+Target_2;
			// initiate reading the async.txt file from the server
			xmlHttp.open("GET",Page, true);
			xmlHttp.onreadystatechange = handleInvoiceDisplay;
			xmlHttp.send(null);
			
			}
			// display the error in case of failure
			catch (e)
			{
			alert("Can't connect to server:\n" + e.toString());
			}
			}
		document.getElementById(Par).value = '';
		var Name1 = document.getElementById(DropDown);
   		Name1.options[0].selected = true;    
} 

function Display_Single_Par(SpanID,Par,Page)
{
	IDToDisplay = SpanID; 
	var Value = document.getElementById(Par).value;
	Value = encodeURI(Value);
	var sid = Math.floor(Math.random()*10000);
			// only continue if xmlHttp isn't void
			if (xmlHttp) 
			{
			// try to connect to the server
			try
			{
			var Page = Page+'Target/'+Value;
			
			// initiate reading the async.txt file from the server
			xmlHttp.open("GET",Page, true);
			xmlHttp.onreadystatechange = handleInvoiceDisplay;
			xmlHttp.send(null);
			
			}
			// display the error in case of failure
			catch (e)
			{
			alert("Can't connect to server:\n" + e.toString());
			}
			}   
} 

function handleInvoiceDisplay()
{
// obtain a reference to the <div> element on the page
myDiv = document.getElementById(IDToDisplay);
// Use the following to tell the user what is happenning (good to use when connecting to database)
/* if (xmlHttp.readyState == 1)
{
myDiv.innerHTML += "Request status: 1 (loading) <br/>";
}
else if (xmlHttp.readyState == 2)
{
myDiv.innerHTML += "Request status: 2 (loaded) <br/>";
}
else if (xmlHttp.readyState == 3)
{
myDiv.innerHTML += "Request status: 3 (interactive) <br/>";
}
// when readyState is 4, we also read the server response
else */

if (xmlHttp.readyState == 4)
{
// continue only if HTTP status is "OK"
if (xmlHttp.status == 200)
{
try
{

// read the message from the server
response = xmlHttp.responseText;
// display the message
myDiv.innerHTML = response;
}
catch(e)
{
// display error message
alert("Error reading the response: " + e.toString());
}
}
else
{
// display status message
alert("There was a problem retrieving the data:\n" +
xmlHttp.statusText);
}
}
}