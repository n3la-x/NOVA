<?php
session_start();
session_unset();  
session_destroy();

header("Location: NOVA/Signin.php"); 
exit();
?>
