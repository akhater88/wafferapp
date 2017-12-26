function RedirectToCustomizedWindow(Location,Title,W,H)
	{
		yahoowin=dhtmlwindow.open('Charts', 'iframe',Location,Title, 'width='+W+'px,height='+H+'px,resize=1,scrolling=1,center=1');
	}
function RedirectToCustomizedWindow_Drop_Down(Location,Title,W,H,DropDown)
	{
		var Name1 = document.getElementById(DropDown);
		var Target = Name1.options[Name1.selectedIndex].value;
		if(Target != '0')
			{
				var Location = Location+'DrpDown/'+Target;
				yahoowin=dhtmlwindow.open('Charts', 'iframe',Location,Title, 'width='+W+'px,height='+H+'px,resize=1,scrolling=1,center=1');
			}
		else
			{
				alert('You must select an offer from the menu');
			}
	}
function RedirectModified(Location)
{
	window.location = Location;
}
function RedirectModified_Par(Location,Par)
{
	var Target = document.getElementById(Par).value;
	window.location = Location+Target;
}
function RedirectToDeleteModified(Location)
{
	var c = confirm("This action will delete selected record. Continue?");
	if(c)
		{
			window.location = Location;
		}
}
function NavigateDroDown(DropDown,Location)
	{
		var Name1 = document.getElementById(DropDown);
		var Target = Name1.options[Name1.selectedIndex].value;
		if(Target)
			{
				window.location = Location+Target;
			}
		else
			{
				alert("You must select from the menu");
				window.location = Location;
			}
	}
function Show_Element(Par)
	{
		document.getElementById(Par).style.display = 'block'
	}