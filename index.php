<?php

/**
 * @author BEHESHT
 * @copyright 2010
 * @prduct 0777 upload center...
 */
    session_start();
    
    if (!$_SESSION['ps']== md5('[0777]4u'))
    {
        echo 'لطفا پسورد را وارد نماييد<pre>';
        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
?>
</pre>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<form method="POST" action="up.php">
<input type="password" maxlength="8" name="ps" />
<input type="submit" value="login" />
</form>
<?php
    }
    else
    {
        echo '<meta http-equiv="Refresh" content="3;up.php">';
    }
?>