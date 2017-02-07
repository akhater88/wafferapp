var xmlHttp=createXmlHttpRequestObject();
var xmlresponse;
//----------------------------------------------

function createXmlHttpRequestObject(){
	var xmlHttpob;
	
	//Create xmlHttpRequest object (not IE browser)
	try{
		xmlHttpob=new XMLHttpRequest();
		}
	catch(e){
		try{
			xmlHttpob=new ActiveXObject("Msxml2.XMLHTTP");
			}
		catch(e1){
			try{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
			catch(e2){
				xmlHttpob=false;
				}
			}		
		}
	if(!xmlHttpob)
		alert("Error: can not create XMLHttpRequest object!");
	else{
		return xmlHttpob;
		}
	}
//-----------------------------------------------

function Add_New_Folder(SpanID,page_link,method,res_type,Field){ //Method and res are capitals. data = "POST" and res_type = "HTML"
			
			var Folder = document.getElementById(Field).value;
			
		if(xmlHttp){
				try{
					//data = 'Quantity='+Quantity+'&Item_ID='+Item_ID+'&Menu_Item='+Menu_Item;
					data = 'Target='+Folder;
					xmlHttp.open(method,page_link,true);
					if(method=='POST'){
						xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8");		
						}
					else{
						data=null;
						}
					xmlHttp.onreadystatechange=function (){
						if(xmlHttp.readyState == 4){
							if(xmlHttp.status == 200){
								try{
								//do something with the response
								if(res_type=='XML')	
									xmlresponse=xmlHttp.responseXML;
									
								else
								
									xmlresponse=xmlHttp.responseText;
									document.getElementById(SpanID).innerHTML = xmlresponse;
										
									//==============================
									}
								catch(e){
									alert("Error reading the response:\n" + e.toString());
									}
								}
							else{
								alert("There was a problem retrieving the data:\n" + xmlHttp.statusText);
								}
							}
						else{
							//do something while ready state not equal 4
							//waitProcess(function_flag);
							}
						}
					xmlHttp.send(data);
					}
				catch(e){
					alert("Can not connect to server:\n" + e.toString());
					}
				}
	}

//---------------------------------------------
function waitProcess(function_flag){
	
	switch(function_flag){
		case 'Loader':
		document.getElementById('Loader').style.display = 'block';
			break;
		}
	}
//-----------------------------------------------
