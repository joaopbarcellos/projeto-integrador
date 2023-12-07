<!-- 
	Todos os arquivos darao include
	nesse header
-->

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
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Div com a lista dos links para as paginas -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php
				// Verifique qual página está sendo acessada para colocar ou não a barra de pesquisa
				$currentPage = basename($_SERVER['PHP_SELF']);

				if ($currentPage === 'index.php') {
					// Incluir a barra de pesquisa apenas na pagina
					echo "<!-- Div com barra de pesquisa -->
						<form action='index.php' method='post' class='d-flex m-auto' role='search' id='pesquisar'>
							<!-- input -->
							<input class='form-control me-2' placeholder='Pesquisar evento' aria-label='Search' id='busca'
								incremental='incremental' type='search' name='pesquisar'>
								<button class='btn' id='lupa'>
								<svg class='iconelupa' xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><path d='M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z'/></svg>
								</button>
						</form>";
				} else if ($currentPage === 'myevents.php'){
					// Incluir a barra de pesquisa apenas na pagina
					echo "<!-- Div com barra de pesquisa -->
						<div class='d-flex m-auto' role='search' id='pesquisar'>
							<!-- input -->
							<input class='form-control me-2' placeholder='Pesquisar evento' aria-label='Search' id='busca'
								incremental='incremental' type='search' name='pesquisar'>
								<button class='btn' id='lupa'>
								<svg class='iconelupa' xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><path d='M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z'/></svg>
								</button>
						</div>";
				}
				?>

				<!-- Lista geral contendo todos os links -->
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">


					<!-- Lista com o link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/index.php'; ?>" id="homea">
							Home
						</a>
					</li>

					<!-- Lista com o link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/criaEvento.php'; ?>" id="criaa">
							Criar Evento
						</a>
					</li>

					<!-- Lista com o link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/myevents.php'; ?>" id="myeventsa">
							Meus Eventos</a>
					</li>

					<!-- Lista com o link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/sobre.php'; ?>" id="sobrea">
							Sobre
						</a>
					</li>

					<!-- Segundo link -->
					<li class="nav-item nav-link">
						<a href="<?php echo $rootDir . '/ajuda.php'; ?>" id="ajudaa">
							Ajuda
						</a>
					</li>

					</li> <!-- Fechando lista geral contendo todos os links -->

					<?php
					if (!isset($_SESSION["logado"])) {
						echo '
							<div  class="log">
							<a href="' . $rootDir . '/login.php">
								<button type="button" id="login_href" class="btn">Entrar</button>
							</a>

							<a href="' . $rootDir . '/cadastro.php">
								<button type="button" id="cadastro_href" class="btn">Cadastrar</button>
							</a>
							</div>
							';
					} else {
						echo '
							<li class="nav-item dropdown">
								<a class="links nav-link dropdown-toggle" id="droplogado" href="#" role="button" data-bs-toggle="dropdown"aria-expanded="false">
									<img src="' . $_SESSION["logado_foto"] . '" id="fotologado"></img>
									<div id="nome_usuario">' .  $_SESSION["logado_nome"] . '</div>
								</a>';

						echo '
								<ul class="dropdown-menu">
									<li>
										<a class="dropdown-item" href="' . $rootDir . '/perfil.php" id="perfila">
											Conta
										</a>
									</li>
		
									<li>
										<hr class="dropdown-divider">
									</li>
	
									<li>
										<a class="dropdown-item" href="' . $rootDir . '/sairConta.php" id="logout">
										Sair
										</a>
									</li>  
								</ul>
								
							<li>';
						}
					?>

				</ul> <!-- Fechando div com a lista dos links -->


			</div> <!-- Fechando div com a lista dos links -->

		</div>

	</nav> <!-- Fechando navbar -->
</body>

</html>
