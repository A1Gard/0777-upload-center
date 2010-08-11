<?php

/**
 * @author 0777 dler
 * @copyright 2010
 */

echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>0777 دانلودر اسكريپت</title>
  <body style="background-color: #292929;color: white;background-image: url(../up/bg.gif);background-repeat: repeat-x;text-align: center;" dir="rtl" >';

if ( isset( $_GET['id'] ) )

  {
    $num = intval($_GET['id']);
    if ($num > 0)
    {
 
  define("DB_HOST",'localhost');
  define("DB_NAME",'behesht2_t');
  define("DB_USER",'behesht2_up');
  define("DB_PASS",'1048576C++');       
        
        $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)
        or die (mysqli_error($con));
    
    $sql = "SELECT `dl`,`durl` FROM `ups` WHERE `id` = '$num'";

        $rese = mysqli_query($con,$sql)
        or die (mysqli_error($con));
        
        if (mysqli_num_rows($rese)==1)
        {
        while($rw = mysqli_fetch_row($rese))
            {
                $dl = $rw[0];
                $url = $rw[1];
            }
            $dl++;
            
            $sql = "UPDATE `ups` SET `dl` = '$dl' WHERE `id` = '$num'";
            
            $rese = mysqli_query($con,$sql)
            or die (mysqli_error($con));
            
            echo '<meta http-equiv="Refresh" content="0;'.$url.'">';
        }
        else
        {
        die('فايل پيدا نشد در صورت اهميت به مدير گزارش دهيد... حتما رسيدگي مي شود');
        }
    }
  }
  else
  {
  
  die('لطفا در وارد كردن لينك توجه فرماييد');
  }

?>