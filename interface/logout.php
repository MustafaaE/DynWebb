<?php
require_once "../components/methods.php";
require_once "../interface/connection.php";

unset($_SESSION['user']);
session_unset();
session_destroy();
redirectTo('ux/login.php');