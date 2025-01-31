<?php
session_start();
session_unset();  
session_destroy();

header("Location:  /GitHub/NOVA/Signin.php"); 
exit();
?>
