<?php
require 'config.php';

//LIMPA A SESSION E DIRECIONA PARA O INDEX
$_SESSION['token'] = null;
header("Location: $base/index.php");

?>