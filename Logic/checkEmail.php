<?php
$obj = new CheckEmail;
$obj->CheckExistingEmail();

class CheckEmail
{
	function CheckExistingEmail()
	{
		$email=$_GET['v'];
		
		$obj = new UsersDal;
		$res = $obj->CheckExistingEmail($email);				
		
		if ($row = mysql_fetch_assoc($res)) {
			echo '<span style="color:red;">Email già presente in archivio</span><span class="hidden" id="resEmailCheck">0</span>';
		} else {
			echo '<img src="style/img/ok.png" alt="ok" title="Email Valida" /><span class="hidden" id="resEmailCheck">1</span>';			
		}
	}
}
?>