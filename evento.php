<!-- 
	Esse arquivo CONSULTA o banco de dados
	para preencher as informacoes do evento
-->

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/eventos.css">

	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/base.js" type="module" defer></script>

	<script src="js/evento.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js" defer></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>

</head>

<?php
session_start();
date_default_timezone_set("America/Sao_Paulo"); 
require('conexaoBancoDados/conexao_db.php');

require_once('conexaoBancoDados/Carregar/carregar_endereco_evento.php');
require_once('conexaoBancoDados/Carregar/carregar_intuito.php');
require_once('conexaoBancoDados/Carregar/carregar_classificacao.php');
require_once('conexaoBancoDados/Carregar/carregar_intervalo.php');
require_once('conexaoBancoDados/inscrito.php');
require_once('conexaoBancoDados/criador.php');

if (isset($_GET['id_evento'])) {
	$_SESSION["evento_atual"] = trim($_GET['id_evento']);
	$json_data = include_once("conexaoBancoDados/carregar_detalhes_eventos.php");
} else {
	header("location: index.php");
}

$evento = json_decode($json_data, true);
?>

<body>
	<!-- Header com a navbar -->
	<header>
		<?php include('header.php') ?>
	</header>
	<div class="d-none d-md-block">
		<!-- Botao de voltar -->
		<button class="cssbuttons-io-button "> Voltar
			<!-- Div com icone para voltar -->
			<div class="icon">
				<svg height="177px" width="177px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.284 483.284" xml:space="preserve" fill="#000000" stroke="#000000">
					<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
					<g id="SVGRepo_iconCarrier">
						<g>
							<polygon class="iconevoltar" points="483.284,221.643 88.284,221.643 88.284,153.358 0,241.644 88.284,241.644 88.284,261.643 483.284,261.643 ">
							</polygon>
							<polygon class="iconevoltar2" points="0,241.644 88.284,329.926 88.284,241.644 "></polygon>
						</g>
					</g>
				</svg>
			</div>
		</button>
	</div>


	<!-- Div com o conteudo ta pagina geral -->
	<div id="container" class="container col-12 m-auto mt-4">
		<div id="fundoev" class="col-11 col-md-8  col m-auto">
			<!-- Adicionando titulo -->
			<h1 id="titulo" class="text-center"><?php echo $evento["nome"];?></h1>
			<div id="evento" class="row">
				<div id="tabela">
					<img src="<?php echo $evento["foto"];?>" id="img_evento">
				</div>

				<!-- Div geral com as informacoes do evento -->
				<div id="informacoes">

					<!-- Div com as descricoes -->
					<div id="desc">
						<p id="t_desc" class="fs-3"><b>Descrição</b></p>
						<p id="p_desc">
							<?php echo $evento["descricao"];?>
						</p>
					</div>

					<!-- Div com o esporte-->
					<div class="alinhando">
						<p><b>Esporte:</b> <?php echo carregar_classificacao($db_con, $evento["id_classificacao"]);?></p>
					</div>

					<!-- Div de localizacao -->
					<div id="localizacao">
						<!-- Icone da localizacao -->
						<svg class="iconezin iconelocev" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
							<path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
						</svg>
						<p>
							<!-- localizacao do evento-->
							<a id="loc_evento" href="https://www.google.com/maps?q=<?php echo urlencode(carregar_endereco($db_con, $evento["id_endereco"])); ?>" target="_blank">
								<?php echo carregar_endereco($db_con, $evento["id_endereco"]);?>
							</a>
						</p>
					</div>


					<!-- Div com a data -->
					<div id="data">
						<svg class="iconezin iconedataev" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
							<path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
						</svg>
						<p id="dia"><?php echo date("d/m/Y", strtotime($evento["data"])). ' ' . date("H:i", strtotime($evento["horario_inicio"])) . ' - ' .date("H:i", strtotime($evento["horario_fim"]));?></p>
					</div>

					<!-- Div com o publico-alvo do evento -->
					<div id="alvo">
						<p id="publi"><b>Faixa Etária: </b> <?php echo carregar_intervalo($db_con, $evento["id_idade_publico"]);?></p>
					</div>

					<!-- Div com o intuito do evento -->
					<div id="intuito">
						<p id="sifrao"><b>Público alvo: </b><?php echo carregar_intuito($db_con, $evento["id_intuito"]);?></p>
					</div>

					<!-- Div com o numero de vagas restantes -->
					<div class="vagas">
						<div id="vagas_restam">
							<p id="t_vagasrestam"><b>Vagas restantes: </b> <?php echo $evento["vagas_restantes"];?></p>
						</div>

						<!-- Div com o numero de inscritos do evento -->
						<div id="num_inscritos">
							<p id="t_numinscritos"><b>Número de Inscritos: </b> <?php echo $evento["inscritos"];?></p>
						</div>
					</div>

					<!-- Div com o organizador do evento -->
					<div id="organizador">
						<p id="t_organizador"><b>Evento organizado por: </b><?php echo $evento["usuario"];?></p>
					</div>

					<!-- Div com o contato-->
					<div class="alinhando">
						<p><b>Contato:</b> <?php echo $evento["contato"];?></p>
					</div>

					<!-- Div com o custo do evento -->
					<div id="preco">
						<p id="sifrao"><b>Custo:</b> <?php if ($evento["preco"] == 0){
							echo ' Gratuito';
						} else {
							echo ' R$'.  $evento["preco"];
						}?></p>
					</div>

					<!-- Botao de inscrever-se -->
					<?php
					if (criador($evento['id'], $db_con)) {
						echo 
						'
						<button class="excluir_evento" name="'. $evento["id"] .'"><span>Excluir evento</span></button>
						
						<button class="editBtn" id="'. $evento["id"] .'">
							<svg height="1em" viewBox="0 0 512 512">
								<path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>										
							</svg>
							<span class="editText"><b>Editar</b></span>
						</button>';
					} else if (inscrito($evento['id'], $db_con)){
						echo
						'<button class="inscrever fixo" id="'. $evento['id'] . '" disabled>
							<img src="logos/icon2.png">
							<span class="now">Prepare-se!</span>
							<span class="play">Você está inscrito!</span>
						</button>';
					} else if ($evento["vagas_restantes"] == 0) {
						echo
						'<button class="inscrever fixo" id="'. $evento['id'] . '" disabled>
							<img src="logos/icon2.png">
							<span class="now">Fica pra próxima!</span>
							<span class="play">Evento lotado!</span>
						</button>';
					} else {
						echo
						'<button class="inscrever fixo" id="' . $evento['id']. '">
							<img src="logos/icon2.png">
							<span class="now">Agora!</span>
							<span class="play">Inscreva-se</span>
						</button>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<?php
			$db_con = NULL; 
			include('footer.php') 
		?>
	</footer>

</body>

</html>
