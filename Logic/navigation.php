<?php
require '/Logic/Users.php';
require '/Views/general.php';
require '/Views/content.php';

class Navigation
{
	public function Nav()
	{		
		session_start();
		
		$class = 'General';
		$SelectedSection = 'Home';
		
		header("http/1.1 200 ok");
		$url=explode("/", $_SERVER['REQUEST_URI']);										
		
		if($url[1]!='')
			$class = trim(stripcslashes($url[1]));
		
		if (@$url[2]!='')
			$SelectedSection = trim(stripcslashes($url[2]));									
				
		if ($url[1]=='secureArea' && !$this->IsLogged())
			header ("location: ../General/Home");
                								
		$userForm = new UsersBll($SelectedSection);
		
		$userForm->LogIn();
		$this->UserForm = $userForm->SelectLogInForm();
		
		
		$content = new $class($SelectedSection);
		$content->SelectContent();
		
		$this->Title ="All In Trapani | ". $content->_title;
		$this->Content = $content->_content;				 
	}
	
	function IsLogged()
	{
		$user = $_SESSION['user'];
		
		if ($user=='')
			return FALSE;
		else 
			return TRUE;
	}	
}
?>