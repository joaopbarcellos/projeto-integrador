<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="logos/icon.png">
	<title>Time In</title>
	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/ajuda.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/ajuda.js" type="module" defer></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
</head>

<?php
session_start();
?>

<body>
	<!-- Header com a navbar -->
	<header>
		<?php include('header.php') ?>
	</header> <!-- Fechando header -->


	<!-- Lista geral com as perguntas  -->
	<ul class=" col-11 m-auto mt-5 px-3" id="container">

		<!-- Lista interna com a perguta e a resposta -->
		<li class="item">

			<!-- Div com a primeira pergunta -->
			<div class="pergunta prim">

				<h2>Como crio um evento?</h2>

			</div>

			<!--- Div com resposta -->
			<div class="resp" id="conteudo1">

				1. Na tela de home, localize e clique no botão "+" posicionado no canto
				inferior direito da tela.<br>

				<br>
				2. Na página do formulário, preencha todas informações do seu evento,
				deixando ele do jeito desejado.<br>

				<br>
				3. Revise cuidadosamente todas as informações inseridas antes de cadastrar
				o evento. Certifique-se de que tudo esteja correto e completo.<br>

				<br>
				4. Quando estiver satisfeito com as informações inseridas, clique no botão
				"Cadastrar evento" para enviar o formulário.<br>

				<br>
				5. Aguarde até que a mensagem de confirmação apareça na tela, confirmando
				que o evento foi criado com sucesso.<br>

				<br>
				E pronto! Seguindo esses passos simples, você será capaz de cadastrar seu
				evento depois de clicar no botão "mais" no canto inferior direito.

			</div> <!-- Fechando div com as respostas -->

		</li> <!-- Fechando lista interna -->


		<!-- Criando outra lista interna com a pergunta e a resposta -->
		<li class="item">

			<!--- Div com a segunda pergunta -->
			<div class="pergunta seg">

				<h2>Criar um evento é pago?</h2>

			</div>

			<!--- Div com resposta -->
			<div class="resp" id="conteudo2">

				Não! Nosso site não possui nenhuma ferramenta paga. Todas as ferramentas
				e recursos disponíveis em nossa plataforma são gratuitos para uso, sem
				custos adicionais ou taxas ocultas. Nós acreditamos em fornecer um serviço
				acessível e útil para todos os nossos usuários, independentemente do seu
				orçamento ou tamanho do evento. Sinta-se à vontade para criar o seu evento
				e não hesite em entrar em contato se tiver alguma dúvida ou precisar de ajuda
				durante o processo.

			</div> <!-- Fechando  -->

		</li>

		<!-- Fim da lista geral -->
	</ul>

	<!-- Div com balao para enviar perguntas -->
	<div class="col-1 offset-md-10 offset-lg-11 offset-9 mt-5" id="suporte">
		<a href="suporte.php">
			<svg class="iconesuporte" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
				<path d="M256 448c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9c-5.5 9.2-11.1 16.6-15.2 21.6c-2.1 2.5-3.7 4.4-4.9 5.7c-.6 .6-1 1.1-1.3 1.4l-.3 .3 0 0 0 0 0 0 0 0c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c28.7 0 57.6-8.9 81.6-19.3c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9zM128 208a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm128 0a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm96 32a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
			</svg>
		</a>
	</div> <!-- Fechando div com balao -->

	<footer>
		<?php include('footer.php') ?>
	</footer>

</body>

</html>