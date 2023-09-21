<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="logos/icon.png" />
    <title>Time In</title>
    <link rel="stylesheet" href="css/cadastro.css" />
    <link rel="stylesheet" href="css/base.css" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />

    <script src="js/cadastro.js" type="module" defer></script>

    <script src="js/base.js" type="module" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

    <link
      href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css"
      rel="stylesheet"
    />
  </head>

  <body>
    <header class="d-none d-lg-block">
      <!-- Header com imagem dentro de um link -->
      <a href="index.php"> <img src="logos/11.png"/> </a>
    </header>

    <!-- Div que ficara com o formulário -->
    <div class="div_cadastro mt-5 col-lg-4 col-10 m-auto">
      <div>
        <a href="login.php" id="voltar">
          <svg
            class="img_voltar"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512"
          >
            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path
              d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"
            />
          </svg>
        </a>
      </div>

      <!-- Div para estilizar o formulário -->
      <div class="formulario">
        <!-- Criando fomulário de Cadastro -->
        <form method="post" action="enviarDadosCadastro.php">
          <legend class="p-3 text-center fs-1">Cadastro</legend>

          <!-- Nome do usuário -->
          <div class="nome campos">
            <!-- Div com o input de nome -->
            <div class="form-floating fs-5">
              <input
                type="text"
                class="form-control"
                id="floatingInputGroup1"
                placeholder="Nome"
                name="nomeCampo"
                tabindex="1"
              />
              <label for="nome" id="label_nome">Nome</label>
            </div>

            <!-- Mensagem de erro -->
            <label class="erro" id="noNome">Nome deve ser preenchido!</label>
          </div>
          <!-- Fechando div de nome -->

          <!-- E-mail do usuário -->
          <div class="email campos">
            <!-- Div com o input de email -->
            <div class="form-floating fs-5">
              <input
                type="email"
                class="form-control"
                id="floatingInputGroup2"
                placeholder="E-mail"
                name="emailCampo"
                tabindex="2"
              />
              <label for="email" id="email_label">E-mail</label>
            </div>

            <!-- Mensagens de erro -->
            <label class="erro" id="noEmail">E-mail deve ser preenchido!</label>

            <label class="erro" id="noEmailPadrao">
              E-mail está fora dos padrões!</label>

            <label class="erro" id="noEmailExiste">
              E-mail já está cadastrado!</label>
          </div>
          <!-- Fechando div de email -->
          
          <div class="telefone campos">
            <!-- Div com o input de telefone -->
            <div class="form-floating fs-5">
              <input type="text" class="form-control" id="floatingInputGroup5" placeholder="Telefone" name="telefoneCampo" tabindex="2">
              <label for="floatingInputGroup5" id="telefone_label">Telefone</label>
            </div>
          </div>

          <!-- Idade do usuário -->
          <div class="idade campos fs-5">
            <!-- Label e input da idade -->
            <label for="idade" id="labelData">Data de Nascimento:</label>
            <input type="date" id="idade" name="dataCampo" tabindex="3"/>

            <!-- Mensagem de erro -->
            <label class="erro" id="noData">Data deve ser preenchida!</label>

            <label class="erro" id="passouData">Data inválida!</label>
          </div>
          <!-- Fechando div de idade -->

          <!-- Senha do usuário -->
          <div class="senha campos">
            <!-- Div com o input de senha -->
            <div class="form-floating fs-5">
              <img src="img/olho_aberto.png" id="olho" class="olho" />
              <input
                type="password"
                class="form-control"
                id="floatingInputGroup3"
                placeholder="Senha"
                name="senhaCampo"
                tabindex="4"
              />
              <label for="senha" id="senha_label">Senha</label>
            </div>

            <!-- Mensagens de erro -->
            <label class="erro" id="noPass">Senha deve ser preenchida!</label>

            <label class="erro" id="aotPass"
              >Senha deve ter 6 a 30 caracteres!</label
            >
          </div>
          <!-- Fechando div de senha -->

          <!-- Confirmação de senha do usuário -->
          <div class="confir_senha campos fs-5">
            <!-- Div com input de confirmacao de senha -->
            <div class="form-floating">
              <img src="img/olho_aberto.png" id="olho2" class="olho" />
              <input
                type="password"
                class="form-control"
                id="floatingInputGroup4"
                placeholder="Confirmação de senha"
                name="confsenhaCampo"
                tabindex="5"
              />
              <label for="confirmasenha" id="senha_label_confirma">
                Confirmação de senha</label>
            </div>

            <!-- Mensagens de erro -->
            <label class="erro" id="noConfPass"
              >Confirmar senha deve ser preenchida!</label
            >

            <label class="erro" id="aotConfPass"
              >Confirmar senha deve ter 6 a 30 caracteres!</label
            >

            <label class="erro" id="passConfPass"
              >Confirme a senha corretamente!</label
            >
          </div>
          <!-- Fechando div de confirmação de senha -->

          <!-- Div experiencia -->
          <div class="joga campos">
            <!-- Div com input de experiencia -->
            <div class="jogabilidade fs-5">
              <!-- Grau de experiencia -->
              <label for="jogabilidade" class="label_joga">Jogador:</label>

              <div class="radios">
                <!-- Profissional-->
                <div class="radio profissa">
                  <input
                    type="radio"
                    id="Profissional"
                    name="jogabilidade"
                    class="bolaRadio"
                    tabindex="6"
                  />

                  <label class="jogabilidades" for="Profissional">
                    Profissional
                  </label>
                </div>

                <!-- Amador -->
                <div class="radio amad">
                  <input
                    type="radio"
                    id="Amador"
                    name="jogabilidade"
                    class="bolaRadio"
                    tabindex="7"
                  />

                  <label class="jogabilidades" for="Amador"> Amador </label>
                </div>

                <!--Iniciante -->
                <div class="radio inic">
                  <input
                    type="radio"
                    id="Iniciante"
                    name="jogabilidade"
                    class="bolaRadio"
                    tabindex="8"
                  />

                  <label class="jogabilidades" for="Iniciante">
                    Iniciante
                  </label>
                </div>

                <!-- Mensagem de erro -->
                <label class="erro" id="noJogabilidade"
                  >Nível de experiência deve ser escolhido!</label
                >

                <!-- Fim da div radios -->
              </div>

              <!-- Fim da div jogabilidade -->
            </div>

            <!-- Fim da div joga -->
          </div>
        </form>

        <!-- Botão para cadastrar usuário, está fora do form para não resetar a página ao clicar-->
        <button class="btn-cadastra mb-4 mt-3 p-2 rounded-3" id="cadastro" tabindex="9">
          CADASTRAR
        </button>
      </div>
    </div>
    
  </body>
</html>
