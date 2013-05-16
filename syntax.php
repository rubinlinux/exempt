<?php

/**
 * AfterNET Java Chat
 *
 * Please create the directory "exempt" in your installation of
 * DokuWiki. Now you can put there any HTML or PHP File you want to
 * this directory.
 *
 * <exempt>
 * 
 * The syntax includes the PHP file per include an puts the result into
 * the wiki page.
 *
 * @license    GNU_GPL_v2
 * @author     Neil_Spierling_<sirvulcan@gmail.com>
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

class syntax_plugin_exempt extends DokuWiki_Syntax_Plugin {
    function getInfo(){
        return array(
            'author' => 'Neil Spierling',
            'email'  => 'sirvulcan@sirvulcan.co.nz',
            'date'   => '2007-08-14',
            'name'   => 'DNSBL Exemption',
            'desc'   => 'Allows a user to get DNSBL exempted on the IRC Network',
            'url'    => 'http://www.afternet.org',
        );
    }
 
 
    function getType(){ return 'container'; }
    function getPType(){ return 'normal'; }
    function getAllowedTypes() { 
        return array('substition','protected','disabled');
    }
    function getSort(){ return 195; }
 
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<exempt>',$mode,'plugin_exempt');
    }
    function handle($match, $state, $pos, &$handler){
 
        switch ($state) {
          case DOKU_LEXER_SPECIAL :
            return array($state, $match);
 
          default:
            return array($state);
        }
    }
 
    function render($mode, &$renderer, $indata) {
        include('/data/web/shared/dokuwiki/lib/plugins/exempt/main_config.php');
        if($mode == 'xhtml'){
          list($state, $data) = $indata;
 
          switch ($state) {
            case DOKU_LEXER_SPECIAL :
              $renderer->info['cache'] = FALSE;
              ob_start();
require_once ($absolute_path .'/classes/template.php');
require_once ($absolute_path .'/classes/hn_captcha.class.x1.php');
require_once ($absolute_path .'/classes/php-captcha.inc.php');
include      ($absolute_path. '/hn_config.php');

?>

<meta name="robots" content="index,follow,noarchive"/>
<style type="text/css">
/* body		{ font-family:Tahoma,sans-serif;font-size:0.94em;cursor:default; } */
/* a		{ color:#003399;text-decoration:underline;cursor:pointer; } */
/* a:hover		{ background-color:#ffffcc; }*/
/* a:active	{ background-color:#ccffff;cursor:wait; }*/
tt		{ font-family:monospace;font-size:0.92em;text-decoration:none; }
form		{ border:0;margin:0;padding:0; }
img		{ border:0; }
div.lookup	{ width:680px;height:52px;margin:0;padding:0; }
/* table.lookup	{ height:48px;table-layout:fixed;font-size:0.94em;margin:0;padding:3px 0 0 4px; } */
span.lookup	{ position:absolute;z-index:1;left:286px;top:5px;margin:0;padding:1px 4px;border:1px inset;font-size:14px; }
/* form.lookup	{ position:relative;Xz-index:1;left:284px;Xtop:6px;border:1px inset; } */
/* form.lookup	{ border:1px dotted; } */
/* input.query	{ height:24px;width:320px;font-family:monospace;font-size:18px;font-weight:bold;letter-spacing:1px;Xborder:1px inset #666666;border:1px solid #006600;background:#e8ffcc;color:#003300;cursor:text;margin:0;padding:0 0 0 3px; } */
/* input.submit	{ height:24px;width:88px;font-weight:bold;border-width:1px;margin:0;padding:0;cursor:pointer;Xbackground:none;color:#006600; } */
div.panel	{ width:680px;background-color:#666666; }
table.panel	{ background:#f0f0f0;border:1px inset #999999;horizontal-align:center;table-layout:fixed; }
input.panel	{ width:108px;height:20px;margin:1px;padding:0px;Xfont-family:sans-serif;font-size:12px;cursor:pointer; }
textarea.panel	{ font-family:monospace;Xwidth:100%;width:668px;Xfont-size:12px;background:#ccffff;border:2px groove #66ffff;padding:2px;margin:0px; }
div.ruler	{ width:680px;height:2px;background-color:#808080;Xborder:1px outset;margin:0;padding:0;font-size:0; }
div.detail	{ width:680px;background-color:#666666 }
table.detail	{ background:#f0f0f0;border:1px inset #999999;horizontal-align:center;table-layout:fixed;Xmargin:4px;padding:3px 0 0 5px; }
div.foot	{ width:680px;margin:0;padding:0; }
table.foot	{ height:18px;table-layout:fixed;font-size:11px;color:#333333;horizontal-align:center;border:0; }
table.foot a	{ color:#333366;text-decoration:none;Xborder:1px outset; }
div.p1		{ position:absolute;left:2px;top:4px;display:none;z-Index:401; }
table.p1	{ background-color:#AD9410;border:2px outset #D6C610; }
iframe.p1	{ width:655px;height:420px;frameborder:0;border:1px inset #D6C610;background:#ffffff; }
div.p2		{ position:absolute;left:132px;top:54px;display:none;z-Index:402; }
table.p2	{ background-color:#083194;border:2px outset #3152A5; }
iframe.p2	{ width:420px;height:160px;border:1px inset #3152A5;background:#ffffff; }
div.p3		{ position:absolute;left:104px;top:80px;width:460px;display:none;z-Index:403; }
table.p3	{ background-color:#AD0000;border:3px outset #D60000; }
td.p3		{ width:450px;height:180px;background:#ffffff;border:1px inset #D60000;margin:0px;padding:4px;font-family:monospace;font-size:16px;text-align:center; }
div.p4		{ position:absolute;left:130px;top:56px;width:470px;Xdisplay:none;z-Index:404; }
table.p4	{ background-color:#218429;border:3px outset #299C39; }
td.p4		{ width:408px;height:88px;background:#ffffff;border:1px inset #299C39;margin:0px;padding:4px;font-family:monospace;font-size:16px;text-align:center; }
td.pbot		{ font-size:14px;color:#ffffff;Xfont-weight:bold; }
input.pbot	{ font-size:12px;font-weight:bold;height:20px;border-width:1px;margin:0px;padding:0px;cursor:pointer; }
input.b16	{ font-size:10px;font-weight:bold;height:16px;width:16px;border:outset 1px;margin:0px;padding:0px;cursor:pointer;color:#333333; }
ul.info		{ font-size:14px;padding:4px;margin:2px 4px 4px 12px;border:1px dotted #999999;Xbackground:#ffffff;list-style-type:circle; }
span.fmt	{ position:absolute;z-index:1;top:8px;left:80px;margin:0;padding:0;border:none;color:#808080;font-size:0.75em; }
span.fmt select	{ width:64px;height:16px;margin:0;padding:0;border:0;none;font-size:10px;background:#b7b7b7; }
span.disp	{ position:absolute;z-index:100;top:6px;left:32px;padding:2px 0;font-size:11px;Xfont-family:sans-serif;border:1px inset; }
a.disp		{ padding:1px 2px;margin:2px 0;border:1px outset;color:#000080;text-decoration:none; }

	p.captcha_1,
	p.captcha_2,
	p.captcha_notvalid
	{
		margin-left: 30px;
		margin-right: 20px;
		font-size: 12px;
		font-style: normal;
		font-weight: normal;
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		background: transparent;
		color: #000000;
	}
	p.captcha_2
	{
		font-size: 10px%;
		font-style: italic;
		font-weight: normal;
	}
	p.captcha_notvalid
	{
		font-weight: bold;
		color: #FFAAAA;
	}
	
	.captchapict
	{
		margin: 0px 0px 0px 0px;
		padding: 0px 0px 0px 0px;
		border-width: 4px;
		border-color: #C0C0C0;
	}
	
	#captcha
	{
		margin-left: 30px;
		margin-right: 30px;
		border-style: dashed;
		border-width: 2px;
		border-color: #FFD940;
	}

	#capt
	{
		border-style: dashed;
		border-width: 2px;
		border-color: #FFD940;
	}

</style>

<script type="text/javascript" language="JavaScript1.5">
var j='1.5';
var jsVersion='1.5';
if(document.getElementById)
{
    j='dom';	// w3c
    if(navigator.cookieEnabled&&document.cookie.indexOf('j=dom')<0) document.cookie='j=dom; path=/; domain=127.0.0.1;';
}
</script>
<script type="text/javascript" language="JavaScript">
if(!j||(j!='dom'&&j!='w3c'))
{
var t='<'+'h3>JavaScript 1.5 (DOM) required<'+'/h3>'
+'<'+'li>this application uses DOM for portability with all modern browsers,<br>'
+'and has been tested with recent versions of <'+'a href="http:/'+'/www.mozilla.org/products/firefox/">Firefox<'+'/a>, Opera and MSIE.<'+'/li>'
+'<'+'li> Your JavaScript implementation is below version 1.5 and outdated.<br>Please update your browser</'+'li>'
}
</script>
<?
$ts = time();

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


function do_login_first($tpl)
{
    $tpl->set_file ('main', 'templates/must_login.html');
    include ("lang/en.php");
    echo $tpl->pparse ('out', 'main');
}

function do_step_two($tpl) {
    $tpl->set_file ('main', 'templates/aup.html');
    $tpl->set_block ('main', 'ErrorBlock', 'error_used_block');
    $tpl->set_var ( array (
            'txtChannelName',
            'txtOwnerHandle',
            'txtOwnerPassword',
            'txtOwnerEmail',
    ) );
    include ("lang/en.php");
    echo $tpl->pparse ('out', 'main');
}

function get_song($ts, $absolute_path) {
//  include('/data/web/shared/dokuwiki//tmp/sqlite.php');
  $dbHandle = sqlite_open('/data/web/afternet/db/sqlite/exempt.db');
  $sql = "SELECT file FROM captcha WHERE ts=\"".$ts."\"";
  $result = sqlite_query($dbHandle, $sql);
  $fetch = sqlite_fetch_array($result);

  $row = $fetch["file"];

  $tp = "/data/web/afternet/www/lib/tmp";
  $fp = "/data/web/afternet/www/lib/tmp/$row";
  if (!file_exists($fp.".mp3")) {
     shell_exec("/usr/bin/lame --quiet --abr 56 $tp/$row.wav $tp/".$row."_.mp3");
     shell_exec("/usr/bin/lame --quiet --resample 22.05 $tp/".$row."_.mp3 $tp/$row.mp3");
  }

  sqlite_close($dbHandle);
  return $row;
}

function cleanup()
{
//  include('/data/web/shared/dokuwiki//tmp/sqlite.php');
  $dbHandle = sqlite_open('/data/web/afternet/db/sqlite/exempt.db', 0666, $sqliteerror);
  if ($sqliteerror) {
    die("Error: ". $sqliteerror);
  }
  $sql = "SELECT captcha,ts,file FROM captcha";
  $result = sqlite_query($dbHandle, $sql);

  if ($result) {
    $tim = time();
    while ($row = sqlite_fetch_array($result)) { 
      list($captcha, $ts, $file) = $row;
      $add = $ts + 600;
      if ($add < $tim) {
        //echo "deleting $id $captcha $ts $file ($add $tim )<br>";
        @unlink("/data/web/afternet/www/lib/tmp/".$file.".wav");
        @unlink("/data/web/afternet/www/lib/tmp/".$file.".mp3");
        @unlink("/data/web/afternet/www/lib/tmp/".$file."_.mp3");
        $dbHandle2 = sqlite_open("/data/web/afternet/db/sqlite/exempt.db", 0666, $dberror);
        $del = "delete from captcha where captcha='$captcha' and file='$file'";
        $result = sqlite_query($dbHandle2, $del);
        sqlite_close($dbHandle2);
      }
    }
//    echo "test: $id $captcha $ts $file\n";
  }
  sqlite_close($dbHandle);
}

function do_flash($ts, $absolute_path, $short_http_path)
{
  $song = get_song($ts, $absolute_path);
?>
<p class="captcha_1">
<object
  classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
  codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0"
  width="78" height="20">

  <param name="movie" value="/lib/plugins/exempt/flash/mp3player.swf">
  <param name="quality" value="high" />
  <PARAM NAME="FlashVars" VALUE="file=/lib/tmp/<?=$song?>.mp3&showeq=false&showdigits=false&showicons=false&shownavigation=false">

  <embed src="/lib/plugins/exempt/flash/mp3player.swf" width="78" height="20"
    FLASHVARS="file=/lib/tmp/<?=$song?>.mp3&showeq=false&showdigits=false&showicons=false&shownavigation=false" 
     type="application/x-shockwave-flash" 
    pluginspage="http://www.macromedia.com/go/getflashplayer">
  </embed>
</object>
</p>
<?
}

$form = 0;
$tpl = new Template();
$captcha =& new hn_captcha_X1($CAPTCHA_INIT, $ts);
cleanup();
/*
if(!$_SERVER['REMOTE_USER']) {
  do_login_first($tpl);
  return true;
}
*/

if (!isset($_POST['iagree']) && ($_POST['iagree'] <> 'true' ) ) {
  $form = 1;
  do_step_two($tpl);
  echo $captcha->display_form($ts, true, $full_http_path);
  $oAudioCaptcha = new AudioPhpCaptcha('/usr/bin/flite', '/data/web/afternet/www/lib/tmp/', $captcha->getpriv(), true, $ts);
  $oAudioCaptcha->Create();
  do_flash($ts, $absolute_path, $short_http_path);
  echo $captcha->display_form_2($ts, $short_http_path);
  echo '</form>';
  return true;
}

$errors = array();
$i = 0;

if ( !isset($_POST['iagree']) || $_POST['iagree'] <> 'true' )
  $errors[] = '{errAupNotAccepted}';

if ( count ($errors) > 0 ) {
  $tpl->set_file ('main', 'templates/aup.html');
  $tpl->set_var ( array ( 'txtexempt_ip' => $exempt_IP,
                          'remote_ip' => $_SERVER['REMOTE_ADDR']) );
  $tpl->set_block ('main', 'ErrorBlock', 'error_blk');

  for ($i = 0; $i < count ($errors); $i++) {
    $tpl->set_var ('error', $errors[$i]);
    $tpl->parse ('error_blk', 'ErrorBlock', true);
  }

  include ("lang/en.php");
  echo $tpl->pparse ('out', 'main');
  echo $captcha->display_form($ts, true, $full_http_path);
  $oAudioCaptcha = new AudioPhpCaptcha('/usr/bin/flite', '/data/web/afternet/www/lib/tmp/', $captcha->getpriv(), true, $ts);
  $oAudioCaptcha->Create();
  do_flash($ts, $absolute_path, $short_http_path);
  echo $captcha->display_form_2($ts, $short_http_path);
  echo "</form>";
  return true;
}

switch($captcha->validate_submit()) {
case 1: //valid code
    if (( !isset($_POST['iagree']))  || ($_POST['iagree'] <> 'true') && ($form == 0)) {
      $form = 1;
      do_step_two($tpl);
      echo $captcha->display_form($ts, false, $full_http_path);
      $oAudioCaptcha = new AudioPhpCaptcha('/usr/bin/flite', '/data/web/afternet/www/lib/tmp/', $captcha->getpriv(), true, $ts);
      $oAudioCaptcha->Create();
      do_flash($ts, $absolute_path, $short_http_path);
      echo $captcha->display_form_2($ts, $short_http_path);
      echo "</form>";
      break;
    } else {
      // all gud
      break;
    }

  case 2: // invalid code
    if ($form == 0) {
      $form = 1;
      do_step_two($tpl);
      echo $captcha->display_form($ts, false, $full_http_path);
      $oAudioCaptcha = new AudioPhpCaptcha('/usr/bin/flite', '/data/web/afternet/www/lib/tmp/', $captcha->getpriv(), true, $ts);
      $oAudioCaptcha->Create();
      do_flash($ts, $absolute_path, $short_http_path);
      echo $captcha->display_form_2($ts, $short_http_path);
      echo "</form>";
      return true;
    } else
      return true;

  case 3: // too many attempts
    echo("Too Many Invalid Attempts");
    return true;

  default:
    if ($form == 0) {
      $form = 1;
      do_step_two($tpl);
      echo $captcha->display_form($ts, false, $full_http_path);
      $oAudioCaptcha = new AudioPhpCaptcha('/usr/bin/flite','/data/web/afternet/www/lib/tmp/', $captcha->getpriv(), true, $ts);
      $oAudioCaptcha->Create();
      do_flash($ts, $absolute_path, $short_http_path);
      echo $captcha->display_form_2($ts, $short_http_path);
      echo "</form>";
      return true;
    } else
      return true;
}

?>
<p><div ID="current">
<?
$tpl->set_file ('main', 'templates/ip.html');
$tpl->set_block ('main', 'ErrorBlock', 'error_used_block');
$tpl->set_var ( array (
        'txtChannelName',
        'txtOwnerHandle',
        'txtOwnerPassword',
        'txtOwnerEmail',
        'remote_ip' => $_SERVER['REMOTE_ADDR'] 
) );
include ("lang/en.php");
echo $tpl->pparse ('out', 'main');
?>
</div></p>

<noscript>
<font color="red"><b>ERROR: JavaScript1.5 &amp; W3C-DOM required</b></font>
<br>this application uses DOM for portability with all modern browsers and
<br>has been tested with recent versions of <a href="http://www.mozilla.org/products/firefox/">Firefox 1.x</a>, Opera8 and MSIE6.
<br>Please enable JavaScript (MSIE: Active Scripting) and reload this page
</p></noscript>

<div id="p1" class="p1" style="display:none"><table class="p1" Xborder=1><tbody><tr>
 <td width="6%"><input type="button" class="b16" onClick="history.go(-1)" value="<" title="History Back"/><input type="button" class="b16" onClick="history.go(1)" value=">" title="History Forward"/></td>
 <td width="88%" align="center"><font color="#ffff99"><b><span id="p1t">p1t</span></b></font></td>
 <td width="6%" align="right"><input type="button" id="p1o" class="b16" onClick="wOpen(this.title,'p1w');wClose(1)" value="^" title="Open in Window"><input type="button" id="p1x" class="b16" onClick="wClose(-1)" title="Close" value="X"></td>
</tr>
<tr><td colspan="3"><iframe id="p1i" name="p1i" class="p1" framemborder=0 scrolling="yes"></iframe></td></tr>
<tr><td class="pbot">&#9674;</td><td class="pbot" align="center"><input type="button" class="pbot" id="p1b" onClick="wClose(-1)" value="Close Window"></td><td class="pbot" align="right">&#9674;</td></tr>
</tbody></table></div>

<div id="p2" class="p2" style="display:none"><table class="p2"><tbody><tr>
 <td width="6%" class="pbot">&#9674;</td>
 <td width="82%" align="center"><font color="#ffff99"><b><span id="p2t">p2t</span></b></font></td>
 <td width="12%" align="right"><input type="button" id="p2x" class="b16" onClick="wClose(-2)" title="Close" value="X"></td>
</tr>
<tr><td colspan="3"><iframe class="p2" id="p2i" name="p2i" scrolling="no" Xframeborder=0></iframe></td></tr>
<tr><td class="pbot">&#9674;</td><td align="center"><input type="button" class="pbot" id="p2b" onClick="wClose(-2)" value="Cancel"></td><td class="pbot" align="right">&#9674;</td></tr>
</tbody></table></div>

<div id="p3" class="p3" style="display:none"><table class="p3"><tbody><tr>
 <td width="6%" class="pbot">&#9674;</td>

 <td width="82%" align="center"><font color="#ffff00"><b><span id="p3t">p3t</span></b></font></td>
 <td width="12%" align="right"><input type="button" id="p3x" name="p3x" class="b16" onClick="wClose(-3)" title="close" value="X"></td>
</tr>
<tr><td colspan="3" class="p3"><tt><div id="p3v" class="p3v">p3v</div></tt></td></tr>
<tr><td class="pbot">&#9674;</td><td align="center"><input type="button" class="pbot" id="p3b" onClick="wClose(-3)" value="Close Alert"></td><td class="pbot" align="right">&#9674;</td></tr>
</tbody></table></div>

<div id="p4" class="p4" Xstyle="display:none"><table class="p4"><tbody><tr>
 <td width="6%" class="pbot">&#9674;</td>
 <td width="82%" align="center"><font color="#ffff00"><b><span id="p4t">Init</span></b></font></td>

 <td width="12%" align="right"><input type="button" id="p4x" name="p4x" class="b16" onClick="wClose(-4)" title="close" value="X"></td>
</tr>
<tr><td colspan="3" class="p4"><center><tt><div id="p4v" class="p4v">Exemption JS/DOM Client<br><font size="+1" style="background:#ffff99"><b>Initialize Application</b></font><br/>
<table id="toW" name="toW" cellpadding="0" cellspacing="0" style="width:224px;border:2px ridge"><tr height="16">
<td id="to1" name="to2" style="background:#d6ef39;Xwidth:0px;margin:0;padding:0;"></td>
<td id="to2" name="to2" style="background:#ad0000;Xwidth:0px;margin:0;padding:0;"></td>
</tr></table>

<script type="text/javascript" language="JavaScript1.5">
var toT=5,toH=null;
function toF(maxx,step,xpos)
{
    if(!maxx)	{ maxx=parseInt(document.getElementById('toW').style.width); }
    else if(maxx<0)	{ if(toH) window.clearTimeout(toH); return true; }
    var o1=document.getElementById('to1'),o2=document.getElementById('to2');
    if(xpos>maxx)
    {
	xpos=0;
	// if((--toT)<0 &&& !confirm("TIMEOUT: JavaScript Loader Timeout\n\nPlease Clear the Browser Cache\nand Force-Reload the Application,\nwait until the bug has been fixed,\nor maybe just use another Browser.\n\nTry Again?")) return false; else toT=3;
	if((--toT)<0) toT=3;
	var b=o1.style.background;o1.style.background=o2.style.background;o2.style.background=b;
    }
    o2.style.width=(maxx-xpos)+'px';o1.style.width=xpos+'px';xpos+=step;
    toH=window.setTimeout('toF('+maxx+','+step+','+xpos+')',100);
}
toF(0,32,0);
</script>
</div></tt></center></td></tr>
<tr><td class="pbot">&#9674;</td><td align="center"><input type="button" class="pbot" id="p3b" onClick="wClose(-4)" value="Close Dialog"></td><td class="pbot" align="right">&#9674;</td></tr>
</tbody></table></div>

<script type="text/javascript" language="JavaScript1.5" deferred>
if(self!=top)
{
    if(window.name && window.name=='p1i' && confirm('Welcome back to '+location.host+'\nfrom '+document.referrer+'\n\nRe-Enter Website ?'))	parent.wClose(-1);
    else if(confirm('Loading '+location.host+' within Frame probably wont work\nReplace (Destroy) current Frameset ?'))	top.location.replace(self.location.href);
    else if(history.length>0)	history.go(-1);
    else	stop();
    window.onerror=errHandler;
}

</script>

<script type="text/javascript" language="JavaScript1.5">
<?
$ip = $_SERVER["REMOTE_ADDR"];
$now = time();
?>
var D=new Date(),sDelta=parseInt(D.getTime()/1000)-<? echo $now ?>;
var sAddr='<? echo $ip ?>',sSeed='CjFc';
</script>
<script type="text/javascript" language="JavaScript1.5" deferred>
var Z=new Array();

var wDebug=0;var wVersion='0.1';var wDelay=250;var wErrUrl='exception.php';var wDomain='';var lQueryId='query';var lSubmitId='submit';var lAction='l',lCount;var cQueryVal=null,cResultNum,cResultPos,cResultNeg,cResultUnk,cResultErr;var dMenu=new Array('all','lhs','rhs','res','pos','neg');var cDispVal='all',cFselVal='button';var wPopId='p';var wCtrlId='ctrl',wPanelId='panel',wDetailId='detail',wTarget='_blank';var pBtnSel=null,pBtnOut='2px outset',pBtnIn='2px inset';var wWidth=700,wHeight=540,wOpts="dependent=no,hotkeys=no,width="+wWidth+",height="+wHeight+",location=no,menubar=no,resizable=yes,scrollbars=yes,status=yes,toolbar=no";var Z_ID=0,Z_ZONE=1,Z_TYPE=2,Z_TITLE=3,Z_DESCR=4,Z_URL=5,Z_QUERY=6,Z_IMG=7;var IS_LHS=1,IS_RHS=2,IS_A=4,IS_META=8,IS_BL=16,IS_WL=32,IS_REQ=64,IS_NOFRAME=128;var vDetailDisclaim='<font size="-1"><i>&lt;Please note&gt; We do not maintain any of these lists and can not add or remove anything.<br>For removals follow the link to the maintainer and read the published instructions carefully.&lt;/&gt;</i></font>';var vInstrHelp='';var HTTP='';var u_wiki='';var u_country='';var u_asn='';var u_ip='';var u_cidr='';var u_groups='';var u_domdns='';var u_sbase='';var R=new Array(),rList=new Array();
function pPrint(t){dPrintId(wPanelId,t);}
function dPrint(t){dPrintId(wDetailId,t);}
function dPrintId(i,t){}

function wCheck(v){if(v==wVersion)return true;alert('WARNING: Version inconsitency','please force reload page');return false;}

function rInit(v,s){cResultNum=0;cResultPos=0;cResultNeg=0;cResultUnk=0;cResultErr=0;rList=new Array();for(var id in R)delete R[id];lCount++;if(s)sSeed=s;return wCheck(v);}

function rDone(type,addr,host) {
	window.status='';
	if(wDelay)
		window.setTimeout('wClose(0)',wDelay);
	else
	wClose(0);
}

function wInit(v){if(!document.getElementById){return wAlert('CLIENT ERROR: DOM not supported','use a recent Firefox, Mozilla or MSIE\nto access this page.');};
 if(self!=top){if(window.name&&window.name=='pop1ifr'){parent.wClose(-1);}else if(confirm('CLIENT WARNING: Application loaded in Frame\n\ntop.location.href='+top.location.href+'\nself.location.href='+self.location.href+'\nwindow.name'+window.name+'\ndocument.referrer='+document.referrer+'\nhistory.length='+history.length+'\n\nReplace (Destroy) current Frameset ?')){top.location.href=self.location.href;}else if(history.length>0){history.go(-1);}else{stop();};
 return false;};
 if(v&&!wCheck(v))return false;
 if(wDebug)window.onerror=errHandler;
 var q=document.getElementById(lQueryId);
 if(!q.value){var x,y,z,s=self.location.search;if((x=s.indexOf('i='))>0){y=s.substr(x+2,64);z=y.indexOf('&');}else if((x=s.indexOf('query='))>0){y=s.substr(x+6,64);z=y.indexOf('&');}else if(s.match(/^\?[-a-zA-Z0-9.]+$/)){y=s.substr(1,64);z=y.indexOf('&');}else if(self.location.hash.indexOf('.')>1){y=self.location.hash.substr(1,64);z=64;}else if((x=document.cookie.indexOf('q='))>=0){y=document.cookie.substr(x+2,64);z=y.indexOf(';');};
 if(y){q.value=y.substr(0,(z<0)?64:z);}else if(sAddr){q.value=sAddr;}};
 lEnable(true);if(wDelay)window.setTimeout('wClose(null)',100+wDelay);}

function errHandler(m,u,l){if(!confirm('JavaScript Exception Handler\n\nscript name: '+u+'\nline number: '+l+'\nmessage: '+m+'\n\nLog this Exception (in new Window) ?'))return false;window.open(wErrUrl+'?e=js&l='+l+'&u='+u+'&m='+m+'&p='+navigator.platform+'&n='+navigator.appName+'&c='+navigator.appCodeName+'&v='+navigator.appVersion+'&w='+((window.innerWidth)?window.innerWidth:document.body.offsetWidth)+'&h='+((window.innerHeight)?window.innerHeight:document.body.offsetHeight),'exception','dependent=yes,hotkeys=no,width='+wWidth+',height='+wHeight+',location=no,menubar=yes,resizable=yes,scrollbars=yes,status=yes,toolbar=no');return true;}

function errFake(){if(confirm('Provoke JavaScript Exception\nby calling \'NonExistingFunction()\'\n\nBrowser should open a new window\n(Opera is a well known ignorant)'))NonExistingFunction();return false;}

function lEnable(status){
	return;
	var q=document.getElementById(lQueryId);var s=document.getElementById(lSubmitId);if(status){q.disabled=false;q.readonly=false;q.focus();s.disabled=false;}else{q.readonly=true;s.disabled=true;}
}

function lErr(t){wAlert('INPUT SYNTAX ERROR','<h2>'+t+'</h2><font color="#ff3300"><i><b>*** NO PUBLIC SERVER AT THIS ADDRESS ***</b></i></font>\n\nplease enter ip-address in quad-dotted notation.\n\n<i>usage example: &quot;<a href="#127.0.0.2" onClick="return lSubmit(\'127.0.0.2\')">127.0.0.2</a>&quot;</i>');return false;}

function lSubmit(query){
	var qo=document.getElementById(lQueryId);
	if(!query)
		query=qo.value;
	var q=escape(query.replace(/^\s*|\s*$/g,"").toLowerCase());
	var type;
	if(!q){
		lErr('Missing Input');
		return false;
	}
	if(q.length>15)
		return lErr('max 15 chars allowed');
	if(q.match(/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/)){
		if(q.match(/^(0|10|127|172\.[12].|192\.168|24.|25.)\./))
			return lErr('Non-Routable/Private IP-Address');
		type='lhs';
	}
	else if(qHost=q.match(/^[a-z0-9][-a-z0-9.]+\.[a-z]{2,5}$/)){
		return lErr('Non-Routable/Private IP-Address');
	}else
		return lErr(q);

	lEnable(false);
	cQueryVal=q;
	qo.value=cQueryVal;
	wClose(0);
	if(navigator.cookieEnabled&&document.cookie.indexOf('q='+q)<0)
		document.cookie='q='+escape(cQueryVal)+';path=/;domain=.'+wDomain+';';
	wLookup(lAction,cQueryVal);
	return false;
}

function wClose(n){if(n<0){n=Math.abs(n);try{document.getElementById((wPopId+n+'i')).src='about:blank';}catch(e){return(wClose(null));};}
 if(n>0){try{document.getElementById((wPopId+n)).style.display='none';}catch(e){};}
 else{try{for(i=1;i<5;i++)document.getElementById((wPopId+i)).style.display='none';}catch(e){};if(n!=0&&n==null){for(i=1;i<3;i++){try{document.getElementById((wPopId+i+'i')).src='about:blank';}catch(e){continue;};}}}
 lEnable(true);if(toF&&toH&&toH!=null)toF(-999);return false;}

function wPop(n,t,f){if(!t)return wClose(n);var div=document.getElementById((wPopId+n));var ifr,val,tit,btn;
 if(ifr=document.getElementById((wPopId+n+'i'))){if(!ifr.src||ifr.src.indexOf(f)<0){var d;
 try{if(d=parent.frames[n].document){d.open('text/html','replace');d.write('<html><body><center><tt><p><b>Connecting to</b><p><font size="+1" style="background:#ffff99;"><b>'+f+'</b></font><p>...please wait...</tt></center></body></html>');d.close();}}
 catch(e){};try{ifr.src=f;}catch(e){if(confirm('INTERNAL ERROR 604:\ncant set ifr.src\n\nself.location.href='+self.location.href+'\nn='+n+'\nt='+t+'\nf='+f+'\n\nplease force reload application\n'+e)){top.location.href='./#'+cQueryVal;}return false;};
 var obtn;if(obtn=document.getElementById((wPopId+n+'o'))){obtn.title=f;obtn.disabled=false;}}
 else if(f.substring(0,4)!='http'){try{if(parent.frames[n].init)window.setTimeout('parent.frames[\''+n+'\'].init()',(1000+wDelay));}catch(e){};}}
 else if(val=document.getElementById((wPopId+n+'v')))val.innerHTML=f.replace(/\n/g,'<br>');else{wAlert('INTERNAL ERROR','wPop('+n+','+t+','+f+')');return false;};
 if(tit=document.getElementById((wPopId+n+'t'))){tit.innerHTML=t;};
 if(btn=document.getElementById((wPopId+n+'b'))){btn.disabled=false;};
 div.style.display='block';return false;}

function wLookup(u,q){
 var c=dataprep(rc4(sSeed,q));
 while(c.charAt(c.length-1)=='=')c=c.substring(0,c.length-1);
 window.location.hash=q;
 window.status='Processing: '+q;
 var f=dataprep(q);
 return wPop(2,'Processing Exemption','/lib/plugins/exempt/l/index.php?data=' + f);}

function wAlert(h,b){return wPop(3,h,b);}
function wDialog(h,b){return wPop(4,h,b);}
function wAsk(t){return confirm(t.replace(/<br>/ig,'\n'));}

function wOpen(f,n){if(!n)n='afternet';if(f.match(/^[a-z]+\.js$/)){if(wHandle==null)wHandle=window.open('about:blank',n,wOpts);var d=wHandle.document;d.open('text/html','replace');d.write('<html><head><title>'+n+'</title></head><body onload="focus();">');d.write('[<a href="#main" onClick="opener.focus();return false;">Main</a>] ');d.write('[<a href="#close" onClick="window.close();opener.focus();opener.wHandle=null;return false;">Close</a>]\n');d.write('<script type="text/javascript" src="'+f+'"><\/script>\n');}else if(f.substr(0,2)=='./'||f.match(/^[a-z]+\.htm$/))window.open(f,n,wOpts);else if(f.match(/^\/.*/)){var opt="width="+wWidth+",height="+wHeight+",location=yes,menubar=yes,resizable=yes,scrollbars=yes,status=yes,toolbar=yes";try{window.open(f,n,opt);}catch(e){return false;};}
 else if(f.match(/^[fh]t[tps]{1,3}:\/\/[-a-z.]+\.[a-z]{2,4}\/.*/)){try{window.open(f,n,'');}catch(e){return false;};}
 else{alert('INTERNAL ERROR\nwOpen('+f+','+n+')\n\ncant open window');}return false;}

function rc4	(k,t){var i,j,x,y,z,r='',b=new Array(256);for(i=0;i<256;i++)b[i]=i;for(i=0,j=0;i<256;i++){j=(j+b[i]+k.charCodeAt(i%k.length))%256;y=b[i];b[i]=b[j];b[j]=y;}for(i=0,j=0,z=0;z<t.length;z++){i=(i+1)%256;j=(j+b[i])%256;y=b[i];b[i]=b[j];b[j]=y;x=(b[i]+b[j])%256;r=r+String.fromCharCode(t.charCodeAt(z)^b[x]);}return r;}var u64='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_=';
function dataprep(i){var c1,c2,c3,e1,e2,e3,e4,x=0,o='';do{c1=i.charCodeAt(x++);c2=i.charCodeAt(x++);c3=i.charCodeAt(x++);e1=(c1>>2);e2=(((c1&3)<<4)|(c2>>4));e3=(((c2&15)<<2)|(c3>>6));e4=(c3&63);if(isNaN(c2)){e3=e4=64;}else if(isNaN(c3)){e4=64;}o=o+u64.charAt(e1)+u64.charAt(e2)+u64.charAt(e3)+u64.charAt(e4);}while(x<i.length);return o;};
 
</script>

<script type="text/javascript" language="JavaScript1.5" deferred>
wInit();
</script>

<?

              $content = ob_get_contents();
              ob_end_clean();
              $renderer->doc .= $content;
              break;  
          }
          return true;
        }
        
        // unsupported $mode
        return false;
    } 
}
 
?>
