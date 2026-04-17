<?php
session_start();
session_destroy();
header("Location: Pages/login.html");
?>