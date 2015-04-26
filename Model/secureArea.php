<?php
require 'dbFunctions.php';

class SecureAreaDal
{
    function FillUsers($idUser, $requestPage, $rowForPage)
    {                       
        $myConn = new DbFunctions;
        $myConn->DBConnect();                                       
        
        $sql = "SELECT * FROM users where 1=1";
        
        if ($idUser !='' )
            $sql.=" and IdUser = $idUser";
        else
            $sql.=" limit $requestPage, $rowForPage";       
        
        $rowUser = mysql_query($sql);
                
        mysql_close();
        
        return $rowUser;
    }
    
    function DeleteUser($idUser)
    {       
        $myConn = new DbFunctions;
        $myConn->DBConnect();                               
        
        $sql = "DELETE FROM users where IdUser=$idUser";                
                
        $rowUser = mysql_query($sql);
                
        mysql_close();
        
        return $rowUser;
    }
    
    function CountUsers()
    {
        $myConn = new DbFunctions;
        $myConn->DBConnect();                               
        
        $sql = "SELECT COUNT(*) FROM users";                
                
        $usersNumber = mysql_query($sql);
                
        mysql_close();
        
        return $usersNumber;
    }
    
    function SelectAvatarImageName($idUser)
    {        
        $myConn = new DbFunctions;
        $myConn->DBConnect();                                       
        
        $sql = "SELECT Avatar FROM users where idUser = $idUser";                
        
        $avatarImageName = mysql_query($sql);
                
        mysql_close();
        
        return $avatarImageName;        
    }
    
    function UpdateAvatarImageName($idUser, $newAvatarImageName)
    {
        $myConn = new DbFunctions;
        $myConn->DBConnect();                               
        
        $sql = "UDATE users set avatar = '$newAvatarImageName' where IdUser = $idUser";                
                
        $result = mysql_query($sql);
                
        mysql_close();
        
        return $result;
    }
}    
?>