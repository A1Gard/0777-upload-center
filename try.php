<?php
session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>0777 آپلود سنتر</title>
  <body style="background-color: #292929;color: white;background-image: url(bg.gif);background-repeat: repeat-x;text-align: center;" dir="rtl" >';
if (!$_SESSION['ps']== md5('[0777]4u'))
    { 
        die('لطفا دوباره وارد شويد');
    }
if ($_FILES["mfile"]["error"] > 0)
  {
  echo "Error: " . $_FILES["mfile"]["error"] . "<br />";
  die('Failed');
  }
  /*echo "Upload: " . $_FILES["mfile"]["name"] . "<br />";
  echo "Type: " . $_FILES["mfile"]["type"] . "<br />";
  echo "Size: " . ($_FILES["mfile"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["mfile"]["tmp_name"];
  */
  echo '<br /><pre>';
  $fn  = $_FILES["mfile"]["name"];
  $len = strlen($fn);
  $tk  = len - 4 ;
  $a = substr($fn,$tk,$len);
  $a = strtoupper($a);
  $arr = array(".ZIP",".RAR",".JPG",".PNG",".GIF",".SWF",".bmp");
  $bool= in_array($a,$arr);
  if (!$bool == 1)
  {
    die('فرمت آپلود شده مجاز نمي باشد.');
  }
  
  define("DB_HOST",'localhost');
  define("DB_NAME",'behesht2_t');
  define("DB_USER",'behesht2_up');
  define("DB_PASS",'1048576C++');
  
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)
    or die (mysqli_error($con));
    
  $time  = intval(strtotime("now"));
  $ip = $_SERVER['REMOTE_ADDR'];
    
  $sql = "SELECT `vip` FROM `timer` WHERE `timer` > $time AND `vip` = '$ip'";

    $rese = mysqli_query($con,$sql)
    or die (mysqli_error($con));
  
  if (mysqli_num_rows($rese)>0)
  {
    die ( 'لطفا صبر كنيد سيستم تا 3 دقيقه اجازه آپلود دوباره فايل را نمي دهد');
  }
  
  switch ($_POST['mozu'])
  {
    case 0: $tarpath = 'amuzesh/';
    break;
    case 1: $tarpath = 'image/';
    break;
    case 2 : $tarpath = 'doc/';
    break;
    case 3 : $tarpath = 'file/';
    break;
    case 4 : $tarpath = 'other/';
    break;
  }
  $tmp = $tarpath;
  $tarpath='../download/'. $tarpath .basename($_FILES["mfile"]["name"]);
  
  $size=($_FILES["mfile"]["size"]/1048500);
  if ($size > 3 )
  { 
    echo $size . "MB <br />";
    die('فايل آپلود شده بيش از حد مجاز است');
  }
  if (move_uploaded_file($_FILES["mfile"]["tmp_name"],$tarpath))
  {
    echo "آپلود شد";
  }
  else
  { 
     print_r($tarpath);
     die ('آپلود با مشكل حادي مواجه شده لطفا با مدير تماس بگيريد...');
  }
  
  $name = anti_injection($_POST['name']);
  
  $url = 'http://dl.0777.ir/'.$tmp.$_FILES["mfile"]["name"];
  
  $size = intval(ceil($_FILES["mfile"]["size"] / 1024)) ;
  
  $sql ="INSERT INTO `ups` (`name`,`vip`,`dl`,`remup`,`durl`,`size`) 
  VALUES ('$name','$ip','0','0','$url','$size')" ;
  
  
    $rese = mysqli_query($con,$sql)
    or die (mysqli_error($con));
  
   $sql = "SELECT MAX( `id` ) as maxnum FROM `ups`";
   
    $res = mysqli_query($con,$sql)
    or die (mysqli_error($con));
    
    $row = mysqli_fetch_array($res) ;
    $max = $row[maxnum];
    
echo '<br />';
    $time  = intval(strtotime("now"));
    $time += 180;
    
$sql ="INSERT INTO `timer` (`vip`,`timer`)
VALUES ('$ip','$time')";
 
    $res = mysqli_query($con,$sql)
    or die (mysqli_error($con));
    
 mysqli_close($con);

?>
<div style="position:absolute;left:20%;">
<label style="float: left;"> نام:<input readonly="true" value="<?php echo $name; ?>" /></label><br />
<label style="float: left;" > حجم:<input readonly="true" value="<?php echo $size.'KB'; ?>" /></label> <br />
<label style="float: left;" > آي پي آپلودر:<input readonly="true" value="<?php echo $ip; ?>" /></label><br />
<label style="float: left;" >لينك دانلود:<b><input readonly="true" value="<?php echo 'http://dl.0777.ir/dl.php?id='.$max ;?>" style="width: 200px;" /></label>
</div>

<?php
  ////////////////////////////////////////////////////////////
  FUNCTION anti_injection( $text ) {
    
            $banlist = ARRAY (
                    "insert", "select", "update", "delete", "distinct", "having", "truncate", "replace",
                    "handler", "like", " as ", "or ", "procedure", "limit", "order by", "group by", "asc", "desc"
            );
            // ---------------------------------------------
            $text = TRIM ( STR_REPLACE ( $banlist, '', STRTOLOWER ( $text ) ) );
            // ---------------------------------------------

            IF ($text == null ) {
                    DIE ( 'شما از کلمات نا مناسب استفاده کردید لطفا اطلاعات خود را اصلاح کنید' );
            } ELSE {
                    RETURN $text;
            }
    } 
?>
  </body>