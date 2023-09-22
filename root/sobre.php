<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/sobre.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"
		defer></script>

</head>
	<?php 
		session_start();
	?>
<body>
	<!-- Header com a navbar -->
	<header>
		<?php include('header.php') ?>
	</header> <!-- Fechando header -->

	<!-- Div que fala um pouco sobre a equipe -->

	<div class="m-auto col-11 col-md-10" id="sobre">

		<!--- Título da div -->
		<h1 class="fs-1 text">Sobre nós</h1>

		<p class="fs-sm-6 fs-lg-5">
			Somos uma equipe dedicada e apaixonada por esportes, e criamos esta plataforma para ajudar os organizadores
			de eventos e os participantes
			a se conectarem de forma fácil e eficiente. Nosso objetivo é tornar a participação em eventos esportivos o
			mais fácil e acessível possível.
			Para isso, oferecemos uma variedade de ferramentas que ajudam a organizar e promover eventos, além de
			permitir que os participantes
			encontrem e se inscrevam para eventos em todo o país. Nós trabalhamos com organizadores de eventos
			esportivos de diferentes modalidades, desde
			corridas de rua até competições de ciclismo, para garantir que nossa plataforma atenda às necessidades de
			todos os tipos de eventos.
			Nós nos esforçamos para oferecer uma experiência online sem complicações para todos os nossos usuários.
			Através de nossa interface intuitiva,
			os organizadores de eventos podem criar e gerenciar seus eventos com facilidade, enquanto os participantes
			podem encontrar e se inscrever para
			eventos com apenas alguns cliques. Além disso, nossa equipe de suporte está sempre pronta para ajudar em
			caso de quaisquer problemas ou dúvidas.
			Queremos garantir que todos os nossos usuários tenham uma experiência positiva em nosso site. Obrigado por
			escolher a Time In como sua plataforma
			de eventos esportivos preferida. Estamos ansiosos para ajudá-lo a descobrir novos eventos emocionantes e
			apoiá-lo em sua jornada esportiva.

		</p>
	</div>

	<!--- DIV COM UM VIDEO SOBRE A GENTE -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="video-container">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/EHcIMmAS14Y"
						frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

	<h2 class="h2_equipe">Equipe</h2>

	<div class="col-11 m-auto p-auto">
		<div class="row">

			<div class="participante col-12 col-sm-6 col-md-4 col-lg-3">
				<!-- Div Fellipy -->
				<div class="pessoas">

					<!-- h3 com nome do integrante -->
					<h3 class="word-break">Fellipy Silva Pereira Wagmackerㅤㅤㅤㅤ</h3>

					<!-- Foto do integrante -->
					<img class="foto" src="img/pi.png">

					<!-- Span que inclui a imagem do instagram e o link puxando para o instagram de cada integrante  -->
					<span class="span_integrantes">

						<svg class="iconeSobre" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>


						<a href="https://www.instagram.com/fellipy_wagmacker/" target="_blank"
							id="textos">fellipy_wagmacker</a>

					</span>

					<!-- Fim da div pessoas div_fellipy -->
				</div>
			</div>

			<!-- col-xl-5 col-xxl-3 -->
			<div class="participante col-12 col-sm-6 col-md-4 col-lg-3">
				<!-- Div gustavo -->
				<div class="pessoas">

					<!-- h3 com nome do integrante -->
					<h3 class="word-break">Gustavo Alves Caetanoㅤㅤㅤㅤㅤㅤㅤㅤ</h3>

					<!-- Foto do integrante -->
					<img class="foto" src="img/gu.png">

					<!-- Span que inclui a imagem do instagram e o link do instagram de cada integrante  -->
					<span class="span_integrantes">

						<svg class="iconeSobre" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>


						<a href="https://www.instagram.com/gustavo.alcaetano/" target="_blank"
							id="textos">gustavo.alcaetano</a>

					</span>



					<!-- Fim da div pessoas div_gustavo -->
				</div>
			</div>

			<div class="participante col-12 col-sm-6 col-md-4 col-lg-3">
				<!-- Div Barcellos -->
				<div class="pessoas">

					<!-- h3 com nome do integrante -->
					<h3 class="word-break">João Pedro Zamborlini Barcellosㅤㅤㅤㅤ</h3>

					<!-- Foto do integrante -->
					<img class="foto" src="img/jp.png">

					<!-- Span que inclui a imagem do instagram e o link do instagram de cada integrante -->
					<span class="span_integrantes">

					<svg class="iconeSobre" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>


						<a href="https://www.instagram.com/jp_barc/" target="_blank" id="textos">jp_barc</a>

					</span>


					<!-- Fim da div pessoas div_Barcellos -->
				</div>
			</div>

			<div class="participante col-12 col-sm-6 col-md-4 col-lg-3 m-auto">
				<!-- Div Pedro -->
				<div class="pessoas">

					<!-- h3 com nome do integrante -->
					<h3 class="word-break">Pedro Ramos Leite Soaresㅤㅤㅤㅤㅤㅤㅤ</h3>

					<!-- Foto do integrante -->
					<img class="foto" src="img/pe.png">

					<!-- Span que inclui a imagem do instagram e o link do instagram de cada integrante -->
					<span class="span_integrantes">

						<svg class="iconeSobre" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>

						<a href="https://www.instagram.com/pedrorls_/" target="_blank" id="textos">pedrorls_</a>

					</span>

					<!-- Fim da div pessoas div_Pedro -->
				</div>
			</div>

		</div>

	</div>
	<footer>
		<?php include('footer.php') ?>
	</footer>
</body>

</html>