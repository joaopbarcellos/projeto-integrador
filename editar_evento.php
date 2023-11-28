<!-- 
	Esse arquivo vai dar POST para 
	EDITAR/ALTERAR um evento no banco de dados

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

	<link rel="stylesheet" href="css/criaEvento.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

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

	<body>
        <div class="container p-1">
			<div class="form-container p-1 pt-3 p-sm-5  col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-4">
				<form id="multistepform" name="multistepform" action="conexaoBancoDados/criar_evento.php" method="post" enctype="multipart/form-data">

					<!-- Etapa 1 -->
					<div class="step">
						<div class="infos">
							<h1>Informações</h1>

							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="nomeEvento" placeholder="Nome do evento" name="nome">
								<label for="nomeEvento">Nome do Evento</label>
							</div>

							<div class="alinha mb-3">
								<div class="form-floating">
                                    <input type="number" min="0" class="form-control" id="capMinima" placeholder="Mínimo de inscrições para realização do evento" name="min_pessoas">
									<label for="capMinima">Qtd mín.</label>
								</div>
								<div class="form-floating">
                                    <input type="number" min="1" class="form-control" id="capMaxima" placeholder="Quantidade de vagas" name="max_pessoas">
									<label for="capMaxima">Qtd máx.</label>
								</div>
							</div>

							<div class="form-floating mb-3">
								<textarea class="form-control" id="desc" maxlength="500" name="descricao"></textarea>
								<label for="desc">Descrição</label>
							</div>
						</div>

                        <button type="submit" class="next-btn"><span>Editar</span></button>

					</div>
                </form>
            </div>
        </div>

		<footer>
			<?php include('footer.php') ?>
		</footer>
	</body>

</html>