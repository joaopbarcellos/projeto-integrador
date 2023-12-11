<?php
session_start();

// esse arquivo utiliza a CONSULTA do banco de dados
// para preencher os blocos de evento no carrousel e
// no resto da pagina
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/index.css">
	
	<script src="js/index.js" type="module" defer></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>

<body>

	<!-- Header com a navbar -->
	<header>
		<?php include('header.php') ?>
	</header> <!-- Fechando header -->

	
		<?php
		if (isset($_POST['pesquisar'])){
			$_SESSION['pesquisar'] = $_POST['pesquisar'];
			$json_data = include("conexaoBancoDados/pesquisar_eventos.php");
			$palavra = $_POST["pesquisar"];

			$eventos = json_decode($json_data, true);
			date_default_timezone_set("America/Sao_Paulo");
			echo'<script defer> document.querySelector("#busca").value = "'. $palavra .'"; </script>';
			if (count($eventos) == 0)  {
				$pesquisar = $_POST['pesquisar'];
				echo "<div id='naoAchou' class='fs-4 msg_erro'>Nenhum resultado para '$pesquisar' foi encontrado!</div>";
			} else {
				echo '
				<!-- Section que carrega todas as div eventos -->
				<section class="conteudo col-11 m-auto">
				';
				foreach ($eventos as $evento){
					echo '<!-- Div evento -->
					<div class="evento mt-3 col-12"  id="'. $evento["id"] .'">
					<!-- Div onde ficará todas as informações -->
						<div class="informacoes col-12">
							<div class="row col-12">
							
								<div class="divdafoto col-12 col-lg-5">
									<img src="' . $evento["foto"] . '" alt="'. $evento["nome"] .'" class="imgEventos">
								</div>

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
									<!-- Button para o usuário se inscrever -->
									<button class="sabermais sb-list"><span>Saber Mais</span></button>

									<!-- Fim da div desc -->
								</div>
							</div>

							<!--- Fim da div informacoes -->
						</div>

						<!-- Fim da div evento -->
					</div>';
				}
				echo '
					<!--- Fim da Section -->
					</section>
					';
			}
			
		} else {
			echo '<div class="owl-carousel slideowl d-none d-sm-block">
			';

			$json_data_carrousel = include("conexaoBancoDados/carregar_eventos_carrousel.php");

			$eventos_carrousel = json_decode($json_data_carrousel, true);
			foreach ($eventos_carrousel["eventos"] as $evento){
				echo"<div class='item eventoslide' id =" . $evento['id'] . ">
							<div class='fotoslide'>
								<img src=" . $evento['foto']. ">
							</div>
							<div class='carousel-caption'>
								<h3 class='slideh3'>" . $evento['nome'] . "</h3>
							</div>
						</div>";
			}
			
			echo '
					</div>
			<div class="custom-nav d-none d-sm-block">
				<button class="custom-prev" type="button">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="custom-next" type="button">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
			'; ?>
			

			<!-- filtros principais de esporte -->
			<form class="carouselContainer mt-3" action="conexaoBancoDados/filtrar_esporte.php" method="post">
				<div class="carouselOfImages">
					<button type="button" class="carouselimage" value="Filtrar" data-bs-toggle="modal" data-bs-target="#Modalfiltros" id="filtro_geral">
						<img src="img/filtro.png">
					</button>

					<button class="carouselimage" type="submit" value="Futebol" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
								<path d="M417.3 360.1l-71.6-4.8c-5.2-.3-10.3 1.1-14.5 4.2s-7.2 7.4-8.4 12.5l-17.6 69.6C289.5 445.8 273 448 256 448s-33.5-2.2-49.2-6.4L189.2 372c-1.3-5-4.3-9.4-8.4-12.5s-9.3-4.5-14.5-4.2l-71.6 4.8c-17.6-27.2-28.5-59.2-30.4-93.6L125 228.3c4.4-2.8 7.6-7 9.2-11.9s1.4-10.2-.5-15l-26.7-66.6C128 109.2 155.3 89 186.7 76.9l55.2 46c4 3.3 9 5.1 14.1 5.1s10.2-1.8 14.1-5.1l55.2-46c31.3 12.1 58.7 32.3 79.6 57.9l-26.7 66.6c-1.9 4.8-2.1 10.1-.5 15s4.9 9.1 9.2 11.9l60.7 38.2c-1.9 34.4-12.8 66.4-30.4 93.6zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm14.1-325.7c-8.4-6.1-19.8-6.1-28.2 0L194 221c-8.4 6.1-11.9 16.9-8.7 26.8l18.3 56.3c3.2 9.9 12.4 16.6 22.8 16.6h59.2c10.4 0 19.6-6.7 22.8-16.6l18.3-56.3c3.2-9.9-.3-20.7-8.7-26.8l-47.9-34.8z"/>
							</svg>
							Futebol
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Basquete" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
								<path d="M86.6 64l85.2 85.2C194.5 121.7 208 86.4 208 48c0-14.7-2-28.9-5.7-42.4C158.6 15 119 35.5 86.6 64zM64 86.6C35.5 119 15 158.6 5.6 202.3C19.1 206 33.3 208 48 208c38.4 0 73.7-13.5 101.3-36.1L64 86.6zM256 0c-7.3 0-14.6 .3-21.8 .9C238 16 240 31.8 240 48c0 47.3-17.1 90.5-45.4 124L256 233.4 425.4 64C380.2 24.2 320.9 0 256 0zM48 240c-16.2 0-32-2-47.1-5.8C.3 241.4 0 248.7 0 256c0 64.9 24.2 124.2 64 169.4L233.4 256 172 194.6C138.5 222.9 95.3 240 48 240zm463.1 37.8c.6-7.2 .9-14.5 .9-21.8c0-64.9-24.2-124.2-64-169.4L278.6 256 340 317.4c33.4-28.3 76.7-45.4 124-45.4c16.2 0 32 2 47.1 5.8zm-4.7 31.9C492.9 306 478.7 304 464 304c-38.4 0-73.7 13.5-101.3 36.1L448 425.4c28.5-32.3 49.1-71.9 58.4-115.7zM340.1 362.7C317.5 390.3 304 425.6 304 464c0 14.7 2 28.9 5.7 42.4C353.4 497 393 476.5 425.4 448l-85.2-85.2zM317.4 340L256 278.6 86.6 448c45.1 39.8 104.4 64 169.4 64c7.3 0 14.6-.3 21.8-.9C274 496 272 480.2 272 464c0-47.3 17.1-90.5 45.4-124z"/>
							</svg>
							Basquete
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Corrida" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
								<path d="M320 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM125.7 175.5c9.9-9.9 23.4-15.5 37.5-15.5c1.9 0 3.8 .1 5.6 .3L137.6 254c-9.3 28 1.7 58.8 26.8 74.5l86.2 53.9-25.4 88.8c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l28.7-100.4c5.9-20.6-2.6-42.6-20.7-53.9L238 299l30.9-82.4 5.1 12.3C289 264.7 323.9 288 362.7 288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H362.7c-12.9 0-24.6-7.8-29.5-19.7l-6.3-15c-14.6-35.1-44.1-61.9-80.5-73.1l-48.7-15c-11.1-3.4-22.7-5.2-34.4-5.2c-31 0-60.8 12.3-82.7 34.3L57.4 153.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l23.1-23.1zM91.2 352H32c-17.7 0-32 14.3-32 32s14.3 32 32 32h69.6c19 0 36.2-11.2 43.9-28.5L157 361.6l-9.5-6c-17.5-10.9-30.5-26.8-37.9-44.9L91.2 352z"/>
							</svg>
							Corrida
						</div>
					</button>	

					<button class="carouselimage" type="submit" value ="Natação" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
								<path d="M309.5 178.4L447.9 297.1c-1.6 .9-3.2 2-4.8 3c-18 12.4-40.1 20.3-59.2 20.3c-19.6 0-40.8-7.7-59.2-20.3c-22.1-15.5-51.6-15.5-73.7 0c-17.1 11.8-38 20.3-59.2 20.3c-10.1 0-21.1-2.2-31.9-6.2C163.1 193.2 262.2 96 384 96h64c17.7 0 32 14.3 32 32s-14.3 32-32 32H384c-26.9 0-52.3 6.6-74.5 18.4zM160 160A64 64 0 1 1 32 160a64 64 0 1 1 128 0zM306.5 325.9C329 341.4 356.5 352 384 352c26.9 0 55.4-10.8 77.4-26.1l0 0c11.9-8.5 28.1-7.8 39.2 1.7c14.4 11.9 32.5 21 50.6 25.2c17.2 4 27.9 21.2 23.9 38.4s-21.2 27.9-38.4 23.9c-24.5-5.7-44.9-16.5-58.2-25C449.5 405.7 417 416 384 416c-31.9 0-60.6-9.9-80.4-18.9c-5.8-2.7-11.1-5.3-15.6-7.7c-4.5 2.4-9.7 5.1-15.6 7.7c-19.8 9-48.5 18.9-80.4 18.9c-33 0-65.5-10.3-94.5-25.8c-13.4 8.4-33.7 19.3-58.2 25c-17.2 4-34.4-6.7-38.4-23.9s6.7-34.4 23.9-38.4c18.1-4.2 36.2-13.3 50.6-25.2c11.1-9.4 27.3-10.1 39.2-1.7l0 0C136.7 341.2 165.1 352 192 352c27.5 0 55-10.6 77.5-26.1c11.1-7.9 25.9-7.9 37 0z"/>
							</svg>
							Natação
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Vôlei" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
								<path d="M511.8 267.4c-26.1 8.7-53.4 13.8-81 15.1c9.2-105.3-31.5-204.2-103.2-272.4C434.1 41.1 512 139.5 512 256c0 3.8-.1 7.6-.2 11.4zm-3.9 34.7c-5.8 32-17.6 62-34.2 88.7c-97.5 48.5-217.7 42.6-311.9-24.5c23.7-36.2 55.4-67.7 94.5-91.8c79.9 43.2 170.1 50.8 251.6 27.6zm-236-55.5c-2.5-90.9-41.1-172.7-101.9-231.7C196.8 5.2 225.8 0 256 0c2.7 0 5.3 0 7.9 .1c90.8 60.2 145.7 167.2 134.7 282.3c-43.1-2.4-86.4-14.1-126.8-35.9zM138 28.8c20.6 18.3 38.7 39.4 53.7 62.6C95.9 136.1 30.6 220.8 7.3 316.9C2.5 297.4 0 277 0 256C0 157.2 56 71.5 138 28.8zm69.6 90.5c19.5 38.6 31 81.9 32.3 127.7C162.5 294.6 110.9 368.9 90.2 451C66 430.4 45.6 405.4 30.4 377.2c6.7-108.7 71.9-209.9 177.1-257.9zM256 512c-50.7 0-98-14.7-137.8-40.2c5.6-27 14.8-53.1 27.4-77.7C232.2 454.6 338.1 468.8 433 441c-46 44-108.3 71-177 71z"/>
							</svg>
							Vôlei
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Xadrez" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
								<path d="M144 16c0-8.8-7.2-16-16-16s-16 7.2-16 16V32H96c-8.8 0-16 7.2-16 16s7.2 16 16 16h16V96H60.2C49.1 96 40 105.1 40 116.2c0 2.5 .5 4.9 1.3 7.3L73.8 208H72c-13.3 0-24 10.7-24 24s10.7 24 24 24h4L60 384H196L180 256h4c13.3 0 24-10.7 24-24s-10.7-24-24-24h-1.8l32.5-84.5c.9-2.3 1.3-4.8 1.3-7.3c0-11.2-9.1-20.2-20.2-20.2H144V64h16c8.8 0 16-7.2 16-16s-7.2-16-16-16H144V16zM48 416L4.8 473.6C1.7 477.8 0 482.8 0 488c0 13.3 10.7 24 24 24H232c13.3 0 24-10.7 24-24c0-5.2-1.7-10.2-4.8-14.4L208 416H48zm288 0l-43.2 57.6c-3.1 4.2-4.8 9.2-4.8 14.4c0 13.3 10.7 24 24 24H488c13.3 0 24-10.7 24-24c0-5.2-1.7-10.2-4.8-14.4L464 416H336zM304 208v51.9c0 7.8 2.8 15.3 8 21.1L339.2 312 337 384H462.5l-3.3-72 28.3-30.8c5.4-5.9 8.5-13.6 8.5-21.7V208c0-8.8-7.2-16-16-16H464c-8.8 0-16 7.2-16 16v16H424V208c0-8.8-7.2-16-16-16H392c-8.8 0-16 7.2-16 16v16H352V208c0-8.8-7.2-16-16-16H320c-8.8 0-16 7.2-16 16zm80 96c0-8.8 7.2-16 16-16s16 7.2 16 16v32H384V304z"/>
							</svg>
							Xadrez
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Skate" name="esporte">
						<div class="alinhafiltro">
							<img src="img/skate.png">
							Skate
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Tênis" name="esporte">
						<div class="alinhafiltro">
							<img src="img/tennis.png">
							Tênis
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Surfe" name="esporte">
						<div class="alinhafiltro">
							<img src="img/surf.png">
							Surfe
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Ciclismo" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
								<path d="M400 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm27.2 64l-61.8-48.8c-17.3-13.6-41.7-13.8-59.1-.3l-83.1 64.2c-30.7 23.8-28.5 70.8 4.3 91.6L288 305.1V416c0 17.7 14.3 32 32 32s32-14.3 32-32V288c0-10.7-5.3-20.7-14.2-26.6L295 232.9l60.3-48.5L396 217c5.7 4.5 12.7 7 20 7h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H427.2zM56 384a72 72 0 1 1 144 0A72 72 0 1 1 56 384zm200 0A128 128 0 1 0 0 384a128 128 0 1 0 256 0zm184 0a72 72 0 1 1 144 0 72 72 0 1 1 -144 0zm200 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"/>
							</svg>
							Ciclismo
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Handebol" name="esporte">
						<div class="alinhafiltro">
							<img src="img/handball.png">
							Handebol
						</div>
					</button>

					<button class="carouselimage" type="submit" value="Tênis de Mesa" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
								<path d="M480 288c-50.1 0-93.6 28.8-114.6 70.8L132.9 126.3l.6-.6 60.1-60.1c87.5-87.5 229.3-87.5 316.8 0c67.1 67.1 82.7 166.3 46.8 248.3C535.8 297.6 509 288 480 288zM113.3 151.9L354.1 392.7c-1.4 7.5-2.1 15.3-2.1 23.3c0 23.2 6.2 44.9 16.9 63.7c-3 .2-6.1 .3-9.2 .3H357c-33.9 0-66.5-13.5-90.5-37.5l-9.8-9.8c-13.1-13.1-34.6-12.4-46.8 1.7L152.2 501c-5.8 6.7-14.2 10.7-23 11s-17.5-3.1-23.8-9.4l-32-32c-6.3-6.3-9.7-14.9-9.4-23.8s4.3-17.2 11-23l66.6-57.7c14-12.2 14.8-33.7 1.7-46.8l-9.8-9.8c-24-24-37.5-56.6-37.5-90.5v-2.7c0-22.8 6.1-44.9 17.3-64.3zM480 320a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/>
							</svg>
							Tênis de Mesa
						</div>
					</button>

					<button class="carouselimage" type="submit" value="Motocross" name="esporte">
						<div class="alinhafiltro">
							<img src="img/capacete.png">
							Motocross
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Mountain Bike" name="esporte">
						<div class="alinhafiltro">
							<img src="img/mountain.png">
							Mountain Bike
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Futebol Americano" name="esporte">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
								<path d="M247.5 25.4c-13.5 3.3-26.4 7.2-38.6 11.7C142.9 61.6 96.7 103.6 66 153.6c-18.3 29.8-30.9 62.3-39.2 95.4L264.5 486.6c13.5-3.3 26.4-7.2 38.6-11.7c66-24.5 112.2-66.5 142.9-116.5c18.3-29.8 30.9-62.3 39.1-95.3L247.5 25.4zM495.2 205.3c6.1-56.8 1.4-112.2-7.7-156.4c-2.7-12.9-13-22.9-26.1-25.1c-58.2-9.7-109.9-12-155.6-7.9L495.2 205.3zM206.1 496L16.8 306.7c-6.1 56.8-1.4 112.2 7.7 156.4c2.7 12.9 13 22.9 26.1 25.1c58.2 9.7 109.9 12 155.6 7.9zm54.6-331.3c6.2-6.2 16.4-6.2 22.6 0l64 64c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-64-64c-6.2-6.2-6.2-16.4 0-22.6zm-48 48c6.2-6.2 16.4-6.2 22.6 0l64 64c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-64-64c-6.2-6.2-6.2-16.4 0-22.6zm-48 48c6.2-6.2 16.4-6.2 22.6 0l64 64c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-64-64c-6.2-6.2-6.2-16.4 0-22.6z"/>
							</svg>
							Futebol Americano
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Hipismo" name="esporte">
						<div class="alinhafiltro">
							<img src="img/hipismo.png">
							Hipismo
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Boxe" name="esporte">
						<div class="alinhafiltro">
							<img src="img/boxe.png">
							Boxe
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Capoeira" name="esporte">
						<div class="alinhafiltro">
							<img src="img/capoeira.png">
							Capoeira
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Judô" name="esporte">
						<div class="alinhafiltro">
							<img src="img/judo.png">
							Judô
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Canoagem" name="esporte">
						<div class="alinhafiltro">
							<img src="img/canoagem.png">
							Canoagem
						</div>
					</button>

					<button class="carouselimage" type="submit" value ="Polo Aquático" name="esporte">
						<div class="alinhafiltro">
							<img src="img/poloaquatico.png">
							Polo Aquático
						</div>
					</button>
					<button class="carouselimage" type="submit" value ="Outros" name="esporte" id="ultimo">
						<div class="alinhafiltro">
							<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
								<path d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"/>
							</svg>
							Outros
						</div>
					</button>
				</div>
			</form>

			<div class="modal fade" id="Modalfiltros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Filtros</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="conexaoBancoDados/filtrar_geral.php" method="post" id="form_do_filtro">
							<div class="modal-body">
								<!-- Filtros de retirada -->
								<label for="idadePublico">Idade alvo</label>
								<select class="form-select mb-3" id="idadePublico" name="idade">
									<option value="0" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "0") echo "selected";?> >Sem filtro</option>
									<option value="1" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "1") echo "selected";?> >De 3 a 7</option>
									<option value="2" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "2") echo "selected";?> >De 8 a 13</option>
									<option value="3" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "3") echo "selected";?> >De 14 a 16</option>
									<option value="4" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "4") echo "selected";?> >De 17 a 20</option>
									<option value="5" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "5") echo "selected";?> >Acima de 18</option>
									<option value="6" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "6") echo "selected";?> >De 20 a 30</option>
									<option value="7" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "7") echo "selected";?> >De 30 a 40</option>
									<option value="8" <?php if (isset($_SESSION["filtro_idade"])) if ($_SESSION["filtro_idade"] == "8") echo "selected";?> >Acima de 40</option>
								</select>

								<label for="intuEvento">Intuito do evento</label>
								<select class="form-select mb-3" id="intuEvento" name="intuito">
									<option value="0" <?php if (isset($_SESSION["filtro_intuito"])) if ($_SESSION["filtro_intuito"] == "0") echo "selected";?> >Sem filtro</option>
									<option value="1" <?php if (isset($_SESSION["filtro_intuito"])) if ($_SESSION["filtro_intuito"] == "1") echo "selected";?> >Para toda família</option>
									<option value="2" <?php if (isset($_SESSION["filtro_intuito"])) if ($_SESSION["filtro_intuito"] == "2") echo "selected";?> >Profissionais</option>
									<option value="3" <?php if (isset($_SESSION["filtro_intuito"])) if ($_SESSION["filtro_intuito"] == "3") echo "selected";?> >Treino para amadores</option>
								</select>

								<label for="Turno">Turno do Evento</label>
								<select class="form-select mb-3" id="Turno" name="turno">
									<option value="0" <?php if (isset($_SESSION["filtro_turno"])) if ($_SESSION["filtro_turno"] == "0") echo "selected";?> >Sem filtro</option>
									<option value="1" <?php if (isset($_SESSION["filtro_turno"])) if ($_SESSION["filtro_turno"] == "1") echo "selected";?> >Manhã</option>
									<option value="2" <?php if (isset($_SESSION["filtro_turno"])) if ($_SESSION["filtro_turno"] == "2") echo "selected";?> >Tarde</option>
									<option value="3" <?php if (isset($_SESSION["filtro_turno"])) if ($_SESSION["filtro_turno"] == "3") echo "selected";?> >Noite</option>
								</select>

								<div class="form-check mb-3">
									<label class="form-check-label" for="gratis">Gratuito</label>
									<input class="form-check-input" type="checkbox" value="0" id="gratis" name="gratuito" <?php if(isset($_SESSION["filtro_gratuito"])) echo "checked=true"; ?> >
								</div>

								<!-- Filtros de margem -->
								<div id="divprecomax">
									<label>Preco Máximo</label>
									<div class="form-floating mb-3" id="range_preco">
										<input type="text" class="form-control" id="precomax" placeholder="Preco Máximo" name="preco"   <?php if (isset($_SESSION["filtro_preco"]))?> value="<?php echo $_SESSION["filtro_preco"];?>" >
										<label for="precomax">R$</label>
									</div>
								</div>
								<label>Data do evento</label>
								<div class="mb-3 row">
									<div class="col-6 data">
										<label>Entre</label>
										<div class="form-floating"> 	
											<input type="date" class="form-control datinha" id="dataEvento" name="data1" <?php if (isset($_SESSION["filtro_data1"]))?> value="<?php echo $_SESSION["filtro_data1"];?>">
										</div>	
									</div>

									<div class="col-6 data">
										<label>e</label>
										<div class="form-floating">
											<input type="date" class="form-control datinha" id="dataEvento2" name="data2" <?php if (isset($_SESSION["filtro_data2"]))?> value="<?php echo $_SESSION["filtro_data2"];?>">
										</div>	
									</div>
									
									<input type="hidden" name="cancelar_esporte" value="" id="escondido_cancelar_esporte">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" id="btn_limpar_filtros">Limpar filtros</button>
								<button type="submit" class="btn btn-primary">Filtrar</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<?php
			if (isset($_GET['filtro'])) {
				$filtro_esporte = $_GET['filtro'];
				if ($_GET['filtro'] == ""){
					echo "<script defer>
					var filtro = document.querySelector('#filtro_geral');
					filtro.classList.add('filtro_selecionado');
					filtro.type='button';
					</script>";
					
					if (isset($_SESSION["filtro_esporte_nome"])){
						$filtro_esporte_nome = $_SESSION["filtro_esporte_nome"];
						echo "<script defer>
						var filtros = document.querySelectorAll('.carouselimage');
						filtros.forEach(filtro =>{
							if(filtro.value == '$filtro_esporte_nome'){
								filtro.classList.add('filtro_selecionado');
								filtro.classList.add('filtro_selecionado_esporte');
								filtro.type='button';
							}
						})
						document.querySelector('.filtro_selecionado_esporte').addEventListener('click', () =>{
							campoInvisivel = document.querySelector('#escondido_cancelar_esporte')
							campoInvisivel.value = 'cancelar';
							formulario = document.querySelector('#form_do_filtro');
							formulario.submit();
						});
						</script>";
					}
				} else if (isset($_SESSION["filtro_esporte_nome"])){
					$filtro_esporte_nome = $_SESSION["filtro_esporte_nome"];
					echo "<script defer>
					var filtros = document.querySelectorAll('.carouselimage');
					filtros.forEach(filtro =>{
						if(filtro.value == '$filtro_esporte_nome'){
							filtro.classList.add('filtro_selecionado');
							filtro.classList.add('filtro_selecionado_esporte');
							filtro.type='button';
						}
					})

					document.querySelector('.filtro_selecionado').addEventListener('click', () =>{
						window.location.assign('conexaoBancoDados/limpar_filtro_esporte.php');
					});
					</script>";
				}
				$json_data = $_SESSION["filtro"];

				echo '
				<h1 class="nome_filtro">'. $filtro_esporte_nome . '</h1>

				<!-- Section que carrega todas as div eventos -->
				<section class="conteudo col-11 m-auto">
				';
				
				ini_set('display_errors', 1);
				$eventos = json_decode($json_data, true);
				date_default_timezone_set("America/Sao_Paulo"); 
				
				if(count($eventos["eventos"]) == 0){
					if (isset($_SESSION["filtro_esporte_nome"])){
						$filtro_esporte_nome = $_SESSION["filtro_esporte_nome"];
						echo "<div id='naoAchou' class='fs-4 msg_erro'>Nenhum evento de $filtro_esporte_nome foi encontrado!</div>";
					} 
					else{
						echo "<div id='naoAchou' class='fs-4 msg_erro'>Nenhum evento foi encontrado!</div>";
					}
				} else {
					foreach ($eventos["eventos"] as $evento){
						echo '<!-- Div evento -->
							<div class="evento mt-3 col-12"  id="'. $evento["id"] .'">
						<!-- Div onde ficará todas as informações -->
							<div class="informacoes col-12">
								<div class="row col-12">
								
									<div class="divdafoto col-12 col-lg-5">
										<img src="' . $evento["foto"] . '" alt="'. $evento["nome"] .'" class="imgEventos">
									</div>

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
										<!-- Button para o usuário se inscrever -->
										<button class="sabermais sb-list"><span>Saber Mais</span></button>

										<!-- Fim da div desc -->
									</div>
								</div>

								<!--- Fim da div informacoes -->
							</div>

							<!-- Fim da div evento -->
						</div>';
					}
				}
				echo '
					<!--- Fim da Section -->
					</section>
					';
			
			} else {
				echo '
				<!-- Section que carrega todas as div eventos -->
				<section class="conteudo col-11 m-auto">
				';

				$json_data = include("conexaoBancoDados/carregar_eventos.php");
				$eventos = json_decode($json_data, true);
				date_default_timezone_set("America/Sao_Paulo"); 
				foreach ($eventos["eventos"] as $evento){
					echo '<!-- Div evento -->
					<div class="evento mt-3 col-12"  id="'. $evento["id"] .'">
					<!-- Div onde ficará todas as informações -->
						<div class="informacoes col-12">
							<div class="row col-12">
							
								<div class="divdafoto col-12 col-lg-5">
									<img src="' . $evento["foto"] . '" alt="'. $evento["nome"] .'" class="imgEventos">
								</div>

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
									<!-- Button para o usuário se inscrever -->
									<button class="sabermais sb-list"><span>Saber Mais</span></button>

									<!-- Fim da div desc -->
								</div>
							</div>

							<!--- Fim da div informacoes -->
						</div>

						<!-- Fim da div evento -->
					</div>';
				}
				echo '
					<!--- Fim da Section -->
					</section>
					';
			}
		}
		?>

	<footer>
		<?php include('footer.php') ?>
	</footer>
</body>

</html>
