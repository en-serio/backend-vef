<?php
session_start();
session_unset();
$_SESSION = [];
session_destroy();
?>

<script>
    location.reload();
    setTimeout(function(){
        window.location.replace("../views/login.php");
    }, 100); 
</script>