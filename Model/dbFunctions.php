<?php
class DbFunctions
{
	function DBConnect()
	{
		$dbhost = "localhost";
		$dbname = "allintrapani";
		$dbuser = "jotarotp";
		$dbpasswd = "action";
		
		/*$dbhost = "jotaro76.altervista.org";
		$dbname = "my_jotaro76";
		$dbuser = "jotaro76";
		$dbpasswd = "action";*/
		
		$link = mysql_connect($dbhost, $dbuser, $dbpasswd, $dbname);
		if (!$link) 
		{
		    die ('Non riesco a connettermi: ' . mysql_error());
		}
		
		$db_selected = mysql_select_db($dbname, $link);
		if (!$db_selected) 
		{
		    die ("Errore nella selezione del database: " . mysql_error());
		}					
	}
}
?>