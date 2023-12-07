<?php
session_start();
if (isset($_SESSION["filtro_esporte"])) unset($_SESSION["filtro_esporte"]);
if (isset($_SESSION["filtro_esporte_nome"])) unset($_SESSION["filtro_esporte_nome"]);
if (isset($_SESSION["filtro_esporte_id"])) unset($_SESSION["filtro_esporte_id"]);
header("location: ../index.php")
?>
