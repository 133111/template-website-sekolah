<?php
    if(session_status() === PHP_SESSION_NONE || PHP_SESSION_NONE){
        session_start();
    }
?>
<script>
    if(window.location){
            window.location.href = 'dashboard/index.php';
    }
</script>
