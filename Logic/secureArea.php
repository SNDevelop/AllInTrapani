<?php
require '/Model/secureArea.php';
require '/Logic/helper.php';

class SecureAreaActivity
{
    public $_userName;
    
    public function __construct($selectedSection)
    {       
        $this->_selectedSection = @$selectedSection;             
    }
    
    function SelectContent()
    {
        $method=$this->_selectedSection;
        $this->$method();
    }
    
    function FillUsers($idUser, $requestPage, $rowForPage)
    {
        if ($requestPage == '')
            $firstRow = 0;
        else 
            $firstRow = ($requestPage - 1) * $rowForPage;        
                
        $usersRow = '';
        $objSecureAreaQuery = new SecureAreaQuery();
        $rowUsers = $objSecureAreaQuery->FillUsers($idUser, $firstRow, $rowForPage);        
                                            
        while ($row = mysql_fetch_assoc($rowUsers)) 
        {
            $idUser = htmlentities($row['IdUser']);                
            $date = htmlentities($row['Date']);
            $userName = htmlentities($row['UserName']);
            $email = htmlentities($row['Email']);
            $isAdmin = htmlentities($row['IsAdmin']);
            $isActive = htmlentities($row['IsActive']);
            
            $usersRow.="
                <tr>
                    <td>$date</td>
                    <td>$userName</td>
                    <td>$email</td>
                    <td>$isAdmin</td>
                    <td>$isActive</td>
                    <td><a href=\"SecureAreaActivity/DeleteUser/$idUser\" title=\"Elimina Utente\"><img src=\"style/img/delete.png\" /></a></td>
                </tr>
            ";
        }
        
        $objHelper = new Helper();
        $usersNumber = mysql_result($objSecureAreaQuery->CountUsers(), 0);
        
        $pagination = $objHelper->Pagination($usersNumber, $rowForPage, 3);        
        
        $usersRow = $usersRow."
            <tr>
                <td colspan=\"6\">$pagination</td>
            </tr>
        ";
        
        return $usersRow;
    }

    function DeleteUser()
    {
        header("http/1.1 200 ok");
        $url=explode("/", $_SERVER['REQUEST_URI']);
        
        if (@$url[3]!='')
            $idUser=mysql_real_escape_string(trim(stripcslashes($url[3])));
        
        $obj = new SecureAreaQuery();
        $obj->DeleteUser($idUser);
        
        header("location: ../../SecureArea/MenageUsers");
    }
    
    function SelectUser()
    {
        $idUser = $_SESSION['idUser'];
        
        $obj = new SecureAreaQuery;
        $userData = $obj->FillUsers($idUser,0,1);
        
        while ($row = mysql_fetch_assoc($userData))
        {
            $this->_userName = htmlentities($row['UserName']);
        }        
    }
    
    function SelectAvatarImageName()
    {        
        $idUser = $_SESSION['idUser'];
        
        $obj = new SecureAreaQuery();
        
        $avatarImageName = $obj->SelectAvatarImageName($idUser);
        $avatarImageName = mysql_result($avatarImageName, 0);
        
        return $avatarImageName; 
    }
    
    function EditAvatar()
    {        
        $destinationFolder = "style/avatar/";
        $idUser = $_SESSION['idUser'];        
        
        $obj = new SecureAreaActivity("");
        $oldAvatarImageName = $obj->SelectAvatarImageName($idUser);        
        die("---$oldAvatarImageName");
        
        unlink("style/avatar/$oldAvatarImageName");
        $newImageSize = $_FILES['avatarImg']['size'];
                        
        if($newImageSize >= 3145728)
            return FALSE;
        
        $fileType = $_FILES['avatar']['type'];
        if($fileType != 'image/jpeg' && $fileType != 'image/png' && $fileType != 'image/gif')
            return FALSE;
                        
        $tmpAvatarImageName = $_FILES['avatar']['tmp_name'];
        list($width, $height, $type, $attr) = getimagesize($tmpAvatarImageName);                
        
        if($width != $height)
            return FALSE;
        
        $fileType = str_replace('image/', '', $fileType);        
                        
        $newAvatarImageName = "$idUser.$fileType";
        
        $obj = new Helper();
        $obj->ResizeImage(48, $tmpAvatarImageName, $newAvatarImageName, $destinationFolder);
        
        $obj = new SecureAreaDal();
        $obj->UpdateAvatarImageName($idUser, $newAvatarImageName);        
    }
}	
?>