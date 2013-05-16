<?
include("main_config.php");
$path = $absolute_path.'/classes/php-captcha.inc.php';
require($path);
//include($absolute_path."/sqlite.php");
$dbHandle = sqlite_open('/data/web/afternet/db/sqlite/exempt.db');

$data = $_GET["data"];
if (!$data)
  header("location: $doku_php_path/doku.php");

$edata = base64_decode($data);
if (!$edata)
  header("location: $doku_php_path/doku.php");

$file = $_GET["file"];

$sql = "SELECT captcha,file FROM captcha WHERE ts=\"".$edata."\"";
$result = sqlite_query($dbHandle, $sql);
$fetch = sqlite_fetch_array($result);

$code = $fetch["captcha"];
$song = $fetch["file"];

sqlite_close($dbHandle);

if (!$code)
  header("location: $doku_php_path/doku.php");

if ($song) {
  if ($file == "wav") {
    header("Content-type: audio/x-wav");
    header("Content-Disposition: attachment;filename=".$song.".wav");

    echo file_get_contents("/data/web/afternet/www/lib/tmp/".$song.".wav");
  } else if ($file == "mp3") {
    header("Content-type: audio/x-mpeg-3");
    header("Content-Disposition: attachment;filename=".$song.".mp3");

    echo file_get_contents("/data/web/afternet/www/lib/tmp/".$song.".mp3");
  } else
    header("location: $doku_php_path/doku.php");
} else {
  $oAudioCaptcha = new AudioPhpCaptcha("/usr/bin/flite", "/data/web/afternet/www/lib/db", $code, false, 0);
  $oAudioCaptcha->Create();
}
?>

