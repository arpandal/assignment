<?php
// For logout session after user login 
session_start();
session_unset();
session_destroy();

// For redirecting home page 
header("location: index.php?error=none")
?>