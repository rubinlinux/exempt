<?php
$tpl->set_var (
	array (
	// page one
	'lblIAcceptAup'			=>	'I accept the above terms and the terms of the Acceptable Use Policy',
	'lblIDoNotAcceptAup'	=>	'I do not accept the above terms and the terms of the Acceptable Use Policy',
	'lblIP'                 =>      'IP Address',
	
	// page one errors
	'errAupNotAccepted'		=> 	'You must accept the terms of the AUP to continue.',
	'errBadIP'                      =>      'The IP address you entered is not valid.',
	
	// page two		
	'lblConfirmOwnerPassword'	=> 	'Confirm password',
	
	// page two errors
	'errInvalidIP'	=>	'You entered an invalid IP address [<a href="help/errInvalidIP.php" target="_blank" onclick="open_help(\'help/errInvalidIP.html\'); return false;">help</a>]',

	// generic
	'lblSubmitButton'		=>	'Continue',
	'hdrPageTitle'			=>	'AfterNET DNSBL Temporary Exemption System'
	)
);

$tpl->set_var ($_SERVER);
?>
