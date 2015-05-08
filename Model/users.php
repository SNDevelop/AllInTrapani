<?php
require '/Model/dbFunctions.php';

class UsersQuery
{		
	function SelectedUser($email, $passWord)
	{		
		$myConn = new DbFunctions();
		$myConn->DBConnect();								
		
		$sql = "SELECT IdUser, UserName FROM users where Email='$email' and PassWord='$passWord' and IsActive = 1";
	 	$result = mysql_query($sql);		
		
		mysql_close();
			  	
	  	return $result;
	}
	
	function CheckExistingUsername($username)
	{
		$myConn = new DbFunctions();
		$myConn->DBConnect();								

		$sql = "select UserName from users where username='$username'";
		
		$res = mysql_query($sql);
		
		mysql_close();
		
		return $res;
	}
	
	function CheckExistingEmail($email)
	{
		$myConn = new DbFunctions();
		$myConn->DBConnect();								

		$sql = "select Email from users where Email='$email'";
		
		$res = mysql_query($sql);
		
		return $res;
		
		mysql_close();
	}
	
	function InsertNewUser($userName, $password, $email, $verifyCode)
	{
		$today = date("Y-m-d H:i:s");
		$myConn = new DbFunctions();
		$myConn->DBConnect();								

		$sql = "insert into users set 
					username = '$userName', 
					password='$password',
					email='$email',
					verifyCode='$verifyCode',
					date = '$today'
				";
		
		$res = mysql_query($sql);		
		
		mysql_close();		
	}
	
    function CheckIfIsHumanUser($email, $verifyCode)
    {
        $myConn = new DbFunctions();
        $myConn->DBConnect();                               
                
        $sql = "select UserName from users where Email = '$email' and VerifyCode = '$verifyCode'";
        
        $res = mysql_query($sql);       
        
        return $res;
        
        mysql_close();
    }
    
    function ActivateUser($UserName)
    {
        $myConn = new DbFunctions();
        $myConn->DBConnect();                               
                
        $sql = "update users set IsActive = 1 where UserName='$UserName'";
        
        $res = mysql_query($sql);                       
        
        mysql_close();
    }
}	
?>