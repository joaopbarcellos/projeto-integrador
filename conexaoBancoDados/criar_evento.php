<?php

/*
 * O seguinte codigo abre uma conexao com o BD e adiciona um evento nele.
 * As informacoes de um evemto sao recebidas atraves de uma requisicao POST.
 */

// conexão com bd
require_once('conexao_db.php');

// autenticação
require_once('autenticacao.php');

// array de resposta
$resposta = array();

// verifica se o usuário conseguiu autenticar
if(autenticar($db_con)) {
	
	// Primeiro, verifica-se se todos os parametros foram enviados pelo cliente.
	// A criacao de um evento precisa dos seguintes parametros:
	// 	descricao
	//  nome
	//  foto
	//  data
	//  telefone
	//  min_pessoas 
	//  preco
	//  horario_inicio
	//  max_pessoas
	//  FK_INTUITO_id
	//  FK_ENDERECO_id
	//  FK_USUARIO_id
	//  FK_IDADE_PUBLICO_id

	if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['descricao']) && isset($_POST['data']) && isset($_POST['telefone']) 
	&& isset($_POST['min_pessoas']) && isset($_POST['horario_inicio']) && isset($_POST['max_pessoas']) && isset($_POST['intuito']) 
	&& isset($_POST['usuario']) && isset($_POST['cepEvento']) && isset($_POST['cidadeEvento']) && isset($_POST['estadoEvento']) 
	&& isset($_POST['logradouroEvento']) && isset($_POST['bairroEvento']) && isset($_POST['numeroEvento']) && isset($_POST['complementoEvento']) 
	&& isset($_POST['idade_publico'])) {

		// Aqui sao obtidos os parametros
		$nome = trim($_POST['nome']);
		$preco = trim($_POST['preco']);
		$descricao = trim($_POST['descricao']);
		$data = trim($_POST['data']);
		$telefone = trim($_POST['telefone']);
		$min_pessoas = trim($_POST['min_pessoas']);
		$horario_inicio = trim($_POST['horario_inicio']);
		$max_pessoas = trim($_POST['max_pessoas']);
		
		// Pegar o id
		$intuito = trim($_POST['intuito']);

		// Criar endereço



		// Pegar o id
		$usuario = trim($_POST['usuario']);

		// Pegar o id
		$idade_publico = trim($_POST['idade_publico']);

		if ($_FILES["foto_evento"]["size"] > 0){
			$curl = curl_init();
			$client_id="6d2b5be8400b2b3";
			$filename = $_FILES['foto_evento']['tmp_name'];    
			$handle = fopen($filename, "r");
			$data = fread($handle, filesize($filename));
			$pvars   = array('image' => base64_encode($data));
			$timeout = 30;
	
			if ($curl === false) {
				// Lidar com erro na inicialização do cURL
				echo "Erro ao inicializar cURL";
			} else {
				// Configurar e executar a solicitação cURL
				curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
				curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				
				$result = curl_exec($curl);
	
				if ($result === false) {
					// Lidar com erro na execução da solicitação
					echo "Erro na execução do cURL: " . curl_error($curl);
				} else {
					// Processar a resposta
					$pms = json_decode($result,true);
					$foto = $pms['data']['link'];
				}
	
				// Fechar a sessão cURL
				curl_close($curl);
			}
	
			$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, telefone, min_pessoas, horario_inicio, max_pessoas, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id) VALUES('$descricao', '$nome', '$foto', '$data', '$telefone', '$min_pessoas', '$horario_inicio', '$max_pessoas', '$intuito', '$endereco', '$usuario', '$idade_publico')");
			if ($consulta->execute()) {
				$resposta["sucesso"] = 1;
			} else {
				$resposta["sucesso"] = 0;
				$resposta["erro"] = "Erro ao criar produto no BD: " . $consulta->$error;
			}
		} else {
			$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, telefone, min_pessoas, horario_inicio, max_pessoas, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id) VALUES('$descricao', '$nome', '', '$data', '$telefone', '$min_pessoas', '$horario_inicio', '$max_pessoas', '$intuito', '$endereco', '$usuario', '$idade_publico')");
			if ($consulta->execute()) {
				$resposta["sucesso"] = 1;
			} else {
				$resposta["sucesso"] = 0;
				$resposta["erro"] = "Erro ao criar produto no BD: " . $consulta->$error;
			}
		}
	} else {
		// Se a requisicao foi feita incorretamente, ou seja, os parametros 
		// nao foram enviados corretamente para o servidor, o cliente 
		// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
		// motivo da falha.
		$resposta["sucesso"] = 0;
		$resposta["erro"] = "Campo requerido nao preenchido";
	}
} else {
	// senha ou usuario nao confere
	$resposta["sucesso"] = 0;
	$resposta["erro"] = "usuario ou senha não confere";
}

// Fecha a conexao com o BD
$db_con = null;

// Converte a resposta para o formato JSON.
echo json_encode($resposta);
?>