<?
    $hostname = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'job';
	$link=mysql_pconnect($hostname,$username,$password);
	if (!$link)
		die("mysql gone away");
	mysql_query("SET SESSION character_set_results = utf8;");
	mysql_query("SET SESSION character_set_connection = utf8;");
	mysql_query("SET SESSION character_set_client= utf8;");
	mysql_select_db($db);
?>