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

	if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['descricao']) && isset($_FILES['foto']) && isset($_POST['data']) && isset($_POST['min_pessoas']) 
	&& isset($_POST['horario_inicio']) && isset($_POST["estado"]) && isset($_POST["cidade"]) && isset($_POST["bairro"]) && isset($_POST["cep"]) && isset($_POST['horario_fim']) 
    && isset($_POST['max_pessoas']) && isset($_POST["numero"]) && isset($_POST['intuito']) && isset($_POST['endereco']) && isset($_POST['idade_publico']) && isset($_POST['classificacao'])) {

		// Aqui sao obtidos os parametros
		$nome = trim($_POST['nome']);
		$preco = trim($_POST['preco']);
		$descricao = trim($_POST['descricao']);
		$data = trim($_POST['data']);
		$min_pessoas = trim($_POST['min_pessoas']);
		$horario_inicio = trim($_POST['horario_inicio']);
		$horario_fim = trim($_POST['horario_fim']);
		$max_pessoas = trim($_POST['max_pessoas']);
		$intuito = $_POST['intuito'];
		$endereco = trim($_POST['endereco']);
		$idade_publico = $_POST['idade_publico'];
		$estado = $_POST['estado'];
		$cidade = trim($_POST['cidade']);
		$bairro = trim($_POST['bairro']);
		$cep = trim($_POST['cep']);
		$numero = trim($_POST["numero"]);
		$classificacao = $_POST['classificacao'];

		$filename = $_FILES['foto']['tmp_name'];
		$client_id="ce5d3a656e2aa51";
		$handle = fopen($filename, "r");
		$data = fread($handle, filesize($filename));
		$pvars   = array('image' => base64_encode($data));
		$timeout = 30;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
		$out = curl_exec($curl);
		curl_close ($curl);
		$pms = json_decode($out,true);
		$img_url=$pms['data']['link'];

		$consulta_cidade = $db_con->prepare("SELECT * FROM cidade WHERE nome = " . $cidade);
        $consulta_cidade->execute();
        if($consulta_cidade->rowCount() == 0){
            $id_estado = $linha_estado["id"];
            $consulta_criar_cidade = $db_con->prepare("INSERT INTO cidade(nome, FK_ESTADO_id) VALUES('$cidade', '$id_estado')");
            if ($consulta_criar_cidade->execute()) {
                // se a consulta deu certo, indicamos sucesso na operação.
                $resposta["sucesso"] = 1;
            }
            else {
                // se houve erro na consulta, indicamos que não houve sucesso
                // na operação e o motivo no campo de erro.
                $resposta["sucesso"] = 0;
                $resposta["erro"] = "erro ao criar cidade BD: " . $consulta_criar_cidade->$error;
            }
            $consulta_cidade = $db_con->prepare("SELECT id FROM cidade WHERE nome = " . $cidade);
            $consulta_cidade->execute();
        }
        $linha_cidade = $consulta_cidade->fetch(PDO::FETCH_ASSOC);

        $consulta_bairro = $db_con->prepare("SELECT * FROM bairro WHERE nome = " . $bairro);
        $consulta_bairro->execute();
        if($consulta_bairro->rowCount() == 0){
            $id_cidade = $linha_cidade["id"];
            $consulta_criar_bairro = $db_con->prepare("INSERT INTO bairro(nome, FK_ESTADO_id) VALUES('$bairro', '$id_cidade')");
            if ($consulta_criar_bairro->execute()) {
                // se a consulta deu certo, indicamos sucesso na operação.
                $resposta["sucesso"] = 1;
            }
            else {
                // se houve erro na consulta, indicamos que não houve sucesso
                // na operação e o motivo no campo de erro.
                $resposta["sucesso"] = 0;
                $resposta["erro"] = "erro ao criar bairro BD: " . $consulta_criar_bairro->$error;
            }
            $consulta_bairro = $db_con->prepare("SELECT id FROM bairro WHERE nome = " . $bairro);
            $consulta_bairro->execute();
        }
        $linha_bairro = $consulta_bairro->fetch(PDO::FETCH_ASSOC);

		$id_bairro = $linha_bairro["id"];
		$consulta_endereco = $db_con->prepare("INSERT INTO endereco(numero, cep, descricao, FK_BAIRRO_id) VALUES('$numero', '$cep', '$endereco', '$id_bairro')");
		$consulta_endereco->execute();
		
		$consulta_endereco = $db_con->prepare("SELECT id FROM endereco WHERE numero = " . $numero . " and cep = ". $cep);
		$consulta_endereco->execute();
		$linha_endereco = $consulta_endereco->fetch(PDO::FETCH_ASSOC);


		$id_endereco = $linha_endereco["id"];

		$consulta_usuario = $db_con->prepare("SELECT id FROM usuario WHERE email = " . $email);
		$consulta_usuario->execute();
		$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);

		$id_usuario = $linha_usuario["id"];

		// A proxima linha insere um novo produto no BD.
		// A variavel consulta indica se a insercao foi feita corretamente ou nao.
		$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, telefone, min_pessoas, horario_inicio, horario_fim, max_pessoas, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id, FK_CLASSIFICACAO_id)
		VALUES('$descricao', '$nome', '$img_url', '$data', '$telefone', '$min_pessoas', '$horario_inicio', '$horario_fim', '$max_pessoas', '$intuito', '$id_endereco', '$id_usuario', '$idade_publico', '$classificacao')");
		if ($consulta->execute()) {
			// Se o produto foi inserido corretamente no servidor, o cliente 
			// recebe a chave "sucesso" com valor 1
			$resposta["sucesso"] = 1;
		} else {
			// Se o produto nao foi inserido corretamente no servidor, o cliente 
			// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
			// motivo da falha.
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Erro ao criar evento no BD: " . $consulta->$error;
		}
	} else {
		// Se a requisicao foi feita incorretamente, ou seja, os parametros 
		// nao foram enviados corretamente para o servidor, o cliente 
		// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
		// motivo da falha.
		$resposta["sucesso"] = 0;
		$resposta["erro"] = "Campo requerido nao preenchido";
	}
}
else {
	// senha ou usuario nao confere
	$resposta["sucesso"] = 0;
	$resposta["erro"] = "usuario ou senha não confere";
}

// Fecha a conexao com o BD
$db_con = null;

// Converte a resposta para o formato JSON.
echo json_encode($resposta);
?>