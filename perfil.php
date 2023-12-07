<?php
session_start();
?>

<!-- 
	Esse arquivo CONSULTA as informacoes de usuario
	do banco de dados para preencher a pagina
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

	<link rel="stylesheet" href="css/perfil.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/perfil.js" type="module" defer></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>

</head>

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
		<div class="col-10 col-lg-5 col-sm-8 col-md-5" id="alinhar">
			<!-- Crio a section com a carteirinha -->
			<section id="perfil">

				<!-- Crio a div com as informacoes do ususario -->
				<div class="fot_desc">
					<div class="row col-12">
						<div class="col-12 col-lg-4 text-center foto">
							<!-- Como padrao o usuario n possui foto -->
							<div class="mx-auto">
								<img src="<?php echo $_SESSION["logado_foto"];?>" id="semfoto">
							</div>
						</div>
						<div class="col-12 col-lg-8 todosdados">
							<!-- Crio a div pra inserir os dados -->
							<div class="dados ms-lg-0">

								<!-- Crio a div do nome -->
								<div class="info">

									<label class="labels texto word-break"> Nome: </label>

									<!-- Escrevo na label o nome do usuario -->
									<label class="cadastro texto word-break" id="nome_usuario_logado"><?php echo $_SESSION["logado_nome"];?></label>

									<!-- Fecho a div do nome -->
								</div>

								<!-- Crio a div do nascimento-->
								<div class="info">

									<label class="labels texto word-break">Data de Nascimento: </label>

									<!-- Escrevo na label o nascimento do usuario -->
									<label class="cadastro texto word-break" id="dataNasc_usuario"><?php echo date("d/m/Y", strtotime($_SESSION["logado_data"]));?></label>

									<!-- Fecho a div do nascimento -->
								</div>

								<!-- Crio a div de email-->
								<div class="info" id="email_user">

									<label class="labels texto word-break">Email: </label>

									<!-- Escrevo na label o email do usuario -->
									<label class="cadastro texto word-break" id="email_usuario"><?php echo $_SESSION["logado"];?></label>

									<!-- Fecho a div de email -->
								</div>

								<!-- Div telefone -->
								<div class="telefone info">
									<label class="labels texto word-break">Telefone: </label>

									<!-- Escrevo na label o telefone do usuario -->
									<label class="cadastro texto word-break" id="telefone_usuario"><?php echo $_SESSION["logado_telefone"];?></label>

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

					<label class="word-break" id="qualidade"> <?php echo $_SESSION["logado_intuito"] ?></label>
				</div>

				<!-- Fecho a section com a carteirinha -->
			</section>

			<div id="botoes">
				<button class="editar" id="editar">Editar
					<svg class="iconeEditar" viewBox="0 0 512 512">
					<path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path></svg>
				</button>

				<button class="excluir" type="button"  id="excluir">
					<span class="excluir__text">Excluir Perfil</span>
					<span class="excluir__icon">
						<svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><title></title><path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line><path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
						</svg>
					</span>
				</button> <!-- crio o botão de excluir perfil -->
			</div>
		</div>
	</div>
	<footer>
		<?php include('footer.php') ?>
	</footer>

</body>

</html>
