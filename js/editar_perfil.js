// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Pegando os dados do usuario logado
var emailLogado = document.querySelector("#nome_usuario").innerHTML;

// Pegando os campos na tela
const campoNome = document.querySelector("#floatingInputGroup1");
const campoEmail = document.querySelector("#floatingInputGroup2");
const campoDataNasc = document.querySelector("#idade");
const campoTelefone = document.querySelector("#floatingInputGroup5");
const radios = document.querySelectorAll(".radio");

// Pegando os labels de nome e email
const labelNome = document.querySelector("#label_nome");
const labelData = document.querySelector("#labelData");
const labelJogador = document.querySelector(".label_joga");
const labelsJogabilidade = document.querySelectorAll(".jogabilidades");
const labelTelefone = document.querySelector("#label_telefone");

// Pegando as labels de erro
const noNome = document.querySelector("#noNome");
const noData = document.querySelector("#noData");
const noJogabilidade = document.querySelector("#noJogabilidade");
const passouData = document.querySelector("#passouData");
const noTelefone = document.querySelector("#noTelefone");
const noTelefoneValido = document.querySelector("#noTelefoneValido");

// Funcao para preencher automaticamente os campos com os dados do usuario
function preencherAuto() {
  let radioMarcada = document.querySelector("#jogabilidade_invisivel").innerText;

  // Mudando a classe dos labels para fins esteticos
  labelNome.classList.add("focado");

  // Selecionando qual e o nivel do jogador
  radios.forEach((radio) => {
    if (radio.children[0].id == radioMarcada) {
      radio.children[0].checked = true;
    }
  });
}

// chamando a funcao
preencherAuto();

function verificaTudo() {
  // Verificando se o campo de nome e vazio
  let verificaNome = base.verificaCampoVazio(campoNome, labelNome, noNome);

  // Verificando se o campo de data e vazio
  let verDataNasc = base.verificaCampoVazio(
    campoDataNasc,
    labelData,
    noData,
    passouData,
    false,
    campoDataNasc
  );
  if (verDataNasc) {
    // Verificando se a data informada for valida (< do que o dia atual)
    verDataNasc = base.dataErrada(campoDataNasc, labelData, passouData);
  }

  // Verificando se uma jogabilidade foi marcada
  let verjog = base.verificaJogabilidade(
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

  let listaTudo = [verificaNome, verDataNasc, verjog, verificaTelefone];
  // Verificando se todos os elementos sao validos
  return listaTudo.every((element) => element);
}

// Pegando o botao de editar
const btnEditar = document.querySelector("#alterar");

btnEditar.addEventListener("click", autenticar);

document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("keypress", (event) => {
    if (event.key == "Enter") {
      // Chamando a funcao quando o usuario apertar enter em qualquer campo
      autenticar();
    }
  });
});

function autenticar() {
  // Verificando se todos os campos estao preenchidos corretamente
  if (verificaTudo()) {
    Swal.fire({
      // Perguntando para o usuario se ele deseja editar suas informacoes
      icon: "question",
      text: "Deseja editar suas informações?",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Sim",
      cancelButtonColor: "#d33",
      showCancelButton: true,
      cancelButtonText: "Não",
    }).then((result) => {
      if (result.isConfirmed) {
        document.querySelector("form").submit();
      }
    });
  }
}

let voltar = document.querySelector(".cssbuttons-io-button");
if (voltar) {
  // Adicionando o ouvidor do evento para se inscrever
  voltar.addEventListener("click", () => {
    window.location.assign("perfil.php");
  });
}
