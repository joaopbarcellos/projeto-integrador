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

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script src="" type="module" defer></script>

	<script src="js/base.js" type="module" defer></script>

	<script src="js/criaEvento.js" defer></script>

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

    <body>
        <div class="container p-1">
			<div class="form-container p-1 pt-3 p-sm-5  col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-4">
				<form id="multi-step-form">

					<!-- Etapa 1 -->
					<div class="step">
						<div class="infos">
							<h1>Informações básicas</h1>
							
							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="nomeEvento" placeholder="Nome do evento">
								<label for="nomeEvento">Nome do Evento</label>
							</div>
								
							<div class="form-floating mb-3">
								<input type="date" class="form-control" id="dataEvento">
								<label for="dataEvento">Data do Evento</label>
							</div>

							<div class="alinha mb-3">
								<div class="form-floating">
									<input type="time" class="form-control" id="horarioInicio">
									<label for="horarioInicio">Horário de Início</label>
								</div>
								<div class="form-floating">
									<input type="time" class="form-control" id="horarioFim">
									<label for="horarioFim">Término Estimado</label>
								</div>
							</div>

							<!-- Preço -->
							<div class="form-floating col-6">
								<input type="text" class="form-control" id="preco" placeholder="R$">
								<label class="form-label" for="preco">Preço do Ingresso</label>		
							</div>

						</div>

						<button class="next-btn"><span>Próximo</span></button>
					</div>

					<!-- Etapa 2 -->
					<div class="step">
						<div class="infos">
							<h1>Localização</h1>

							<!-- Logradouro -->
							<div class="loc mb-3 m-auto mt-3">
								<!-- Cep do Evento -->
								<div class="form-floating col-4">
									<input type="text" class="form-control" id="cepEvento" placeholder="CEP" >
									<label for="cepEvento">CEP</label>
								</div>
									
								<!-- Numero do evento -->
								<div class="form-floating col-4">
									<input type="text" class="form-control" id="cidadeEvento" placeholder="Cidade" oninput="formatCEP()">
									<label for="cidadeEvento">Cidade</label>
								</div>

								<!-- Estado -->
								<div class="form-floating col-3">
									<select class="form-select" id="estadoEvento">
										<option value="1">AC</option>
										<option value="2">AL</option>
										<option value="3">AP</option>
										<option value="4">AM</option>
										<option value="5">BA</option>
										<option value="6">CE</option>
										<option value="7">DF</option>
										<option value="8">ES</option>
										<option value="9">GO</option>
										<option value="10">MA</option>
										<option value="11">MT</option>
										<option value="12">MS</option>
										<option value="13">MG</option>
										<option value="14">PA</option>
										<option value="15">PB</option>
										<option value="16">PR</option>
										<option value="17">PE</option>
										<option value="18">PI</option>
										<option value="19">RJ</option>
										<option value="20">RN</option>
										<option value="21">RS</option>
										<option value="22">RO</option>
										<option value="23">RR</option>
										<option value="24">SC</option>
										<option value="25">SP</option>
										<option value="26">SE</option>
										<option value="27">TO</option>
									</select>
									<label for="estadoEvento">Estado</label>
								</div>
								
							</div>

							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="logradouroEvento" placeholder="Logradouro">
								<label for="logradouroEvento">Logradouro</label>
							</div>
							<div class="alinha mb-3 m-auto" >
								<div class="form-floating col-6">
									<input type="text" class="form-control" id="bairroEvento" placeholder="Bairro">
									<label for="bairroEvento">Bairro</label>
								</div>
								<!-- Bairro -->
								<div class="form-floating espaco">
									<input type="number" min="0" class="form-control" id="numeroEvento" placeholder="Número">
									<label for="numeroEvento">Número</label>
								</div>
							</div>						

							<!-- Complemento -->
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="complementoEvento" placeholder="Complemento">
								<label for="complementoEvento">Complemento</label>
							</div>					


						</div>

						<div class="botoes">
							<button class="prev-btn">
								<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" class="iconevoltarevents">
									<path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></path>
								</svg>
								<span>Anterior</span>
							</button>

							<button class="next-btn"><span>Próximo</span></button>
						</div>
					</div>

					<div class="step">
						<div class="infos">

							<h1>Vagas</h1>

							<div class="alinha mb-3 mt-3">
								<!-- Minimo de inscricoes -->
								<div class="form-floating col-6">
									<input type="number" min="0" class="form-control" id="capMinima" placeholder="Mínimo de inscrições para realização do evento">
									<label for="capMinima">Qtd mín.</label>
								</div>

								<!-- Qtd de vagas -->
								<div class="form-floating espaco">
									<input type="number" min="1" class="form-control" id="capMaxima" placeholder="Quantidade de vagas">
									<label for="capMaxima">Qtd máx.</label>
								</div>
							</div>
							
							<div class="alinha mb-3 col-12 m-auto">
								<!-- Evento recorrente -->
								<div class="form-floating col-5">
									<select class="form-select" id="idadePublico">
										<option value="1">De 3 a 7</option>
										<option value="2">De 8 a 13</option>
										<option value="3">De 14 a 16</option>
										<option value="4">De 17 a 20</option>
										<option value="5">Acima de 18</option>
										<option value="6">De 20 a 30</option>
										<option value="7">De 30 a 40</option>
										<option value="8">Acima de 40</option>
									</select>
									<label for="idadePublico">Idade Alvo</label>
								</div>

								<!-- Intuito do evento -->
								<div class="form-floating espaco">
									<select  class="form-select" id="intuEvento">
										<option>Para toda família</option>
										<option>Profissionais</option>
										<option>Treino para amadores</option>
									</select>
									<label for="intuEvento">Intuito</label>
								</div>	
							</div>

							<div class="intRecor">
								<!-- Evento recorrente -->
								<div class="form-floating col-8 col-sm-6 col-md-5 mb-3">
									<select type="checkbox" class="form-control" id="eveRecorrente">
										<option value="1">Não</option>
										<option value="2">Sim</option>
									</select>
									<label for="eveRecorrente">O Evento é Recorrente?</label>
								</div>

								<div class="form-floating col-12">
									<p id="legendinha">Caso o evento seja recorrente, assinale os dias em que ele se repete</p>
									<div class="btn-group" role="group" id="semana" aria-label="Basic checkbox toggle button group">
										
										<input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
										<label class="btn btn-outline-primary" for="btncheck1">D</label>
										
										<input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
										<label class="btn btn-outline-primary" for="btncheck2">S</label>
										
										<input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
										<label class="btn btn-outline-primary" for="btncheck3">T</label>

										<input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off">
										<label class="btn btn-outline-primary" for="btncheck4">Q</label>

										<input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off">
										<label class="btn btn-outline-primary" for="btncheck5">Q</label>

										<input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off">
										<label class="btn btn-outline-primary" for="btncheck6">S</label>

										<input type="checkbox" class="btn-check" id="btncheck7" autocomplete="off">
										<label class="btn btn-outline-primary" for="btncheck7">S<label>

									</div>		
								</div>
															
							</div>
	
						</div>
					
						<div class="botoes">
							<button class="prev-btn">
								<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" class="iconevoltarevents">
									<path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></path>
								</svg>
								<span>Anterior</span>
							</button>
							
							<button class="btn-53">
								
								<div class="original">Finalizar</div>
								<div class="letters">
									<span>F</span>
									<span>I</span>
									<span>N</span>
									<span>A</span>
									<span>L</span>
									<span>I</span>
									<span>Z</span>
									<span>A</span>
									<span>R</span>
								</div>
							</button>
						</div>
					</div>
				</form>
			</div>
        </div>
		<footer>
		<?php include('footer.php') ?>
	</footer>
	</body>
</html>