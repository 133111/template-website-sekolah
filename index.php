<?php
//startup 
    if(session_status() === PHP_SESSION_NONE || PHP_SESSION_NONE){
        session_start();
    }
?>
<script>
    if(window.location.pathname === "/school-dashboard-template/"){
            window.location.href = 'dashboard/login.php';
    }
</script>
