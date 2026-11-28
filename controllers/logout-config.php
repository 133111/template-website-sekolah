<?php
//not need config
//destroy data session
session_start();
    //delete value of $_SESSION from tmp
        $_SESSION ["login"] = []; //empty
    session_unset(); //delete addition, (timpa)
    session_destroy(); 
setcookie('id', '', time()-3600);
setcookie('key', '', time()-3600);

//redirect:
header("Location: login.php");

?>