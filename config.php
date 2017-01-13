<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "forum";
$conexao = mysqli_connect($server, $user, $password, $db);
date_default_timezone_set('America/Sao_Paulo');

// URL Absoluta
$pasta = ($_SERVER['SERVER_NAME'] == "localhost") ? 'forum' : null;
$url = "http://" . $_SERVER['SERVER_NAME'] . '/' . $pasta . '/';
?>