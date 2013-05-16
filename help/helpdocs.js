function open_help ( page )
{
	helpwin = window.open( page, 'help', 'width=300, height=300, scrollbars=yes, menubar=no, status=no' );
	helpwin.focus();
}

function close_help ()
{
	window.close();
	window.opener.focus();
}