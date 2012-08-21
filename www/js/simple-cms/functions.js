// JavaScript Document

function checkSure(message, url)
{
	var sure = confirm(message);
	if (sure)
	{
		window.location = url;
	}
}