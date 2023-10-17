<?php

/*
 * O código abaixo registra um novo usuário.
 * Método do tipo POST.
 */

// array de resposta
$resposta = array();

require_once('conexao_db.php');

if (isset($_POST['intuito'])){
    echo PHP_VERSION;
	echo $_POST['intuito'];
}


// verifica se todos os campos necessários foram enviados ao servidor
if (isset($_POST['emailCampo']) && isset($_POST['dataCampo']) && isset($_POST['nomeCampo']) && isset($_POST['senhaCampo']) && isset($_POST['intuito']) && isset($_POST['telefoneCampo'])) {
    // o método trim elimina caracteres especiais/ocultos da string
	$nome = trim($_POST['nomeCampo']);
	$data = trim($_POST['dataCampo']);
	$email = trim($_POST['emailCampo']);
	$senha = trim($_POST['senhaCampo']);
	$intuito = trim($_POST['intuito']);
	$telefone = trim($_POST['telefoneCampo']);

	// o bd não armazena diretamente a senha do usuário, mas sim 
	// um código hash que é gerado a partir da senha.
	$token = password_hash($senha, PASSWORD_DEFAULT);
	
	// antes de registrar o novo usuário, verificamos se ele já
	// não existe.
	$consulta_usuario_existe = $db_con->prepare("SELECT email FROM usuarios WHERE email='$email'");
	$consulta_usuario_existe->execute();
	if ($consulta_usuario_existe->rowCount() > 0) { 
		// se já existe um usuario para login
		// indicamos que a operação não teve sucesso e o motivo
		// no campo de erro.
		$resposta["sucesso"] = 0;
		$resposta["erro"] = "usuario ja cadastrado";
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
			$consulta = $db_con->prepare("INSERT INTO usuarios(nome, email, token, data_nascimento, telefone, foto, FK_INTUITO_id) VALUES('$nome', '$email', '$token', '$data', '$telefone', 'foto.png', '$intuito')");
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
}
else {
	// se não foram enviados todos os parâmetros para o servidor, 
	// indicamos que não houve sucesso
	// na operação e o motivo no campo de erro.
    $resposta["sucesso"] = 0;
	$resposta["erro"] = "faltam parametros";
}

// A conexão com o bd sempre tem que ser fechada
$db_con = null;

// converte o array de resposta em uma string no formato JSON e 
// imprime na tela.
echo $resposta;
echo json_encode($resposta);
?>