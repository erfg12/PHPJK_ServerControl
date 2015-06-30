<?PHP
error_reporting(E_ALL & ~E_NOTICE);
include ("setup.php");
if (isset($_GET['logout'])){
	unset($_COOKIE['username']);
    unset($_COOKIE['password']);
	setcookie('username', "", time()-3600);
    setcookie('password', "", time()-3600);
} else {
	if (stristr($user,$_POST['gs_user']) && stristr($pass,$_POST['gs_pass'])){
		setcookie("username",$_POST['gs_user']);
		setcookie("password",$_POST['gs_pass']);
	}
}
?>
<html>
<head>
	<title>PHP JediKnight Server Controller</title>
  	<style type="text/css">
    	.error{ color:red; font-weight:bold; }
    	.unlink{ margin-left:1em; font-size:small; color:red;}
  	</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox({
            	type: 'iframe',
            	afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
            	    parent.location.reload(true);
            	}
        	});
			$("a#fancyBoxLink").fancybox({
        		type: 'iframe',
				beforeLoad: function(){
   					setTimeout( function() {$.fancybox.close(); },4000); // 4000 = 4 secs
  				},
            	afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
            	    parent.location.reload(true);
            	}
    		});
		});
	</script>
</head>
<?PHP
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
	if (!stristr($_COOKIE['username'],$user) || !stristr($_COOKIE['password'],$pass)){
		if (!strstr($_SERVER['REQUEST_URI'],"index")) {
			?><script type="text/javascript"> window.location = "index.php" </script><?PHP
			exit();
		}
	}
} else {
	if (!strstr($_SERVER['REQUEST_URI'],"index")) {
		?><script type="text/javascript"> window.location = "index.php" </script><?PHP
		exit();
	}
}

require_once 'GameQ.php';

$serverList = array();
$handle = fopen("servers.php", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if (strstr($line,","))
			array_push($serverList,explode(",", $line));
    }
    fclose($handle);
} else
    echo 'ERROR: Can\'t read serverinfo.php';
	
$servers = array();

$publicIP = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));

foreach ($serverList as $s) {
	array_push($servers, array($s[0] => $s[1], $publicIP, $s[2]));
}

$gq = new GameQ();
$gq->addServers($servers);
//print_r($servers);
?>