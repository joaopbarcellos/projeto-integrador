<?php
session_start();
?>

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

	<link rel="stylesheet" href="css/editarEvento.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="js/base.js" type="module" defer></script>

	<script src="js/editar_evento.js" type="module" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>

</head>

<?php
date_default_timezone_set("America/Sao_Paulo"); 

require('conexaoBancoDados/conexao_db.php');
require_once('conexaoBancoDados/Carregar/carregar_endereco_evento.php');
require_once('conexaoBancoDados/Carregar/carregar_intuito.php');
require_once('conexaoBancoDados/Carregar/carregar_classificacao.php');
require_once('conexaoBancoDados/Carregar/carregar_intervalo.php');
require_once('conexaoBancoDados/inscrito.php');
require_once('conexaoBancoDados/criador.php');

if (isset($_GET['id_evento'])) {
	$_SESSION["evento_atual"] = trim($_GET['id_evento']);
	$json_data = include_once("conexaoBancoDados/carregar_detalhes_eventos.php");
} else {
	header("location: index.php");
}


$evento = json_decode($json_data, true);
$db_con = null;
?>

<body>
	<!-- Header com a navbar -->
	<header>
		<?php include('header.php') ?>
	</header> <!-- Fechando header -->

	<body>
        <div class="container p-1">
			<div class="form-container p-1 pt-3 p-sm-5  col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-4">
				<form id="multistepform" name="multistepform" action="conexaoBancoDados/editar_evento_criado.php" method="post" enctype="multipart/form-data">
					<div class="step">
						<div class="infos">
							<h1>Informações</h1>

							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="nomeEvento" placeholder="Nome do evento" name="nome" value="<?php echo $evento['nome'];?>">
								<label for="nomeEvento">Nome do Evento</label>
							</div>

							<div class="mb-3">
								<label id="labelimg">Foto do Evento:</label>
								<input class="form-control" type="file" placeholder="Foto do Evento" id="imgevento" accept="image/*" name="foto_evento">
							</div>

							<div class="form-floating mb-3">
								<select class="form-select" id="esporte" name="classificacao">
									<option value="1" <?php if ($evento["id_classificacao"] == 1) echo "selected"?>>Corrida</option>
									<option value="2" <?php if ($evento["id_classificacao"] == 2) echo "selected"?>>Automobilismo</option>
									<option value="3"  <?php if ($evento["id_classificacao"] == 3) echo "selected"?>>Basquete</option>
									<option value="4"  <?php if ($evento["id_classificacao"] == 4) echo "selected"?>>Beach Tennis</option>
									<option value="5"  <?php if ($evento["id_classificacao"] == 5) echo "selected"?>>Bicicross</option>
									<option value="6"  <?php if ($evento["id_classificacao"] == 6) echo "selected"?>>Boxe</option>
									<option value="7"  <?php if ($evento["id_classificacao"] == 7) echo "selected"?>>Capoeira</option>
									<option value="8"  <?php if ($evento["id_classificacao"] == 8) echo "selected"?>>Canoagem</option>
									<option value="9"  <?php if ($evento["id_classificacao"] == 9) echo "selected"?>>Corrida</option>
									<option value="10"  <?php if ($evento["id_classificacao"] == 10) echo "selected"?>>Ciclismo</option>
									<option value="11"  <?php if ($evento["id_classificacao"] == 11) echo "selected"?>>Escalada Esportiva</option>
									<option value="12"  <?php if ($evento["id_classificacao"] == 12) echo "selected"?>>Futebol</option>
									<option value="13"  <?php if ($evento["id_classificacao"] == 13) echo "selected"?>>Futebol Americano</option>
									<option value="14"  <?php if ($evento["id_classificacao"] == 14) echo "selected"?>>Futsal</option>
									<option value="15"  <?php if ($evento["id_classificacao"] == 15) echo "selected"?>>Ginástica Artística</option>
									<option value="16"  <?php if ($evento["id_classificacao"] == 16) echo "selected"?>>Handebol</option>
									<option value="17"  <?php if ($evento["id_classificacao"] == 17) echo "selected"?>>Hipismo</option>
									<option value="18"  <?php if ($evento["id_classificacao"] == 18) echo "selected"?>>Hóquei em Patins</option>
									<option value="19"  <?php if ($evento["id_classificacao"] == 19) echo "selected"?>>Jiu-Jitsu</option>
									<option value="20"  <?php if ($evento["id_classificacao"] == 20) echo "selected"?>>Judô</option>
									<option value="21"  <?php if ($evento["id_classificacao"] == 21) echo "selected"?>>Kitesurf</option>
									<option value="22"  <?php if ($evento["id_classificacao"] == 22) echo "selected"?>>Levantamento de Peso</option>
									<option value="23"  <?php if ($evento["id_classificacao"] == 23) echo "selected"?>>Mergulho</option>
									<option value="24"  <?php if ($evento["id_classificacao"] == 24) echo "selected"?>>MMA</option>
									<option value="25"  <?php if ($evento["id_classificacao"] == 25) echo "selected"?>>Motocross</option>
									<option value="26"  <?php if ($evento["id_classificacao"] == 26) echo "selected"?>>Mountain Bike</option>
									<option value="27"  <?php if ($evento["id_classificacao"] == 27) echo "selected"?>>Natação</option>
									<option value="28"  <?php if ($evento["id_classificacao"] == 28) echo "selected"?>>Natação Sincronizada</option>
									<option value="29"  <?php if ($evento["id_classificacao"] == 29) echo "selected"?>>Pentatlo Moderno</option>
									<option value="30"  <?php if ($evento["id_classificacao"] == 30) echo "selected"?>>Polo Aquático</option>
									<option value="31"  <?php if ($evento["id_classificacao"] == 31) echo "selected"?>>Remo</option>
									<option value="32"  <?php if ($evento["id_classificacao"] == 32) echo "selected"?>>Rugby</option>
									<option value="33"  <?php if ($evento["id_classificacao"] == 33) echo "selected"?>>Rugby em Cadeira de Rodas</option>
									<option value="34"  <?php if ($evento["id_classificacao"] == 34) echo "selected"?>>Skate</option>
									<option value="35"  <?php if ($evento["id_classificacao"] == 35) echo "selected"?>>Surfe</option>
									<option value="36"  <?php if ($evento["id_classificacao"] == 36) echo "selected"?>>Surfe de Remo</option>
									<option value="37"  <?php if ($evento["id_classificacao"] == 37) echo "selected"?>>Taekwondo</option>
									<option value="38"  <?php if ($evento["id_classificacao"] == 38) echo "selected"?>>Tênis</option>
									<option value="39"  <?php if ($evento["id_classificacao"] == 39) echo "selected"?>>Tênis de Mesa</option>
									<option value="40"  <?php if ($evento["id_classificacao"] == 40) echo "selected"?>>Tiro Esportivo</option>
									<option value="41"  <?php if ($evento["id_classificacao"] == 41) echo "selected"?>>Triatlo</option>
									<option value="42"  <?php if ($evento["id_classificacao"] == 42) echo "selected"?>>Vôlei</option>
									<option value="43"  <?php if ($evento["id_classificacao"] == 43) echo "selected"?>>Vôlei de Praia</option>
									<option value="44"  <?php if ($evento["id_classificacao"] == 44) echo "selected"?>>Vôlei Sentado</option>
									<option value="45"  <?php if ($evento["id_classificacao"] == 45) echo "selected"?>>Xadrez</option>
									<option value="46"  <?php if ($evento["id_classificacao"] == 46) echo "selected"?>>Outro</option>
								</select>
								<label for="esporte">Esporte</label>
							</div>

							
							<div class="alinha mb-3">
								<div class="form-floating">
                                    <input type="number" min="0" class="form-control" id="capMinima" placeholder="Mínimo de inscrições para realização do evento" name="min_pessoas" value="<?php echo $evento['min_pessoas'];?>">
									<label for="capMinima">Qtd mín.</label>
								</div>
								<div class="form-floating">
                                    <input type="number" min="1" class="form-control" id="capMaxima" placeholder="Quantidade de vagas" name="max_pessoas" value="<?php echo $evento['max_pessoas'];?>">
									<label for="capMaxima">Qtd máx.</label>
								</div>
							</div>
							
							<div class="form-floating mb-3">
								<textarea class="form-control" id="desc" maxlength="500" name="descricao"><?php echo $evento['descricao'];?></textarea>
								<label for="desc">Descrição</label>
							</div>
						</div>

						<button type="submit" id="salvarEvento" class="salvar">
							<div class="original">Salvar</div>
							<div class="letters">
								<span>S</span>
								<span>A</span>
								<span>L</span>
								<span>V</span>
								<span>A</span>
								<span>R</span>
							</div>
						</button>
					</div>
                </form>
				<?php
					echo '
					<button class="excluir" type="button"  name="'. $evento["id"] .'" id="excluir_evento">
						<span class="excluir__text">Excluir Evento</span>
						<span class="excluir__icon">
							<svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><title></title><path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line><path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
							</svg>
						</span>
					</button>
					';
				?>
			</div>
        </div>

		<footer>
			<?php include('footer.php') ?>
		</footer>
	</body>

</html>
