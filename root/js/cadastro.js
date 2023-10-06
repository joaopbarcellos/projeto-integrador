// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Ouvidor de cliques no botao de cadastro
document.querySelector("#cadastro").addEventListener("click", autenticar);

var todosInputs = document.querySelectorAll("input,select");

for (var i = 0; i < todosInputs.length; i++) {
  // Percorrendo a lista de inputs ate chegar ao numero total (8)
  todosInputs[i].addEventListener("keypress", function (event) {
    // Se a tecla clicada for Enter
    if (event.key == "Enter") {
      event.preventDefault();
      // Pegando os inputs na frente do input focado
      var proxInput = document.querySelector(
        '[tabIndex="' + (this.tabIndex + 1) + '"]'
      );
      // Se nao haver proximos inputs
      if (!proxInput) {
        // Pegando o primeiro input novamente
        proxInput = document.querySelector('[tabIndex="1"]');
      }
      // Dando foco ao proximo input
      proxInput.focus();
    }
  });
}

// Labels de erro
const noNome = document.querySelector("#noNome");
const noPass = document.querySelector("#noPass");
const noConfPass = document.querySelector("#noConfPass");
const noData = document.querySelector("#noData");
const noEmail = document.querySelector("#noEmail");
const passConfPass = document.querySelector("#passConfPass");
const aotPass = document.querySelector("#aotPass");
const aotConfPass = document.querySelector("#aotConfPass");
const noEmailPadrao = document.querySelector("#noEmailPadrao");
const noEmailExiste = document.querySelector("#noEmailExiste");
const passouData = document.querySelector("#passouData");
const noTelefone = document.querySelector("#noTelefone");
const noTelefoneValido = document.querySelector("#noTelefoneValido");

// Campo de nome
const campoNome = document.querySelector("#floatingInputGroup1");

// Campo de email
const campoEmail = document.querySelector("#floatingInputGroup2");

// Campos da data
const campoData = document.querySelector("#idade");

// Campos de senha e confirmar senha
const campoSenha = document.querySelector("#floatingInputGroup3");
const campoConfSenha = document.querySelector("#floatingInputGroup4");

// Campo de telefone
const campoTelefone = document.querySelector("#floatingInputGroup5");

// Labels
const labelEmail = document.querySelector("#email_label");
const labelJogador = document.querySelector(".label_joga");
const labelsJogabilidade = document.querySelectorAll(".jogabilidades");
const labelConf_Senha = document.querySelector("#senha_label_confirma");
const labelSenha = document.querySelector("#senha_label");
const labelNome = document.querySelector("#label_nome");
const labelData = document.querySelector("#labelData");
const labelTelefone = document.querySelector("#telefone_label");

function autenticar() {
  // Funcao para autenticar todos os campos

  // Verificando se todos os campos sao validos
  if (verificaTudo()) {
    // Valor da data de nascimento
    let dataNasc = campoData.value;
    let telefone = campoTelefone.value;
    // Valor do nome
    let nome = campoNome.value;
    // Valor da tipo do jogador
    let jogabilidade = base.jogabilidadeMarcada();

    // Valor do email
    let email = campoEmail.value.toLowerCase();

    // Valores de senha
    let senha = campoSenha.value;

    // Verificando se o email ja foi cadastrado
    let stringJSON = {
      email: email,
      nome: nome,
      telefone: telefone,
      dataNasc: dataNasc,
      senha: senha,
      jogabilidade: jogabilidade,
      eventos_inscritos: [],
      eventos_criados: [],
    };

    // Salvando os dados no localStorage
    salvar(email, stringJSON);

    // Alerta de conta cadastrada
    Swal.fire({
      icon: "success",
      title: "Você foi cadastrado!",
    }).then(() => {
      // Enviando para a pagina de index
      document.querySelector("form").submit();
    });
  }
}
 
function verificaTudo() {
  // Verificando se o campo de nome e vazio
  let verificaNome = base.verificaCampoVazio(campoNome, labelNome, noNome);
  if (verificaNome) verificaNome = base.validarSeNomeTemNumero(campoNome.value, false);
  if (verificaNome) verificaNome = base.validarSeNomeTemCaracterEspecial(campoNome.value, false);

  // Verificando se o campo de email e vazio
  let verificaEmail = base.verificaCampoVazio(
    campoEmail,
    labelEmail,
    noEmail,
    noEmailPadrao,
    noEmailExiste
  );
  if (verificaEmail) {
    // Verificando se o campo de email esta fora dos padroes
    verificaEmail = base.verificaEmailForaPadrao(
      campoEmail,
      noEmail,
      noEmailPadrao,
      noEmailExiste
    );
  }

  if (verificaEmail) {
    // Verificando se o email ja foi cadastrado antes
    verificaEmail = base.emailIgual(campoEmail, noEmailExiste, true);
  }
  // Verificando se o campo de senha e vazio
  let verificaSenha = base.verificaCampoVazio(
    campoSenha,
    labelSenha,
    noPass,
    aotPass
  );
  if (verificaSenha) {
    // Verificando se o campo de senha esta fora dos padroes
    verificaSenha = base.verificaSenhaForaPadrao(
      campoSenha,
      labelSenha,
      aotPass
    );
  }

  // Verificando se o campo de data e vazio
  let verificaData = base.verificaCampoVazio(
    campoData,
    labelData,
    noData,
    passouData,
    false,
    campoData
  );
  if (verificaData) {
    // Verificando se a data informada for valida (< do que o dia atual)
    verificaData = base.dataErrada(campoData, labelData, passouData);
  }

  // Verificando se o campo de confirmar senha e vazio
  let verificaConfSenha = base.verificaCampoVazio(
    campoConfSenha,
    labelConf_Senha,
    noConfPass,
    aotConfPass
  );
  if (verificaConfSenha) {
    // Verificando se o campo de confirmar senha esta fora dos padroes
    verificaConfSenha = base.verificaSenhaForaPadrao(
      campoConfSenha,
      labelConf_Senha,
      aotConfPass
    );
  }
  if (verificaConfSenha) {
    // Verificando se a senha e igual ao confirmar senha
    verificaConfSenha = base.verificaSenhaSalva(
      campoSenha,
      campoConfSenha,
      labelConf_Senha,
      labelSenha,
      passConfPass
    );
  }

  // Verificando a jogabilidade
  let verJog = base.verificaJogabilidade(
    labelJogador,
    labelsJogabilidade,
    noJogabilidade
  );

  // Verificando o numero de telefone
  let verificaTelefone = base.verificaCampoVazio(
    campoTelefone,
    labelTelefone,
    noTelefone,
    noTelefoneValido
  );

  if (verificaTelefone) {
    verificaTelefone = base.verificaTelefoneValido(
      campoTelefone,
      noTelefone,
      noTelefoneValido
    );
  }

  let listaTudo = [
    verificaConfSenha,
    verificaData,
    verificaEmail,
    verJog,
    verificaNome,
    verificaSenha,
    verificaTelefone,
  ];
  // Verificando se todos os elementos sao validos
  return listaTudo.every((element) => element);
}

function salvar(email, stringJSON) {
  // Salvando no localStorage a stringJson com a chave de email
  localStorage.setItem(email, JSON.stringify(stringJSON));
}

let voltar = document.querySelector(".cssbuttons-io-button");
if (voltar) {
  // Adicionando o ouvidor do evento para se inscrever
  voltar.addEventListener("click", () => {
    window.history.back();
  });
}

const olho1 = document.querySelector("#olho");
// Mostrar/ocultar senha
olho1.addEventListener("click", function () {
  let input = document.querySelector("#floatingInputGroup3");
  if (input.type == "text") {
    input.type = "password";
    olho1.src = "./img/olho_aberto.png";
  } else if (input.type == "password") {
    input.type = "text";
    olho1.src = "./img/olho_fechado.png";
  }
});

const olho2 = document.querySelector("#olho2");
// Mostrar/ocultar senha
olho2.addEventListener("click", function () {
  let input = document.querySelector("#floatingInputGroup4");
  if (input.type == "text") {
    input.type = "password";
    olho2.src = "./img/olho_aberto.png";
  } else if (input.type == "password") {
    input.type = "text";
    olho2.src = "./img/olho_fechado.png";
  }
});
