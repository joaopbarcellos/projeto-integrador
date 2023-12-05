<?php
session_start();
if (isset($_SESSION["filtro_esporte"])) unset($_SESSION["filtro_esporte"]);
if (isset($_SESSION["filtro_esporte_nome"])) unset($_SESSION["filtro_esporte_nome"]);
if (isset($_SESSION["filtro_esporte_id"])) unset($_SESSION["filtro_esporte_id"]);
if (isset($_SESSION["filtro_idade"])) unset($_SESSION["filtro_idade"]);
if (isset($_SESSION["filtro_intuito"])) unset($_SESSION["filtro_intuito"]);
if (isset($_SESSION["filtro_gratuito"])) unset($_SESSION["filtro_gratuito"]);
if (isset($_SESSION["filtro_preco"])) unset($_SESSION["filtro_preco"]);
if (isset($_SESSION["filtro_turno"])) unset($_SESSION["filtro_turno"]);
if (isset($_SESSION["filtro_data1"])) unset($_SESSION["filtro_data1"]);
if (isset($_SESSION["filtro_data2"])) unset($_SESSION["filtro_data2"]);
header("location: ../index.php")
?>
