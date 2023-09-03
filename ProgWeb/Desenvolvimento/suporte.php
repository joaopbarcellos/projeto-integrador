<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/suporte.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/suporte.js" type="module" defer></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"
		defer></script>

</head>
<body>
	<!-- Header com a navbar -->
	<header>
		<?php include('header.php') ?>
	</header> <!-- Fechando header -->

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

	<div class="container col-10 col-lg-6 col-md-8 col-sm-9  mt-5" id="container">


		<h1 class="text-center fs-1 ">Seu contato é muito importante para nós!</h1>
		<p class="text-center">Envie-nos um e-mail preenchendo os campos abaixo, e logo retornaremos o seu contato</p>

		<form class="container col-lg-11 col-md-11 col-sm-11 m-4" id="form">

			<!-- E-mail do usuário -->
			<div class="email campos mt-3">

				<div class="form-floating">
					<input type="email" class="form-control" id="floatingInputGrid" placeholder="E-mail para contato">
					<label for="floatingInputGrid">Email</label>
				</div>

				<label class="erro" id="noEmail">E-mail deve ser preenchido!</label>

				<label class="erro" id="noEmailPadrao">E-mail está fora dos padrões!</label>

			</div>

			<div class="mensagem campos mb-3">

				<div class="form-floating">
					<textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea1" maxlength="500"></textarea>
					<label for="floatingTextarea2">Mensagem</label>
				</div>

				<label class="erro" id="noMsg">Mensagem deve ser preenchida!</label>

			</div>

		</form>
		<button class="col-6 col-lg-6 col-md-6 col-sm-6 mb-4 fs-6" id="envio">Enviar</button>
	</div>

	</div>


	<footer>
		<?php include('footer.php') ?>
	</footer>

</body>

</html>