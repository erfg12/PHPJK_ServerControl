CREATED BY THE NEW AGE SOLDIER
http://newagesoldier.com

These are all PHP scripts, no database setup needed!

_ABOUT

This lets you remotely control your Jedi Knight game servers. Very handy for when you're changing files/mods on a remote server, renting servers or just always traveling and need to control your server from a mobile device that doesn't have access to rcon.

_SETUP

edit servers.php with notepad or another text editor with your server data. You can put as many servers as your server can handle. Local only.

EXAMPLE: 

(LABEL),quake3,(PORT),(GAMEDATA FOLDER),(MOD)
(LABEL),quake3,(PORT),(GAMEDATA FOLDER),(MOD)

edit setup.php with notepad or another text editor with your login credentials. Please, do not keep the default credentials!!!

EXAMPLE: 

$user="admin";
$pass="password";

Apache will need permissions to these game files and to shell commands like the kill command. On Linux you need to chmod 777 the gamedata files so you can delete and upload to this folder. If you have a cPanel server, you can give the user shell access in the WHM panel.