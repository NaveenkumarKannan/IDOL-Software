function enterevent(event,nextfield,previousfield)
{
	if ((event.keyCode == 13)||(event.keyCode == null))document.getElementById(nextfield).focus();

if (event.keyCode == 37) document.getElementById(previousfield).focus();
}

