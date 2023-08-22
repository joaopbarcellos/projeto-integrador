<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="../logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="../css/styles_base.css">

	<link rel="stylesheet" href="../css/styles_eventos.css">

	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="../js/script_base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js" defer></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"
		defer></script>

</head>


<body>
	<!-- Header com a navbar -->
	<header>
	<?php include('header_events.php') ?>
	</header>
	<div class="d-none d-md-block">
		<!-- Botao de voltar -->
		<button class="cssbuttons-io-button "> Voltar
			<!-- Div com icone para voltar -->
			<div class="icon">
				<svg height="177px" width="177px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.284 483.284" xml:space="preserve"
					fill="#000000" stroke="#000000">
					<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
					<g id="SVGRepo_iconCarrier">
						<g>
							<polygon class="iconevoltar"
								points="483.284,221.643 88.284,221.643 88.284,153.358 0,241.644 88.284,241.644 88.284,261.643 483.284,261.643 ">
							</polygon>
							<polygon class="iconevoltar2" points="0,241.644 88.284,329.926 88.284,241.644 "></polygon>
						</g>
					</g>
				</svg>
			</div>
		</button>
	</div>
	<!-- Div com as informações do evento -->
	<div id="container" class="container col-12 m-auto">
		<h1 id="titulo" class="text-center text-lg-start offset-1">Basquete - Praça do Cauê</h1>
		<div id="evento" class="row">
			<div id="tabela" class="col-12 col-lg-10 m-auto">
				<img src="../img/13.png" id="img_evento"><!-- Imagem do evento -->
			</div>

			<div id="informacoes" class="col-12 col-lg-10 m-auto">

				<div id="desc">
					<p id="t_desc" class="fs-3" class="fs-3"><b>Descrição</b></p>
					<p id="p_desc"> <!-- Descricao do evento -->
						Basquete na cidade de Vitória - ES na Praça do Cauê, perto da Terceira Ponte
					</p>
				</div>

				<div id="localizacao"><a id="local" href="maps.php">
						<svg class="iconezin iconelocev" xmlns="http://www.w3.org/2000/svg" height="1em"
							viewBox="0 0 384 512">
							<path
								d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
						</svg>
						<p><!-- localização do evento -->
							Praça Cristóvão Jaques, 189-273 - Santa Helena, Vitória - ES, 29055-070
						</p>
					</a>
				</div>

				<div id="data">
					<svg class="iconezin iconedataev" xmlns="http://www.w3.org/2000/svg" height="1em"
						viewBox="0 0 448 512">
						<path
							d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
					</svg>
					<p id="dia">05/07/23 18:00</p><!-- Data do evento -->
				</div>

				<div id="preco">
					<p id="sifrao"><b>R$: </b> Gratuito</p><!-- Custo do evento -->
				</div>

				<div id="alvo">
					<p id="publi"><b>Público alvo: </b> Acima de 16 anos</p><!-- publico alvo do evento -->
				</div>

				<div id="intuito">
					<p id="sifrao"><b>Intuito do Evento: </b> Treino para amadores</p><!-- intuito do evento -->
				</div>

				<div class="vagas">
					<div id="vagas_restam">
						<p id="t_vagasrestam"><b>Vagas restantes: </b> 12</p><!-- Número de vagas restantes do evento -->
					</div>

					<div id="num_inscritos">
						<p id="t_numinscritos"><b>Número de Inscritos: </b> 6</p><!-- Numero de inscritos do evento -->
					</div>

				</div>
				<div id="organizador">
					<p id="t_organizador"><b>Evento organizado por: </b> Gabrielle Castro Lima</p><!-- Criador do evento -->
				</div>
				<button class="inscrever fixo" id="basqueteCaue"> <!-- botao de inscrever-se no evento -->
					<img src="../img/bola.png">
					<span class="now">Agora!</span>
					<span class="play">Inscreva-se</span>
				</button>
			</div>
		</div>
	</div>
	<footer>
	<?php include('footer_events.php') ?>
	</footer>

</body>

</html>