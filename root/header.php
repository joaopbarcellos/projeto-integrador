<!DOCTYPE html>       
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php
	// Caminho absoluto da pasta
	$dirPath = __DIR__;

	// Parte do caminho que você deseja remover
	$partToRemove = '\root';
	$caminho = explode($partToRemove, $dirPath);

	// Substituir a parte a ser removida por uma string vazia
	$rootDir = $caminho[1];
	?>

    <link rel="icon" type="image/x-icon" href="<?php echo $rootDir . '/logos/icon.png'; ?>">
    <title>Time In</title>
    <link rel="stylesheet" href="<?php echo $rootDir . '/css/base.css'; ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="<?php echo $rootDir . '/js/base.js'; ?>" type="module" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
</head>
<body>
    <!-- navbar com menu hamburguer -->
	<nav class="navbar navbar-expand-lg header ">
		<div class="container-fluid col-11 m-auto">
			<a class="navbar-brand" href="<?php echo $rootDir . '/index.php'; ?>"><img src="<?php echo $rootDir . '/logos/9.png'; ?>" id="logo"></a>
			<!-- Botao com imagem do menu hamburguer -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Div com a lista dos links para as paginas -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php
					// Verifique qual página está sendo acessada para colocar ou não a barra de pesquisa
					$currentPage = basename($_SERVER['PHP_SELF']);

					if ($currentPage === 'index.php' || $currentPage === 'myevents.php') {
						// Incluir a barra de pesquisa apenas na pagina
						echo "<!-- Div com barra de pesquisa -->
						<div class='d-flex m-auto' role='search' id='pesquisar'>

							<!-- input -->
							<input class='form-control me-2' placeholder='Pesquisar evento' aria-label='Search' id='busca'
								incremental='incremental' type='search'>
							<button class='btn' id='lupa'>&#128269;</button>
						</div>";
					}
				?>

				<!-- Lista geral contendo todos os links -->
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">

					
					<!-- Lista com o link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/index.php'; ?>" id="homea">
							<svg class="iconecasinha" xmlns="http://www.w3.org/2000/svg" height="1em"
								viewBox="0 0 576 512">
								<path
									d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
							</svg>
							Home
						</a>
					</li>

					<!-- Lista com o link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/criaEvento.php'; ?>" id="criaa">
							<svg class="iconecria" xmlns="http://www.w3.org/2000/svg" height="1em"
								viewBox="0 0 448 512">
								<path
									d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
							</svg>
							Criar Evento
						</a>
					</li>

					<!-- Lista com o link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/myevents.php'; ?>" id="myeventsa">
							<svg class="iconemeusevents" xmlns="http://www.w3.org/2000/svg" height="1em"
								viewBox="0 0 384 512">
								<path
									d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
							</svg>
							Meus Eventos</a>
					</li>

					<!-- Lista com o link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/sobre.php'; ?>" id="sobrea">
							<svg class="iconesobre" xmlns="http://www.w3.org/2000/svg" height="1em"
								viewBox="0 0 512 512">
								<path
									d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
							</svg>
							Sobre
						</a>
					</li>

					<!-- Segundo link -->
					<li  class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/ajuda.php'; ?>" id="ajudaa">
							<svg class="iconeajuda" xmlns="http://www.w3.org/2000/svg" height="1em"
								viewBox="0 0 512 512">
								<path
									d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24V250.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1H222.6c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
							</svg>
							Ajuda
						</a>
					</li>

					<!-- Lista geral com o dropdown do cara 
					<li class="nav-item dropdown">
						<a class="links nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							<img id="fotouser">
							<div id="nomeuser"></div>
						</a>

						
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item" href="<?php echo $rootDir . '/perfil.php';?>" id="perfila">
									<svg class="iconeuser" xmlns="http://www.w3.org/2000/svg" height="1em"
										viewBox="0 0 512 512">
										<path
											d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
									</svg>
									Conta
								</a>
							</li>

							<li>
								<hr class="dropdown-divider">
							</li>

							<li>
								<a class="dropdown-item" href="#" id="logout">
									<svg class="iconelogout" xmlns="http://www.w3.org/2000/svg" height="1em"
										viewBox="0 0 512 512">
										<path
											d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
									</svg>
									Sair
								</a>

							</li>  
						</ul> -->

					</li> <!-- Fechando lista geral contendo todos os links -->

					<?php
						if(!isset($_SESSION["logado"])){
							echo '<a href="'. $rootDir . '/login.php" id="login_href">Login</a>
							<a href="'. $rootDir . '/cadastro.php" id="entrar_href">Cadastro</a>';
						} else {
							//echo "<a id="nome_usuario"> ".  $_SESSION["logado"] . "</a>";
							echo "<a id='nome_usuario'></a>";
							?>
							<script>
								var paragrafo = document.querySelector("#nome_usuario");
								paragrafo.value = JSON.parse(localStorage.getItem(document.querySelector(".paragrafo").value))["nome"];

								// GUSTAVO VE SE ESSA BOMBA FUNCIONA KKKK
								// TENTEI COLOCAR O NOME DELE MAS FICOU UMA GAMBIARRA DO KRL
								// TALVEZ FUNCIONE, TALVEZ N FUNCIONE, 50%
							</script>
							<?php
						}
					?>

				</ul> <!-- Fechando div com a lista dos links -->
				

			</div> <!-- Fechando div com a lista dos links -->

		</div>

	</nav> <!-- Fechando navbar -->
</body>
</html>