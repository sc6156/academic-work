<?php
session_start();
session_regenerate_id();
session_unset();
session_destroy();
header('Refresh: 1; url=home.php'); // Redirect to the home page
exit;
?>