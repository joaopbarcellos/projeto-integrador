<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>

	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/myevents.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/meuseventos.js" type="module"></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
</head>

<body>
	<!-- Header com a navbar -->
	<header>
		<?php include('header.php') ?>
	</header> <!-- Fechando header -->

	<div class="col-12" id="seletorevento">
		<div class="col-6 selected" id="inscrito">
			<h3>Eventos Inscritos</h3>
		</div>

		<div class="col-6 not-selected" id="criado">
			<h3>Eventos Criados</h3>
		</div>
	</div>

	<p class="text-center semevento" id="seminscrito">Você não está inscrito em nenhum evento!</p>
	<p class="text-center semevento" id="semcriado">Você não criou nenhum evento!</p>

	<!-- Section que carrega todas as div eventos -->
	<section class="conteudo col-11 m-auto">
		<div id="naoAchou" class="fs-4 msg_erro">Nenhum resultado para "" foi encontrado!</div>
		
		<?php
			$json_data = include("conexaoBancoDados/carregar_eventos_inscritos.php");
			$eventos = json_decode($json_data, true);
			date_default_timezone_set("America/Sao_Paulo"); 
			foreach ($eventos["eventos"] as $evento){
				echo '<!-- Div evento -->
				<div class="evento mt-3 mt-sm-4 mt-4 mt-5 mt-3"  id="'. $evento["id"] .'">
				<!-- Div onde ficará todas as informações -->
					<div class="informacoes">
						<div class="row">
						
							<img src="' . $evento["foto"] . '" alt="'. $evento["nome"] .'" class="imgEventos img-fluid col-12  col-lg-5">
							<!-- Div desc que contem todas as descrições do evento -->
							<div class="desc col-12 col-lg-7">
								<!-- Parágrafo com título do evento -->
								<p class="pTitulo"><b>'. $evento["nome"] . '</b></p>
								
								<!-- Div que contem data e hora -->
								<div class="data">
									<svg class="iconedata" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
										<path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
									</svg>
									<p>'. date("d/m/Y", strtotime($evento["data"])). ' ' . date("H:i", strtotime($evento["horario_inicio"])) . ' - ' .date("H:i", strtotime($evento["horario_fim"])) .'</p>
								</div>
								
								<!-- Parágrafo com endereço do evento -->
								<p class="ende">
									<svg class="iconeloc" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
										<path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
									</svg>
									'. $evento["endereco"] . '
								</p>
								
								<!-- Div com o Esporte-->
								<div class="intuito">
									<p><b>Esporte:</b> '. $evento["classificacao"] . '</p>
								</div>
								
								<!-- Div com o intuito-->
								<div class="intuito d-none d-lg-block">
									<p><b>Público alvo:</b> '. $evento["intuito"] .'</p>
								</div>
								
								<!-- Div com o público-->
								<div class="intuito d-none d-lg-block">
									<p><b>Faixa Etária:</b> '. $evento["idade_publico"] .' anos</p>
								</div>
								
								<!-- Div com botão para inscrever-se e parágrafo dizendo o valor do evento-->
								<div class="btn_des">
									<p><b>Custo:</b>';
								if ($evento["preco"] == 0){
									echo ' Gratuito</p>
									</div>';
								} else {
									echo ' R$'.  $evento["preco"] . '</p>
								</div>';
								}
								echo '
								<!-- Button para o usuário se desinscrever -->
								<button class="inscricao sb-list " id="'. $evento["id"] .'"><span>Cancelar inscrição</span></button>

								<!-- Fim da div desc -->
							</div>
						</div>

						<!--- Fim da div informacoes -->
					</div>

					<!-- Fim da div evento -->
				</div>';
			}
			$db_con = NULL;
			?>

		<!--- Fim da Section -->
	</section>




	<footer>
		<?php include('footer.php') ?>
	</footer>
</body>

</html>






