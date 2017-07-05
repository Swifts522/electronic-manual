<?php
if( isset( $_GET['createfoolder'] ) )
{
    $uploaddir = $_POST['CurrentDir'].'/'.$_POST['Name'];
    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0700 );
}
if( isset( $_GET['refresh'] ) )
{
    $dir = 'uploads';
    $files = scandir($dir, 1);
    
    $returnhtml = "";
    
    foreach ($files as $key => $file) 
    {
        if($file != '..' && $file != '.')
        {
            if(strripos($file, '.png') == false && strripos($file, '.jpg') == false && strripos($file, '.jpeg') == false &&
            strripos($file, '.ico') == false && strripos($file, '.svg') == false && strripos($file, '.gif') == false)
            {
                $returnhtml .= "<div class='imgview folder'>
                            <img src = 'images/icons/folder.png' width='100px' height='100px'>
                            <p style = 'text-align: center; margin-top: 10px;'>".$file."</p>
                            </div>";  
            }
            else
            {
                $returnhtml .= "<div class='imgview'>
                            <img src = '".$dir."/".$file."' width='100px' height='100px'>
                            <p style = 'text-align: center; margin-top: 10px;'>".$file."</p>
                            </div>";     
            }
        }
    }
    echo $returnhtml;
}
if( isset( $_GET['deletefolder'] ) )
{
    $files = array();
    $files = $_POST['folder'];

    foreach ($files as $file) 
    {
        rmdir($_POST['CurrentDir'].'/'.$file);
        unlink($_POST['CurrentDir'].'/'.$file); 
    }
}
if( isset( $_GET['opendir'] ) )
{
    $dir = $_POST['Folder'];
    $files = scandir($dir, 1);
    
    $returnhtml = "";
    
    foreach ($files as $key => $file) 
    {
        if($file != '..' && $file != '.')
        {
            if(strripos($file, '.png') == false && strripos($file, '.jpg') == false && strripos($file, '.jpeg') == false &&
            strripos($file, '.ico') == false && strripos($file, '.svg') == false && strripos($file, '.gif') == false)
            {
                $returnhtml .= "<div class='imgview folder'>
                            <img src = 'images/icons/folder.png' width='100px' height='100px'>
                            <p style = 'text-align: center; margin-top: 10px;'>".$file."</p>
                            </div>";  
            }
            else
            {
                $returnhtml .= "<div class='imgview'>
                            <img src = '".$dir."/".$file."' width='100px' height='100px'>
                            <p style = 'text-align: center; margin-top: 10px;'>".$file."</p>
                            </div>";     
            }
        }
    }
    echo $returnhtml;
}
?>