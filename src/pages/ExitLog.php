<?php
session_start();
session_destroy();
$_SESSION['userID'] = false;
$_SESSION['fio'] = false;
header("Location: http://testbd/");