<?php
require '/Views/users.php';
require '/Model/users.php';
	
class UsersLogic
{
	public function __construct($selectedSection)
	{		
		$this->_selectedSection = $selectedSection;				
	}
	
	function SelectContent()
	{
		$method=$this->_selectedSection;
		$this->$method();                
	}
	
	function UsersList()
	{
		$usersList = new UsersQuery();		
		return $usersList->UsersList();
	}
	
	function SelectedUser($email,$passWord)
	{		
		$selectedUser = new UsersQuery();		
		return $selectedUser->SelectedUser($email,$passWord);
	}
	
	function LogIn()
	{								
		if(@$_POST['email']=='' || @$_POST['Password']=='')
			return;
				
		$email = mysql_real_escape_string(stripcslashes(trim($_POST['email'])));
		$passWord = sha1(mysql_real_escape_string(stripcslashes(trim($_POST['Password']))));				
				
		$selectedUser = new UsersQuery();		
		$userData = $selectedUser->SelectedUser($email,$passWord);
		        
        while ($row = mysql_fetch_assoc($userData)) 
        {
            $_SESSION['idUser'] = htmlentities($row['IdUser']);                                    
            $_SESSION['user'] = htmlentities($row['UserName']);            
        }        
		
		header ("location: ../General/Home");		
	}
	
	function SelectLogInForm()
	{
		$formLogin='';
		
		$formLogin = new UsersView();		
		
		if (@$_SESSION['user']=='')
			$formLogin = $formLogin->LoggedOff();
		else 
			$formLogin = $formLogin->LoggedOn();
		
		return $formLogin;
	}
	
	function UserRegistration()
	{		
		if
		(
			@$_POST['email']=='' || 
			@$_POST['UserName']=='' || 
			@$_POST['Password']=='' || 
			@$_POST['RePassword']=='' || 
			@$_POST['iagree']==''			
		)
			return;				
		
		$email = mysql_real_escape_string(stripcslashes(trim($_POST['email'])));
		$userName = mysql_real_escape_string(stripcslashes(trim($_POST['UserName'])));
		$password = sha1(mysql_real_escape_string(stripcslashes(trim($_POST['Password']))));
		$rePassword = sha1(mysql_real_escape_string(stripcslashes(trim($_POST['RePassword']))));
		
		if
		(
			$this->IsValidEmail($email) && 
			$this->IsNewMail($email) && 
			$this->IsNewUserName($userName) && 
			$this->IsValidPassword($password, $rePassword)
		)
		{			
			$verifyCode = $this->VerifyCode();
			
			$saveUser = new UsersQuery();
			$saveUser->InsertNewUser($userName, $password, $email, $verifyCode);
			
			$this->SendEmail("Si è registrato l'utente $userName",'allintrapani@gmail.com', "Registrazione utente $userName");
			
			$activationLink = $this->ActivationEmailText($userName, $verifyCode, $email);
			$this->SendEmail($activationLink, $email, "Registrazione account su www.allintrapani.it");
			
			header("location: ../General/Home");
		}	
		else 
		{		    
		    header("location: ../General/Home");
			return;
		}					
	}
	
	function IsValidEmail($email)
	{
		$at = strpos($email,'@');
		
		if(!$at)
			return FALSE;
				
		$subString = explode('@', $email);
		$rightAt = $subString[1];
		
		$point = strpos($rightAt,'.');
		
		if(!$point)
			return FALSE;
		
		$subString = explode('.', $rightAt);
		
		$lenLeftPoint=strlen($subString[0]);
		$lenRightPoint=strlen($subString[1]);
		
		if($lenLeftPoint<3||$lenRightPoint<2||$lenRightPoint>3)
			return FALSE;
		
		return TRUE;
	}
	
	function IsValidPassword($password, $rePassword)
	{		
		if($password == $rePassword)
			return TRUE;
		else
			return FALSE;
	}
	
	function IsNewMail($email)
	{
		$obj = new UsersQuery;
		$res = $obj->CheckExistingEmail($email);				
		
		if ($row = mysql_fetch_assoc($res)) 		
			return FALSE;
		 else 
			return TRUE;					
	}
	
	function IsNewUserName($userName)
	{
		$obj = new UsersQuery();
		$res = $obj->CheckExistingUsername($userName);
		
		if ($row = mysql_fetch_assoc($res)) 
			return FALSE;
 	    else 
			return TRUE;		
	}
	
	function VerifyCode()
	{
		$lettere="0123456789abcdefghijklmnopqrstuvwxyz";
		$verifyCode="";
		
		for ($i=0; $i<16; $i++)
		{
		    @$rndNum = rand(0,strlen($lettere));
		    @$verifyCode.= $lettere{$rndNum};
		}
		
		return $verifyCode;
	}
	
	function SendEmail($emailText, $email, $oggetto)
	{
		$headers  = 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\n";
		$headers .= 'Content-Transfer-Encoding: 8bit' . "\n";
		$headers .= 'From: All in Trapani.it <info@allintrapani.it>' ."\r\n";
								
		$messaggio ="
		    <a href=\"http://www.allintrapani.it\" title=\"All In Trapani\">
		    <img src=\"http://www.allintrapani.it/allintrapani.png\" title=\"All In Trapani\"></a>\n\n\n\n\n\n\t<br /><br />
		    ".$emailText." \n\n <br/>
		";
		    
		$ok=mail($email,$oggetto,$messaggio,$headers);		
	}
	
	function ActivationEmailText($userName, $verifyCode, $email)
	{
		$activationLink="Ciao $userName <br /> ".'
			Benvenuto tra gli utenti di All In Trapani.<br />Clicca sul Link sottostante per completare la registrazione. <br />
			<a href="http://jotaro76.altervista.org/UsersLogic/Activation/'.$verifyCode.'/'.$email.'"/ title="All In Trapani">Link di attivazione</a>
		';
		
		return $activationLink;
	}
    
    function Activation()
    {                
        header("http/1.1 200 ok");
        $url=explode("/",$_SERVER['REQUEST_URI']);
        
        if($url[3] != '')
            $verifyCode = mysql_real_escape_string(stripcslashes(trim($url[3])));
        
        if($url[4] != '')
            $email = mysql_real_escape_string(stripcslashes(trim($url[4])));                        
        
        $email = str_replace('%40', '@', $email);
        
        $obj = new UsersQuery();
        $result = $obj->CheckIfIsHumanUser($email, $verifyCode);
                        
        if($result!='')
        {            
            $UserName=mysql_result($result, 0);
            $obj->ActivateUser($UserName);
            
            $this->SendEmail("Si è attivato l'utente $UserName", "allintrapani@gmail.com", "Attivazione account");
            
            $emailText=
                $UserName.' il tuo Account è stato attivato con successo. <br />
                Benvenuto tra gli utenti di All in Trapani, adesso puoi scrivere articoli o intereagire con la vita del nostro sito. <br />
                Buon Divertimento.
            ';
            
            $this->SendEmail("$emailText " , $email, "Attivazione Account su All in Trapani");            
        }
                                
        header ("location: ../../../General/Home");
    }
}
?>