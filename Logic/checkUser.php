<?php
$obj = new CheckUserName;
$obj->CheckExistingUsername();

class CheckUserName
{	
	function CheckExistingUsername()
	{
		$userName = $_GET['v'];
		$obj = new UsersQuery();
		$res = $obj->CheckExistingUsername($userName);
		
		if ($row = mysql_fetch_assoc($res)) {
			echo '<span style="color:red;">Nome utente già presente in archivio</span><span class="hidden" id="resUserNameCheck">0</span>';
		} else {
			echo '<img src="style/img/ok.png" alt="ok" title="Nome Utente valido" /><span class="hidden" id="resUserNameCheck">1</span>';
		}
	}
}
?>