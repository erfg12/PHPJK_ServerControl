<?PHP include ("include.php"); ?>
<div style="width:300px;margin-left:auto;margin-right:auto;margin-top:15px;text-align:right;border:thin solid #949494; border-radius:15px;padding:20px;position: fixed; top: 30%; left: 40%;">
<h3>GameServer Login</h3>

<?PHP
if (isset($_GET['logout'])){
	echo 'You are logged out.';
	?><script type="text/javascript"> window.location = "index.php" </script><?PHP
}

if (stristr($user,$_COOKIE['username']) && stristr($pass,$_COOKIE['password'])){
	?><script type="text/javascript"> window.location = "main.php" </script><?PHP
}

if (isset($_POST['login'])){
	if (stristr($user,$_POST['gs_user'])){
		if (stristr($pass,$_POST['gs_pass'])){
			echo 'You are logged in.<br><a href="main.php">Continue to the status page.</a>';
			?><script type="text/javascript"> window.location = "main.php" </script><?PHP
		} else
			echo 'incorrect password';
	} else
		echo 'incorrect username';
}
?>

<form method="post">
<p>Username <input type="text" name="gs_user" placeholder="gameserver username"></p>
<p>Password <input type="password" name="gs_pass" placeholder="gameserver password"></p>
<p><input type="submit" name="login" value="LOGIN" style="font-weight:bold;color:#545BA7;font-size:21px;"></p>
</form>
</div>