<!--
  Esse arquivo vai dar um POST para
  CONSULTAR o banco de dados e checar
  se o usuario acertou o email e senha
-->

<!DOCTYPE html>

<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="icon" type="image/x-icon" href="logos/icon.png" />

  <title>Time In</title>

  <link rel="stylesheet" href="css/login.css" />

  <link rel="stylesheet" href="css/base.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

  <script src="js/valida_login.js" type="module" defer></script>

  <script src="js/base.js" type="module" defer></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet" />
</head>

<body>
  <?php
  $emailUsuario = "";
  $senhaUsuario = "";

  if (isset($_GET['salvou'])) {
    $script = $_GET['salvou'];
    session_start();
    if (isset($_SESSION["senha"]) && isset($_SESSION["email"])) {
      $emailUsuario = $_SESSION["email"];
      $senhaUsuario = $_SESSION["senha"];
    }
  }

  if (isset($_GET['erroLogin'])) {
    $erro = $_GET['erroLogin'];
    session_start();
    echo '<script>
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: `' . $_GET["erroLogin"] . '`
    });
    
    </script>';

  }

  ?>
  <header class="d-none d-lg-block">
    <!-- Header com imagem dentro de um link -->
    <a href="index.php"> <img id="logo_image" src="logos/11.png" /></a>
  </header>
  <!-- Div que ficará com o formulário -->
  <div class="divLogin mt-5 col-lg-4 col-10 m-auto">
    <form id="form" action="conexaoBancoDados/carregaLogin.php" method="post">
      <legend class="p-3 text-center fs-1">Entrar</legend>

      <!-- Nome usuário -->
      <div class="campos email mb-5">
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInputGroup1" placeholder="E-mail" name="emailCampo" value="<?php echo $emailUsuario ?>" />
          <label for="email_usuario" id="label_email">E-mail</label>
        </div>
      </div>

      <!-- Senha usuário -->
      <div class="campos senha">
        <div class="form-floating">
          <img src="img/olho_aberto.png" id="olho" class="olho" />
          <input type="password" class="form-control" id="floatingInputGroup2" placeholder="Senha" name="senhaCampo" value="<?php echo $senhaUsuario ?>" />
          <label for="senha_usuario" id="label_senha">Senha</label>
        </div>
        <!-- Links caso o usuário tenha esquecido a senha ou ainda não possui uma conta -->
        <a href="cadastro.php" class="link"> Não possui uma conta? </a>
      </div>
    </form>

    <!-- Div com botão para entrar na conta ou entrar como convidado, está fora do form para página não recarregar com o clique -->
    <div class="campos log">
      <button id="btnEnviar">Entrar</button>

      <button id="entrar_conv">Entrar como convidado</button>
    </div>

    <!-- Fim da div divLogin -->
  </div>
</body>

</html>