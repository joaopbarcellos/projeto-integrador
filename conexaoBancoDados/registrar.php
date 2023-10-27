<?php

/*
 * O código abaixo registra um novo usuário.
 * Método do tipo POST.
 */

// array de resposta
$resposta = array();

require_once('conexao_db.php');

$verifica = false;

session_start();
session_unset();
session_destroy();
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
	// o método trim elimina caracteres especiais/ocultos da string
	$nome = trim($_POST['nomeCampo']);
	$data = trim($_POST['dataCampo']);
	$email = strtolower(trim($_POST['emailCampo']));
	$senha = trim($_POST['senhaCampo']);
	$intuito = trim($_POST['intuito']);
	$telefone = trim($_POST['telefoneCampo']);

	// o bd não armazena diretamente a senha do usuário, mas sim 
	// um código hash que é gerado a partir da senha.
	$token = password_hash($senha, PASSWORD_DEFAULT);
	
	// antes de registrar o novo usuário, verificamos se ele já
	// não existe.
	$consulta_usuario_existe = $db_con->prepare("SELECT email FROM usuario WHERE email='$email'");
	$consulta_usuario_existe->execute();
	if ($consulta_usuario_existe->rowCount() > 0) { 
		
		// se já existe um usuario para login
		// indicamos que a operação não teve sucesso e o motivo
		// no campo de erro.
		$resposta["sucesso"] = 0;
		$resposta["erro"] = "usuario ja cadastrado";
		$erro = "Usuário já cadastrado!";
		header("Location: ../cadastro.php?nome=$nome&data=$data&telefone=$telefone&erro=$erro");
		exit();
	}
	else {
		$verifica = false;
		if (!empty($nome)) {
			// Sanitizando o nome retornado
			$nomeFiltrado = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
			$verifica = true;
		}else{
			$verifica = false;
		}
		if (!empty($email)) {
			// Verificando se o campo de email e valido para os padroes do filtro
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// Sanitizando o email retornado
				$email = filter_var($email, FILTER_SANITIZE_EMAIL);
				$verifica = true;
			} else {
				$verifica = false;
			}
		} else {
			$verifica = false;
		}
		// Verificando se o campo de telefone retornou algum valor diferente de vazio
		$telefone = $_POST["telefoneCampo"];
		if (!empty($telefone)) {
			// Sanitizando o telefone retornado
			$telefone = filter_var($telefone, FILTER_SANITIZE_NUMBER_INT);
			$verifica = true;
		} else {
			$verifica = false;
		}
		if($verifica){
			// se o usuário ainda não existe, inserimos ele no bd.
			$email = strtolower($email);
			$consulta = $db_con->prepare("INSERT INTO usuario(nome, email, token, data_nascimento, telefone, foto, FK_INTUITO_id) VALUES('$nome', '$email', '$token', '$data,', '$telefone', 'semfoto.png', '$intuito')");
			if ($consulta->execute()) {
				// se a consulta deu certo, indicamos sucesso na operação.
				$resposta["sucesso"] = 1;
			}
			else {
				// se houve erro na consulta, indicamos que não houve sucesso
				// na operação e o motivo no campo de erro.
				$resposta["sucesso"] = 0;
				$resposta["erro"] = "erro BD: " . $consulta->$error;
			}
		}
	}

	
}else {
	// se não foram enviados todos os parâmetros para o servidor, 
	// indicamos que não houve sucesso
	// na operação e o motivo no campo de erro.
	$resposta["sucesso"] = 0;
	$resposta["erro"] = "faltam parametros";
}
// A conexão com o bd sempre tem que ser fechada
$db_con = null;

// envia pra outra pagina
header("location: ../login.php?salvou='salvou'");
?>
