<?
include("main_config.php");

//die();
//unlink("/tmp/exempt.db");

try{
	$dbHandle = sqlite_open('/data/web/afternet/db/sqlite/exempt.db');
}catch( Exception $exception ){
	die("Error: ". $exception->getMessage());
}
/*
$sqlCreateTable = 'CREATE TABLE exemption(username CHAR(99), ip CHAR(16), timestamp INTEGER(100), remote_ip CHAR(6))';
sqlite_query($dbHandle,$sqlCreateTable);
$sqlCreateTable = 'CREATE TABLE captcha(captcha CHAR(50), ts INTEGER(100), file CHAR(1000))';
sqlite_query($dbHandle, $sqlCreateTable);
*/

$sqlCreateTable = 'delete from exemption';
$q = sqlite_query($dbHandle, $sqlCreateTable);
?>
