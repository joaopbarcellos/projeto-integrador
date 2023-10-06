<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/perfil.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/perfil.js" type="module" defer></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>

</head>

<?php
session_start();
?>

<body>
	<header>
		<?php include('header.php') ?>
	</header> <!-- Fechando header -->

	<label class="switch">
		<span class="sun"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<g fill="#ffd43b">
					<circle r="5" cy="12" cx="12"></circle>
					<path d="m21 13h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm-17 0h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm13.66-5.66a1 1 0 0 1 -.66-.29 1 1 0 0 1 0-1.41l.71-.71a1 1 0 1 1 1.41 1.41l-.71.71a1 1 0 0 1 -.75.29zm-12.02 12.02a1 1 0 0 1 -.71-.29 1 1 0 0 1 0-1.41l.71-.66a1 1 0 0 1 1.41 1.41l-.71.71a1 1 0 0 1 -.7.24zm6.36-14.36a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm0 17a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm-5.66-14.66a1 1 0 0 1 -.7-.29l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.29zm12.02 12.02a1 1 0 0 1 -.7-.29l-.66-.71a1 1 0 0 1 1.36-1.36l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.24z">
					</path>
				</g>
			</svg></span>
		<span class="moon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
				<path d="m223.5 32c-123.5 0-223.5 100.3-223.5 224s100 224 223.5 224c60.6 0 115.5-24.2 155.8-63.4 5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6-96.9 0-175.5-78.8-175.5-176 0-65.8 36-123.1 89.3-153.3 6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z">
				</path>
			</svg></span>
		<input type="checkbox" class="input">
		<span class="slider"></span>
	</label>

	<div id="container">
		<div class="col-10 col-lg-5 col-sm-8 col-md-6 col-xg-3 " id="alinhar">
			<!-- Crio a section com a carteirinha -->
			<section id="perfil">

				<!-- Crio a div com as informacoes do ususario -->
				<div class="fot_desc">
					<div class="row col-12">

						<div class="col-12 col-lg-3 text-center">
							<!-- Como padrao o usuario n possui foto -->
							<div class="mx-auto" id="semfoto"></div>
						</div>
						<div class="col-12 col-lg-9 ">
							<!-- Crio a div pra inserir os dados -->
							<div class="dados ms-lg-0">

								<!-- Crio a div do nome -->
								<div class="info">

									<label class="labels texto word-break"> Nome: </label>

									<!-- Escrevo na label o nome do usuario -->
									<label class="cadastro texto word-break" id="nome_usuario_logado"> </label>

									<!-- Fecho a div do nome -->
								</div>

								<!-- Crio a div do nascimento-->
								<div class="info">

									<label class="labels texto word-break">Data de Nascimento: </label>

									<!-- Escrevo na label o nascimento do usuario -->
									<label class="cadastro texto word-break" id="dataNasc_usuario"> </label>

									<!-- Fecho a div do nascimento -->
								</div>

								<!-- Crio a div de email-->
								<div class="info" id="email_user">

									<label class="labels texto word-break">Email: </label>

									<!-- Escrevo na label o email do usuario -->
									<label class="cadastro texto word-break" id="email_usuario"> </label>

									<!-- Fecho a div de email -->
								</div>

								<!-- Div telefone -->
								<div class="telefone info">
									<label class="labels texto word-break">Telefone: </label>

									<!-- Escrevo na label o telefone do usuario -->
									<label class="cadastro texto word-break" id="telefone_usuario"> </label>

									<!-- Fechando div telefone -->
								</div>

							</div>
							<!-- Fecho a div pra inserir os dados -->
						</div>
					</div>
				</div>

				<!-- Crio o rodape da carteirinha com logo e hashtag -->
				<div id="hashtag">

					<img src="logos/icon2.png" id="logo_cart"></img>
					<p class=" word-break" id="sloganperfil">#AlwaysInMovement</p>

					<label class="word-break" id="qualidade"></label>
				</div>

				<!-- Fecho a section com a carteirinha -->
			</section>

			<div id="botoes">
				<button id="editar"><svg class="iconeeditar" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
						<path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
					</svg>
					Editar Informações</button> <!-- crio o botão de editar insformações -->
				<button id="excluir"><svg class="iconeexcluir" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
						<path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
					</svg>
					Excluir Perfil</button> <!-- crio o botão de excluir perfil -->
			</div>
		</div>
	</div>

	<footer>
		<?php include('footer.php') ?>
	</footer>

</body>

</html>