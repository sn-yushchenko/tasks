<?php
//класс обработки файлов 

class File{
    public function __construct()
    {
        
    } 
    public static function sizeFileRecord($width,$height,$tmpName,$type,$fileName)
    {
                 
        $path=ROOT."/image/$fileName";
        
        // получение новых размеров
        list($pageWidth, $pageHeight) = getimagesize($tmpName); 
                
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($tmpName);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height,$pageWidth, $pageHeight);

    switch($type) 
    {
        case "image/jpeg": imagejpeg($image_p,$path); break;
        case "gif": imagejgif($image_p,$path); break;
        case "png": imagejgif($image_p,$path); break;
    }
        return $tmpName;
    } 
 
}
?>