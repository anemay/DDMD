<?php
session_start();
session_destroy();
header("Location: http://localhost/ddmd/pages/index.php");
die();
