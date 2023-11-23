<?php
// esse arquivo SANITIZA as entradas
// do cadastro de usuario

$verifica = false;

session_start();
if (isset($_POST["nomeCampo"])) {
  // Verificando se o campo de nome retornou algum valor diferente de vazio
  $nome = $_POST["nomeCampo"];
  if (!empty($nome)) {
    // Sanitizando o nome retornado
    $nomeFiltrado = filter_var(trim($nome), FILTER_SANITIZE_SPECIAL_CHARS);
    $verifica = true;
    $_POST["nomeCampo"] = $nome;
  } else {
    $verifica = false;
  }
} else {
  $verifica = false;
}

if (isset($_POST["emailCampo"])) {
  // Verificando se o campo de email retornou algum valor diferente de vazio
  $email = $_POST["emailCampo"];
  if (!empty($email)) {
    // Verificando se o campo de email e valido para os padroes do filtro
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // Sanitizando o email retornado
      $emailFiltrado = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
      $_SESSION["email"] = $emailFiltrado;
      $verifica = true;
      $_POST["emailCampo"] = $emailFiltrado;
    } else {
      $verifica = false;
    }
  } else {
    $verifica = false;
  }
} else {
  $verifica = false;
}
if (isset($_POST["telefoneCampo"])) {
  // Verificando se o campo de telefone retornou algum valor diferente de vazio
  $telefone = $_POST["telefoneCampo"];
  if (!empty($telefone)) {
    // Sanitizando o telefone retornado
    $telefoneFiltrado = filter_var(trim($telefone), FILTER_SANITIZE_NUMBER_INT);
    $verifica = true;
    $_POST["telefoneCampo"] = $telefoneFiltrado;
  } else {
    $verifica = false;
  }
} else {
  $verifica = false;
}

if (isset($_POST["senhaCampo"])) {
  $_SESSION["senha"] = $_POST["senhaCampo"];
}

// Verificando se todos os valores foram sanitizados
if ($verifica) {
  // Enviando para a tela de login
  header("location: registrar.php");
}
?>