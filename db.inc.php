<?php
define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASSWORD", "root");
define("MYSQL_DB", "cms");

$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die(mysqli_error($db));
mysqli_select_db($db, MYSQL_DB) or die(mysqli_error($db));

// 设置时区
date_defauLt_timezone_set("PRC");

// 显示所有错误
error_reporting(E_ALL ^ E_NOTICE);