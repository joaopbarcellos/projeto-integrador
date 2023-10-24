// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Capturando o botao da tela e adicionando um ouvidor de clique
document.querySelector("#btnEnviar").addEventListener("click", autenticar);

// Capturando os campos de texto
const campoEmail = document.querySelector("#floatingInputGroup1");
const campoSenha = document.querySelector("#floatingInputGroup2");

document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("keypress", (event) => {
    if (event.key == "Enter") {
      autenticar();
    }
  });
});

function autenticar() {
  // Verificando se estao todos os campos certos
  if (campoEmail.value && campoSenha.value) {
    passaTela();
  } else {
    Swal.fire({
      // Alert informando para o usuario que algo esta errado
      title: "ERRO!",
      icon: "error",
      text: "Preencha todos os campos!",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK!",
    });
  }
}

// Funcao para levar para tela de home e setar o usuario logado no sessionStorage
function passaTela() {
  document.querySelector("form").submit();
}

// Ouvidor de cliques para entrar como convidado
document.querySelector("#entrar_conv").addEventListener("click", () => {
  window.location.assign("index.php");
});

const olho = document.querySelector("#olho");
// Mostrar/ocultar senha
olho.addEventListener("click", function () {
  let input = document.querySelector("#floatingInputGroup2");
  if (input.type == "text") {
    input.type = "password";
    olho.src = "./img/olho_aberto.png";
  } else if (input.type == "password") {
    input.type = "text";
    olho.src = "./img/olho_fechado.png";
  }
});