<?php

/*
 * O seguinte codigo abre uma conexao com o BD e adiciona um evento nele.
 * As informacoes de um evemto sao recebidas atraves de uma requisicao POST.
 */

// conexão com bd
require_once('conexao_db.php');

// autenticação
require_once('autenticacao.php');

// endereco evento
require_once('criar_endereco_evento.php');

// usuario que criou evento
require_once('carregar_usuario_evento.php');

// array de resposta
$resposta = array();

if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['descricao']) && isset($_POST['data']) && isset($_POST['min_pessoas']) 
&& isset($_POST['horario_inicio']) && isset($_POST['max_pessoas']) && isset($_POST['intuito']) && isset($_POST['cepEvento']) 
&& isset($_POST['cidadeEvento']) && isset($_POST['estadoEvento']) && isset($_POST['logradouroEvento']) && isset($_POST['bairroEvento']) 
&& isset($_POST['numeroEvento']) && isset($_POST['complementoEvento']) && isset($_POST['idade_publico']) && isset($_POST['classificacao']) 
&& isset($_POST['horario_fim'])) {

	// Aqui sao obtidos os parametros
	$nome = trim($_POST['nome']);
	$preco = trim($_POST['preco']);
	$descricao = trim($_POST['descricao']);
	$data = trim($_POST['data']);
	$min_pessoas = trim($_POST['min_pessoas']);
	$horario_inicio = trim($_POST['horario_inicio']);
	$horario_fim = trim($_POST['horario_fim']);
	$max_pessoas = trim($_POST['max_pessoas']);
	$intuito = trim($_POST['intuito']);
	$classificacao = trim($_POST['classificacao']);
	$idade_publico = trim($_POST['idade_publico']);

	// Chamar funcao para criar o endereço
	$cep_evento = trim($_POST['cepEvento']);
	$bairro_evento = trim($_POST['bairroEvento']);
	$cidade_evento = trim($_POST['cidadeEvento']);
	$estado_evento = trim($_POST['estadoEvento']);
	$descricao_evento = trim($_POST['logradouroEvento']);
	$numero_evento = trim($_POST['numeroEvento']);
	$complemento_evento = trim($_POST['complementoEvento']);

	$endereco = criar_endereco($db_con, $cep_evento, $bairro_evento, $cidade_evento, $estado_evento, $descricao_evento, $numero_evento, $complemento_evento);
	
	// Chamar funcao para pegar o id do usuario
	$usuario = carregar_usuario($db_con);
	if ($_FILES["foto_evento"]["size"] > 0){
		$curl = curl_init();
		$client_id="6d2b5be8400b2b3";
		$filename = $_FILES['foto_evento']['tmp_name'];    
		$handle = fopen($filename, "r");
		$data_foto = fread($handle, filesize($filename));
		$pvars   = array('image' => base64_encode($data_foto));
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
		if ($foto == NULL){
			$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, min_pessoas, horario_inicio, horario_fim, max_pessoas, FK_CLASSIFICACAO_id, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id, preco) VALUES('$descricao', '$nome', 'https://i.imgur.com/ebF3p8e.png', '$data', $min_pessoas, '$horario_inicio', '$horario_fim', $max_pessoas, $classificacao, $intuito, $endereco, $usuario, $idade_publico, $preco) returning id");
		if ($consulta->execute()) {
			$resposta["sucesso"] = 1;
		} else {
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Erro ao criar produto no BD: " . $consulta->$error;
		}
		} else {
			$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, min_pessoas, horario_inicio, horario_fim, max_pessoas, FK_CLASSIFICACAO_id, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id, preco) VALUES('$descricao', '$nome', '$foto', '$data', $min_pessoas, '$horario_inicio', '$horario_fim', $max_pessoas, $classificacao, $intuito, $endereco, $usuario, $idade_publico, $preco) returning id");
			if ($consulta->execute()) {
				$resposta["sucesso"] = 1;
			} else {
				$resposta["sucesso"] = 0;
				$resposta["erro"] = "Erro ao criar produto no BD: " . $consulta->$error;
			}
		}
	} else {
		$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, min_pessoas, horario_inicio, horario_fim, max_pessoas, FK_CLASSIFICACAO_id, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id, preco) VALUES('$descricao', '$nome', 'https://i.imgur.com/ebF3p8e.png', '$data', $min_pessoas, '$horario_inicio', '$horario_fim', $max_pessoas, $classificacao, $intuito, $endereco, $usuario, $idade_publico, $preco) returning id");
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


$linha_id = $consulta->fetch(PDO::FETCH_ASSOC);
$id_evento = $linha_id["id"];

// Converte a resposta para o formato JSON.
echo json_encode($resposta);

// Fecha a conexao com o BD
$db_con = null;

header("location: ../evento.php?id_evento=$id_evento");
?>