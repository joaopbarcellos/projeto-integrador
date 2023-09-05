<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/editar_perfil.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/editar_perfil.js" type="module" defer></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js" defer></script>

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
			<!--  -->
		</button>
	</div>
	<div class="col-11 col-sm-8 col-md-7 col-lg-6 col-xg-5 mx-auto" id="editar">
		<!-- Div que ficará com o formulário -->
		<div class="div_cadastro mt-5 mt-md-0 col-12">

			<!-- Título pro formulário -->
			<h1 class="fs-1"> Editar informações de login </h1>

			<!-- Div para estilizar o formulário -->
			<div class="formulario fs-5">

				<!-- Criando fomulário de Cadastro -->
				<form>

					<div class="campos">
						<label for="formFile" class="form-label ">Foto de Perfil:</label>
						<input class="form-control" type="file" id="formFile" accept="image/*">
					</div>
					
					<!-- Nome do usuário -->
					<div class="nome campos">

						<div class="form-floating">
							<!-- input de nome -->
							<input type="text" class="form-control" id="floatingInputGroup1" placeholder="Nome">
							<label for="nome" id="label_nome">Nome</label>
						</div>

						<!-- Mensagem de erro -->
						<label class="erro fs-6 fs-10 fs-7 fs-6 fs-5" id="noNome">Nome deve ser preenchido!</label>

					</div>



					<!-- E-mail do usuario -->
					<div class="email campos">
						<div class="form-floating">
							<label  for="floatingInputGroup2" class="focado">E-mail</label>
							<div class="input-group">
							  	<input type="email" class="form-control" id="floatingInputGroup2" placeholder="E-mail">
							  	<div class="input-icon">
									<svg class="iconefechadura" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
								  	<path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
								</svg>
							  	</div>
							</div>
						</div>
					</div>

					<div class="form-floating">
							<!-- input de telefone -->
							<input type="text" class="form-control" id="floatingInputGroup5" placeholder="Telefone">
							<label for="telefoe" id="label_telefone">Telefone</label>
					</div>

					<!-- Idade do usuario -->
					<div class="idade campos">
						<label for="idade" id="labelData">Data de Nascimento:</label>

						<input type="date" id="idade" name="idade_usuario">

						<!-- Mensagens de erro -->
						<label class="erro fs-6 fs-10 fs-7 fs-6 fs-5" id="noData">Data deve ser preenchida!</label>

						<label class="erro fs-6 fs-10 fs-7 fs-6 fs-5" id="passouData">Data inválida!</label>

					</div>

					<div class="joga campos">

						<div class="jogabilidade">

							<!-- Grau de conhecimento -->
							<label for="jogabilidade" class="label_joga">Jogador:</label>

							<div class="radios">

								<!-- Profissional-->
								<div class="radio profissa">

									<!-- Input e label -->
									<input type="radio" id="Profissional" name="jogabilidade" class="bolaRadio">

									<label class="jogabilidades" for="Profissional"> Profissional </label>

								</div>

								<!-- Amador -->
								<div class="radio amad">

									<!-- Input e label -->
									<input type="radio" id="Amador" name="jogabilidade" class="bolaRadio">

									<label class="jogabilidades" for="Amador"> Amador </label>

								</div>

								<!--Iniciante -->
								<div class="radio inic">

									<!-- Input e label -->
									<input type="radio" id="Iniciante" name="jogabilidade" class="bolaRadio">

									<label class="jogabilidades" for="Iniciante"> Iniciante </label>

								</div>

								<!-- Mensagem de erro -->
								<label class="erro fs-6 fs-10 fs-7 fs-6 fs-5" id="noJogabilidade">Nível de experiência
									deve ser escolhido!</label>

								<!-- Fim da div radios -->
							</div>
							
							<!-- Fim da div jogabilidade -->
						</div>
						
						<!-- Fim da div joga -->
					</div>
				</form>

				<!-- Link para alterar senha -->
				<a href="alterarSenha.php" class="link"> Deseja alterar senha? </a>
				<!-- Botão para cadastrar usuário, está fora do form para não resetar a página ao clicar-->
				<button id="alterar" class="fs-5 col-12 col-lg-8 mt-4 mx-auto"> SALVAR ALTERAÇÕES </button>
				

			</div>
		
		</div>

	
	</div>
	<footer>
		<?php include('footer.php') ?>
	</footer>

</body>

</html>