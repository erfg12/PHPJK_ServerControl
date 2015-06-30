<?PHP
include ("include.php");
error_reporting(E_ALL);

if ($openjk){
	$lojk = "openjkded.x86_64";
	$wojk = "openjkded.x86.exe";
} else {
	$lojk = "linuxjampded";
	$wojk = "jampded.exe";
}

$gamePort = $serverList[$_GET['id']][2];
$gDataPath = $serverList[$_GET['id']][3];
$gameMod = $serverList[$_GET['id']][4];

if (strstr($myos,"linux")) {
	if (isset($_GET['stop'])) {
		echo 'Server is stopping...';
		$result = shell_exec("kill -9 $(/usr/sbin/lsof -i:$gamePort -t) 2>&1");
		echo "<pre>$result</pre>";
	} else if (isset($_GET['start'])){
		echo 'Server is starting, please wait 10 seconds.<br>You can close this window.';
		$handle = popen("cd $gDataPath; ./$lojk +set dedicated 2 +exec server.cfg +exec bots.cfg +set fs_game $gameMod +set net_port $gamePort", 'r');
		pclose($handle);
	}
}

if (strstr($myos,"windows")) {
	if (isset($_GET['stop'])) {
		echo 'Server is stopping...<br>';
		$result = shell_exec("FOR /F \"tokens=4 delims= \" %P IN ('netstat -a -n -o ^| findstr :".$gamePort."') DO TaskKill.exe /F /PID %P 2>&1");
		echo "<pre>$result</pre>";
	} else if (isset($_GET['start'])){
		$args = urldecode($_GET['args']);
		echo 'Server is starting, please wait 10 seconds.<br>You can close this window.';
		$handle = popen("cd $gDataPath && start \"JKA SERVER\" /HIGH $wojk +set dedicated 2 +exec server.cfg +exec bots.cfg +set fs_game $gameMod +set net_port $gamePort", 'r');
		pclose($handle);
	}
}
?>