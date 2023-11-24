<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/alterarSenha.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/alterarSenha.js" type="module" defer></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>

	<?php
	session_start();
	?>

</head>

<body>
	<header>
		<?php include('header.php') ?>
	</header> <!-- Fechando header -->
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

	<!-- Div geral com o formulario -->
	<div class="divGeral col-10 col-sm-6 col-md-5 col-lg-4 col-xg-3 m-auto  mt-5 mt-md-2">
		<h1 class="p-3 text-center fs-1 pb-0">Alterar Senha </h1>
		<!-- Formulario -->
		<div class="formulario mt-0">
			<form method="post" action="conexaoBancoDados/alterar_senha.php">

				<!-- Legenda do formulario -->
				<div id="senhas">
					<!-- Senha usuário -->
					<div class="campos senhaAntiga mb-4">

						<div class="form-floating">
							<img src="img/olho_aberto.png" id="olho" class="olho">
							<input type="password" class="form-control" id="floatingInputGroup1" placeholder="Senha antiga" name="senhaAntigaCampo">
							<label for="senhaAnti_usuario" id="label_senhaAnti">Senha Antiga</label>

							<!-- Mesagens de erro -->
							<span class="erro" id="noPassNew">Senha deve ser preenchida!</span>

							<span class="erro" id="aotPassNew">Senha deve ter 6 a 30 caracteres!</span>

							<span class="erro" id="passPassNew">A senha deve ser igual à senha cadastrada!</span>
						</div>

					</div> <!-- Fechando div de Senha Antiga -->


					<!-- Senha usuário -->
					<div class="campos senha mb-4">

						<div class="form-floating">
							<img src="img/olho_aberto.png" id="olho2" class="olho">
							<input type="password" class="form-control" id="floatingInputGroup2" placeholder="Senha nova" name="senhaCampo">
							<label for="senha_usuario" id="label_senha">Senha</label>

							<!-- Mensagens de erro -->
							<span class="erro" id="noPass">Senha deve ser preenchida!</span>

							<span class="erro" id="aotPass">Senha deve ter 6 a 30 caracteres!</span>
						</div>

					</div> <!-- Fechando div da senha nova -->

					<!-- Confimar Senha usuário -->
					<div class="campos confirmSenha mb-4">

						<div class="form-floating">
							<img src="img/olho_aberto.png" id="olho3" class="olho">
							<input type="password" class="form-control" id="floatingInputGroup3" placeholder="Confirmar Senha" name="confSenhaCampo">
							<label for="confSenha_usuario" id="label_confSenha">Confirmar Senha</label>

							<!-- Mensagens de erro -->
							<span class="erro" id="noConfPass">Confirmar senha deve ser preenchida!</span>

							<span class="erro" id="aotConfPass">Confirme a senha corretamente!</span>

							<span class="erro" id="passConfPass">Confirme a senha corretamente!</span>
						</div>

					</div> <!-- Fechando confirmacao de senha  -->

				</div>
			</form>
			<!-- Botão para cadastrar usuário, está fora do form para não resetar a página ao clicar-->
			<button id="alterar" class="fs-5 col-10"> ALTERAR </button>
		</div>
	</div>
	<footer>
		<?php include('footer.php') ?>
	</footer>

</body>

</html>

</body>

</html>