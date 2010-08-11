<?php

/**
 * @author BEHESHT
 * @copyright 2010
 * @prduct 0777 upload center...
 */
session_start();
   if (!$_SESSION['ps']== md5('[0777]4u'))
    {   
       if (md5($_POST['ps']) == md5('[0777]4u'))
       {
          echo 'خوش آمديد';
          $_SESSION['ps']= md5('[0777]4u');
       }
       else
       {
        echo '<meta http-equiv="Refresh" content="3;index.php">';
        die( 'password is invalid...');
       }
    }  
?>
<script type="text/javascript">
	function subme ( frm)
    {
        var a = document.getElementById("name");
        if (a.value.length < 4 )
        {
            alert('نام خيلي كوتاه است');
            return false ;
        }
        var b = document.getElementById("up");
        if (b.value.length < 5 )
        {
            alert('فايل به نظر معتبر نيست');
            return false ;
        }
    return true;
    }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>0777 آپلود سنتر</title>
<body style="background-color: #292929;color: white;background-image: url(bg.gif);background-repeat: repeat-x;" dir="rtl" >
<div style="position: absolute;left: 30%; top: 25%;text-align: center;color: white;">
<pre><img src="logo.png" /></pre>
<form id="form" enctype="multipart/form-data" method="POST" action="try.php" onsubmit="return  subme(this) ;">
<input type="file" name="mfile" id="up" style="background-color: #4A5064;color: white;border: 1px solid ;" />
<pre><label> نام: <input type="text" name="name" id="name" style="background-color: #4A5064;color: white;width: 175px;" /> <br />
 موضوع: <select name="mozu" style="width: 140px;background-color: #4A5064;color;color: white;width: 152px;" id="sel">
<option value="0">آموزش</option>
<option value="1">عكس</option>
<option value="2">پرونده</option>
<option value="3">دانلود</option>
<option value="4">ديگر موارد</option>
</select><br />
</pre> 
<input type="submit" value="Upload" /></label><br />
</form>
</div>
</body>