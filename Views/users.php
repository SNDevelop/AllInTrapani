<?php
class UsersGui
{
	function LoggedOn()
	{
		$loggedOn = '
			<div id="menu">
				<ul>
					<li>
						<a href="#"><h3>MENU</h3></a>
						<ul>
							<li>
								<img class="fleft" src="style/img/NewArticle.png" alt="Nuovo articolo" title="Scrivi un nuovo articolo" /><a class="fleft" href="SecureArea/WriteNews"> Nuovo articolo</a>
							</li>
							<li>
								<img class="fleft" src="style/img/edit.png" alt="Modifica Articolo" title="Vai all\'elenco degli articoli da modificare" /><a class="fleft" href="SecureArea/EditNews"> Modifica aricolo</a>
							</li>
							<li>
								<img class="fleft" src="style/img/comment.png" alt="Elenco commenti" title="Vai all\'elenco dei commenti da modificare" /><a class="fleft" href="SecureArea/MenageComment"> Gestione commenti</a> 
							</li>
							<li>
								<img class="fleft" src="style/img/account.png" alt="Gestione account" title="Modifica i dati del tuo account" /><a class="fleft" href="SecureArea/MenageAccount"> Gestione account</a> 
							</li>
							<li>
								<img class="fleft" src="style/img/user.png" alt="Gestione utenti" title="Vai all\'elenco degli utenti" /><a class="fleft" href="SecureArea/MenageUsers"> Gestione utenti</a>
							</li>
							<li>
								<img class="fleft" src="style/img/exit.png" /><a class="fleft" href="SecureArea/LogOut">Esci</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>						
			Benvenuto Utente : '.$_SESSION['user'].'													
		';
		
		return $loggedOn;
	}
	
	function LoggedOff()
	{
		$formLoggedOff = '
			<a href = "javascript:void(0)" onclick = "document.getElementById(\'loginlight\').style.display=\'block\';document.getElementById(\'loginfade\').style.display=\'block\'"><h3 class="hemens">LOGIN</h3></a>		
			<a href = "javascript:void(0)" onclick = "document.getElementById(\'reglight\').style.display=\'block\';document.getElementById(\'regfade\').style.display=\'block\'"><h3 class="hemens">REGISTRAZIONE</h3></a>
		';
		
		return $formLoggedOff;
	}			
}

?>