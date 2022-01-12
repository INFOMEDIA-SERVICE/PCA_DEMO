<?php 
        header('content-type: image/png');
        $img=@imagecreatetruecolor(100,30);
        $fondo=imagecolorallocate($img,255,255,255);
        $text=imagecolorallocate($img,255,255,255);
        session_start();
        $key='';
        for($x=15;$x<95;$x+=20){
            $key.=($num=rand(0,9));
            imagechar($img,rand(3,5),$x,rand(2,14),$num,$text);
        }    
        imagepng($img);
        imagedestroy($img);
        $_SESSION['img_number']=$key;
    ?>