<?php
session_start();
session_unset();
session_destroy();
header("Location: ../paginas/smarTrack.html");
exit();
?>