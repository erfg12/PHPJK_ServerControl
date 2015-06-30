<?PHP 
include ("include.php"); 
$gamequery = $gq->requestData();
$i = 0;
?>
<body>
<div style="margin-left:auto;margin-right:auto;width:800px;margin-top:25px;">
<table width="800" border="1" style="text-align:center;">
  <tbody>
  <tr style="font-weight:bold;">
      <td>LABEL</td>
      <td>RUNNING</td>
      <td>START</td>
      <td>STOP</td>
      <td>INFO</td>
      <td>CONFIG</td>
      <td>FILES</td>
    </tr>
<?PHP
foreach ($serverList as $s) { 
?>
    <tr>
      <td style="text-align:left;"><?PHP echo $s[0]; ?></td>
      <td>
	  	<?PHP
	  	if ($gamequery[$i]['gq_online'] == '1') 
	  		echo '<span style="color:green;font-weight:bold;">ONLINE</span>'; 
		else 
			echo '<span style="color:red;font-weight:bold;">OFFLINE</span>'; 
		?>
      </td>
      <td><?PHP if ($gamequery[$i]['gq_online'] == '1') { echo '<strike>STOP</strike>'; } else { ?><a href="comm.php?start&id=<?PHP echo $i; ?>" id="fancyBoxLink">START</a><?PHP } ?></td>
      <td><?PHP if ($gamequery[$i]['gq_online'] != '1') { echo '<strike>STOP</strike>'; } else { ?><a href="comm.php?stop&id=<?PHP echo $i; ?>" id="fancyBoxLink">STOP</a><?PHP } ?></td>
      <td><?PHP if ($gamequery[$i]['gq_online'] != '1') { echo '<strike>STATUS</strike>'; } else { ?> <a href="status.php?id=<?PHP echo $i; ?>" class="fancybox fancybox.iframe">STATUS</a><?PHP } ?></td>
      <td><a href="textedit.php?f=<?PHP echo $s[3].'/'.$s[4]; ?>/server.cfg" class="fancybox fancybox.iframe">EDIT</a></td>
      <td><a href="browser.php?path=<?PHP echo $s[3]; ?>" class="fancybox fancybox.iframe">MANAGE</a></td>
    </tr>

<?PHP $i++; } ?>

  </tbody>
</table>
<div style="width:800px;"><span style="text-align:left;float:left"><a href="index.php?logout">LOG OUT</a></span> <span style="text-align:right;float:right">Created by <a href="http://newagesoldier.com" target="_BLANK">the New Age Soldier</a></span></div>
</div>
</body>