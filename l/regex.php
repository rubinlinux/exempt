<?php 
$_letter = "a-zA-Z";
$_digit = "0-9";
$_special = "\[\]\\`^{}|_-";
$_nonwhite = "\r\n ";
$_channel = "[#&][^{$_nonwhite},]";
$_nickname = "[{$_letter}][{$_letter}{$_digit}{$_special}]";
$_password = "[^{$_nonwhite}]";
$_email = "[{$_letter}{$_digit}.-]+@([{$_letter}{$_digit}.-]*\.[{$_letter}]{2,4})|(([{$_digit}]{1,3}\.){3}[{$_digit}]{1,3})";
?>
