<?php
class Helper
{
    function Pagination($totalRows, $rowForPage, $pagesInList)
    {
        $firstRow = 0;
        $firstPage = 1;
        $prev = '';
        $next = '';
        $separator = '';
        $pageList='';
        
        header("http/1.1 200 ok");
        $url = explode("/", $_SERVER['REQUEST_URI']);
        
        $class = $url[1];
        $SelectedSection = $url[2];
        @$requestPage = $url[3];                        
               
        $numberOfPages = ceil($totalRows/$rowForPage);                    
        $lastPage = $numberOfPages;
        
        if ($requestPage == '')
            $requestPage = 1;
                
        if($requestPage > $numberOfPages)
            $requestPage = $numberOfPages;                                
        
        if($requestPage == 1 && $numberOfPages >= $pagesInList){#Se la pagina richiesta è 1                                                                       
            $lastPage = $pagesInList;#se il numero di pagine della query è maggiore del numero massimo di pagine nella lista
            $last = ' - <a href="'.$class.'/'.$SelectedSection.'/'.$numberOfPages.'">Fine</a>';
            $next = ' - <a href="'.$class.'/'.$SelectedSection.'/2'.'">></a>'.$last;            
        }else{#dalla pagina 2 in poi
            $firstRow = ($requestPage - 1) * $totalRows;
            
            if($requestPage <= $numberOfPages - $pagesInList){#se la pag corrente � inferiore alla differenza tra numero di pagine e il numero passimod i pagine x riga
                $firstPage = $requestPage;
                $lastPage = $requestPage + ($pagesInList - 1);
                $first = '<a href="'.$class.'/'.$SelectedSection.'">Inizio</a> - ';
                $prev = $first.'<a href="'.$class.'/'.$SelectedSection.'/'.($requestPage - 1).'"><</a> - ';
                $last = ' - <a href="'.$class.'/'.$SelectedSection.'/'.$numberOfPages.'">Fine</a>';
                $next = ' - <a href="'.$class.'/'.$SelectedSection.'/'.($requestPage + 1).'">></a>'.$last;
            }else{
                $firstPage = ($numberOfPages - $pagesInList) + 1;
                $lastPage = $pagesInList;
                if($requestPage >= $numberOfPages - 2){  #quando le pagine si avvicinano alla fine 
                    $lastPage = $numberOfPages;                    
                    $first = '<a href="'.$class.'/'.$SelectedSection.'">Inizio</a> - ';
                    $prev = $first.'<a href="'.$class.'/'.$SelectedSection.'/'.($requestPage - 1).'"><</a> - ';                        
                }else{
                    $lastPage = $requestPage + ($pagesInList - 1);#quando le pagine sono all'inizio
                    $first = '<a href="'.$class.'/'.$SelectedSection.'">Inizio</a> - ';
                    $prev = $first.'<a href="'.$class.'/'.$SelectedSection.'/'.($requestPage - 1).'"><</a> - ';
                    $next = '- <a href="'.$class.'/'.$SelectedSection.'/'.($requestPage + 1).'">></a>';
                }
            }            
        }        
        
        for($i = $firstPage; $i <= $lastPage; ++$i)
        {                            
            if($i >= $firstPage && $i <= $lastPage - 1)
                $separator = ' - ';
            else 
                $separator = '';                         
            
            if($i == $requestPage || $requestPage == '' && $i == 1)
                $pageList.='<a name="">'.$i.'</a>'.$separator;
            else
                $pageList.='<a href="'.$class.'/'.$SelectedSection.'/'.$i.'">'.$i.'</a>'.$separator;
        }
        
        if($totalRows >= $rowForPage)            
            $pageList = '<div style="text-align:center;">Pagine - '.$prev.$pageList.$next.'</div> <br />';
        
        return $pageList;
    }

    function ResizeImage($maxSize, $tmpImageName, $newImageName, $destinationFolder)
    {
        if (isset($maxSize))
            $this->ProportionalSize($pathImage, $maxSize, $proportionalWidth, $proportionalWidth);
        
        $resizedImage = imagecreatetruecolor ($Width, $Height);
        
        if($imageType == 'image/jpeg' || $imageType=='jpeg' || $imageType == 'image/jpg' || $imageType=='jpg'){
            $source = imagecreatefromjpeg($tmpImageName);
            imagecopyresampled($resizedImage, $source,0, 0, 0, 0, $proportionalWidth, $proportionalHeight, $width, $height);    
            imagejpeg($resizedImage,"$destinationFolder"."$newImageName",100);
            
        }elseif($imageType=='image/png' || $imageType=='png'){
            
            $source = imagecreatefrompng($tmpImageName);
            imagecolortransparent($resizedImage, imagecolorallocate($resizedImage, 0, 0, 0));
            imagealphablending($resizedImage, true);
            imagesavealpha($resizedImage, true);
            imagecopyresampled($resizedImage, $source, 0, 0, 0, 0, $proportionalWidth, $proportionalHeight, $width, $height);
            
            imagepng($thumb,"$destinationFolder"."$newImageName", 0);
            
        }elseif($imageType=='image/gif' || $imageType=='gif'){
            $source=imagecreatefromgif($tmpImageName);
            imagecolortransparent($resizedImage, imagecolorallocate($resizedImage, 0, 0, 0));
            imagealphablending($resizedImage, true);
            imagesavealpha($resizedImage, true);
            imagecopyresampled($resizedImage, $source,0, 0, 0, 0, $proportionalWidth, $proportionalHeight, $width, $height);
            
            imagegif($resizedImage,"$destinationFolder"."$newImageName", 100);            
        }        
    }
    
    function ProportionalSize($pathImage, $maxSize, &$proportionalWidth, &$proportionalHeight)
    {
        list($width, $height, $imageType, $attr) = getimagesize($pathImage);
                                        
        if($height > $width)
        {
            $proportionalWidth = ($maxSize * $width)/$height;
            $proportionalHeight = $maxSize;
        }
        elseif($alt < $larg)
        {
            $proportionalWidth = $maxSize;
            $proportionalHeight = ($height * $maxSize)/$width;
        }
        elseif($width == $height)
        {
            $proportionalWidth = $maxSize;
            $proportionalHeight = $maxSize;
        }        
    }     
}
?>