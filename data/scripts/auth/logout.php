<?php 
header("Location: /tugas/index.php");
session_start();
session_destroy();
session_unset();
?>