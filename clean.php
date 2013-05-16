<?

die();
$srcDir = opendir("/data/web/afternet/www/lib/tmp/");
while($appname = readdir($srcDir)) {
        if (($appname == ".") || ($appname == ".."))
                continue;


	$app = explode(".", $appname);
	list($file, $ext) = $app;

	if (($ext == "jpg") || ($ext == "txt"))
		continue;

	unlink("/data/web/afternet/www/lib/tmp/".$file.".".$ext);
}
?>
