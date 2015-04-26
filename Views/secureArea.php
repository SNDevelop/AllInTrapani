<?php
class SecureArea
{
	public $_title;
	public $_content;
	
	public function __construct($selectedSection)
	{		
		$this->_selectedSection = $selectedSection;				
	}
	
	function SelectContent()
	{
		$method=$this->_selectedSection;
		$this->$method();                
	}
	
	function WriteNews()
    {
        $this->_title = 'Scrivi Nuovo articolo';
        $this->_content = 'Qui puoi scrivere il nuovo articolo';
    }		
	
    function EditNews()
    {
        $this->_title = 'Modifica articolo';
        $this->_content = 'Qui puoi modificare l\'articolo';
    }
    
    function MenageComment()
    {
        $this->_title = 'Gestione commenti';
        $this->_content = 'Qui puoi modificare i commenti';
    }
    	
    function MenageAccount()
    {
        $this->_title = 'Gestione account';
        
        $obj = new SecureAreaActivity("");
        $obj->SelectUser();        
        $avatarImageName = $obj->SelectAvatarImageName();        
        
        $this->_content = 
        '
            <form method="post" action="SecureAreaActivity/EditAvatar" name="accountForm">
                <fieldset>
                    <legend>Dati Account</legend>
                    <img src = "style/avatar/'.$avatarImageName.'"/>
                    Nome utente: <input name="userName" type="text" value="'.$obj->_userName.'" /><br />
                    <input type="file" name="avatarImg" /><br />
                    Password: <input name="password" type="password" value="" /> <br />
                    Ripeti Password: <input name=rePassword type="password" value="" /> <br />
                    <button name="save" value="#">Salva</button>
                </fieldset>
            </form>
        ';
    }    
    
    function MenageUsers()
    {
        header("http/1.1 200 ok");
        $url = explode("/", $_SERVER['REQUEST_URI']);
                
        @$requestPage = trim(stripcslashes($url[3]));
                
        @$objSecureAreaBll = new SecureAreaActivity();
        $rowUsers = $objSecureAreaBll->FillUsers("", $requestPage, 10);        
        
        $this->_title = 'Gestione utenti';
        
        $this->_content = '
            <table border=1>
                <tr>
                    <td>Data registrazione</td>
                    <td>Nome Utente</td>
                    <td>Email</td>
                    <td>Admin</td>
                    <td>Attivo</td>
                    <td></td>
                </tr>
                '.$rowUsers.'
            </table>
        ';        
    }
        
	function LogOut()
	{
		session_destroy();
		header("location: ../General/Home");
	}		
}
?>