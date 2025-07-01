<?php
session_start();
session_destroy(); // Encerrar a sessão
header("Location: login.php");
exit();
?>