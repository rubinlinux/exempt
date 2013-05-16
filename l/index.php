<?php
include("../main_config.php");

$eip =  $_GET["data"];
$ip = base64_decode($eip);

if (!$eip || !$ip)
  header("location: ".$doku_php_path."/doku.php");

$bits = explode(".", $ip);
$bip = $bits[3] . "." . $bits[2] . "." . $bits[1] . "." . $bits[0];
$host = $ip;
$exempt_IP = $ip;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<meta name="robots" content="noindex,follow,noarchive"/>
<script language="javascript" src="<?=$full_http_path?>/l/functions.js"></script>
<style type="text/css">
body	{ font-family:monospace;font-size:16px;background:#ffffff; }
span.tbig	{ font-size:18px;font-weight:bold; }
span.tyellow	{ font-size:18px;font-weight:bold;color:#990000;background:#ffff99;margin:0px;padding:2px; }
span.tred	{ font-size:18px;font-weight:bold;color:#ffff66;background:#cc0033;margin:0px;padding:2px; }
span.tgreen	{ font-size:18px;font-weight:bold;color:#ccff00;background:#339900;margin:0px;padding:2px; }
</style>
</head>
<body onLoad="init()">
<script type="text/javascript">
document.writeln('<center>');
var bar1 = createBar(300,15,'white',1,'black','blue',85,7,3,"");
document.writeln('</center><p>');
</script>
<p><div ID="process"></div></p>
<?php

flush();

require_once ($absolute_path .'/classes/ircclient.php');
require_once ($absolute_path .'/classes/template.php');
require_once ($absolute_path .'/l/regex.php');

global $irc_nick, $irc_user, $irc_name, $irc_host, $irc_server, $irc_server, $irc_botchan;
global $db_server, $db_port, $db_user, $db_pass, $db_database, $db_database;

$irc_nick       = 'web_exempt';
$irc_user       = 'afternet';
$irc_name       = 'BOPM Web Link';
$irc_host       = '127.0.0.1';
$irc_server     = '127.0.0.1:6667';

// Name of the bopm bot and channel:
$irc_botnick    = 'bopm';
$irc_botchan    = '#operations';

$db_server      = 'localhost';
$db_port        = '';
$db_user        = 'root';
$db_pass        = 'dzp113';
$db_database    = 'afternet2';
$db_table       = 'chanreg';

$exemption_IP;

$debug = 1;

function do_step_one ( )
{
    global $tpl, $irc, $irc_nick, $irc_user, $irc_name, $irc_host,
            $irc_server, $irc_botnick, $dbx, $db_server,
            $db_port, $db_user, $db_pass, $db_database,
            $db_table;
    
    $tpl->set_file ('main', 'templates/aup.html');
    $tpl->set_block ('main', 'ErrorBlock', 'error_used_block');
    $tpl->set_var ( array (
            'txtChannelName',
            'txtOwnerHandle',
            'txtOwnerPassword',
            'txtOwnerEmail',
            'remote_ip' => $_SERVER['REMOTE_ADDR']
    ) );
    include ("../lang/en.php");
    $tpl->pparse ('out', 'main');
}

function do_step_two()
{
	global $my, $tpl, $exempt_IP, $irc, $irc_nick, $irc_user, $irc_name, $irc_host,
           $irc_server, $irc_botnick, $dbx, $db_server,
		   $db_port, $db_user, $db_pass, $db_database,
		   $db_table;

	$errors = array();
	$i = 0;
/*	
	if ( !isset($_POST['iagree']) || $_POST['iagree'] <> 'true' )
        {
            $errors[] = '{errAupNotAccepted}';
        }
	if(!ip_ok($_POST['exempt_ip']))
	{
	    $errors[] = '{errBadIP}';
	}
	else
	    $exempt_IP = $_REQUEST['exempt_ip'];
*/
//$exempt_IP = $ip;

	if ( count ($errors) > 0 )
	{
		$tpl->set_file ('main', 'templates/aup.html');
		$tpl->set_var ( array ( 'txtexempt_ip' => $exempt_IP,
                                'remote_ip' => $_SERVER['REMOTE_ADDR']) );
		$tpl->set_block ('main', 'ErrorBlock', 'error_blk');
	
		for ($i = 0; $i < count ($errors); $i++)
		{
			$tpl->set_var ('error', $errors[$i]);
			$tpl->parse ('error_blk', 'ErrorBlock', true);
		}
		
		include ("../lang/en.php");
		$tpl->pparse ('out', 'main');
	}
	else 
	{
                @unlink('/tmp/irclog.log');
		$irc = new IRCClient ($irc_nick, $irc_user, $irc_name, $irc_host);
		$irc->irc_register_callback ('001', 'irc_on_connect');
		$irc->irc_register_callback ('433', 'irc_on_nicknameinuse');
//		$irc->irc_register_callback ('512', 'irc_on_nogline');
//		$irc->irc_register_callback ('280', 'irc_on_gline');
		$irc->irc_register_callback ('PRIVMSG', 'irc_on_privmsg');
		$irc->irc_register_callback ('NOTICE', 'irc_on_privmsg');
//                $irc->irc_register_callback ('QUIT', 'irc_on_quit');
                $irc->irc_register_callback ('timeout', 'irc_on_timeout');
		$irc->irc_connect($irc_server);
?>
<script type="text/JavaScript" language="JavaScript1.5">
document.getElementById("process").innerHTML = "<center><b>Processing</b></center>";
</script>
<?
flush();
                return;

	}
}

function ip_ok($ip)
{
	if(preg_match('/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/',$ip, $matches))
	{
	   for($i=1; $i<=4;$i++)
	   {
	   	if(!($matches[$i] <= 255 and $matches[$i] >=0))
		   return(FALSE);
	   }
	   return(TRUE);
	}
	else
	{
	   return(FALSE);
	}

}

/* The purpose of this is.. ??? */
function post_clean ( $key )
{
	return trim ($key);
}

function db_connect ()
{
	global $dbx;
	global $db_server, $db_port, $db_user, $db_pass, $db_database;
//	include("/data/web/shared/dokuwiki/lib/plugins/exempt/sqlite.php");
        $dbx = sqlite_open('/data/web/afternet/db/sqlite/exempt.db');
	return $dbx;
}

function db_query ( $query )
{
	$dbx = db_connect();
	$res = sqlite_query($dbx, $query);

	if (!$res) {
		global $tpl;
/*
		$tpl->set_file ('main', 'templates/dberror.html');
		$tpl->set_var ('query', $query);
		$tpl->set_var ('error', @mysql_error());
		$tpl->set_var ('errno', @mysql_errno());
		$tpl->pparse ('out', 'main');
*/
		die("uh oh");
	}

	return $res;
}

function irc_on_connect ( $data, $object )
{
    global $tpl, $irc, $irc_botchan, $exempt_IP, $irc_nick, $irc_user, $irc_name, $irc_host,
            $irc_server, $irc_botnick, $irc_oper, $dbx, $db_server,
	    $db_port, $db_user, $db_pass, $db_database,
	    $db_table;
		   
    /* We connected successfully. Send oper and scriptreg */
    // TODO: get the oper username/pass into a config file for god sake!
    $object->irc_send_msg("oper OPERNAME OPERPASSWORD");
    $object->irc_send_msg(preg_replace('/[\n]/','', "EXEMPT +*!*@$exempt_IP"));
?>
<script type="text/JavaScript" language="JavaScript1.5">
document.getElementById("process").innerHTML = "<center><b>Requesting Exemption</b></center>";
</script>
<?
flush();
    //echo "DEBUG: Asking for exemption<BR>";
    return(TRUE);
}


/* PRIVMSG & NOTICE TOO */
function irc_on_privmsg ( $data, $object )
{
	global $tpl, $irc, $exempt_IP, $irc_nick, $irc_user, $irc_name, $irc_host,
                   $irc_server, $irc_botchan, $irc_botnick, $dbx, $db_server,
		   $db_port, $db_user, $db_pass, $db_database,
		   $db_table, $my;

$message = $data[3];
$nick = $data[2];

?>
<script type="text/JavaScript" language="JavaScript1.5">
document.getElementById("process").innerHTML = "<center><b>Processing Results</b></center>";
</script>
<?
flush();

	$nick = substr ($nick, 0, strpos ($nick, '!'));
	
    $message = str_replace("\002", "", $message);
    $message = str_replace("\n", "", $message);

    /* The new /exempt reply code: */
    // :Scream.NL.AfterNET.Org NOTICE * :*** Notice -- Rubin adding DNSBL Exemption for *!*@127.0.0.1
    //                                                       DNSBL Exemption for *!*@127.0.0.1 already exists
   if(stristr($message, "adding DNSBL Exemption for *!*@$exempt_IP"))
   {
        $object->irc_disconnect();
	$now = time();
        $query = "insert into exemption (username, ip, timestamp, remote_ip) values('$my->username','$exempt_IP','$time','$_SERVER[REMOTE_ADDR]')";
            $res = db_query ($query);
        $tpl->set_file ('main', 'templates/success.html');
        $tpl->set_var ('exempt_ip', $exempt_IP);
        include ('../lang/en.php');
        $retcode = $tpl->pparse ('out', 'main');
        finish($retcode);
        return(FALSE);
   }
   elseif(stristr($message, "Exemption for *!*@$exempt_IP already exists"))
   {
         $object->irc_disconnect();
         $tpl->set_file('main', 'templates/duplicate.html');
         $tpl->set_var('exempt_ip', $exempt_IP);
         include('../lang/en.php');
         $retcode = $tpl->pparse('out', 'main');
         finish($retcode);
         return(FALSE);
   }
   return(TRUE);
}

function irc_on_nogline ( $data, $object )
{
    // :eNetwork.US.AfterNET.Org 512 Rewbin *@62.215.60.44 :No such gline
    //echo "DEBUG: There was no gline, so none removed<BR>";
    return(TRUE);
}

function irc_on_gline ( $data, $object )
{
    global $exempt_IP;

	// :eNetwork.US.AfterNET.Org 280 Rewbin *@62.215.60.45 1097175785 * + :<Jaden> Your access to the AfterNET IRC Network has been denied. [#non]
    list($gline, $reason) = split(':', $data[3]);
    list($mask, $timestamp) = split(' ', $gline);
    //echo "DEBUG: There was a gline on $mask expiring $timestamp :$reason<BR>";
    if(preg_match('/^AUTO BOPM/',$reason))
    {
        //echo "DEBUG: It looks like a BOPM gline, so I'm removing it for you:<BR>";
        $object->irc_send_msg(preg_replace('/[\n]/','', "PRIVMSG X2 :UNGLINE *@$exempt_IP"));
        $object->irc_send_msg(preg_replace('/[\n]/','', "PRIVMSG #BOPM :SENT: PRIVMSG x2 :UNGLINE *@$exempt_IP"));
    }
    else
    {
        //echo "DEBUG: It does not look like a BOPM gline though, so you are out of luck<BR>";
    }
    return(TRUE);
}

function irc_on_nicknameinuse ( $data, $object )
{
	global $irc;
	$irc->irc_nick = "{$irc->irc_nick}_";
	$irc->irc_send_msg (sprintf ("NICK %s", $irc->irc_nick));
    return(TRUE);
}

function irc_on_timeout($data, $object)
{
?>
<script type="text/JavaScript" language="JavaScript1.5">
document.getElementById("process").innerHTML = "<center><b>Time Out</b></center>";
</script>
<?
    finish("Sorry, the exemption process timed out. Please try again later, or contact us with the link on the left.");
    //echo "<pre>";
    //readfile('/tmp/irclog.log');
    //echo "</pre>";
    //unlink('/tmp/irclog.log');
    return(FALSE);
}

function do_login_first()
{
    global $tpl, 
            $irc, $irc_nick, $irc_user, $irc_name, $irc_host,
            $irc_server, $irc_botnick, $dbx, $db_server,
            $db_port, $db_user, $db_pass, $db_database,
            $db_table;

    $tpl->set_file ('main', 'templates/must_login.html');
    include ("../lang/en.php");
    $tpl->pparse ('out', 'main');
}

function do_show_too_many($reason)
{
    global $tpl,
            $irc, $irc_nick, $irc_user, $irc_name, $irc_host,
            $irc_server, $irc_botnick, $dbx, $db_server,
            $db_port, $db_user, $db_pass, $db_database,
            $db_table;

    $tpl->set_file ('main', 'templates/too_many.html');
    $tpl->set_var ('Error', $reason);
    include('../lang/en.php');
    $retcode = $tpl->pparse('out', 'main');
    finish($retcode);
}


function rate_limit()
{
    global $my;
    global $tpl, 
            $irc, $irc_nick, $irc_user, $irc_name, $irc_host,
            $irc_server, $irc_botnick, $dbx, $db_server,
            $db_port, $db_user, $db_pass, $db_database,
            $db_table;

// Disable most of these checks because they dont make any sense... theres no username they dont have accounts!!
    if(0) {
        /* 1 channel per day check */
        $yesterday = time() - (24 * 60 * 60);
        $strSQL = "
            select count(*) AS view
             FROM exemption   
            WHERE  username='$my->username' 
               AND timestamp > $yesterday
        ";
        $res = db_query($strSQL);
        $r = sqlite_fetch_array($res);
        if ($r["view"] > 15)
        {
            finish("You may exempt only 5 IP's per day. There are $r[view] since $yesterday");
        }

        /* 3 channels per month check */
        $lastmonth = time() - (24 * 60 * 60 * 30);
        $strSQL = "
            SELECT count(*) AS view
              FROM exemption
              WHERE username='$my->username'
                AND timestamp > $lastmonth
        ";
        $res = db_query($strSQL);
        $r = sqlite_fetch_array($res);
        if ($r["view"] > 100)
        {
            finish("You may exempt only 100 IP addresses per month");
        }
        /* max 100 per day for all users */
        $yesterday = time() - (24 * 60 * 60);
        $strSQL = "
            select count(*) AS view
             FROM  exemption
            WHERE timestamp > $yesterday
        ";
        $res = db_query($strSQL);
        $r = sqlite_fetch_array($res);
        if ($r["view"] > 100)
        {
            finish("Our exemption system is currently overloaded. Please check back tomorrow.");
        }
        /* max 3 channels per day for same IP address */
        $yesterday = time() - (24 * 60 * 60);
        $strSQL = "
            select count(*) AS view 
             FROM exemption
            WHERE timestamp > $yesterday
               AND remote_ip='$_SERVER[REMOTE_ADDR]'
        ";
        $res = db_query($strSQL);
        $r = sqlite_fetch_array($res);
        if ($r["view"] >= 5)
        {
            finish("Too many exemptions from your IP. Please contact us.");
        }
    }
    return FALSE;
}

function finish($retcode) {
  global $tpl, $irc, $exempt_IP, $irc_nick, $irc_user, $irc_name, $irc_host,
         $irc_server, $irc_botchan, $irc_botnick, $dbx, $db_server,
         $db_port, $db_user, $db_pass, $db_database, $db_table, $my;
  flush();
  $res = array();
  $last = "window.setTimeout(\"parent.rDone('LHSBL','" . $ip . "','";
  $last .= "');\",100);\n";
  array_push($res, $last);

  $temp = str_replace("\n", " ", $retcode);
  $temp = str_replace('"', '\'', $temp);
?>

</script>
<script type="text/JavaScript" language="JavaScript1.5">
function init() {
try		{ parent.rInit("0.1",""); }
catch(e)	{ alert("INTERNAL ERROR: cant access parent.rInit()\n"+e); stop(); };
parent.rInit("0.1","");
<?
foreach ($res as $resentry) {
  echo $resentry;
}
?>
}

bar1.togglePause();
parent.document.getElementById("current").innerHTML = "<?=$temp ?>";
// --></script>
</body></html>
<?
  flush();
  exit();
}


if (!$done) {
  $done = 1;
  flush();


  global $dbx, $tpl, $irc_nick, $irc_user, $irc_name, $irc_host;

  $dbx = db_connect();
  $tpl = new Template();
  $irc = new IRCClient ($irc_nick, $irc_user, $irc_name, $irc_host);

  $reason = rate_limit();
  if($reason)
    do_show_too_many($reason);
  else
    do_step_two();
}
?>
